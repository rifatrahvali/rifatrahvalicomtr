#!/bin/bash
# Türkçe: Bu script en son alınan veritabanı ve dosya sistemi yedeğini geri yükler

# Yedekleme dizinleri
BACKUP_DIR="storage/private/backups/database"
FILES_BACKUP_DIR="storage/private/backups/files"

# Veritabanı bilgileri (env'den okunmalı)
DB_NAME=$(grep DB_DATABASE .env | cut -d '=' -f2)
DB_USER=$(grep DB_USERNAME .env | cut -d '=' -f2)
DB_PASS=$(grep DB_PASSWORD .env | cut -d '=' -f2)
DB_HOST=$(grep DB_HOST .env | cut -d '=' -f2)

# Son veritabanı yedeğini bul
LATEST_DB_BACKUP=$(ls -t $BACKUP_DIR/backup_*.sql | head -1)

# Son dosya yedeğini bul
LATEST_FILES_BACKUP=$(ls -t $FILES_BACKUP_DIR/files_backup_*.tar.gz | head -1)

# Veritabanı geri yükleme
if [ -f "$LATEST_DB_BACKUP" ]; then
  mysql -u$DB_USER -p$DB_PASS -h$DB_HOST $DB_NAME < "$LATEST_DB_BACKUP"
  echo "Veritabanı geri yüklendi: $LATEST_DB_BACKUP"
else
  echo "Veritabanı yedeği bulunamadı!"
fi
# Türkçe: Son alınan veritabanı yedeği geri yüklenir

# Dosya sistemi geri yükleme
if [ -f "$LATEST_FILES_BACKUP" ]; then
  tar -xzf "$LATEST_FILES_BACKUP" -C ./
  echo "Dosya sistemi geri yüklendi: $LATEST_FILES_BACKUP"
else
  echo "Dosya sistemi yedeği bulunamadı!"
fi
# Türkçe: Son alınan dosya sistemi yedeği geri yüklenir 