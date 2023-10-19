<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'ADM Mis.Raudlatul Atfal'
        ];
        return view('login', $data);
    }
}
