<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $allowedFields = ['product_name', 'price', 'image'];
    protected $useTimestamps = true;
}
