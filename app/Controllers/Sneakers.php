<?php

namespace App\Controllers;

use App\Models\SneakersModel;

class Sneakers extends BaseController
{
    public function __construct()
    {
        $this->sneakersModel = new SneakersModel();
    }
    public function index()
    {
        // $sneakers = $this->sneakersModel->findAll();

        $data = [
            'title' => 'List Of Sneakers',
            'sneakers' => $this->sneakersModel->getSneakers()
        ];


        return view('sneakers/index', $data);
    }

    // sintaks untuk membuat detail sneakers pada aplikasi crud
    public function detail($slug)
    {
        $sneakers = $this->sneakersModel->getSneakers($slug);
        $data = [
            'title' => 'Detail Sneakers',
            'sneakers' => $this->sneakersModel->getSneakers($slug)
        ];

        if (empty($data['sneakers'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Sneakers Name' . ' Not Found ');
        }

        return view('sneakers/detail', $data);
    }

    // sintaks untuk membuat data sneakers baru pada aplikasi crud
    public function create()
    {
        $data = [
            'title' => "Form Create List of Sneakers",
            'validation' => \Config\Services::validation()
        ];

        return view('sneakers/create', $data);
    }

    // sintaks untuk membuat menyimpan data sneakers setelah selesai create
    public function save()
    {
        // validasi input
        if (!$this->validate([
            'name' => [
                'rules' => 'required|is_unique[sneakers.name]',
                'errors' => [
                    'required' => 'Sneakers name must be filled.',
                    'is_unique' => 'Sneakers name has been registered.'
                ]
            ],
            'brand' => [
                'rules' => 'required[sneakers.brand]',
                'errors' => [
                    'required' => 'Brand name must be filled.'
                ]
            ],
            'price' => 'required[sneakers.price]',
            'picture' => [
                'rules' => 'max_size[picture,2048]|is_image[picture]|mime_in[picture,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'The size of the picture is too big.',
                    'is_image' => 'The one you choose is not a picture.',
                    'mime_in' => 'The one you choose is not a picture.'
                ]
            ]
        ])) {
            return redirect()->to('/sneakers/create')->withInput();
        }

        $filePicture = $this->request->getFile('picture');

        // apakah tidak ada gambar yang diupload
        if ($filePicture->getError() == 4) {
            $sneakersName = 'default.jpg';
        } else {
            // generate nama file random
            $sneakersName = $filePicture->getRandomName();
            // move picture
            $filePicture->move('img', $sneakersName);
        }


        $slug = url_title($this->request->getVar('name'), '-', true);
        $this->sneakersModel->save([
            'name' => $this->request->getVar('name'),
            'slug' => $slug,
            'brand' => $this->request->getVar('brand'),
            'price' => $this->request->getVar('price'),
            'picture' => $sneakersName
        ]);

        session()->setFlashdata('message', "Data Added Succesfully ");

        return redirect()->to('/sneakers');
    }

    // sintaks untuk mendelete data sneakers pada aplikasi crud
    public function delete($id)
    {
        // cari gambar berdasarkan id
        $sneakers = $this->sneakersModel->find($id);

        // cek jika file gambarnya default.jpg
        if ($sneakers['picture'] != 'default.jpg') {
            // delete image
            unlink('img' . $sneakers['picture']);
        }

        $this->sneakersModel->delete($id);
        session()->setFlashdata('message', "Data Deleted Succesfully ");
        return redirect()->to('/Sneakers');
    }

    // sintaks untuk mengedit data sneakers pada aplikasi crud
    public function edit($slug)
    {
        $data = [
            'title' => "Form Edit List of Sneakers",
            'validation' => \Config\Services::validation(),
            'sneakers' => $this->sneakersModel->getSneakers($slug)
        ];

        return view('sneakers/edit', $data);
    }

    // sintaks untuk update untuk mengupdate data setelah berhasil di edit
    public function update($id)
    {
        //cek name
        $sneakersOld = $this->sneakersModel->getSneakers($this->request->getVar('slug'));
        if ($sneakersOld['name'] == $this->request->getVar('name')) {
            $rule_name = 'required';
        } else {
            $rule_name = 'required|is_unique[sneakers.name]';
        }

        // validasi input
        if (!$this->validate([
            'name' => [
                'rules' => $rule_name,
                'errors' => [
                    'required' => 'Sneakers name must be filled.',
                    'is_unique' => 'Sneakers name has been registered.'
                ]
            ],
            'brand' => [
                'rules' => 'required[sneakers.brand]',
                'errors' => [
                    'required' => 'Brand name must be filled.'
                ]
            ],
            'price' => 'required[sneakers.price]',
            'picture' => [
                'rules' => 'max_size[picture,2048]|is_image[picture]|mime_in[picture,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'The size of the picture is too big.',
                    'is_image' => 'The one you choose is not a picture.',
                    'mime_in' => 'The one you choose is not a picture.'
                ]
            ]
        ])) {
            return redirect()->to('/sneakers/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $filePicture = $this->request->getFile('picture');

        // cek gambar, apakah tetap gambar lama
        if ($filePicture->getError() == 4) {
            $sneakersName = $this->request->getVar('oldPicture');
        } else {
            // generate nama file random
            $sneakersName = $filePicture->getRandomName();
            // move picture
            $filePicture->move('img', $sneakersName);
            // delete old file
            unlink('img/' . $this->request->getVar('oldPicture'));
        }


        $slug = url_title($this->request->getVar('name'), '-', true);
        $this->sneakersModel->save([
            'id' => $id,
            'name' => $this->request->getVar('name'),
            'slug' => $slug,
            'brand' => $this->request->getVar('brand'),
            'price' => $this->request->getVar('price'),
            'picture' => $sneakersName
        ]);

        session()->setFlashdata('message', "Data Updated Succesfully ");

        return redirect()->to('/sneakers');
    }
}
