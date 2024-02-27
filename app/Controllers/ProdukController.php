<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Picqer;

class ProdukController extends BaseController
{
    public function index()
    {
        $data = [
            'data' => $this->produk->getAllproduk(),
            'listProduk' => $this->produk->getAllproduk(),
            'listJenis' => $this->jenis_produk->findAll(),
            'listSatuan' => $this->satuan_produk->findAll(),
            'judulHalaman' => 'Data Produk'
        ];

        return view('produk/list-produk', $data);
    }

    public function simpanproduk()
    {
        $data = [
            'barcode' => $this->request->getVar('barcode'),
            'nama_produk' => $this->request->getVar('nama_produk'),
            'id_jenis_produk' => $this->request->getVar('jenis_produk'),
            'id_satuan' => $this->request->getVar('satuan'),
            'stok' => $this->request->getVar('stok'),
            'harga_beli'            => str_replace(['Rp. ', '.', ','], '',  $this->request->getVar('harga_beli')),
            'harga_jual'            => str_replace(['Rp. ', '.', ','], '',  $this->request->getVar('harga_jual'))
        ];

        $this->produk->save($data);
        session()->setFlashdata('pesan', 'data produk berhasil disimpan!');
        return redirect()->to('/list-produk');
    }

    public function updateproduk()
    {

        $data = [
            'barcode'               => $this->request->getVar('barcode'),
            'nama_produk'           => $this->request->getVar('nama_produk'),
            'id_jenis_produk'        => $this->request->getVar('jenis_produk'),
            'id_satuan'             => $this->request->getVar('satuan'),
            'stok'                  => $this->request->getVar('stok'),
            'harga_beli'            => str_replace(['Rp ', '.', ','], '',  $this->request->getVar('harga_beli')),
            'harga_jual'            => str_replace(['Rp ', '.', ','], '',  $this->request->getVar('harga_jual'))
        ];

        $this->produk->update($this->request->getVar('id_produk'), $data);
        session()->setFlashdata('pesan', 'data produk berhasil diupdate!');
        return redirect()->to('/list-produk');
    }

    public function hapusproduk()
    {
        $id = $this->request->getPost('id_produk');
        $this->produk->deleteProduct($id);
        session()->setFlashdata('pesan', 'data produk berhasil dihapus!');
        return redirect()->to('/list-produk');
    }

    public function laporanProduk()
    {
        $data = [
            'data' => $this->produk->getAllproduk(),
            'listProduk' => $this->produk->getAllproduk(),
            'listJenis' => $this->jenis_produk->findAll(),
            'listSatuan' => $this->satuan_produk->findAll(),
        ];

        $view = view('Produk/laporan-produk', $data);
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'Potrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("Laporan-Produk", array("Attachment" => false));
    }

    public function barcodeGenerator()
    {
    }
}
