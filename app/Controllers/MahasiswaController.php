<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\UserModel;
use CodeIgniter\Controller;
use App\Models\TransactionModel;

class MahasiswaController extends Controller
{
    public function index()
    {
        $session = session();
        $user = $session->get('user');

        // Ambil saldo dari database
        $userModel = new UserModel();
        $userData = $userModel->find($user['id']);
        $saldo = $userData['saldo'];

        // Ambil data produk
        $productModel = new ProductModel();
        $products = $productModel->findAll();

        // Ambil riwayat transaksi mahasiswa
        $transactionModel = new TransactionModel();
        $transactions = $transactionModel->select('transactions.*, products.product_name')
            ->join('products', 'products.id = transactions.product_id')
            ->where('transactions.user_id', $user['id'])
            ->findAll();

        // Kirim saldo, produk, dan transaksi ke view
        return view('dashboard/mahasiswa', [
            'products' => $products,
            'saldo' => $saldo,
            'transactions' => $transactions // Kirim variabel $transactions ke view
        ]);
    }

    public function buyProduct($id)
    {
        $session = session();
        $user = $session->get('user');
        $userModel = new UserModel();
        $productModel = new ProductModel();
        $transactionModel = new TransactionModel();

        // Dapatkan detail produk yang akan dibeli
        $product = $productModel->find($id);

        // Jika produk tidak ditemukan, kembali ke dashboard dengan pesan error
        if (!$product) {
            return redirect()->to('/dashboard-mahasiswa')->with('error', 'Produk tidak ditemukan!');
        }

        // Ambil saldo terbaru dari database
        $userData = $userModel->find($user['id']);
        $currentSaldo = $userData['saldo'];

        // Dapatkan kuantitas dari input form
        $quantity = $this->request->getPost('quantity');

        // Validasi kuantitas, minimal harus 1
        if (!$quantity || $quantity < 1) {
            return redirect()->to('/dashboard-mahasiswa')->with('error', 'Kuantitas harus minimal 1!');
        }

        // Hitung total harga berdasarkan kuantitas
        $totalPrice = $product['price'] * $quantity;

        // Periksa apakah saldo cukup untuk melakukan pembelian
        if ($currentSaldo >= $totalPrice) {
            // Kurangi saldo mahasiswa
            $newSaldo = $currentSaldo - $totalPrice;
            $userModel->update($user['id'], ['saldo' => $newSaldo]);

            // Simpan transaksi dengan kuantitas
            $transactionModel->insert([
                'user_id' => $user['id'],
                'product_id' => $product['id'],
                'total_price' => $totalPrice,
                'quantity' => $quantity,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            // Perbarui session saldo setelah transaksi berhasil
            $session->set('user', array_merge($user, ['saldo' => $newSaldo]));

            // Redirect ke dashboard mahasiswa dengan pesan sukses
            return redirect()->to('/dashboard-mahasiswa')->with('message', 'Pembelian berhasil!');
        } else {
            // Redirect ke dashboard mahasiswa jika saldo tidak mencukupi
            return redirect()->to('/dashboard-mahasiswa')->with('error', 'Saldo tidak mencukupi!');
        }
    }

    // Fungsi untuk menampilkan struk pembelian
    public function receipt($transaction_id)
    {
        $transactionModel = new TransactionModel();
        $productModel = new ProductModel();

        // Ambil data transaksi berdasarkan ID
        $transaction = $transactionModel->find($transaction_id);

        if ($transaction) {
            // Ambil detail produk yang dibeli
            $product = $productModel->find($transaction['product_id']);

            // Kirim data transaksi dan produk ke view struk
            return view('dashboard/receipt', [
                'transaction' => $transaction,
                'product' => $product
            ]);
        } else {
            // Jika transaksi tidak ditemukan, kembali ke dashboard
            return redirect()->to('/dashboard-mahasiswa')->with('error', 'Transaksi tidak ditemukan');
        }
    }
}
