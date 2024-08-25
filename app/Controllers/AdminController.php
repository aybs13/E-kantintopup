<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\TransactionModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class AdminController extends Controller
{
    public function index()
    {
        setlocale(LC_TIME, 'id_ID.UTF-8'); // Set locale untuk menampilkan tanggal dalam format Indonesia

        // Ambil data produk
        $productModel = new ProductModel();
        $products = $productModel->findAll();

        // Ambil data user
        $userModel = new UserModel();
        $users = $userModel->findAll(); // Pastikan user diambil dari model

        // Kirim data produk, user ke view
        return view('dashboard/admin', [
            'products' => $products,
            'users' => $users // Kirim variabel $users ke view
        ]);
    }

    public function addProduct()
    {
        return view('dashboard/add_product');
    }

    public function saveProduct()
    {
        $productModel = new ProductModel();

        // Ambil input nama produk dan harga
        $productName = $this->request->getPost('product_name');
        $price = $this->request->getPost('price');

        // Proses upload gambar
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Beri nama unik untuk gambar dan pindahkan ke folder uploads
            $imageName = $file->getRandomName();
            $file->move('uploads', $imageName);

            // Simpan data produk beserta gambar ke database
            $productModel->insert([
                'product_name' => $productName,
                'price' => $price,
                'image' => $imageName
            ]);

            return redirect()->to('/dashboard')->with('message', 'Produk berhasil ditambahkan');
        } else {
            // Handle error jika gagal upload
            return redirect()->back()->with('error', 'Gagal mengupload gambar. Pastikan gambar diunggah.');
        }
    }

    public function editProduct($id)
    {
        $productModel = new ProductModel();
        $product = $productModel->find($id);
        return view('dashboard/edit_product', ['product' => $product]);
    }

    public function updateProduct($id)
    {
        $productModel = new ProductModel();
        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'price' => $this->request->getPost('price'),
        ];

        // Proses upload gambar jika ada file baru yang diunggah
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Hapus gambar lama jika ada
            $oldProduct = $productModel->find($id);
            if ($oldProduct['image']) {
                unlink('uploads/' . $oldProduct['image']); // Hapus gambar lama dari folder
            }

            // Pindahkan gambar baru ke folder uploads
            $imageName = $file->getRandomName();
            $file->move('uploads', $imageName);

            // Tambahkan nama file gambar baru ke data yang akan diupdate
            $data['image'] = $imageName;
        }

        // Update data produk
        $productModel->update($id, $data);
        return redirect()->to('/dashboard')->with('message', 'Produk berhasil diupdate');
    }

    public function deleteProduct($id)
    {
        $productModel = new ProductModel();
        
        // Hapus gambar yang terkait dengan produk
        $product = $productModel->find($id);
        if ($product && $product['image']) {
            unlink('uploads/' . $product['image']); // Hapus gambar dari folder
        }

        // Hapus produk dari database
        $productModel->delete($id);
        return redirect()->to('/dashboard')->with('message', 'Produk berhasil dihapus');
    }

    // Fungsi untuk menampilkan form tambah user
    public function addUser()
    {
        return view('dashboard/add_user');
    }

    // Fungsi untuk menyimpan user baru
    public function saveUser()
    {
        $userModel = new UserModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'), // Simpan password tanpa hash
            'role' => $this->request->getPost('role')
        ];

        $userModel->insert($data);
        return redirect()->to('/dashboard')->with('message', 'User berhasil ditambahkan');
    }

}
