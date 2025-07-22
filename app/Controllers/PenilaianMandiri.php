<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PertanyaanModel;

class PenilaianMandiri extends BaseController
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
    }

    // function index untuk tampilan awal user PM
    public function index()
    {
        $id_satker = session()->get('id_satker');
        $data = [
            'SK' => $this->SKModel->statusSK($id_satker),
            'dataUmum' => $this->DataUmumModel->getBySatker($id_satker)
        ];
        return view('/penilaianMandiri/dataUmum', $data);
    }

    public function save_sk()
    {
        $data = $this->request->getPost();
        $existingData = $this->SKModel->where('thn_anggaran', $data['tahun_anggaran'])
            ->where('id_satker', $data['id_satker'])
            ->first();
        if ($existingData) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data dengan tahun anggaran dan id satker ini sudah ada.']);
        }
        $input = [
            'thn_anggaran' => $data['tahun_anggaran'],
            'link_sk' => $data['url'],
            'id_user' => $data['id_user'],
            'id_satker' => $data['id_satker']
        ];
        $this->SKModel->save($input);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil disimpan', 'data' => $input]);
    }

    public function edit_sk()
    {
        $data = $this->request->getPost();

        $input = [
            'thn_anggaran' => $data['tahun_anggaran'],
            'link_sk' => $data['url'],
            'id_sk' => $data['id_SK'],
            'id_user' => $data['id_user'],
            'id_satker' => $data['id_satker']
        ];
        $this->SKModel->edit($input);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil diperbaharui', 'data' => $input]);
    }

    public function prfl_satker()
    {
        $id_satker = session()->get('id_satker');
        $data = [
            'dataUmum' => $this->DataUmumModel->getBySatker($id_satker)
        ];
        return view('/penilaianMandiri/prfl_satker', $data);
    }

    public function save_prfl_satker()
    {
        $data = $this->request->getPost();
        $existingData = $this->DataUmumModel->where('id_satker', $data['id_satker'])->first(); // Cek apakah id_satker sudah ada

        if ($existingData) {
            // Jika ada, lakukan edit
            $input = [
                'id_satker' => $data['id_satker'],
                'nama_pimpinan' => $data['nama_pimpinan'],
                'nip_pimpinan' => $data['nip_pimpinan'],
                'nama_jabatan' => $data['nama_jabatan'],
                'nama_ketua' => $data['nama_ketua'],
                'nip_ketua' => $data['nip_ketua'],
                'alamat_satker' => $data['alamat_satker'],
                'kota_satker' => $data['kota_satker'],
                'kodepos' => $data['kodepos'],
            ];
            $this->DataUmumModel->edit($input); // Panggil metode edit
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil diperbarui']);
        } else {
            // Jika tidak ada, lakukan save
            $input = [
                'id_satker' => $data['id_satker'],
                'nama_pimpinan' => $data['nama_pimpinan'],
                'nip_pimpinan' => $data['nip_pimpinan'],
                'nama_jabatan' => $data['nama_jabatan'],
                'nama_ketua' => $data['nama_ketua'],
                'nip_ketua' => $data['nip_ketua'],
                'alamat_satker' => $data['alamat_satker'],
                'kota_satker' => $data['kota_satker'],
                'kodepos' => $data['kodepos'],
            ];
            $this->DataUmumModel->save($input);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil disimpan']);
        }
    }

    //  function untuk dashboard
    public function dash()
    {
        $id_satker = session()->get('id_satker');
        $id_user = session()->get('id');
        $thn = $this->request->getGet('thn');
        $precentage = $this->nilaiPMModel->precentage($id_satker, $thn);
        $dash = $this->nilaiPMModel->dashboard($id_satker, $thn);
        $status_pm = $this->statusPMModel->filter($id_satker, $thn);
        $spm_pim = $this->sPimPMModel->filter($id_satker, $thn);
        $user = $this->UserModel->getSatker($id_user);

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

    // function untuk form input LKE pengungkit
    public function soal_pengungkit()
    {
        // Ambil semua data dari model
        $id_satker = session()->get('id_satker');
        $thn = $this->request->getGet('thn');
        $allPertanyaan = $this->pertanyaanModel->soal();
        $allJawaban = $this->nilaiModel->findAll();
        $precentage = $this->nilaiPMModel->precentage($id_satker, $thn);
        $nilaiPM = $this->nilaiPMModel->filter($id_satker, $thn);
        $nilaiPK = $this->nilaiPKModel->filter($id_satker, $thn);
        $nilailvl = $this->nilailvlModel->filter($id_satker, $thn);
        $s_pm = $this->statusPMModel->filter($id_satker, $thn);

        // Filtering data
        $filteredPertanyaan = array_filter($allPertanyaan, function ($pertanyaan) {
            return $pertanyaan->id_unsur >= 1 && $pertanyaan->id_unsur <= 4;
        });

        $filteredJawaban = array_filter($allJawaban, function ($jawaban) {
            return $jawaban['id'] >= 1 && $jawaban['id'] <= 103;
        });

        $filteredNilaiPM = array_filter($nilaiPM, function ($n_pm) {
            return $n_pm['id_pm_satker'] >= 1 && $n_pm['id_pm_satker'] <= 40;
        });

        $filteredNilaiPK = array_filter($nilaiPK, function ($n_pk) {
            return $n_pk['id_pm_satker'] >= 1 && $n_pk['id_pm_satker'] <= 40;
        });

        $filteredNilailvl = array_filter($nilailvl, function ($n_lvl) {
            return $n_lvl['id_pm_satker'] >= 1 && $n_lvl['id_pm_satker'] <= 40;
        });

        // Gabungkan data
        $syncedArray = [];
        foreach ($filteredPertanyaan as $pertanyaan) {
            // Cari jawaban yang sesuai dengan id_indikator
            $relatedJawaban = array_filter($filteredJawaban, function ($jawaban) use ($pertanyaan) {
                return $pertanyaan->id_indikator == $jawaban['nomer'];
            });

            // Cari nilai_pm yang sesuai dengan id_indikator
            $relatedNilaiPM = array_filter($filteredNilaiPM, function ($n_pm) use ($pertanyaan) {
                return $pertanyaan->id_indikator == $n_pm['id_pm_satker'];
            });

            // Cari nilai_pk yang sesuai dengan id_indikator
            $relatedNilaiPK = array_filter($filteredNilaiPK, function ($n_pk) use ($pertanyaan) {
                return $pertanyaan->id_indikator == $n_pk['id_pm_satker']; // Menambahkan logika untuk nilai PK
            });

            // cari nilai_level yang sesuai dengan id_indikator
            $relatedNilailvl = array_filter($filteredNilailvl, function ($n_lvl) use ($pertanyaan) {
                return $pertanyaan->id_indikator == $n_lvl['id_pm_satker']; // Menambahkan logika untuk nilai PK
            });

            // Tambahkan pertanyaan beserta jawaban dan nilai_pm
            $syncedArray[] = [
                'id_unsur'      => $pertanyaan->id_unsur, // Menambahkan judul berdasarkan kondisi
                'nama_unsur'      => $pertanyaan->nama_unsur, // Menambahkan judul berdasarkan kondisi
                'name_sub_unsur'  => $pertanyaan->name_sub_unsur, // Menambahkan judul berdasarkan kondisi
                'id_sub_unsur'    => $pertanyaan->id_sub_unsur,
                'id_indikator'    => $pertanyaan->id_indikator,
                'nama_indikator'  => $pertanyaan->nama_indikator,
                'jawaban'         => array_values($relatedJawaban),
                'nilai_pm'        => array_values($relatedNilaiPM),
                'nilai_pk'        => array_values($relatedNilaiPK),
                'nilai_lvl'       => array_values($relatedNilailvl)
            ];
        }

        // Output hasil gabungan
        $data = [
            'syncedData' => $syncedArray,
            'role' => session()->get('role'),
            'tahun'           => $thn,
            'presen' => $precentage,
            's_pm'            => $s_pm
        ];
        // d($data);
        return view('/penilaianMandiri/soal_pengungkit_V2', $data);
    }

    // function untuk form input LKE hasil
    public function soal_hasil()
    {
        // Ambil semua data dari model
        $id_satker = session()->get('id_satker');
        $thn = $this->request->getGet('thn');
        $allPertanyaan = $this->pertanyaanModel->soal();
        $allJawaban = $this->nilaiModel->findAll();
        $precentage = $this->nilaiPMModel->precentage($id_satker, $thn);
        $nilaiPM = $this->nilaiPMModel->filter($id_satker, $thn);
        $nilaiPK = $this->nilaiPKModel->filter($id_satker, $thn);
        $nilailvl = $this->nilailvlModel->filter($id_satker, $thn);
        $s_pm = $this->statusPMModel->filter($id_satker, $thn);

        // Filtering data
        $filteredPertanyaan = array_filter($allPertanyaan, function ($pertanyaan) {
            return $pertanyaan->id_unsur >= 5 && $pertanyaan->id_unsur <= 9;
        });

        $filteredJawaban = array_filter($allJawaban, function ($jawaban) {
            return $jawaban['id'] >= 103 && $jawaban['id'] <= 139;
        });

        $filteredNilaiPM = array_filter($nilaiPM, function ($n_pm) {
            return $n_pm['id_pm_satker'] >= 41 && $n_pm['id_pm_satker'] <= 49;
        });

        $filteredNilaiPK = array_filter($nilaiPK, function ($n_pk) {
            return $n_pk['id_pm_satker'] >= 41 && $n_pk['id_pm_satker'] <= 49;
        });

        $filteredNilailvl = array_filter($nilailvl, function ($n_lvl) {
            return $n_lvl['id_pm_satker'] >= 41 && $n_lvl['id_pm_satker'] <= 49;
        });

        // Gabungkan data
        $syncedArray = [];
        foreach ($filteredPertanyaan as $pertanyaan) {
            // Cari jawaban yang sesuai dengan id_indikator
            $relatedJawaban = array_filter($filteredJawaban, function ($jawaban) use ($pertanyaan) {
                return $pertanyaan->id_indikator == $jawaban['nomer'];
            });

            // Cari nilai_pm yang sesuai dengan id_indikator
            $relatedNilaiPM = array_filter($filteredNilaiPM, function ($n_pm) use ($pertanyaan) {
                return $pertanyaan->id_indikator == $n_pm['id_pm_satker'];
            });

            // Cari nilai_pk yang sesuai dengan id_indikator
            $relatedNilaiPK = array_filter($filteredNilaiPK, function ($n_pk) use ($pertanyaan) {
                return $pertanyaan->id_indikator == $n_pk['id_pm_satker']; // Menambahkan logika untuk nilai PK
            });

            // cari nilai_level yang sesuai dengan id_indikator
            $relatedNilailvl = array_filter($filteredNilailvl, function ($n_lvl) use ($pertanyaan) {
                return $pertanyaan->id_indikator == $n_lvl['id_pm_satker']; // Menambahkan logika untuk nilai PK
            });

            // Tambahkan pertanyaan beserta jawaban dan nilai_pm
            $syncedArray[] = [
                'id_unsur'      => $pertanyaan->id_unsur, // Menambahkan judul berdasarkan kondisi
                'nama_unsur'      => $pertanyaan->nama_unsur, // Menambahkan judul berdasarkan kondisi
                'name_sub_unsur'  => $pertanyaan->name_sub_unsur, // Menambahkan judul berdasarkan kondisi
                'id_sub_unsur'    => $pertanyaan->id_sub_unsur,
                'id_indikator'    => $pertanyaan->id_indikator,
                'nama_indikator'  => $pertanyaan->nama_indikator,
                'jawaban'         => array_values($relatedJawaban),
                'nilai_pm'        => array_values($relatedNilaiPM),
                'nilai_pk'        => array_values($relatedNilaiPK),
                'nilai_lvl'       => array_values($relatedNilailvl)
            ];
        }

        // Output hasil gabungan
        $data = [
            'syncedData' => $syncedArray,
            'role' => session()->get('role'),
            'tahun'           => $thn,
            'presen' => $precentage,
            's_pm'            => $s_pm
        ];
        // d($data);
        return view('/penilaianMandiri/soal_hasil_v1', $data);
    }

    // function untuk penyimpanan input LKE PM,PK,Leveling
    public function save()
    {
        $data = $this->request->getPost();
        $existingData = $this->nilaiPMModel->where('id_pm_satker', $data['idPmSatker'])
            ->where('thn_dipa', $data['tahun'])
            ->where('id_satker', $data['satkerId'])
            ->first();
        if ($existingData) {
            $input = [
                // 'id' => $existingData['id'],
                'id_user' => $data['id'],
                'id_satker' => $data['satkerId'],
                'id_pm_satker' => $data['idPmSatker'],
                'nilai' => $data['nilaiSelect'],
                'link_dakung' => $data['linkDakung'],
                'thn_dipa' => $data['tahun']
            ];
            $this->nilaiPMModel->edit($input);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil diperbarui']);
        } else {
            $input = [
                'id_user' => $data['id'],
                'id_satker' => $data['satkerId'],
                'id_pm_satker' => $data['idPmSatker'],
                'nilai' => $data['nilaiSelect'],
                'link_dakung' => $data['linkDakung'],
                'thn_dipa' => $data['tahun']
            ];
            $this->nilaiPMModel->save($input);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil disimpan']);
        }
    }

    public function savePK()
    {
        $data = $this->request->getPost();
        $existingData = $this->nilaiPKModel->where('id_pm_satker', $data['idPmSatker'])
            ->where('thn_dipa', $data['tahun'])
            ->where('id_satker', $data['satkerId'])
            ->first();
        if ($existingData) {
            $input = [
                // 'id' => $existingData['id'],
                'id_user' => $data['id'],
                'id_satker' => $data['satkerId'],
                'id_pm_satker' => $data['idPmSatker'],
                'thn_dipa' => $data['tahun'],
                'nilai' => $data['nilaiSelectPK'],
                'komenpk' => $data['komentarPK'],
                'rekomendasi' => $data['rekomenPK']
            ];
            $this->nilaiPKModel->edit($input);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil diperbarui']);
        } else {
            $input = [
                'id_user' => $data['id'],
                'id_satker' => $data['satkerId'],
                'id_pm_satker' => $data['idPmSatker'],
                'thn_dipa' => $data['tahun'],
                'nilai' => $data['nilaiSelectPK'],
                'komenpk' => $data['komentarPK'],
                'rekomendasi' => $data['rekomenPK']
            ];
            $this->nilaiPKModel->save($input);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil disimpan']);
        }
    }

    public function savelvl()
    {
        $data = $this->request->getPost();
        $existingData = $this->nilailvlModel->where('id_pm_satker', $data['idPmSatker'])
            ->where('thn_dipa', $data['tahun'])
            ->where('id_satker', $data['satkerId'])
            ->first();
        if ($existingData) {
            $input = [
                // 'id' => $existingData['id'],
                'id_user' => $data['id'],
                'id_satker' => $data['satkerId'],
                'id_pm_satker' => $data['idPmSatker'],
                'thn_dipa' => $data['tahun'],
                'nilai' => $data['nilaiSelectlvl'],
                'komenlvl' => $data['komentarlvl'],
                'rekomendasi' => $data['rekomenlvl']
            ];
            $this->nilailvlModel->edit($input);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil diperbarui']);
        } else {
            $input = [
                'id_user' => $data['id'],
                'id_satker' => $data['satkerId'],
                'id_pm_satker' => $data['idPmSatker'],
                'thn_dipa' => $data['tahun'],
                'nilai' => $data['nilaiSelectlvl'],
                'komenlvl' => $data['komentarlvl'],
                'rekomendasi' => $data['rekomenlvl']
            ];
            $this->nilailvlModel->save($input);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil disimpan']);
        }
    }

    // function tombol di lke
    public function updateTombol()
    {
        $id_satker = $this->request->getGet('satkerId');
        $thn = $this->request->getGet('tahun');

        // Panggil model untuk mendapatkan data terbaru berdasarkan parameter
        $data = $this->nilaiPMModel->precentage($id_satker, $thn);

        // Kembalikan response dalam bentuk JSON
        return $this->response->setJSON($data);
    }

    // function progress chart
    public function progress_1()
    {
        $pm_satker = 0;
        $n_pm = 0;
        $persentase_pm = 0;
        $n_pk = 0;
        $persentase_pk = 0;
        $n_lvl = 0;
        $persentase_lvl = 0;

        $id_satker = $this->request->getGet('satkerId');
        $thn = $this->request->getGet('tahun');

        $presen = $this->nilaiPMModel->precentage($id_satker, $thn); // Ambil data dari database        

        foreach ($presen as $data) {
            if ($data['id_unsur'] >= 1 and $data['id_unsur'] <= 4) {
                $pm_satker += $data['jumlah_pm_satker'];
                $n_pm += $data['jumlah_nilai_pm'];
                $n_pk += $data['jumlah_nilai_pk'];
                $n_lvl += $data['jumlah_nilai_lvl'];
            }
        }

        if ($pm_satker > 0) {
            $persentase_pm = ($n_pm / $pm_satker) * 100;
            $persentase_pk = ($n_pk / $pm_satker) * 100;
            $persentase_lvl = ($n_lvl / $pm_satker) * 100;
        }

        return $this->response->setJSON([
            'persentase_pm' => $persentase_pm,
            'persentase_pk' => $persentase_pk,
            'persentase_lvl' => $persentase_lvl
        ]);
    }

    public function progress_2()
    {
        $pm_satker = 0;
        $n_pm = 0;
        $persentase_pm = 0;
        $n_pk = 0;
        $persentase_pk = 0;
        $n_lvl = 0;
        $persentase_lvl = 0;

        $id_satker = $this->request->getGet('satkerId');
        $thn = $this->request->getGet('tahun');

        $presen = $this->nilaiPMModel->precentage($id_satker, $thn); // Ambil data dari database        

        foreach ($presen as $data) {
            if ($data['id_unsur'] >= 5 and $data['id_unsur'] <= 9) {
                $pm_satker += $data['jumlah_pm_satker'];
                $n_pm += $data['jumlah_nilai_pm'];
                $n_pk += $data['jumlah_nilai_pk'];
                $n_lvl += $data['jumlah_nilai_lvl'];
            }
        }

        if ($pm_satker > 0) {
            $persentase_pm = ($n_pm / $pm_satker) * 100;
            $persentase_pk = ($n_pk / $pm_satker) * 100;
            $persentase_lvl = ($n_lvl / $pm_satker) * 100;
        }

        return $this->response->setJSON([
            'persentase_pm' => $persentase_pm,
            'persentase_pk' => $persentase_pk,
            'persentase_lvl' => $persentase_lvl
        ]);
    }

    public function submit_pm()
    {
        $data = $this->request->getPost();
        $existingData = $this->statusPMModel->where('id_satker', $data['id_satker'])
            ->where('thn_dipa', $data['tahun'])
            ->first();

        $input = [
            'id_satker' => $data['id_satker'],
            'id_user' => $data['id_user'],
            'status' => 1,
            'thn_dipa' => $data['tahun'],
            'nilai_pm' => $data['nilai_pm']
        ];

        if ($existingData) {
            return $this->response->setJSON(['status' => 'failed', 'message' => 'Data gagal disubmit']);
        } else {
            $this->statusPMModel->insert($input);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil disubmit']);
        }
    }

    public function submit_pim()
    {
        $data = $this->request->getPost();
        $existingData = $this->sPimPMModel->where('id_satker', $data['id_satker'])
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
            $this->sPimPMModel->insert($input);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil disubmit']);
        }
    }

    public function reverse_pm()
    {
        $data = $this->request->getPost();
        $existingData = $this->statusPMModel->where('id_satker', $data['id_satker'])
            ->where('thn_dipa', $data['tahun'])
            ->first();

        if ($existingData) {
            $this->statusPMModel
                ->where('id_satker', $data['id_satker'])
                ->where('thn_dipa', $data['tahun'])
                ->delete();
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        } else {
            return $this->response->setJSON(['status' => 'failed', 'message' => 'Data gagal dihapus']);
        }
    }
}
