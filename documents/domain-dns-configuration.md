# Domain & DNS Yapılandırma Rehberi

## 1. Temel DNS Kayıtları

### A Kaydı (Ana Domain)
```
@   IN  A     185.86.5.10
```
// Türkçe: Domain ana IP adresine yönlendirilir

### CNAME Kaydı (www yönlendirmesi)
```
www IN  CNAME  rifatrahvali.com.tr.
```
// Türkçe: www alt alan adı ana domaine yönlendirilir

### Subdomain Örneği
```
blog IN  A     185.86.5.10
```
// Türkçe: blog.rifatrahvali.com.tr alt alan adı için A kaydı

## 2. E-posta için DNS Kayıtları

### MX Kaydı
```
@   IN  MX  10 mail.rifatrahvali.com.tr.
```
// Türkçe: E-posta sunucusu için MX kaydı

### SPF Kaydı (TXT)
```
@   IN  TXT  "v=spf1 a mx include:mailgun.org ~all"
```
// Türkçe: SPF ile e-posta gönderim yetkilendirmesi

### DKIM Kaydı (TXT)
```
mail._domainkey IN TXT "v=DKIM1; k=rsa; p=MIGf..."
```
// Türkçe: DKIM ile e-posta imzalama anahtarı

### DMARC Kaydı (TXT)
```
_dmarc IN TXT "v=DMARC1; p=quarantine; rua=mailto:admin@rifatrahvali.com.tr"
```
// Türkçe: DMARC ile e-posta sahteciliği önleme

## 3. Güvenlik Kayıtları

### CAA Kaydı
```
@ IN CAA 0 issue "letsencrypt.org"
```
// Türkçe: Sadece Let's Encrypt sertifika verebilir

### DNSSEC
- Domain panelinizden DNSSEC aktif edin.
// Türkçe: DNS sorgularının imzalanmasını sağlar, sahteciliği önler

## 4. Test ve Doğrulama

- DNS kayıtlarını kontrol etmek için:
```
dig +short A rifatrahvali.com.tr
nslookup -type=MX rifatrahvali.com.tr
nslookup -type=TXT rifatrahvali.com.tr
```
// Türkçe: DNS kayıtlarının doğru olup olmadığını test etmek için komutlar

- Online araçlar:
  - https://mxtoolbox.com
  - https://dnschecker.org
  - https://www.mail-tester.com

## 5. Notlar ve Güvenlik Önerileri
- DNS değişiklikleri 1-24 saat arası yayılabilir (propagation).
- Domain panelinizde DNSSEC ve CAA kayıtlarını aktif edin.
- E-posta için SPF, DKIM ve DMARC kayıtlarını mutlaka ekleyin.
- Subdomainler için ayrı A veya CNAME kayıtları oluşturun.
- Tüm kayıtlarınızın sonunda nokta (.) olmasına dikkat edin (bazı panellerde gereklidir).

---

> Türkçe: Bu dosya domain ve DNS yapılandırması, e-posta ve güvenlik ayarları için örnekler ve açıklamalar içerir. Her adımda neden ve nasıl yapılacağı detaylı anlatılmıştır. 