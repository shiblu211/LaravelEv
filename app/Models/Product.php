<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'subcategory_id',
        'price',
        'thumbnail',
    ];

    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }
}
