<?php

namespace App\Models;

use CodeIgniter\Model;

class MPembelian extends Model
{
    protected $table            = 'tbl_pembelianproduk';
    protected $primaryKey       = 'id_pembelian';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['no_faktur', 'tgl_pembelian', 'id_supplier', 'id_produk', 'jumlah_produk', 'id_satuan', 'harga_beli', 'diskon', 'total_harga', 'nota_pembelian'];

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

    public function getAllTransaksiPembelian()
    {
        $pembelian = new MPembelian();
        $pembelian->select('id_pembelian, no_faktur, date_format(tgl_pembelian, "%d %M %Y") as tgl_pembelian, tbl_pembelianproduk.id_supplier, tbl_pembelianproduk.id_produk,tbl_pembelianproduk.harga_beli, diskon, jumlah_produk, nama_supplier, alamat_supplier, wa_supplier, nama_produk, total_harga');
        $pembelian->join('tbl_produk', 'tbl_produk.id_produk=tbl_pembelianproduk.id_produk', 'left');
        $pembelian->join('tbl_supplier', 'tbl_supplier.id_supplier=tbl_pembelianproduk.id_supplier', 'left');
        return $pembelian->findAll();
    }

    public function deletePembelian($id)
    {
        $query = $this->db->table('tbl_pembelianproduk')->delete(array('id_pembelian' => $id));
        return $query;
    }


    // public function getAllTransaksiPembelian($idPembelian = null)
    // {
    //     $pembelian = new MPembelian();
    //     $pembelian->select('tbl_pembelianproduk.no_faktur, date_format(tbl_pembelianproduk.tgl_pembelian,"%d %M %Y") as tgl_pembelian, tbl_pembelianproduk.id_supplier, tbl_pembelianproduk.id_pembelian,tbl_supplier.nama_supplier,sum(tbl_detailpembelian.jumlah_produk * tbl_detailpembelian.harga_satuan) as total_harga');
    //     $pembelian->join('tbl_supplier', 'tbl_supplier.id_supplier=tbl_pembelianproduk.id_supplier', 'left');
    //     $pembelian->join('tbl_detailpembelian', 'tbl_detailpembelian.id_pembelian=tbl_pembelianproduk.id_pembelian');
    //     $pembelian->groupby('tbl_pembelianproduk.id_pembelian');
    //     $pembelian->orderby('tbl_pembelianproduk.tgl_pembelian', 'desc');
    //     if ($idPembelian != null) {
    //         $pembelian->where('tbl_pembelianproduk.id_pembelian', $idPembelian);
    //     }
    //     return $pembelian->findAll();
    // }


    public function getAllUsers()
    {
        return $this->select('id_pembelian, no_faktur, date_format(tbl_pembelianproduk.tgl_pembelian,"%d %M %Y") as tgl_pembelian, id_supplier, id_produk, harga_satuan, diskon, jumlah_produk, nama_supplier, nama_produk, sum(tbl_pembelianproduk.jumlah_produk * tbl_pembelianproduk.harga_satuan) as total_harga')
            ->join('tbl_produk', 'tbl_produk.id_produk=tbl_pembelianproduk.id_produk')
            ->join('tbl_supplier', 'tbl_supplier.id_supplier=tbl_pembelianproduk.id_supplier')
            ->findAll();
    }

    public function getDetailPembelian($idPembelian)
    {
        $detail = new MDPembelian();
        $detail->select('tbl_pembelianproduk.no_faktur, tbl_pembelianproduk.tgl_pembelian, tbl_pembelianproduk.tgl_pembelian, tbl_produk.nama_produk, tbl_pembelianproduk.jumlah_produk, tbl_pembelianproduk.harga_satuan, tbl_pembelianproduk.total_harga, tbl_supplier.nama_supplier, tbl_pembelianproduk.id_pembelian, tbl_pembelianproduk.id_detail_pembelian');
        $detail->join('tbl_pembelianproduk', 'tbl_pembelianproduk.id_pembelian=tbl_pembelianproduk.id_pembelian', 'left');
        $detail->join('tbl_supplier', 'tbl_supplier.id_supplier=tbl_pembelianproduk.id_supplier', 'left');
        $detail->join('tbl_produk', 'tbl_produk.id_produk=tbl_pembelianproduk.id_produk', 'left');
        $detail->where('tbl_pembelianproduk.id_pembelian', $idPembelian);
        return $detail->findAll();
    }
}
