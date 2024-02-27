<?php

namespace App\Models;

use CodeIgniter\Model;

class MLaporan extends Model
{


    public function DataHarian($tgl)
    {
        return $this->db->table('tbl_detailtransaksi')
            ->join('tbl_produk', 'tbl_produk.barcode=tbl_detailtransaksi.barcode')
            ->join('tbl_transaksi', 'tbl_transaksi.no_faktur=tbl_detailtransaksi.no_faktur')
            ->where('tbl_transaksi.tgl_transaksi', $tgl)
            ->select('tbl_detailtransaksi.barcode')
            ->select('tbl_produk.nama_produk')
            ->select('tbl_detailtransaksi.harga_beli')
            ->select('tbl_detailtransaksi.harga_jual')
            ->groupBy('tbl_detailtransaksi.barcode')
            ->selectSum('tbl_detailtransaksi.qty')
            ->selectSum('tbl_transaksi.total_harga')
            ->selectSum('tbl_detailtransaksi.untung')
            ->get()->getResultArray();
    }

    public function DataBulanan($bulan, $tahun)
    {
        return $this->db->table('tbl_detailtransaksi')
            ->join('tbl_transaksi', 'tbl_transaksi.no_faktur=tbl_detailtransaksi.no_faktur')
            ->where('month(tbl_transaksi.tgl_transaksi)', $bulan)
            ->where('year(tbl_transaksi.tgl_transaksi)', $tahun)
            ->select('tbl_transaksi.tgl_transaksi')
            ->groupBy('tbl_transaksi.tgl_transaksi')
            ->selectSum('tbl_transaksi.total_harga')
            ->selectSum('tbl_detailtransaksi.untung')
            ->get()->getResultArray();
    }

    public function DataTahunan($tahun)
    {
        return $this->db->table('tbl_detailtransaksi')
            ->join('tbl_transaksi', 'tbl_transaksi.no_faktur=tbl_detailtransaksi.no_faktur')
            ->where('year(tbl_transaksi.tgl_transaksi)', $tahun)
            ->select('month(tbl_transaksi.tgl_transaksi) as bulan')
            ->groupBy('month(tbl_transaksi.tgl_transaksi)')
            ->selectSum('tbl_transaksi.total_harga')
            ->selectSum('tbl_detailtransaksi.untung')
            ->get()->getResultArray();
    }
}
