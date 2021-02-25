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
            'title' => "Form Create List of Sneakers"
        ];

        return view('sneakers/create', $data);
    }

    // sintaks untuk membuat menyimpan data sneakers setelah selesai create
    public function save()
    {
        $slug = url_title($this->request->getVar('name'), '-', true);
        $this->sneakersModel->save([
            'name' => $this->request->getVar('name'),
            'slug' => $slug,
            'brand' => $this->request->getVar('brand'),
            'price' => $this->request->getVar('price'),
            'picture' => $this->request->getVar('picture'),
        ]);

        session()->setFlashdata('message', "Data Added Succesfully ");

        return redirect()->to('/sneakers');
    }

    // sintaks untuk mendelete data sneakers pada aplikasi crud
    public function delete($id)
    {
        $this->sneakersModel->delete($id);
        session()->setFlashdata('message', "Data Deleted Succesfully ");
        return redirect()->to('/Sneakers');
    }

    // sintaks untuk mengedit data sneakers pada aplikasi crud
    public function edit($slug)
    {
        $data = [
            'title' => "Form Edit List of Sneakers",
            'sneakers' => $this->sneakersModel->getSneakers($slug)
        ];

        return view('sneakers/edit', $data);
    }

    // sintaks untuk update untuk mengupdate data setelah berhasil di edit
    public function update($id)
    {
        $slug = url_title($this->request->getVar('name'), '-', true);
        $this->sneakersModel->save([
            'id' => $id,
            'name' => $this->request->getVar('name'),
            'slug' => $slug,
            'brand' => $this->request->getVar('brand'),
            'price' => $this->request->getVar('price'),
            'picture' => $this->request->getVar('picture'),
        ]);

        session()->setFlashdata('message', "Data Updated Succesfully ");

        return redirect()->to('/sneakers');
    }
}
