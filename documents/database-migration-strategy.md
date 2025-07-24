# Production Database Migration & Seeding Strategy

## 1. Migration Rollback ve Güvenli Yükseltme
- Production ortamında migration rollback işlemleri risklidir. Veri kaybı yaşanmaması için migration'lar dikkatli yazılmalı ve test edilmelidir.
- Migration komutları:
  - `php artisan migrate` : Tüm migration'ları uygular.
  - `php artisan migrate:rollback` : Son migration grubunu geri alır (riskli, production'da dikkatli kullanılmalı).
  - `php artisan migrate:status` : Migration'ların durumunu gösterir.
  - `php artisan migrate:fresh` : Tüm tabloları silip baştan oluşturur (production'da kullanılmaz!).
- **Tavsiye:** Production ortamında migration rollback yerine yeni migration ile düzeltme yapılmalı.

## 2. Production Data Seeding
- Seeder'lar production ortamında dikkatli çalıştırılmalıdır. Sadece güvenli ve idempotent (tekrar çalıştırılabilir) seed'ler kullanılmalı.
- Komutlar:
  - `php artisan db:seed --class=SeederName` : Belirli bir seeder'ı çalıştırır.
  - `php artisan db:seed` : DatabaseSeeder içindeki tüm seed'leri çalıştırır.
- **Tavsiye:** Production'da demo/test verisi seed edilmemeli, sadece gerçek ihtiyaç duyulan seed'ler kullanılmalı.

## 3. Database Backup Prosedürleri
- Migration veya seed işlemi öncesi mutlaka tam veritabanı yedeği alınmalıdır.
- Örnek MySQL backup komutu:
  ```bash
  mysqldump -u cvblog_user -p cvblog_prod > backup_$(date +%F).sql
  ```
- Yedekler güvenli bir dizinde ve erişimi kısıtlı şekilde saklanmalıdır.

## 4. Migration Testing
- Migration ve seed işlemleri test ortamında otomatik olarak test edilmelidir.
- `php artisan migrate:fresh --seed` komutu ile tüm migration ve seed işlemleri test edilebilir.

---

> Türkçe: Bu doküman production ortamı için migration, seed ve backup stratejilerini açıklar. 