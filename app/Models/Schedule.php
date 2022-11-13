<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    public function motor(){
        return $this->belongsTo(Motor::class);
    }

    public function sparepart(){
        return $this->belongsTo(Sparepart::class);
    }
}
