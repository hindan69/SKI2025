<?php

namespace App\Models;

use CodeIgniter\Model;

class PertanyaanModel extends Model
{
    protected $table            = 'komponen_sub_unsur';
    protected $primaryKey       = 'id_komponen';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function soal()
    {
        // Subquery pertama: Dari tabel komponen_sub_unsur
        $subquery1 = $this->db->table('komponen_sub_unsur')
            ->select('id_komponen, id_unsur, id_sub_unsur, id_indikator');

        // Subquery kedua: Dari tabel komponen_unsur
        $subquery2 = $this->db->table('komponen_unsur')
            ->select("id_komponen, id_unsur, '0' AS id_sub_unsur, id_indikator", false); // Literal '0'

        // Gabungkan kedua subquery menggunakan UNION
        $unionQuery = $subquery1->unionAll($subquery2);

        // Query utama: LEFT JOIN dengan tabel indikator, komponen, sub_unsur, dan unsur
        $builder = $this->db->table("({$unionQuery->getCompiledSelect()}) AS ks")
            ->select('ks.id_komponen, c.nama_komponen, ks.id_unsur,  u.nama_unsur, ks.id_sub_unsur, su.name_sub_unsur, ks.id_indikator, i.nama_indikator ')
            ->join('indikator AS i', 'ks.id_indikator = i.id_indikator', 'left')
            ->join('komponen AS c', 'ks.id_komponen = c.id_komponen', 'left')
            ->join('sub_unsur AS su', 'ks.id_sub_unsur = su.id_sub_unsur', 'left')
            ->join('unsur AS u', 'ks.id_unsur = u.id_unsur', 'left');

        // Eksekusi query
        $query = $builder->get();
        $result = $query->getResult();

        // Tampilkan hasil (opsional)
        return $result;
    }

    public function xx()
    {
        // Subquery pertama: Dari tabel komponen_sub_unsur
        $subquery1 = $this->db->table('komponen_sub_unsur')
            ->select('id_komponen, id_unsur, id_sub_unsur, id_indikator');

        // Subquery kedua: Dari tabel komponen_unsur
        $subquery2 = $this->db->table('komponen_unsur')
            ->select("id_komponen, id_unsur, '0' AS id_sub_unsur, id_indikator", false); // Literal '0'

        // Gabungkan kedua subquery menggunakan UNION
        $unionQuery = $subquery1->union($subquery2);

        // Query utama: LEFT JOIN dengan tabel indikator
        $builder = $this->db->table("({$unionQuery->getCompiledSelect()}) AS ks")
            ->select('ks.id_komponen, ks.id_unsur, ks.id_sub_unsur, ks.id_indikator, i.nama_indikator')
            ->join('indikator AS i', 'ks.id_indikator = i.id_indikator', 'left');

        // Eksekusi query
        $query = $builder->get();
        $result = $query->getResult();

        // Tampilkan hasil (opsional)
        return $result;
    }
}
