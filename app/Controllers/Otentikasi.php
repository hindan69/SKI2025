<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;

class Otentikasi extends BaseController
{
    protected $users;
    public function __construct()
    {
        $this->users = new \App\Models\UserModel();
    }

    public function index()
    {
        return view('login');
        // echo "hallo";
    }

    public function process()
    {
        $users = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $dataUser = $users->where([
            'username' => $username,
        ])->first();

        if ($dataUser) {
            if (password_verify($password, $dataUser['password'])) {
                $params = ['id' => $users->id];
                session()->set([
                    'id' => $dataUser['id'],
                    'username' => $dataUser['username'],
                    'firstname' => $dataUser['firstname'],
                    'lastname' => $dataUser['lastname'],
                    'email' => $dataUser['email'],
                    'id_satker' => $dataUser['id_satker'],
                    'role' => $dataUser['role'],
                    'logged_in' => TRUE
                ]);
                if ($dataUser['role'] == '2') {
                    return redirect()->to(base_url('/tu'));
                    // echo "admin TU";
                } elseif ($dataUser['role'] == '3') {
                    return redirect()->to(base_url('/pm'));
                    // echo "PIM Satker";
                } elseif ($dataUser['role'] == '4') {
                    return redirect()->to(base_url('/pm'));
                    // echo "PM Satker";
                } elseif ($dataUser['role'] == '5') {
                    return redirect()->to(base_url('/prfl'));
                    // echo "PK Satker";
                } elseif ($dataUser['role'] == '6') {
                    return redirect()->to(base_url('/'));
                    // echo "Eselon 2";
                } elseif ($dataUser['role'] == '9') {
                    return redirect()->to(base_url('/'));
                    // echo "Eselon 1";
                } elseif ($dataUser['role'] == '1') {
                    return redirect()->to(base_url('/cms'));
                    // echo "CMS";
                }
                // elseif ($dataUser['role'] == '10') {
                //     return redirect()->to(base_url('/kpk/home'));
                // }
                else {
                    return redirect()->to(base_url('/pmsatker/home'));
                }
            } else {
                session()->setFlashdata('error', 'Username & Password Salah');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('error', 'Username & Password Salah');
            return redirect()->back();
        }
    }

    function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
