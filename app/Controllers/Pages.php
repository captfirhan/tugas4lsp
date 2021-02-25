<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home | Web'

        ];
        return view('pages/home', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About | Web'

        ];
        return view('pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact Us',
            'alamat' => [
                [
                    'tipe' => 'rumah',
                    'alamat' => 'Jl. Dinosaurs',
                    'kota' => 'Bogor'
                ],
                [
                    'tipe' => 'rumah',
                    'alamat' => 'Jl. Neo',
                    'kota' => 'Bogor'
                ]
            ],
        ];
        return view('pages/contact', $data);
    }
}
