<?php

namespace App\Controllers;

use App\Models\TopupModel;
use App\Models\UserModel;
use Midtrans\Config;
use Midtrans\Snap;

class TopupController extends BaseController
{
    public function index()
    {
        return view('dashboard/topup');
    }

    public function createTransaction()
    {
        // Ambil user dari session
        $user = session()->get('user');

        // Ambil nominal topup dari input
        $amount = $this->request->getPost('amount');

        // Konfigurasi Midtrans
        $midtransConfig = new \Config\Midtrans();
        Config::$serverKey = $midtransConfig->serverKey;
        Config::$isProduction = $midtransConfig->isProduction;
        Config::$isSanitized = $midtransConfig->isSanitized;
        Config::$is3ds = $midtransConfig->is3ds;

        // Buat parameter transaksi
        $params = [
            'transaction_details' => [
                'order_id' => uniqid(), // Gunakan uniqid() untuk membuat ID unik
                'gross_amount' => (int)$amount,
            ],
            'customer_details' => [
                'first_name' => $user['username'],
                'email' => 'email@example.com', // Bisa diambil dari database user jika ada
            ],
        ];

        // Generate Snap Token
        $snapToken = Snap::getSnapToken($params);

        // Simpan transaksi topup ke database
        $topupModel = new TopupModel();
        $topupModel->insert([
            'user_id' => $user['id'],
            'amount' => $amount,
            'status' => 'pending',
            'transaction_id' => $params['transaction_details']['order_id'], // Transaction ID dari Midtrans
        ]);

        // Kirim token Snap ke view
        return view('dashboard/confirm_topup', ['snapToken' => $snapToken, 'order_id' => $params['transaction_details']['order_id']]);
    }

    public function checkTransactionStatus($transaction_id)
    {
        // Konfigurasi Midtrans
        $midtransConfig = new \Config\Midtrans();
        \Midtrans\Config::$serverKey = $midtransConfig->serverKey;

        // Ambil status transaksi dari Midtrans
        $status = \Midtrans\Transaction::status($transaction_id);

        if ($status->transaction_status == 'settlement') {
            // Jika transaksi sukses, tambahkan saldo user
            $userModel = new \App\Models\UserModel();
            $topupModel = new \App\Models\TopupModel();

            // Ambil data topup dari database
            $topup = $topupModel->where('transaction_id', $transaction_id)->first();

            // Update status transaksi ke 'success'
            $topupModel->updateStatus($transaction_id, 'success');

            // Ambil data user dari tabel users
            $user = $userModel->find($topup['user_id']);

            // Hitung saldo baru
            $newSaldo = $user['saldo'] + $topup['amount'];

            // Update saldo di tabel users
            $userModel->update($user['id'], ['saldo' => $newSaldo]);

            // Redirect ke dashboard
            return redirect()->to('/dashboard')->with('message', 'Topup berhasil!');
        } else {
            // Jika status bukan settlement
            return redirect()->to('/dashboard')->with('error', 'Topup gagal! Status: ' . $status->transaction_status);
        }
    }


    private function processTransactionStatus($transaction_id, $transaction_status)
{
    $userModel = new UserModel();
    $topupModel = new TopupModel();

    // Jika transaksi sukses (settlement), tambahkan saldo user
    if ($transaction_status === 'settlement') {
        // Cari transaksi di database berdasarkan transaction_id
        $topup = $topupModel->where('transaction_id', $transaction_id)->first();

        // Pastikan transaksi ditemukan dan belum diproses
        if ($topup && $topup['status'] === 'pending') {
            // Debugging: cek data transaksi
            error_log('Topup ditemukan, transaction_id: ' . $transaction_id);

            // Update status transaksi menjadi 'success'
            if ($topupModel->updateStatus($transaction_id, 'success')) {
                error_log('Update status sukses');

                // Ambil user dari database
                $user = $userModel->find($topup['user_id']);

                // Cek apakah user dan saldo valid
                if ($user && isset($user['saldo'])) {
                    $newSaldo = $user['saldo'] + $topup['amount'];

                    // Debugging: cek saldo user sebelum diupdate
                    error_log('Saldo sebelum: ' . $user['saldo']);
                    error_log('Jumlah topup: ' . $topup['amount']);
                    error_log('Saldo setelah: ' . $newSaldo);

                    // Cek apakah data saldo valid sebelum update
                    if ($newSaldo >= 0) {
                        // Debugging: memastikan saldo yang di-update tidak kosong
                        error_log('Update saldo user ID: ' . $user['id'] . ', saldo baru: ' . $newSaldo);

                        // Update saldo user
                        $updateStatus = $userModel->update($user['id'], ['saldo' => $newSaldo]);

                        // Cek apakah update saldo berhasil
                        if ($updateStatus) {
                            error_log('Saldo berhasil diupdate untuk user ID: ' . $user['id']);
                            return redirect()->to('/dashboard')->with('message', 'Topup berhasil dan saldo telah ditambahkan.');
                        } else {
                            error_log('Gagal mengupdate saldo untuk user ID: ' . $user['id']);
                            return redirect()->to('/dashboard')->with('error', 'Gagal mengupdate saldo.');
                        }
                    } else {
                        error_log('Saldo baru tidak valid.');
                        return redirect()->to('/dashboard')->with('error', 'Saldo baru tidak valid.');
                    }
                } else {
                    error_log('User tidak ditemukan atau saldo tidak valid untuk user ID: ' . $topup['user_id']);
                    return redirect()->to('/dashboard')->with('error', 'User tidak ditemukan atau saldo tidak valid.');
                }
            } else {
                error_log('Gagal mengupdate status transaksi.');
                return redirect()->to('/dashboard')->with('error', 'Gagal mengupdate status transaksi.');
            }
        } else {
            error_log('Transaksi sudah diproses atau tidak ditemukan.');
            return redirect()->to('/dashboard')->with('message', 'Transaksi sudah diproses atau tidak ditemukan.');
        }
    } else if ($transaction_status === 'pending') {
        error_log('Pembayaran masih dalam status pending.');
        return redirect()->to('/dashboard')->with('message', 'Pembayaran masih dalam status pending.');
    } else {
        error_log('Pembayaran gagal atau dibatalkan.');
        return redirect()->to('/dashboard')->with('error', 'Pembayaran gagal atau dibatalkan.');
    }
}

}
