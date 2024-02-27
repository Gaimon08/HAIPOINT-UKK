<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MGSettings;
use CodeIgniter\HTTP\ResponseInterface;
use Myth\Auth\Models\UserModel;

// ESCPOS
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\Printer;


class TransaksiController extends BaseController
{

    public function transaksiPembelian()
    {
        $data = [
            'judulHalaman' => 'Data Pembelian',
            'introText' => '<p>Berikut ini adalah daftar transaksi pembelian, untuk menambah data pembelian produk klik tombol Tambah</p>',
            'listProduk' => $this->produk->getAllproduk(),
            'listPembelian' => $this->pembelian->getAllTransaksiPembelian(),
            'listSupplier' => $this->supplier->findAll(),
            'listSatuan' => $this->satuan_produk->findAll(),
        ];
        return view('transaksi/list-transaksi-pembelian', $data);
    }

    public function ListPenjualan()
    {
        $data = [
            'judulHalaman' => 'Data Penjualan',
            'introText' => '<p>Berikut ini adalah daftar transaksi pembelian, untuk menambah data pembelian produk klik tombol Tambah</p>',
            'listProduk' => $this->produk->getAllproduk(),
            'listPenjualan' => $this->penjualan->findAll(),
            'listSupplier' => $this->supplier->findAll(),
            'listSatuan' => $this->satuan_produk->findAll(),
            'listToko' => $this->general_settings->findAll(),
        ];
        return view('transaksi/list-transaksi-penjualan', $data);
    }

    public function listDetailPenjualan($no_faktur)
    {
        $syarat = [
            'no_faktur' => $no_faktur
        ];
        $data = [
            'no_faktur' => $no_faktur,
            'judulHalaman' => 'Pendataan Detail Pembelian',
            'introText' => '<p>Silahkan masukan data barang yang dibeli pada form dibawah ini.</p>',
            // 'listBarang' => $this->barang->getAllBarang(),  // select * from tbl_barang
            'listDetailPembelian' => $this->penjualan->getDetailPembelian($no_faktur),
            'listToko' => $this->general_settings->findAll()
        ];

        return view('transaksi/detail-penjualan', $data);
    }

    public function transaksiPenjualan()
    {
        $cart = \Config\Services::cart();

        $data = [
            'judulHalaman' => 'Data Pembelian',
            'listProduk' => $this->produk->getAllproduk(),
            'cart' => $cart->contents(),
            'grand_total' => $cart->total(),
            'no_faktur' => $this->penjualan->noFaktur(),
        ];
        return view('transaksi/transaksi-penjualan', $data);
    }

    public function invoicePembelian($idPembelian)
    {
        $syarat = [
            'id_pembelian' => $idPembelian
        ];

        $data = [
            'judulHalaman' => 'Invoice Pembelian Produk',
            'listProduk' => $this->produk->getAllproduk(),
            'detailPembelian' => $this->pembelian->where($syarat)->getAllTransaksiPembelian(),
            'listSupplier' => $this->supplier->findAll(),
        ];
        return view('transaksi/invoice-pembelian', $data);
    }

    public function simpanPembelian()
    {

        $dataPembelian = [
            'no_faktur' => $this->request->getVar('no_faktur'),
            'tgl_pembelian' => $this->request->getVar('tgl_pembelian'),
            'id_supplier' => $this->request->getVar('id_supplier'),
            'id_produk' => $this->request->getVar('id_produk'),
            'id_satuan' => $this->request->getVar('id_satuan'),
            'jumlah_produk' => $this->request->getVar('jumlah_produk'),
            'harga_beli'   => $this->request->getVar('harga_beli'),
            'total_harga' => $this->request->getVar('harga_beli') * $this->request->getVar('jumlah_produk'),
        ];

        $this->pembelian->save($dataPembelian);
        session()->setFlashdata('pesan', 'data Pembelian berhasil disimpan!');
        return redirect()->to('/list-transaksi-pembelian');
    }

    public function updatePembelian()
    {

        $data = [
            'id_pembelian' => $this->request->getVar('id_pembelian'),
            'no_faktur' => $this->request->getVar('no_faktur'),
            'tgl_pembelian' => $this->request->getVar('tgl_pembelian'),
            'id_supplier' => $this->request->getVar('id_supplier'),
            'id_produk' => $this->request->getVar('id_produk'),
            'jumlah_produk' => $this->request->getVar('jumlah_produk'),
            'harga_satuan'            => $this->request->getVar('harga_satuan'),
            'diskon' => $this->request->getVar('diskon'),
            'total_harga' => $this->request->getVar('harga_satuan') * $this->request->getVar('jumlah_produk'),
        ];

        $this->pembelian->update($this->request->getVar('id_pembelian'), $data);
        session()->setFlashdata('pesan', 'data Pembelian berhasil diupdate!');
        return redirect()->to('/list-transaksi-pembelian');
    }

    public function hapusPembelian()
    {
        $id = $this->request->getPost('id_pembelian');
        $this->pembelian->deletePembelian($id);
        session()->setFlashdata('pesan', 'data pembelian berhasil dihapus!');
        return redirect()->to('/list-transaksi-pembelian');
    }

    public function CekProduk()
    {
        $barcode = $this->request->getPost('barcode');
        $produk = $this->penjualan->CekProduk($barcode);
        if ($produk == null) {
            $data = [
                'barcode' => '',
                'id_produk' => '',
                'nama_produk' => '',
                'nama_jenis_produk' => '',
                'nama_satuan' => '',
                'harga_satuan' => '',
                'harga_jual' => '',
                'harga_beli' => '',
            ];
        } else {
            $data = [
                'barcode' => $produk['barcode'],
                'id_produk' => $produk['id_produk'],
                'nama_produk' => $produk['nama_produk'],
                'nama_jenis' => $produk['nama_jenis'],
                'nama_satuan' => $produk['nama_satuan'],
                'harga_jual' => $produk['harga_jual'],
                'harga_beli' => $produk['harga_beli'],
            ];
        }
        echo json_encode($data);
    }

    public function simpanPenjualan()
    {
        // Ambil data dari form
        $bayar = str_replace(".", "", $this->request->getPost('bayar'));
        $kembali = str_replace(".", "", $this->request->getPost('kembalian'));

        // Inisialisasi keranjang belanja
        $cart = \Config\Services::cart();
        $produk = $cart->contents();

        // Validasi stok produk
        foreach ($produk as $value) {
            $produkInfo = $this->produk->find($value['id']);

            if ($produkInfo['stok'] < $value['qty']) {
                $msg = ['warning' => 'Stok produk ' . $value['name'] . ' tidak mencukupi untuk transaksi ini.'];
                session()->setFlashdata($msg);
                return redirect()->to('/transaksi-penjualan');
            }
        }

        // Validasi uang yang dibayarkan
        if ($bayar < $cart->total()) {
            $msg = ['warning' => 'Uang yang dibayarkan kurang dari total harga transaksi.'];
            session()->setFlashdata($msg);
            return redirect()->to('/transaksi-penjualan');
        }

        // Simpan ke tabel detail penjualan
        $no_faktur = $this->penjualan->noFaktur();
        foreach ($produk as $value) {
            $data = [
                'no_faktur' => $no_faktur,
                'id_produk' => $value['id'],
                'nama_satuan' => $value['options']['nama_satuan'],
                'barcode' => $value['options']['barcode'],
                'harga_jual' => $value['price'],
                'harga_beli' => $value['options']['harga_beli'],
                'qty' => $value['qty'],
                'subtotal' => $value['subtotal'],
                'untung' => ($value['price'] - $value['options']['harga_beli']) * $value['qty']

            ];
            $this->detail_penjualan->save($data);
        }

        // Simpan ke tabel penjualan
        $userModel = new UserModel();
        $user = $userModel->find(user()->id);
        $data = [
            'no_faktur' => $no_faktur,
            'tgl_transaksi' => date('Y-m-d H:i:s'),
            'total_harga' => $cart->total(),
            'bayar' =>  str_replace(['Rp ', '.'], '', $bayar),
            'kembalian' => str_replace(['Rp ', '.'], '', $kembali),
            'full_name' => $user->full_name
        ];
        $this->penjualan->save($data);

        // Hapus isi keranjang
        $cart->destroy();

        // Set flash data berhasil
        $msg = ['pesan' => 'Transaksi Berhasil di Simpan', 'no_faktur' => $no_faktur];
        session()->setFlashdata($msg);

        return redirect()->to('transaksi-penjualan');
    }


    // ci4cart
    public function cek()
    {
        $cart = \Config\Services::cart();

        $response = $cart->contents();
        $data = json_encode($response);
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }

    public function addCart()
    {
        $cart = \Config\Services::cart();
        $cart->insert(array(
            'id'      =>  $this->request->getPost('id_produk'),
            'qty'     =>  $this->request->getPost('jumlah'),
            'price'   =>  $this->request->getPost('harga_jual'),
            'name'    =>  $this->request->getPost('nama_produk'),
            'options' => array(
                'harga_beli'    =>  $this->request->getPost('harga_beli'),
                'barcode'    =>  $this->request->getPost('barcode'),
                'nama_satuan'    =>  $this->request->getPost('nama_satuan'),
                'nama_jenis' =>  $this->request->getPost('nama_jenis'),
            )
        ));

        return redirect()->to(base_url('/transaksi-penjualan'));
    }

    public function viewCart()
    {
        $cart = \Config\Services::cart();
        $data = $cart->contents();
        echo dd($data);
    }

    public function removeitems($rowid)
    {
        $cart = \Config\Services::cart();
        $cart->remove($rowid);
        return redirect()->to(base_url('/transaksi-penjualan'));
    }

    public function clearCart()
    {
        $cart = \Config\Services::cart();
        $cart->destroy();
    }

    public function cetakStruk()
    {
        function buatBaris1Kolom($kolom1)
        {
            // Mengatur lebar setiap kolom (dalam satuan karakter)
            $lebar_kolom_1 = 33;

            // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
            $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", false);

            // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
            $kolom1Array = explode("\n", $kolom1);

            // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (tanpa spasi di antara baris)
            $hasilBaris = implode(" ", $kolom1Array);

            // Hasil yang berupa string
            return $hasilBaris . "\n";
        }

        function buatBaris3Kolom($kolom1, $kolom2, $kolom3)
        {
            // Mengatur lebar setiap kolom (dalam satuan karakter)
            $lebar_kolom_1 = 11;
            $lebar_kolom_2 = 11;
            $lebar_kolom_3 = 11;

            // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
            $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", false);
            $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", false);
            $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", false);

            // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
            $jmlBarisTerbanyak = max(count(explode("\n", $kolom1)), count(explode("\n", $kolom2)), count(explode("\n", $kolom3)));

            // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
            $hasilBaris = array();

            // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
            for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {
                // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
                $hasilKolom1 = str_pad((isset(explode("\n", $kolom1)[$i]) ? explode("\n", $kolom1)[$i] : ""), $lebar_kolom_1, " ");
                $hasilKolom2 = str_pad((isset(explode("\n", $kolom2)[$i]) ? explode("\n", $kolom2)[$i] : ""), $lebar_kolom_2, " ");
                $hasilKolom3 = str_pad((isset(explode("\n", $kolom3)[$i]) ? explode("\n", $kolom3)[$i] : ""), $lebar_kolom_3, " ");

                // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (tanpa spasi di antara kolom)
                $hasilBaris[] = $hasilKolom1 . $hasilKolom2 . $hasilKolom3;
            }

            // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
            return implode("\n", $hasilBaris) . "\n";
        }


        // Config
        $profile = CapabilityProfile::load("simple");
        $connector = new WindowsPrintConnector("POS-58");
        $printer = new Printer($connector, $profile);

        //  Prepare Data
        $modelToko = new MGSettings();
        $dataToko = $modelToko->findAll();
        $no_faktur = $this->request->getPost('no_faktur');
        $tblPenjualan = $this->penjualan;
        $tblDetailPenjualan = $this->detail_penjualan;

        // $queryPenjualan = $tblPenjualan->getWhere(['tgl_transaksi' => $no_faktur]);
        // $rowPenjualan = $queryPenjualan->getRowArray();

        // Get tabel tbl_transaksi
        $queryTransaksi = $tblPenjualan
            ->select('bayar, kembalian, tgl_transaksi, full_name')
            ->where('no_faktur', $no_faktur)
            ->get();
        $rowTransaksi = $queryTransaksi->getRowArray();

        try {

            // Font
            $printer->initialize();
            $printer->selectPrintMode(Printer::MODE_FONT_A);


            // Pastikan dataToko tidak kosong sebelum mengakses kunci
            if (!empty($dataToko) && count($dataToko) > 0) {
                // Menggunakan data toko pertama (asumsi Anda hanya memiliki satu data toko)
                $toko = $dataToko[0];

                // Menampilkan informasi toko
                $printer->text(buatBaris1Kolom($toko['nama_toko']));
                $printer->text(buatBaris1Kolom("{$toko['alamat_toko']}"));
                $printer->text(buatBaris1Kolom("No Telp   : {$toko['no_telp_toko']}"));
            } else {
                // Tindakan yang sesuai jika data toko tidak ditemukan
                $printer->text(buatBaris1Kolom("Informasi toko tidak tersedia"));
            }

            $printer->text(buatBaris1Kolom("No Faktur : $no_faktur"));
            $printer->text(buatBaris1Kolom("Tanggal   :  $rowTransaksi[tgl_transaksi]"));
            $printer->text(buatBaris1Kolom("Kasir     :  $rowTransaksi[full_name]"));
            $printer->text(buatBaris1Kolom("--------------------------------"));

            // Get Detail Pembelian
            $queryPenjualanDetail = $tblDetailPenjualan
                ->select('tbl_produk.nama_produk, tbl_detailtransaksi.qty, tbl_detailtransaksi.barcode, tbl_detailtransaksi.harga_jual, tbl_detailtransaksi.subtotal, tbl_detailtransaksi.nama_satuan')
                ->join('tbl_produk', 'tbl_produk.id_produk = tbl_detailtransaksi.id_produk', 'left')
                ->where('tbl_detailtransaksi.no_faktur', $no_faktur)
                ->get();

            $totalPembayaran = 0;
            foreach ($queryPenjualanDetail->getResultArray() as $row) {
                $printer->text(buatBaris1Kolom("$row[nama_produk]"));
                $printer->text(buatBaris3Kolom("$row[qty] $row[nama_satuan]", number_format($row['harga_jual'], 0, ',', '.'), number_format($row['subtotal'], 0, ',', '.')));

                $totalPembayaran += $row['subtotal'];
            }

            $printer->text(buatBaris1Kolom("--------------------------------"));
            $printer->text(buatBaris3Kolom("", "Total :", number_format($totalPembayaran, 0, ',', '.')));
            if ($rowTransaksi) {
                $bayar = $rowTransaksi['bayar'];
                $kembalian = $rowTransaksi['kembalian'];
                $printer->text(buatBaris3Kolom("", "Bayar :", number_format($bayar, 0, ',', '.')));
                $printer->text(buatBaris3Kolom("", "Kembalian :", number_format($kembalian, 0, ',', '.')));
            } else {
                // Tindakan jika informasi transaksi tidak ditemukan
                $printer->text(buatBaris1Kolom("Informasi transaksi tidak tersedia"));
            }
        } catch (\Exception $e) {
            // Tangkap kesalahan dan tampilkan pesan kesalahan
            echo "Error: " . $e->getMessage();
        }

        $printer->text(buatBaris1Kolom("----------Terima kasih----------"));

        $printer->feed(2);
        $printer->cut();
        $printer->close();

        // return redirect()->to('transaksi-penjualan');
    }
}
