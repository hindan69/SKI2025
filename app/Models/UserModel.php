<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'username',
        'email',
        'firstname',
        'lastname',
        'password',
        'id_satker',
        'role',
        'created_at'
    ];

    public function getUserdata()
    {
        return $this->db->table('users')
            ->join('roles', 'roles.id=users.role')
            ->get()->getResultArray();
    }

    public function getSatker($id)
    {
        $builder = $this->db->table('users AS u')
            ->select('u.id, u.username, u.firstname, u.lastname, u.email, u.id_satker, s.nama_satker, s.nama_organisasi, s.pembina')
            ->join('satker AS s', 'u.id_satker = s.id', 'left')
            ->where('u.id', $id);

        $query = $builder->get();
        $result = $query->getResult(); // Ambil hasil dalam bentuk object

        return $result;
    }

    public function getInspektur()
    {
        return $this->where('role', '6')
            ->findAll();
    }

    public function getAuditor()
    {
        return $this->where('role', '5')
            ->findAll();
    }
}
