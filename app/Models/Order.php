<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['reservation_id','qty','types','prices','note','date', 'total'];
    public function reservation(){
        return $this->belongsTo(Reservation::class,'reservation_id');
    }
    protected $casts=[
        'qty'=>'array',
        'types'=>'array',
        'prices'=>'array',
    ];
}
