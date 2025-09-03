<?php

namespace App\Models;

use CodeIgniter\Model;

class AuditorModel extends Model
{
    protected $table            = 'assign_pk';
    protected $primaryKey       = '';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_pk', 'id_timaudit', 'id_auditor', 'rolepk', 'id_satker', 'id_tu', 'created_date', 'is_active'];


    public function dashboard($id)
    {
        $builder = $this->db->table('assign_pk as ap');
        $builder->select('
            ap.id_satker,
            sat.nama_satker,
            YEAR(ta.tgl_surat) AS periode_penilaian,
            sp.nilai_pm,
            pim.status AS status_pim,
            spk.nilai_pk,
            kpk.status AS status_kpk,
            sl.nilai_lvl,
            klvl.status AS status_klvl,
            ap.is_active,
            ap.rolepk
        ');
        $builder->join('timaudit AS ta', 'ap.id_timaudit = ta.id_timaudit');
        $builder->join('satker AS sat', 'sat.id = ap.id_satker', 'left');
        $builder->join('status_pm AS sp', 'ap.id_satker = sp.id_satker AND YEAR(ta.tgl_surat) = sp.thn_dipa', 'left');
        $builder->join('status_pim AS pim', 'ap.id_satker = pim.id_satker AND YEAR(ta.tgl_surat) = pim.thn_dipa', 'left');
        $builder->join('status_pk AS spk', 'ap.id_satker = spk.id_satker AND YEAR(ta.tgl_surat) = spk.thn_dipa', 'left');
        $builder->join('status_kpk AS kpk', 'ap.id_satker = kpk.id_satker AND YEAR(ta.tgl_surat) = kpk.thn_dipa', 'left');
        $builder->join('status_lvl AS sl', 'ap.id_satker = sl.id_satker AND YEAR(ta.tgl_surat) = sl.thn_dipa', 'left');
        $builder->join('status_klvl AS klvl', 'ap.id_satker = klvl.id_satker AND YEAR(ta.tgl_surat) = klvl.thn_dipa', 'left');
        $builder->where('ap.id_auditor', $id);
        $builder->distinct();
        $builder->orderBy('ap.id_satker', 'ASC');
        $builder->orderBy('periode_penilaian', 'ASC');

        $query = $builder->get();
        return $query->getResultArray();
    }

    public function filterRole($id, $id_satker, $thn)
    {
        $builder = $this->db->table('assign_pk as ap');
        $builder->select('
            ap.id_auditor,
            ap.id_satker,
            sat.nama_satker,
            YEAR(ta.tgl_surat) AS periode_penilaian,
            sp.nilai_pm,
            pim.status AS status_pim,
            spk.nilai_pk,
            kpk.status AS status_kpk,
            sl.nilai_lvl,
            klvl.status AS status_klvl,
            ap.is_active,
            ap.rolepk
        ');
        $builder->join('timaudit AS ta', 'ap.id_timaudit = ta.id_timaudit');
        $builder->join('satker AS sat', 'sat.id = ap.id_satker', 'left');
        $builder->join('status_pm AS sp', 'ap.id_satker = sp.id_satker AND YEAR(ta.tgl_surat) = sp.thn_dipa', 'left');
        $builder->join('status_pim AS pim', 'ap.id_satker = pim.id_satker AND YEAR(ta.tgl_surat) = pim.thn_dipa', 'left');
        $builder->join('status_pk AS spk', 'ap.id_satker = spk.id_satker AND YEAR(ta.tgl_surat) = spk.thn_dipa', 'left');
        $builder->join('status_kpk AS kpk', 'ap.id_satker = kpk.id_satker AND YEAR(ta.tgl_surat) = kpk.thn_dipa', 'left');
        $builder->join('status_lvl AS sl', 'ap.id_satker = sl.id_satker AND YEAR(ta.tgl_surat) = sl.thn_dipa', 'left');
        $builder->join('status_klvl AS klvl', 'ap.id_satker = klvl.id_satker AND YEAR(ta.tgl_surat) = klvl.thn_dipa', 'left');
        $builder->where('ap.id_auditor', $id);
        $builder->where('ap.id_satker', $id_satker);
        $builder->where('YEAR(ta.tgl_surat) =', $thn, false);
        $builder->distinct();
        $builder->orderBy('ap.id_satker', 'ASC');
        $builder->orderBy('periode_penilaian', 'ASC');

        $query = $builder->get();
        return $query->getResultArray();
    }
}
