#!/bin/bash
# Türkçe: Bu script veritabanı ve dosya sistemi yedeği alır

# Yedekleme dizinleri
BACKUP_DIR="storage/private/backups/database"
FILES_BACKUP_DIR="storage/private/backups/files"
DATE=$(date +%F_%H-%M-%S)

# Veritabanı bilgileri (env'den okunmalı)
DB_NAME=$(grep DB_DATABASE .env | cut -d '=' -f2)
DB_USER=$(grep DB_USERNAME .env | cut -d '=' -f2)
DB_PASS=$(grep DB_PASSWORD .env | cut -d '=' -f2)
DB_HOST=$(grep DB_HOST .env | cut -d '=' -f2)

# Veritabanı yedeği
mkdir -p "$BACKUP_DIR"
mysqldump -u$DB_USER -p$DB_PASS -h$DB_HOST $DB_NAME > "$BACKUP_DIR/backup_${DATE}.sql"
# Türkçe: Veritabanı yedeği alınır ve backup dizinine kaydedilir

# Dosya sistemi yedeği (public/uploads ve storage/app/public)
mkdir -p "$FILES_BACKUP_DIR"
tar -czf "$FILES_BACKUP_DIR/files_backup_${DATE}.tar.gz" public/images storage/app/public
# Türkçe: Dosya sistemi yedeği alınır (görseller ve public storage)

# Yedeklerin başarılı şekilde alındığına dair çıktı
if [ $? -eq 0 ]; then
  echo "Yedekleme başarılı: $DATE"
else
  echo "Yedekleme sırasında hata oluştu!"
fi
# Türkçe: Scriptin sonunda başarı veya hata mesajı verilir 