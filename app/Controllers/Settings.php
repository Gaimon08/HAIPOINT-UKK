<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Settings extends BaseController
{
    public function index()
    {

        $data = [
            'judulHalaman' => 'Settings'
        ];

        return view('Settings/settings', $data);
    }

    public function generalSettings()
    {

        $data = [
            'listGeneral' => $this->general_settings->findAll(),
            'judulHalaman' => 'General Settings'
        ];

        return view('Settings/general-settings', $data);
    }

    public function simpanGeneralSettings()
    {
        $data = [
            'id' => $this->request->getVar('id'), // Ambil ID dari form
            'nama_toko' => $this->request->getVar('nama_toko'),
            'alamat_toko' => $this->request->getVar('alamat_toko'),
            'no_telp_toko' => $this->request->getVar('no_telp_toko'),
        ];

        // Gunakan update jika ID ada, atau save jika tidak
        if (!empty($data['id'])) {
            $this->general_settings->update($data['id'], $data);
        } else {
            $this->general_settings->save($data);
        }

        session()->setFlashdata('pesan', 'Data berhasil disimpan!');
        return redirect()->to('/general-settings');
    }
}
