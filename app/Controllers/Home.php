<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        echo "beranda";
    }

    public function tbl_pk(): string
    {
        return view('tbl_pk');
    }

    public function tbl_lvl(): string
    {
        return view('tbl_level');
    }

   


}
