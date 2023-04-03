<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $guarded =[
        'id',
    ];

    public function DetailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class);
    }

    // public function setCatAttribute($value)
    // {
    //     $this->attributes['fasilitas'] = json_encode($value);
    // }

    // public function getCatAttribute($value)
    // {
    //     return $this->attributes['fasilitas'] = json_decode($value);
    // }
}
