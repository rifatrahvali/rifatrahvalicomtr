<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // Toplu atama ile 'name' alanının doldurulabilmesini sağlar.
    protected $fillable = ['name'];

    /**
     * Get all of the experiences that are assigned this skill.
     */
    // Bu becerinin atandığı tüm iş deneyimlerini getiren polimorfik ilişkiyi tanımlar.
    public function experiences()
    {
        return $this->morphedByMany(Experience::class, 'skillable');
    }

    /**
     * Get all of the education records that are assigned this skill.
     */
    // Bu becerinin atandığı tüm eğitim kayıtlarını getiren polimorfik ilişkiyi tanımlar.
    public function educations()
    {
        return $this->morphedByMany(Education::class, 'skillable');
    }
}
