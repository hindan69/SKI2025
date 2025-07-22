<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Auditor extends BaseController
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
    protected $satkerModel;
    protected $TimauditModel;
    protected $AnggotaTimModel;
    protected $AuditorModel;
    public function __construct()
    {
        $this->satkerModel = new \App\Models\satkerModel();
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
        $this->TimauditModel = new \App\Models\TimauditModel();
        $this->AnggotaTimModel = new \App\Models\AnggotaTimModel();
        $this->AuditorModel = new \App\Models\AuditorModel();
    }

    public function index()
    {
        $ir = session()->get();
        $data = [
            'resume' => $this->SKModel->resumeAll(),
            'sesi' => $ir
        ];
        return view('/auditor/index', $data);
        // d($ir);
    }

    public function riwayat()
    {
        $id_satker = session()->get('id_satker');
        $data = [
            'SK' => $this->SKModel->statusSK($id_satker),
            'dataUmum' => $this->DataUmumModel->getBySatker($id_satker),
            'sesi' => session()->get(),
            'penugasan' => $this->AuditorModel->dashboard(session()->get('id'))
        ];
        return view('auditor/riwayat_penilaian', $data);
    }

    public function dash()
    {
        $id_satker = $this->request->getGet('id_satker');
        $thn = $this->request->getGet('thn');
        $precentage = $this->nilaiPMModel->precentage($id_satker, $thn);
        $dash = $this->nilaiPMModel->dashboard($id_satker, $thn);
        $status_pm = $this->statusPMModel->filter($id_satker, $thn);
        $spm_pim = $this->sPimPMModel->filter($id_satker, $thn);
        $satker = $this->satkerModel->where('id', $id_satker)->first();

        $data = [
            'tahun' => $thn,
            'persen' => $precentage,
            'role' => session()->get('role'),
            's_pm' => $status_pm,
            'dash' => $dash,
            'satker' => $satker,
            's_pim' => $spm_pim,
        ];

        return view('tbl_pk', $data);
    }
}
