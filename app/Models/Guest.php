<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function Room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
    public function DetailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}
