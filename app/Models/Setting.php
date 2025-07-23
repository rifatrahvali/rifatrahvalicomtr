<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    // Toplu atama için izin verilen alanlar
    protected $fillable = [
        'key', // Ayarın anahtar ismi
        'value', // Ayarın değeri
        'type', // Veri tipi
        'group', // Ayar grubu
        'description', // Açıklama
        'updated_by', // Son güncelleyen admin id'si
    ];

    // value alanı json ise otomatik olarak diziye çevrilir
    protected $casts = [
        'value' => 'array', // JSON tipli ayarlar için otomatik cast
    ];

    /**
     * Belirli bir gruba ait ayarları getirir
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $group
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGroup($query, $group)
    {
        // Türkçe: Belirli bir ayar grubunu filtreler
        return $query->where('group', $group);
    }
}
