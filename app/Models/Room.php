<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    
    protected $fillable = ['status','room', 'img', 'deskripsi', 'harga'];

    public function Visibility()
    {
        return $this->hasMany(Visibility::class);
    }

    public function Guest()
    {
        return $this->hasMany(Guest::class);
    }

}