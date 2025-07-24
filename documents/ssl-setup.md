# Production SSL Kurulumu (Let's Encrypt)

## 1. Let's Encrypt ile SSL Sertifikası Alma

```bash
sudo apt update
sudo apt install certbot python3-certbot-nginx # veya python3-certbot-apache
sudo certbot --nginx -d example.com -d www.example.com
# veya Apache için:
sudo certbot --apache -d example.com -d www.example.com
```

## 2. Otomatik Yenileme

```bash
sudo crontab -e
# Aşağıdaki satırı ekleyin:
0 3 * * * /usr/bin/certbot renew --quiet
```

## 3. Nginx/Apache için SSL Redirect ve HSTS

- Nginx ve Apache örnekleri için ilgili conf dosyalarına bakınız.
- HSTS ve HTTPS redirect ayarları örneklerde mevcut.

## 4. Test

- https://www.ssllabs.com/ssltest/ ile domaininizi test edin.
- Tarayıcıda kilit simgesi ve HTTPS göründüğünden emin olun.

---

> Türkçe: Bu dosya production ortamı için Let's Encrypt ile SSL kurulumu ve güvenli HTTPS yönlendirmesi adımlarını içerir. 