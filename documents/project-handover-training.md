# Proje Teslimi & Eğitim Rehberi

## 1. Kod Walkthrough (Kod İncelemesi)

- Proje klasör yapısı, ana modüller ve önemli dosyalar adım adım anlatılır.
- Her ana fonksiyon, controller ve servis sınıfı örneklerle açıklanır.
- `app/`, `routes/`, `resources/views/`, `tests/` gibi ana klasörlerin amacı ve içeriği gösterilir.
- Onboarding checklist: Geliştirici ortamı kurulumu, .env ayarları, test çalıştırma, ilk migration, ilk deploy.
// Türkçe: Kodun nasıl organize edildiği ve önemli noktalar detaylı gösterilir. Yeni başlayanlar için ilk gün rehberi eklenmiştir.

## 2. Admin Panel Eğitimi

- Admin panelde kullanıcı, içerik, galeri, referans ve ayar yönetimi canlı olarak gösterilir.
- Her modülün temel işlevleri (ekle, düzenle, sil, filtrele) uygulamalı anlatılır.
- Demo senaryosu: Yeni kullanıcı ekleme, blog yazısı oluşturma, galeriye görsel yükleme, referans ekleme, ayar güncelleme.
- Sık yapılan hatalar: Zorunlu alanları doldurmadan kaydetme, görsel formatı hatası, yetkisiz işlem denemesi.
// Türkçe: Admin paneldeki tüm işlemler pratik olarak gösterilir. Demo sırasında yapılan işlemler ve hatalar örneklenir.

## 3. Deployment Prosedürü Eğitimi

- Otomatik deployment pipeline (CI/CD) adımları, manuel deploy ve rollback işlemleri anlatılır.
- Yedek alma, geri yükleme ve bakım moduna alma işlemleri örneklenir.
- Deployment sonrası test checklist: Uygulama açılıyor mu, loglarda hata var mı, yeni özellikler çalışıyor mu?
// Türkçe: Canlıya geçiş ve bakım süreçleri uygulamalı olarak gösterilir. Her adımda neden o işlemin yapıldığı açıklanır.

## 4. Sıkça Sorulan Sorular (Eğitim Sırasında)

**S: Yeni bir modül eklemek için ne yapmalıyım?**
C: İlgili model, migration, controller ve view dosyalarını oluşturup route eklemelisiniz. Sonrasında test ve dokümantasyon eklemeyi unutmayın.

**S: Sunucuya manuel deploy nasıl yapılır?**
C: SSH ile sunucuya bağlanıp `git pull`, `composer install`, `php artisan migrate --force`, `npm run build` komutlarını çalıştırın. Her adım sonrası logları kontrol edin.

**S: Yedekleri nasıl geri yüklerim?**
C: `scripts/deployment/restore.sh` scriptini çalıştırarak en son yedeği geri yükleyebilirsiniz. Yedek sonrası uygulamayı test edin.

**S: CI/CD pipeline başarısız olursa ne yapmalıyım?**
C: Hata mesajını inceleyin, kodu düzeltip tekrar push edin. Gerekirse rollback adımlarını uygulayın.

## 5. Eğitim Oturumu Notları

- Tüm eğitim oturumları video veya yazılı olarak kaydedilir.
- Katılımcıların soruları ve verilen yanıtlar dokümante edilir.
- Eğitim sonrası değerlendirme: Katılımcıdan geri bildirim alınır, eksik kalan noktalar tekrar anlatılır.
// Türkçe: Eğitim sonrası dokümantasyon, yeni ekip üyeleri için referans olur. Sık yapılan hatalar ve çözüm yolları eklenmiştir.

## 6. Onboarding Checklist (Yeni Ekip Üyesi için)

- Geliştirici ortamı kurulumu (PHP, Composer, Node, NPM, MySQL, Redis)
- Proje klonlama: `git clone ...`
- .env dosyasını oluşturma ve ayarları yapma
- `composer install`, `npm install`, `php artisan migrate --seed`, `npm run build`
- Testleri çalıştırma: `php artisan test`
- İlk commit ve push işlemi
// Türkçe: Yeni başlayanlar için adım adım ilk gün rehberi.

## 7. Sık Yapılan Hatalar ve Çözüm Yolları

- Migration hatası: Migration dosyalarını ve veritabanı bağlantısını kontrol edin.
- Test başarısız: Test çıktısını inceleyin, eksik seed veya yanlış env ayarı olabilir.
- Deploy sonrası hata: Logları kontrol edin, cache temizleyin, rollback uygulayın.
// Türkçe: Her hata için pratik çözüm önerisi eklenmiştir.

---

> Türkçe: Bu dosya, proje teslimi ve eğitim sürecinde kodun, panelin ve deployment'ın nasıl kullanılacağını, onboarding checklist, sık sorulan sorular, eğitim notları ve sık yapılan hatalar ile birlikte detaylı olarak sunar. Her adımda neden ve nasıl yapılacağı açıklanmıştır. 