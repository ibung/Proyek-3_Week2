<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id'; // ganti sesuai nama primary key di tabel kamu
    protected $allowedFields = ['username', 'password']; 
}
