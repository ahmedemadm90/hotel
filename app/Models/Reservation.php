<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable=['customer_id','room_id', 'reservation_date','from_date','to_date','state','bill'];
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function room(){
        return $this->belongsTo(Room::class);
    }
}
