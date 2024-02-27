<?php

namespace App\Models;

use CodeIgniter\Model;

class MDPembelian extends Model
{
    protected $table            = 'tbl_detailpembelian';
    protected $primaryKey       = 'id_detail_pembelian';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_detail_pembelian', 'id_pembelian', 'id_barang', 'jumlah_barang', 'harga_satuan', 'diskon', 'total_harga'];
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

    public function getDetailPembelian()
    {
        $detail = new MDPembelian();
        $detail->select('tbl_pembelianbarang.no_faktur, tbl_pembelianbarang.tgl_pembelian, tbl_pembelianbarang.tgl_pembelian, tbl_barang.nama_barang, tbl_detailpembelian.jumlah_barang, tbl_detailpembelian.harga_satuan, tbl_detailpembelian.total_harga, tbl_supplier.nama_supplier, tbl_pembelianbarang.id_pembelian, tbl_detailpembelian.id_detail_pembelian');
        $detail->join('tbl_pembelianbarang', 'tbl_pembelianbarang.id_pembelian=tbl_detailpembelian.id_pembelian');
        $detail->join('tbl_supplier', 'tbl_supplier.id_supplier=tbl_pembelianbarang.id_supplier');
        $detail->join('tbl_barang', 'tbl_barang.id_barang=tbl_detailpembelian.id_barang');
        return $detail->findAll();
    }
}
