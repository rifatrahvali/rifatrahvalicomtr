# Bakım ve Güncelleme Rehberi

## 1. Düzenli Bakım Prosedürleri

- Haftalık olarak veritabanı ve dosya yedekleri alın.
- Log dosyalarını arşivleyin ve eski logları silin.
- Sunucu disk alanı ve kaynak kullanımı kontrol edin.
- Güvenlik güncellemelerini takip edin.
// Türkçe: Düzenli bakım, sistemin sorunsuz ve güvenli çalışmasını sağlar.

## 2. Güncelleme ve Yükseltme

### Laravel ve PHP Güncellemesi
1. Bakım modunu aktif edin: `php artisan down`
2. Composer ile güncelleme: `composer update`
3. NPM ile frontend güncelleme: `npm update && npm run build`
4. Migration ve cache işlemleri: `php artisan migrate --force && php artisan config:cache && php artisan route:cache && php artisan view:cache`
5. Bakım modunu kapatın: `php artisan up`
// Türkçe: Güncelleme sırasında bakım modu ile kullanıcı erişimi engellenir.

### Bağımlılık Güncellemeleri
- `composer outdated` ve `npm outdated` ile eski paketleri tespit edin.
- Sadece güvenli ve uyumlu güncellemeleri uygulayın.
// Türkçe: Paket güncellemeleri sonrası testleri mutlaka çalıştırın.

## 3. Performans İzleme Rehberi

- Uptime ve response time için Prometheus/Grafana veya UptimeRobot kullanın.
- `/metrics` endpointi ile temel metrikleri izleyin.
- Laravel Telescope ile sorgu, memory ve response time analizleri yapın (sadece local/dev ortamda).
- Sunucu CPU, RAM ve disk kullanımı için `htop`, `top`, `df -h` komutlarını kullanın.
// Türkçe: Performans izleme, olası yavaşlamaları ve darboğazları önceden tespit etmeye yarar.

## 4. Sorun Giderme Prosedürleri (Troubleshooting)

- **Uygulama açılmıyor:** Log dosyalarını (`storage/logs/laravel.log`) kontrol edin.
- **Migration hatası:** Migration dosyalarını ve veritabanı bağlantısını kontrol edin.
- **Görsel yüklenmiyor:** Dosya izinlerini (`storage/`, `public/`) ve PHP upload limitlerini kontrol edin.
- **E-posta gitmiyor:** .env dosyasındaki mail ayarlarını ve mail sunucusunu test edin.
- **Cache sorunları:** `php artisan config:clear && php artisan cache:clear` komutlarını çalıştırın.
// Türkçe: Sorun giderme adımlarında loglar ve hata mesajları yol göstericidir.

---

> Türkçe: Bu dosya, projenin düzenli bakımı, güncellenmesi, performans izlenmesi ve sorun giderme adımlarını içerir. Her adımda neden ve nasıl yapılacağı detaylı anlatılmıştır. 