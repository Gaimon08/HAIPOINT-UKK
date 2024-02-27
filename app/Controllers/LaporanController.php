<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

// $this->response->setContentType('application/pdf');
class LaporanController extends BaseController
{
    public function LaporanHarian()
    {
        $data = [
            'judulHalaman' => 'Laporan Harian'

        ];
        return view('Laporan/laporan-harian', $data);
    }

    public function ViewLaporanHarian()
    {
        $tgl = $this->request->getPost('tgl');
        $data = [
            'judul' => 'Laporan Harian',
            'dataharian' => $this->laporan->DataHarian($tgl),
            'listToko' => $this->general_settings->findAll(),
            'tgl' => $tgl,
        ];

        $response = [
            'data' => view('Laporan/table-laporan-harian', $data)
        ];

        echo json_encode($response);
        //echo dd($this->ModelLaporan->DataHarian($tgl));
    }

    public function LaporanBulanan()
    {
        $data = [
            'judulHalaman' => 'Laporan Bulanan',
        ];
        return view('Laporan/laporan-bulanan', $data);
    }

    public function ViewLaporanBulanan()
    {
        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');
        $data = [
            'judul' => 'Laporan Bulanan',
            'databulanan' => $this->laporan->DataBulanan($bulan, $tahun),
            'listToko' => $this->general_settings->findAll(),
            'bulan' => $bulan,
            'tahun' => $tahun,
        ];

        $response = [
            'data' => view('Laporan/table-laporan-bulanan', $data)
        ];

        echo json_encode($response);
        //echo dd($this->ModelLaporan->DataHarian($bulan, $tahun));
    }

    public function LaporanTahunan()
    {
        $data = [
            'judulHalaman' => 'Laporan Tahunan'

        ];
        return view('Laporan/laporan-tahunan', $data);
    }

    public function ViewLaporanTahunan()
    {
        $tahun = $this->request->getPost('tahun');
        $data = [
            'judul' => 'Laporan Tahunan',
            'datatahunan' => $this->laporan->DataTahunan($tahun),
            'listToko' => $this->general_settings->findAll(),
            'tahun' => $tahun,
        ];

        $response = [
            'data' => view('laporan/table-laporan-tahunan', $data)
        ];

        echo json_encode($response);
    }

    public function PrintLaporanHarian($tgl)
    {
        $data = [
            'judul' => 'Laporan Data Penjualan Harian',
            'dataharian' => $this->laporan->DataHarian($tgl),
            'listToko' => $this->general_settings->findAll(),
            'page' => 'Laporan/laporan-harian-print',
            'tgl' => $tgl,
        ];
        return view('Laporan/template_print', $data);
    }

    public function PrintLaporanBulanan($bulan, $tahun)
    {
        $data = [
            'judul' => 'Laporan Data Penjualan Bulanan',
            'databulanan' => $this->laporan->DataBulanan($bulan, $tahun),
            'listToko' => $this->general_settings->findAll(),
            'page' => 'Laporan/laporan-bulanan-print',
            'bulan' => $bulan,
            'tahun' => $tahun,
        ];
        return view('Laporan/template_print', $data);
    }

    public function PrintLaporanTahunan($tahun)
    {
        $data = [
            'judul' => 'Laporan Data Penjualan Bulanan',
            'datatahunan' => $this->laporan->DataTahunan($tahun),
            'listToko' => $this->general_settings->findAll(),
            'page' => 'Laporan/laporan-tahunan-print',
            'tahun' => $tahun,
        ];
        return view('Laporan/template_print', $data);
    }
}
