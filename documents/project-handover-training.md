# Proje Teslimi & Eğitim Rehberi

## 1. Kod Walkthrough (Kod İncelemesi)

- Proje klasör yapısı, ana modüller ve önemli dosyalar adım adım anlatılır.
- Her ana fonksiyon, controller ve servis sınıfı örneklerle açıklanır.
// Türkçe: Kodun nasıl organize edildiği ve önemli noktalar detaylı gösterilir.

## 2. Admin Panel Eğitimi

- Admin panelde kullanıcı, içerik, galeri, referans ve ayar yönetimi canlı olarak gösterilir.
- Her modülün temel işlevleri (ekle, düzenle, sil, filtrele) uygulamalı anlatılır.
// Türkçe: Admin paneldeki tüm işlemler pratik olarak gösterilir.

## 3. Deployment Prosedürü Eğitimi

- Otomatik deployment pipeline (CI/CD) adımları, manuel deploy ve rollback işlemleri anlatılır.
- Yedek alma, geri yükleme ve bakım moduna alma işlemleri örneklenir.
// Türkçe: Canlıya geçiş ve bakım süreçleri uygulamalı olarak gösterilir.

## 4. Sıkça Sorulan Sorular (Eğitim Sırasında)

**S: Yeni bir modül eklemek için ne yapmalıyım?**
C: İlgili model, migration, controller ve view dosyalarını oluşturup route eklemelisiniz.

**S: Sunucuya manuel deploy nasıl yapılır?**
C: SSH ile sunucuya bağlanıp `git pull`, `composer install`, `php artisan migrate --force`, `npm run build` komutlarını çalıştırın.

**S: Yedekleri nasıl geri yüklerim?**
C: `scripts/deployment/restore.sh` scriptini çalıştırarak en son yedeği geri yükleyebilirsiniz.

## 5. Eğitim Oturumu Notları

- Tüm eğitim oturumları video veya yazılı olarak kaydedilir.
- Katılımcıların soruları ve verilen yanıtlar dokümante edilir.
// Türkçe: Eğitim sonrası dokümantasyon, yeni ekip üyeleri için referans olur.

---

> Türkçe: Bu dosya, proje teslimi ve eğitim sürecinde kodun, panelin ve deployment'ın nasıl kullanılacağını, sık sorulan soruları ve eğitim notlarını içerir. Her adımda neden ve nasıl yapılacağı detaylı anlatılmıştır. 