<?php

namespace App\Services\Security;

class InputSanitizer
{
    /**
     * Girilen metni XSS ve zararlı HTML'den arındırır.
     *
     * @param string|null $input
     * @return string
     */
    public static function clean(?string $input): string
    {
        if (is_null($input)) {
            return '';
        }
        // HTMLPurifier yüklüyse onu kullan, yoksa strip_tags ve htmlspecialchars uygula
        if (class_exists('HTMLPurifier')) {
            $purifier = new \HTMLPurifier();
            $input = $purifier->purify($input);
        } else {
            $input = strip_tags($input);
            $input = htmlspecialchars($input, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        }
        return $input;
        // Türkçe: Bu fonksiyon, input'u XSS ve zararlı HTML'den temizler.
    }
} 