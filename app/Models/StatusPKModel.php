<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusPKModel extends Model
{
    protected $table            = 'status_pk';
    // protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_satker', 'id_user', 'status', 'thn_dipa', 'nilai_pk', 'created_at'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
