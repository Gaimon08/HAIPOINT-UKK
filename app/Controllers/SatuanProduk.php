<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MSProduk;
use CodeIgniter\HTTP\ResponseInterface;

class Satuanproduk extends BaseController
{
    public function index()
    {
        $data = [
            'listSProduk' => $this->satuan_produk->findAll(),
            'judulHalaman' => 'Data Satuan Produk'
        ];

        return view('Produk/satuan_produk/list-satuan-produk', $data);
    }

    public function simpanSatuanProduk()
    {
        $data = [

            'nama_satuan' => $this->request->getVar('nama_satuan')
        ];

        $this->satuan_produk->save($data);
        session()->setFlashdata('pesan', 'data satuan produk berhasil disimpan!');
        return redirect()->to('/list-satuan-produk');
    }

    public function updateSatuanProduk()
    {

        $data = [
            'id_satuan' => $this->request->getVar('id_satuan'),
            'nama_satuan' => $this->request->getVar('nama_satuan')
        ];
        //var_dump($data);

        $this->satuan_produk->update($this->request->getVar('id_satuan'), $data);
        session()->setFlashdata('pesan', 'data satuan produk berhasil diupdate!');
        return redirect()->to('/list-satuan-produk');
    }

    public function hapusSatuan()
    {
        $id = $this->request->getPost('id_satuan');
        $this->satuan_produk->deleteSProduk($id);
        session()->setFlashdata('pesan', 'data satuan produk berhasil dihapus!');
        return redirect()->to('/list-satuan-produk');
    }
}
