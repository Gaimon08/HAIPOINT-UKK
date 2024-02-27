<?php

namespace App\Models;

use CodeIgniter\Model;

class MPenjualan extends Model
{
    protected $table            = 'tbl_transaksi';
    protected $primaryKey       = 'id_transaksi';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_transaksi', 'barcode', 'no_faktur', 'tgl_transaksi', 'pajak', 'diskon', 'total_harga', 'kembalian', 'bayar', 'kembali', 'full_name'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getDetailPembelian($no_faktur)
    {
        $detail = new MDPenjualan();
        $detail->select('tbl_transaksi.id_transaksi, tbl_transaksi.no_faktur, tbl_transaksi.total_harga, tbl_transaksi.tgl_transaksi, TIME(tbl_transaksi.tgl_transaksi) as waktu_transaksi, tbl_produk.nama_produk, tbl_detailtransaksi.qty, tbl_detailtransaksi.barcode, tbl_detailtransaksi.harga_jual, tbl_detailtransaksi.subtotal');
        $detail->join('tbl_transaksi', 'tbl_transaksi.no_faktur = tbl_detailtransaksi.no_faktur', 'left');
        $detail->join('tbl_produk', 'tbl_produk.id_produk = tbl_detailtransaksi.id_produk', 'left');
        $detail->where('tbl_detailtransaksi.no_faktur', $no_faktur);
        return $detail->get()->getResultArray();
    }





    public function noFaktur()
    {
        $tgl = date('Ymd');
        $query =  $this->db->query("SELECT MAX(RIGHT(no_faktur,4)) as no_urut from tbl_transaksi where DATE(tgl_transaksi)='$tgl'");
        $hasil = $query->getRowArray();
        if ($hasil['no_urut'] > 0) {
            $tmp = $hasil['no_urut'] + 1;
            $kd = sprintf("%04s", $tmp);
        } else {
            $kd = "0001";
        }
        $no_faktur = date('Ymd') . $kd;
        return $no_faktur;
    }

    public function CekProduk($barcode)
    {
        return $this->db->table('tbl_produk')
            ->join('tbl_jenis_produk', 'tbl_jenis_produk.id_jenis_produk=tbl_produk.id_jenis_produk')
            ->join('tbl_satuan', 'tbl_satuan.id_satuan=tbl_produk.id_satuan')
            ->where('barcode', $barcode)
            ->get()
            ->getRowArray();
    }
}
