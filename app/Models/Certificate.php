<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Certificate extends Model
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
        'name',
        'issuing_organization',
        'issue_date',
        'expiration_date',
        'credential_id',
        'credential_url',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // Tarih alanlarının Carbon nesnelerine dönüştürülmesini sağlıyoruz.
    // Bu, tarih formatlama ve manipülasyonunu kolaylaştırır.
    protected $casts = [
        'issue_date' => 'date',
        'expiration_date' => 'date',
    ];

    /**
     * Get the user that owns the certificate.
     */
    // Bu sertifikanın ait olduğu kullanıcıyı getiren ilişkiyi tanımlar.
    // 'belongsTo' ilişkisi, bu modelin başka bir modele ait olduğunu belirtir.
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
