<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiPMModel extends Model
{
    protected $table            = 'nilai_pm';
    protected $primaryKey       = 'idx';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['idx', 'id_user', 'id_satker', 'id_pm_satker', 'nilai', 'link_dakung', 'thn_dipa'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function filter($id_satker, $thn_dipa)
    {
        // Membuat instance query builder untuk tabel 'nilai_pm'
        $builder = $this->db->table('nilai_pm');

        // Pilih kolom yang dibutuhkan
        $builder->select('idx, id_user, id_satker, id_pm_satker, nilai, link_dakung, thn_dipa, date_created');

        // Tambahkan filter WHERE
        $builder->where('id_satker', $id_satker);
        $builder->where('thn_dipa', $thn_dipa);

        // Eksekusi query
        $query = $builder->get();

        // Kembalikan hasil sebagai array
        return $query->getResultArray(); // atau getResult() untuk objek
    }

    public function edit($data)
    {
        $id_satker = $data['id_satker'];
        $id_pm_satker = $data['id_pm_satker'];
        $thn_dipa = $data['thn_dipa'];
        $builder = $this->db->table('nilai_pm');
        $builder->where('id_satker', $id_satker);
        $builder->where('id_pm_satker', $id_pm_satker);
        $builder->where('thn_dipa', $thn_dipa);
        return $builder->update($data);
    }

    public function precentage($id_satker, $thn_dipa)
    {
        $builder = $this->db->table('pm_satker as a');

        // Select columns
        $builder->select('
        a.id_unsur,
        COUNT(DISTINCT a.id_indikator) AS jumlah_pm_satker,
        COUNT(DISTINCT n_pm.id_pm_satker) AS jumlah_nilai_pm,
        CASE 
            WHEN COUNT(DISTINCT a.id_indikator) = 0 THEN NULL  
            WHEN COUNT(DISTINCT n_pm.id_pm_satker) = 0 THEN 0  
            ELSE (COUNT(DISTINCT n_pm.id_pm_satker) * 100.0 / COUNT(DISTINCT a.id_indikator)) 
        END AS presentase_pm,
        COUNT(DISTINCT n_pk.id_pm_satker) AS jumlah_nilai_pk,
        CASE 
            WHEN COUNT(DISTINCT a.id_indikator) = 0 THEN NULL  
            WHEN COUNT(DISTINCT n_pk.id_pm_satker) = 0 THEN 0  
            ELSE (COUNT(DISTINCT n_pk.id_pm_satker) * 100.0 / COUNT(DISTINCT a.id_indikator)) 
        END AS presentase_pk,
        COUNT(DISTINCT n_lvl.id_pm_satker) AS jumlah_nilai_lvl,
        CASE 
            WHEN COUNT(DISTINCT a.id_indikator) = 0 THEN NULL  
            WHEN COUNT(DISTINCT n_lvl.id_pm_satker) = 0 THEN 0  
            ELSE (COUNT(DISTINCT n_lvl.id_pm_satker) * 100.0 / COUNT(DISTINCT a.id_indikator)) 
        END AS presentase_lvl
        ');

        // Left Join dengan tabel terkait
        $builder->join('nilai_pm as n_pm', 'n_pm.id_pm_satker = a.id_pm_satker AND n_pm.id_satker = ' . $id_satker . ' AND n_pm.thn_dipa = ' . $thn_dipa, 'left');
        $builder->join('nilai_pk as n_pk', 'n_pk.id_pm_satker = a.id_pm_satker AND n_pk.id_satker = ' . $id_satker . ' AND n_pk.thn_dipa = ' . $thn_dipa, 'left');
        $builder->join('nilai_level as n_lvl', 'n_lvl.id_pm_satker = a.id_pm_satker AND n_lvl.id_satker = ' . $id_satker . ' AND n_lvl.thn_dipa = ' . $thn_dipa, 'left');

        // Group By
        $builder->groupBy('a.id_unsur');

        // Execute query
        $query = $builder->get();

        // Return as array
        return $query->getResultArray();
    }

    public function dashboard($id_satker, $thn_dipa)
    {
        $subquery1 = $this->db->table('komponen_sub_unsur')
            ->select('id_komponen, id_unsur, id_sub_unsur, id_indikator');

        $subquery2 = $this->db->table('komponen_unsur')
            ->select("id_komponen, id_unsur, '0' AS id_sub_unsur, id_indikator", false); // Literal '0'

        // Menggabungkan dua subquery dengan UNION ALL
        $unionQuery = $subquery1->unionAll($subquery2);

        // Query utama dengan LEFT JOIN
        $builder = $this->db->table("({$unionQuery->getCompiledSelect()}) AS ks")
            ->select('ks.id_komponen, c.nama_komponen, ks.id_unsur, u.nama_unsur, 
              ks.id_sub_unsur, su.name_sub_unsur, ks.id_indikator, i.nama_indikator, 
              i.bobot_indikator, COALESCE(p_nilai.nilai, 0) AS nilai', false) // Menangani NULL dengan COALESCE
            ->join('indikator AS i', 'ks.id_indikator = i.id_indikator', 'left')
            ->join('komponen AS c', 'ks.id_komponen = c.id_komponen', 'left')
            ->join('sub_unsur AS su', 'ks.id_sub_unsur = su.id_sub_unsur', 'left')
            ->join('unsur AS u', 'ks.id_unsur = u.id_unsur', 'left')
            ->join('nilai_pm AS n_pm', 'ks.id_indikator = n_pm.id_pm_satker AND n_pm.id_satker = ' . $this->db->escape($id_satker) . ' AND n_pm.thn_dipa = ' . $this->db->escape($thn_dipa), 'left', false)
            ->join('pilih_nilai AS p_nilai', 'n_pm.nilai = p_nilai.id', 'left')
            ->orderBy('ks.id_indikator', 'ASC');

        $query = $builder->get();
        $result = $query->getResult();

        return $result;
    }
}
