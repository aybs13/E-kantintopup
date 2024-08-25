<?php

namespace App\Models;

use CodeIgniter\Model;

class TopupModel extends Model
{
    protected $table = 'topups';
    protected $allowedFields = ['user_id', 'amount', 'status', 'transaction_id', 'created_at'];

    public function updateStatus($transaction_id, $status)
{
    // Ambil transaksi yang sesuai dengan transaction_id
    $topup = $this->where('transaction_id', $transaction_id)->first();

    if ($topup) {
        // Hanya lakukan update jika statusnya belum sama dengan $status baru
        if ($topup['status'] !== $status) {
            if (!empty($status)) {
                return $this->where('transaction_id', $transaction_id)->set(['status' => $status])->update();
            } else {
                error_log('Status kosong, tidak melakukan update');
                return false;
            }
        } else {
            error_log('Status sudah sesuai, tidak perlu update');
            return true; // Status sudah sesuai, tidak perlu update
        }
    } else {
        error_log('Transaksi tidak ditemukan untuk transaction_id: ' . $transaction_id);
        return false; // Transaksi tidak ditemukan
    }
}



}
