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
    protected $PKModel;
    protected $PimPKModel;
    protected $statuspk;
    protected $SPimPK;
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
        $this->PKModel = new \App\Models\PKModel();
        $this->PimPKModel = new \App\Models\PimPKModel();
        $this->statuspk = new \App\Models\StatusPKModel();
        $this->SPimPK = new \App\Models\SPimPKModel();
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
        // d($data);
        return view('auditor/riwayat_penilaian', $data);
    }

    public function dash()
    {
        $user_id = session()->get('id');
        $id_satker = $this->request->getGet('id_satker');
        $thn = $this->request->getGet('thn');
        $precentage = $this->nilaiPKModel->precentage($id_satker, $thn);
        $dash = $this->nilaiPKModel->dashboard($id_satker, $thn);
        $satker = $this->satkerModel->where('id', $id_satker)->first();
        $status_pm = $this->PKModel->filter($id_satker, $thn);
        $spm_pim = $this->PimPKModel->filter($id_satker, $thn);
        $user = $this->AuditorModel->filterRole(session()->get('id'), $id_satker, $thn);
        $roles = $this->AuditorModel->filterRole($user_id, $id_satker, $thn);
        if (!empty($roles)) {
            $role = (int) $roles[0]['rolepk']; // karena hasilnya array of array
        }

        $data = [
            'tahun' => $thn,
            'persen' => $precentage,
            'role' => $role,
            'dash' => $dash,
            'satker' => $satker,
            's_pm' => $status_pm,
            's_pim' => $spm_pim,
            'user' => $user,
            'id_satker' => $id_satker
        ];

        return view('/auditor/tbl_pk', $data);
    }

    public function submit_pk()
    {
        $data = $this->request->getPost();
        $existingData = $this->statuspk->where('id_satker', $data['id_satker'])
            ->where('thn_dipa', $data['tahun'])
            ->first();

        $input = [
            'id_satker' => $data['id_satker'],
            'id_user' => $data['id_user'],
            'status' => 1,
            'thn_dipa' => $data['tahun'],
            'nilai_pk' => $data['nilai_pk']
        ];

        if ($existingData) {
            return $this->response->setJSON(['status' => 'failed', 'message' => 'Data gagal disubmit']);
        } else {
            $this->statuspk->insert($input);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil disubmit']);
        }
    }

    public function submit_pim()
    {
        $data = $this->request->getPost();
        $existingData = $this->SPimPK->where('id_satker', $data['id_satker'])
            ->where('thn_dipa', $data['tahun'])
            ->first();

        $input = [
            'id_satker' => $data['id_satker'],
            'id_user' => $data['id_user'],
            'status' => 1,
            'thn_dipa' => $data['tahun']
        ];

        if ($existingData) {
            return $this->response->setJSON(['status' => 'failed', 'message' => 'Data gagal disubmit']);
        } else {
            $this->SPimPK->insert($input);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil disubmit']);
        }
    }

    public function reverse_pk()
    {
        $data = $this->request->getPost();
        $existingData = $this->statuspk->where('id_satker', $data['id_satker'])
            ->where('thn_dipa', $data['tahun'])
            ->first();

        if ($existingData) {
            $this->statuspk
                ->where('id_satker', $data['id_satker'])
                ->where('thn_dipa', $data['tahun'])
                ->delete();
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        } else {
            return $this->response->setJSON(['status' => 'failed', 'message' => 'Data gagal dihapus']);
        }
    }
}
