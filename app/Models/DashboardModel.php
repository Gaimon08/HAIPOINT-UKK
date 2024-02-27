<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{

    public function Chart()
    {
        return $this->db->table('tbl_detailtransaksi')
            ->join('tbl_transaksi', 'tbl_transaksi.no_faktur=tbl_detailtransaksi.no_faktur')
            ->where('month(tbl_transaksi.tgl_transaksi)', date('m'))
            ->where('year(tbl_transaksi.tgl_transaksi)', date('Y'))
            ->select('tbl_transaksi.tgl_transaksi')
            ->groupBy('tbl_transaksi.tgl_transaksi')
            ->selectSum('tbl_transaksi.total_harga')
            ->selectSum('tbl_detailtransaksi.untung')
            ->get()->getResultArray();
    }

    public function PendapatanHarian()
    {
        return $this->db->table('tbl_detailtransaksi')
            ->join('tbl_transaksi', 'tbl_transaksi.no_faktur=tbl_detailtransaksi.no_faktur')
            ->where('tbl_transaksi.tgl_transaksi', date('Y-m-d'))
            ->select('tbl_transaksi.tgl_transaksi')
            ->groupBy('tbl_transaksi.tgl_transaksi')
            ->selectSum('tbl_transaksi.total_harga')
            ->get()->getRowArray();
    }

    public function PendapatanBulanan()
    {
        return $this->db->table('tbl_detailtransaksi')
            ->join('tbl_transaksi', 'tbl_transaksi.no_faktur=tbl_detailtransaksi.no_faktur')
            ->where('month(tbl_transaksi.tgl_transaksi)', date('m'))
            ->where('year(tbl_transaksi.tgl_transaksi)', date('Y'))
            ->select('tbl_transaksi.tgl_transaksi')
            ->groupBy('month(tbl_transaksi.tgl_transaksi)')
            ->selectSum('tbl_transaksi.total_harga')
            ->get()->getRowArray();
    }

    public function PendapatanTahunan()
    {
        return $this->db->table('tbl_detailtransaksi')
            ->join('tbl_transaksi', 'tbl_transaksi.no_faktur=tbl_detailtransaksi.no_faktur')
            ->where('year(tbl_transaksi.tgl_transaksi)', date('Y'))
            ->select('tbl_transaksi.tgl_transaksi')
            ->groupBy('year(tbl_transaksi.tgl_transaksi)')
            ->selectSum('tbl_transaksi.total_harga')
            ->get()->getRowArray();
    }

    public function TotalProduk()
    {
        return $this->db->table('tbl_produk')->countAll();
    }

    public function TotalKategori()
    {
        return $this->db->table('tbl_jenis_produk')->countAll();
    }

    public function TotalSatuan()
    {
        return $this->db->table('tbl_satuan')->countAll();
    }

    public function TotalUser()
    {
        return $this->db->table('users')->countAll();
    }

    public function TotalPenjualan()
    {
        return $this->db->table('tbl_transaksi')->countAll();
    }
}
