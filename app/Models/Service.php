<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['room_id','date_in','date_out','state','note'];
    public function room(){
        return $this->belongsTo(Room::class,'id');
    }
}
