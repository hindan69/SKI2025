<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TataUsaha extends BaseController
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
    }

    public function index()
    {
        $ir = session()->get('email');
        $data = [
            'tim' => array_slice($this->TimauditModel->getByIR($ir), 0, 5),
            'resume' => $this->SKModel->resume($ir)
        ];
        return view('/tataUsaha/index', $data);
    }

    // controller untuk create tim audit
    public function create_tim()
    {
        $ins = session()->get('email');
        $data = [
            'satker' => $this->satkerModel->getSatkerByPembina($ins),
            'inspektur' => $this->UserModel->getInspektur()
        ];
        return view('/tataUsaha/form', $data);
    }

    // controller untuk menampilkan tim audit based on IR
    public function tableTim()
    {
        $ir = session()->get('email');
        $data = [
            'tim' => $this->TimauditModel->getByIR($ir)
        ];
        return View('/tatausaha/tabelTim', $data);
    }

    // controller untuk menambahkan anggota tim
    public function tambahAnggota()
    {
        $encodedId = $this->request->getGet('id');
        $id = base64_decode($encodedId);
        $data = [
            'tim' => $this->TimauditModel->getByID($id),
            'auditor' => $this->UserModel->getAuditor()
        ];
        return view('/tatausaha/anggota', $data);
    }

    // controller untuk save timaudit
    public function save()
    {
        $data = $this->request->getPost();
        $existingData = $this->TimauditModel->where('id_satker', $data['satkerId'])
            ->where('tim', $data['tipePenilaian'])
            ->where('YEAR(tgl_surat)', date('Y', strtotime($data['tglSurat'])))
            ->first();
        if ($existingData) {
            return $this->response->setJSON(['status' => 'failed', 'message' => 'Tim Sudah Ada']);
        } else {
            $input = [
                'id_satker' => $data['satkerId'],
                'nosurat' => $data['noSurat'],
                'tgl_surat' => $data['tglSurat'],
                'tgl_awal' => $data['tglAwal'],
                'tgl_akhir' => $data['tglAkhir'],
                'penanggungjawab' => $data['pj'],
                'tim' => $data['tipePenilaian'],
                'namapenanggung' => $data['ir'],
                'statustim' => 0
            ];
            $this->TimauditModel->save($input);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil disimpan']);
        }
    }

    // controller untuk update tgl timaudit
    public function upTim()
    {
        $d = $this->request->getPost();
        $data = [
            'id_timaudit' => $d['id_timaudit'],
            'tglAwal' => $d['tglAwal'],
            'tglAkhir' => $d['tglAkhir'],
        ];

        $this->TimauditModel->updateByID($data);
        return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil diubah']);
    }

    // controller untuk menambah anggota tim
    public function save_anggota()
    {
        $id_timaudit = $this->request->getPost('id_timaudit');
        $id_user     = $this->request->getPost('id_user');
        $posisi      = $this->request->getPost('posisi');
        $id_satker   = $this->request->getPost('idSatker');
        $id_TU   = $this->request->getPost('idTu');

        // Cek apakah id_user sudah ada dalam id_timaudit
        $duplikatUser = $this->AnggotaTimModel
            ->where('id_timaudit', $id_timaudit)
            ->where('id_auditor', $id_user)
            ->first();

        if ($duplikatUser) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Auditor sudah menjadi anggota'
            ]);
        }

        // Cek apakah sudah ada posisi = 1 dalam id_timaudit
        if ($posisi == 10) {
            $duplikatPosisi = $this->AnggotaTimModel
                ->where('id_timaudit', $id_timaudit)
                ->where('rolepk', 10)
                ->first();

            if ($duplikatPosisi) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Sudah ada Ketua Tim'
                ]);
            }
        }

        // Jika validasi lolos, lanjut simpan
        $data = [
            'id_timaudit' => $id_timaudit,
            'id_auditor'     => $id_user,
            'rolepk'      => $posisi,
            'id_satker'  => $id_satker,
            'created_date' => date('Y-m-d H:i:s'),
            'id_tu'     => $id_TU,
            'is_active' => 0
        ];

        $this->AnggotaTimModel->save($data);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Anggota berhasil ditambahkan.'
        ]);
    }

    // controller table anggota
    public function tabAnggota()
    {
        $encodedId = $this->request->getGet('id');
        $id = base64_decode($encodedId);
        $data = [
            'tim' => $this->AnggotaTimModel->getByID($id)
        ];
        return view('/tatausaha/tabelAnggota', $data);
    }

    // controller untuk menghapus anggota tim
    public function delAnggota()
    {
        $id = $this->request->getPost('id');
        if ($this->AnggotaTimModel->delete($id)) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    // controller untuk mengaktifkan tim
    public function subTim()
    {
        $d = $this->request->getPost();
        $data = [
            'id_timaudit' => $d['id_timaudit'],
            'statustim' => 1
        ];

        $data2 = [
            'id_timaudit' => $d['id_timaudit'],
            'is_active' => 1
        ];

        $this->AnggotaTimModel->updateByStat($data2);

        $this->TimauditModel->updateByStat($data);
        return $this->response->setJSON(['status' => 'success', 'message' => 'Tim berhasil diaktifkan!']);
    }

    // controller untuk menampilkan tim secara lengkap
    public function displayTim()
    {
        $x = $this->request->getGet();
        $d = $x['id'];
        $timaudit = $this->TimauditModel->getByID($d);
        $anggotatim = $this->AnggotaTimModel->getByID($d);

        $data = [
            'tim' => $timaudit,
            'anggota' => $anggotatim
        ];

        if ($data) {
            return $this->response->setJSON($data); // Kirim data sebagai JSON
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        }

        // return $this->response->setJSON(['status' => 'success', 'message' => $d]);
    }

    // controller delete tim
    public function delTim()
    {
        $d = $this->request->getPost();
        $idTim = $d['id'];

        $this->TimauditModel->delete($idTim);
        $this->AnggotaTimModel->where('id_timaudit', $idTim)->delete();

        return $this->response->setJSON(['status' => 'success', 'message' => 'Tim sudah terhapus!']);
    }
}
