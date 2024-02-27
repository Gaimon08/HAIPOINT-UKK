<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {

        return view('auth/login');
    }

    public function dashboard()
    {

        $data = [
            'listUser' => $this->user->getAllUsers(),
            'Chart' => $this->dashboard->Chart(),
            'PendapatanHarian' => $this->dashboard->PendapatanHarian(),
            'PendapatanBulanan' => $this->dashboard->PendapatanBulanan(),
            'PendapatanTahunan' => $this->dashboard->PendapatanTahunan(),
            'TotalProduk' => $this->dashboard->TotalProduk(),
            'TotalKategori' => $this->dashboard->TotalKategori(),
            'TotalSatuan' => $this->dashboard->TotalSatuan(),
            'TotalUser' => $this->dashboard->TotalUser(),
            'TotalPenjualan' => $this->dashboard->TotalPenjualan(),
            'judulHalaman' => 'Dashboard'
        ];

        return view('Dashboard', $data);
    }
}
