<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuType extends Model
{
    use HasFactory;
    protected $fillable = ['type_name', 'menu_category_id','price'];
    public function category(){
        return $this->belongsTo(MenuCategory::class, 'menu_category_id');
    }
}
