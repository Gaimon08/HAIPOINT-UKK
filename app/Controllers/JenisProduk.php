<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\MJProduk;

class JenisProduk extends BaseController
{
    public function index()
    {
        $data = [
            'listJProduk' => $this->jenis_produk->findAll(),
            'judulHalaman' => 'Data Jenis Produk'
        ];

        return view('Produk/jenis_produk/list-jenis-produk', $data);
    }

    public function simpanJenisProduk()
    {
        $data = [

            'nama_jenis' => $this->request->getVar('nama_jenis')
        ];

        $this->jenis_produk->save($data);
        session()->setFlashdata('pesan', 'data jenis produk berhasil disimpan!');
        return redirect()->to('/list-jenis-produk');
    }

    public function updateJenisProduk()
    {

        $data = [
            'id_jenis_produk' => $this->request->getVar('id_jenis_produk'),
            'nama_jenis' => $this->request->getVar('nama_jenis')
        ];
        //var_dump($data);

        $this->jenis_produk->update($this->request->getVar('id_jenis_produk'), $data);
        session()->setFlashdata('pesan', 'data jenis produk berhasil diupdate!');
        return redirect()->to('/list-jenis-produk');
    }

    public function hapusJenis()
    {
        $id = $this->request->getPost('id_jenis_produk');
        $this->jenis_produk->deleteJProduk($id);
        session()->setFlashdata('pesan', 'data kategori produk berhasil dihapus!');
        return redirect()->to('/list-jenis-produk');
    }
}
