<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SupplierController extends BaseController
{
    public function index()
    {
        $data = [
            'listSupplier' => $this->supplier->findAll(),
            'judulHalaman' => 'Data Supplier',
            'titleModal' => 'Form Tambah Data Supplier',
        ];

        return view('Supplier/supplier', $data);
    }

    public function simpanSupplier()
    {

        $data = [
            'nama_supplier' => $this->request->getVar('nama_supplier'),
            'alamat_supplier' => $this->request->getVar('alamat_supplier'),
            'wa_supplier' => $this->request->getVar('wa_supplier'),
        ];
        $this->supplier->save($data);
        session()->setFlashdata('pesan', 'data Supplier berhasil disimpan!');
        return redirect()->to('/list-supplier');
    }

    public function updateSupplier()
    {

        $data = [
            'id_supplier' => $this->request->getVar('id_supplier'),
            'nama_supplier' => $this->request->getVar('nama_supplier'),
            'alamat_supplier' => $this->request->getVar('alamat_supplier'),
            'wa_supplier' => $this->request->getVar('wa_supplier'),
        ];

        $this->supplier->update($this->request->getVar('id_supplier'), $data);
        session()->setFlashdata('pesan', 'data Supplier berhasil diupdate!');
        return redirect()->to('/list-supplier');
    }

    public function hapusSupplier()
    {
        $id = $this->request->getPost('id_supplier');
        $this->supplier->deleteSupplier($id);
        session()->setFlashdata('pesan', 'data supplier berhasil dihapus!');
        return redirect()->to('/list-supplier');
    }
}
