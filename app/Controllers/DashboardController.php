<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProductModel;
use App\Models\UserModel;

class DashboardController extends Controller
{
    public function index()
    {
        $session = session();
        $user = $session->get('user');

        if ($user['role'] == 'admin') {
            // Dashboard untuk admin
            $productModel = new ProductModel();
            $products = $productModel->findAll();
            return view('dashboard/admin', ['products' => $products]);
        } else {
            // Dashboard untuk mahasiswa
            $userModel = new UserModel();
            $userData = $userModel->find($user['id']);
            $saldo = $userData['saldo'];  // Ambil saldo mahasiswa dari database

            $productModel = new ProductModel();
            $products = $productModel->findAll();

            // Kirimkan data saldo dan produk ke view mahasiswa
            return view('dashboard/mahasiswa', ['products' => $products, 'saldo' => $saldo]);
        }
    }
}
