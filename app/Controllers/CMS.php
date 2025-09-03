<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CMS extends BaseController
{
    protected $pertanyaanModel;
    protected $nilaiModel;
    protected $sPimPMModel;
    protected $statusPMModel;
    protected $nilaiPKModel;
    protected $nilaiPMModel;
    protected $nilailvlModel;
    protected $SKModel;
    protected $DataUmumModel;
    protected $UserModel;
    protected $SatkerModel;
    public function __construct()
    {
        $this->pertanyaanModel = new \App\Models\PertanyaanModel();
        $this->nilaiModel = new \App\Models\NilaiModel();
        $this->sPimPMModel = new \App\Models\SPimPMModel();
        $this->statusPMModel = new \App\Models\StatusPMModel();
        $this->nilaiPMModel = new \App\Models\NilaiPMModel();
        $this->nilaiPKModel = new \App\Models\NilaiPKModel();
        $this->nilailvlModel = new \App\Models\NilailvlModel();
        $this->SKModel = new \App\Models\SkSatkerModel();
        $this->DataUmumModel = new \App\Models\DataUmumModel();
        $this->UserModel = new \App\Models\UserModel();
        $this->SatkerModel = new \App\Models\SatkerModel();
    }

    public function admin()
    {        
        return view('/admin/index');
    }

    public function users()
    {
        return view('admin/users');
    }

    public function getUsersData()
    {
            $data = $this->UserModel->findAll();
            $result = [];
            $no = 1;
            foreach ($data as $row) {
                $result[] = [
                    $no++,
                    esc($row['username']),
                    esc($row['firstname']),
                    esc($row['lastname']),
                    esc($row['email']),
                    esc($row['password']),
                    esc($row['role']),
                    esc($row['is_active']),
                    '<a href="#">Edit</a>'
                ];
            }
            return $this->response->setJSON(['data' => $result]);        
    }

    public function nilai()
    {
        return view('admin/nilai');
    }

    public function getSatkerData()
    {
            $data = $this->SatkerModel->findAll();
            $result = [];
            $no = 1;
            foreach ($data as $row) {
                $result[] = [
                    $no++,
                    esc($row['nama_satker']),
                    esc($row['nama_organisasi']),
                    esc($row['nama_kategori']),
                    esc($row['pembina']),                   
                    '<a href="#" class="btn btn-primary btn-sm btn-nilai" data-id="' . esc($row['id']) . '" data-nama="' . esc($row['nama_satker']) . '">Nilai</a>'
                ];
            }
            return $this->response->setJSON(['data' => $result]);        
    }

    public function getNilai($id)
    {
        $d = $this->SatkerModel->getNilai($id);
        return $this->response->setJSON($d);
    }

    public function dash_pm()
    {
        // $session = session()->get();
        $id_satker = $this->request->getGet('id');
        $id_user = session()->get('id');
        $thn       = $this->request->getGet('thn');

        // d($id_satker, $id_user, $thn, $session);
        $precentage = $this->nilaiPMModel->precentage($id_satker, $thn);
        $dash = $this->nilaiPMModel->dashboard($id_satker, $thn);
        $status_pm = $this->statusPMModel->filter($id_satker, $thn);
        $spm_pim = $this->sPimPMModel->filter($id_satker, $thn);
        $user = $this->SatkerModel->getSatker($id_satker);
        $data = [
            'tahun' => $thn,
            'persen' => $precentage,
            'role' => session()->get('role'),
            's_pm' => $status_pm,
            'dash' => $dash,
            'user' => $user,
            's_pim' => $spm_pim
        ];

        return view('/penilaianMandiri/dashboard', $data);
    }
}
