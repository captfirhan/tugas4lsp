<?php

namespace App\Models;

use CodeIgniter\Model;

class SneakersModel extends Model
{
    protected $table = 'sneakers';
    //protected $useTimestamps = true;
    protected $allowedFields = ['name', 'slug', 'brand', 'price', 'picture'];

    public function getSneakers($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}
