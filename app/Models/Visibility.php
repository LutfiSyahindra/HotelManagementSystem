<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visibility extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function Room()
    {
        return $this->belongsTo(Room::class);
    }
}
