<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class RoleController extends BaseController
{
    public function index()
    {
        $data = [
            'listJProduk' => $this->jenis_produk->findAll(),
            'judulHalaman' => 'Data Jenis Produk'
        ];

        return view('Produk/jenis_produk/list-jenis-produk', $data);
    }

    public function editUser($idUser)
    {

        $syarat = [
            'id' => $idUser
        ];

        $data = [

            'introText' => '<p>Silahkan masukan data pengguna pada form dibawa ini.</p>',
            'judulHalaman' => 'Edit Data Pengguna',
            'user' => $this->user->where($syarat)->findAll()
        ];


        return view('User/edit-user', $data);
    }
}
