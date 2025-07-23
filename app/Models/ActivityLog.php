<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    // Türkçe: updated_at ve created_at otomatik olarak kullanılmaz
    public $timestamps = false;

    // Toplu atama için izin verilen alanlar
    protected $fillable = [
        'user_id', // İşlemi yapan admin kullanıcı id'si
        'action', // Yapılan işlemin kısa adı
        'description', // İşlemin detaylı açıklaması
        'ip_address', // Kullanıcının IP adresi
        'user_agent', // Kullanıcının tarayıcı bilgisi
        'created_at', // İşlemin zamanı
    ];

    /**
     * Log kaydını oluşturan kullanıcı ilişkisi
     */
    public function user()
    {
        // Türkçe: Log kaydını oluşturan kullanıcıyı getirir
        return $this->belongsTo(User::class);
    }

    /**
     * Kolay log kaydı için yardımcı fonksiyon
     *
     * @param string $action
     * @param string|null $description
     * @param int|null $userId
     * @param string|null $ip
     * @param string|null $agent
     * @return static
     */
    public static function log($action, $description = null, $userId = null, $ip = null, $agent = null)
    {
        // Türkçe: Log kaydını hızlıca oluşturur
        return self::create([
            'user_id' => $userId,
            'action' => $action,
            'description' => $description,
            'ip_address' => $ip,
            'user_agent' => $agent,
        ]);
    }
}
