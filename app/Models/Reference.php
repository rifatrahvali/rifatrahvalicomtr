<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reference extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // Toplu atama ile doldurulabilir alanları belirtir.
    protected $fillable = [
        'name',
        'title',
        'company',
        'comment',
        'image',
        'order',
    ];
}
