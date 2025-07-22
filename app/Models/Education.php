<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Education extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // Toplu atama ile doldurulabilecek alanları belirtiyoruz.
    // Bu, create veya update metotlarıyla bu alanların güvenli bir şekilde doldurulmasını sağlar.
    protected $fillable = [
        'user_id',
        'school',
        'degree',
        'field_of_study',
        'description',
        'start_date',
        'end_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // Tarih alanlarının Carbon nesnelerine dönüştürülmesini sağlıyoruz.
    // Bu, tarih formatlama ve manipülasyonunu kolaylaştırır.
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Get the user that owns the education.
     */
    // Bu eğitim bilgisinin ait olduğu kullanıcıyı getiren ilişkiyi tanımlar.
    // 'belongsTo' ilişkisi, bu modelin başka bir modele ait olduğunu belirtir.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the skills for the education record.
     */
    // Bu eğitim kaydı ile ilişkili tüm becerileri getiren polimorfik ilişkiyi tanımlar.
    // 'morphToMany' metodu, bu modelin başka bir modelle polimorfik bir çoktan-çoğa ilişkisi olduğunu belirtir.
    public function skills()
    {
        return $this->morphToMany(Skill::class, 'skillable');
    }
}
