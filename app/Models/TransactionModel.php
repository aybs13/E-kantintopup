<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transactions';
    protected $allowedFields = ['user_id', 'product_id', 'total_price', 'created_at', 'quantity'];
}
