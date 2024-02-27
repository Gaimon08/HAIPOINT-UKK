<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;


class UserController extends BaseController
{

    protected $db, $builder;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
    }

    public function index()
    {

        $data = [
            'listUser' => $this->user->getAllUsers(),
            'judulHalaman' => 'Data Pengguna'
        ];

        return view('User/list-user', $data);
    }


    public function Tambah_user()
    {
        $data = [
            'judulHalaman' => 'Tambah Data Pengguna'
        ];

        return view('User/register', $data);
    }

    public function detail($id = 0)
    {
        $data['title'] = 'User Detail';

        $this->builder->select('users.id as userid, username, email, fullname, user_image, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();

        $data['user'] = $query->getRow();
        if (empty($data['user'])) {
            return redirect()->to('/admin');
        }

        return view('admin/detail', $data);
    }

    public function profile($idUser)
    {

        $syarat = [
            'id' => $idUser
        ];

        $this->builder->select('users.id as userid, username, email, full_name, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $idUser);
        $query = $this->builder->get();

        $data['judulHalaman'] = 'Profil Pengguna';
        $data['user'] = $query->getRow();

        return view('/profile', $data);
    }

    // public function profile($idUser)
    // {

    //     $syarat = [
    //         'id' => $idUser
    //     ];

    //     $data = [

    //         'introText' => '<p>Silahkan masukan data pengguna pada form dibawa ini.</p>',
    //         'judulHalaman' => 'Profile Pengguna',
    //         'user' => $this->user->where($syarat)->findAll()
    //     ];


    //     return view('/profile', $data);
    // }

    public function editUser($idUser)
    {

        $syarat = [
            'id' => $idUser
        ];

        $data = [

            'introText' => '<p>Silahkan masukan data pengguna pada form dibawa ini.</p>',
            'judulHalaman' => 'Edit Data Pengguna',
            'user' => $this->user->where($syarat)->findAll()
        ];


        return view('User/edit-user', $data);
    }

    // Update Profile
    public function updateUser()
    {
        $data = [
            'id' => $this->request->getVar('id'),
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'full_name' => $this->request->getVar('full_name'),
            'phone_number' => $this->request->getVar('phone_number'),
            'user_image' => $this->request->getVar('user_image'),
        ];

        $this->user->update($this->request->getVar('id'), $data);
        session()->setFlashdata('pesan', 'User berhasil diupdate');
        return redirect()->to('/');
    }

    // Update List User
    public function updateUsers()
    {
        $data = [
            'id' => $this->request->getVar('id'),
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'full_name' => $this->request->getVar('full_name'),
            'phone_number' => $this->request->getVar('phone_number'),
            'user_image' => $this->request->getVar('user_image'),
        ];
        var_dump($data);
        // $this->userMyth->withGroup($this->request->getVar('role'))->update($this->request->getVar('userid'), $data);
        $this->user->update($this->request->getVar('id'), $data);
        session()->setFlashdata('pesan', 'User berhasil diupdate');
        return redirect()->to('/list-user');
    }

    public function simpanUser()
    {
        $rules = [
            'email' => 'required',
            'username' => 'required',
            'password' => 'required|min_length[8]|max_length[255]|matches[pass_confirm]',
            'pass_confirm' => 'required|min_length[8]|max_length[255]',
            // tambahkan aturan validasi lainnya sesuai kebutuhan
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'full_name' => $this->request->getVar('full_name'),
            'password_hash' => $this->request->getVar('password'),
        ];

        // Lakukan simpan user dengan data di atas
        $this->userMyth->withGroup($this->request->getVar('role'))->save($data);

        session()->setFlashdata('pesan', 'User berhasil disimpan');
        return redirect()->to('/list-user');
    }

    public function hapusUser($idUser)
    {
        $syarat = [
            'id' => $idUser
        ];
        $this->user->where($syarat)->delete();
        session()->setFlashdata('pesan', 'User berhasil dihapus!');
        return redirect()->to('/list-user');
    }
}
