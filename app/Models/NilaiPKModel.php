<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiPKModel extends Model
{
    protected $table            = 'nilai_pk';
    protected $primaryKey       = 'idx';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user', 'id_satker', 'id_pm_satker', 'nilai', 'komenpk', 'rekomendasi', 'thn_dipa'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function filter($id_satker, $thn_dipa)
    {
        // Membuat instance query builder untuk tabel 'nilai_pm'
        $builder = $this->db->table('nilai_pk');

        // Pilih kolom yang dibutuhkan
        $builder->select('idx, id_user, id_satker, id_pm_satker, nilai, komenpk, rekomendasi, thn_dipa, date_created');

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
        $builder = $this->db->table('nilai_pk');
        $builder->where('id_satker', $id_satker);
        $builder->where('id_pm_satker', $id_pm_satker);
        $builder->where('thn_dipa', $thn_dipa);
        return $builder->update($data);
    }
}
