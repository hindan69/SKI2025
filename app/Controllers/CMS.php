<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CMS extends BaseController
{
    public function admin()
    {        
        return view('/admin/index');
    }

    public function users()
    {
        
    }
}
