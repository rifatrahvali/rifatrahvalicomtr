# CVBlog - Product Requirements Document (PRD)
*Version 1.0 - Kişisel Portföy ve Blog Web Platformu*

## 1. Ürün Genel Bakış ve Vizyon

### 1.1 Ürün Tanımı
CVBlog, rifatrahvali.com.tr domaini üzerinde çalışacak Laravel tabanlı modüler bir kişisel portföy ve blog platformudur. Platform, kullanıcının profesyonel kimliğini dijital ortamda en iyi şekilde temsil edecek şekilde tasarlanmıştır.

### 1.2 Vizyon
Profesyonel kariyeri, eğitimi, projeler ve düşünceleri tek bir platformda birleştirerek güçlü bir kişisel marka oluşturmak.

### 1.3 Temel Hedefler
- Modüler ve ölçeklenebilir mimari ile geliştirilecek
- SEO dostu yapı ile arama motorlarında üst sıralarda yer alma
- Responsive tasarım ile tüm cihazlarda mükemmel görünüm
- Yüksek performans ve güvenlik standartları
- Kolay içerik yönetimi için kullanıcı dostu admin paneli

## 2. Teknik Gereksinimler ve Mimari

### 2.1 Temel Teknoloji Stack
- **Backend**: Laravel 12 (PHP 8.1+)
- **Frontend**: HTML5, CSS3, Vanilla JavaScript (ES6+)
- **Database**: MySQL 8.0+
- **Cache**: Redis
- **Asset Management**: Laravel Vite
- **Version Control**: Git

### 2.2 Mimari Prensipler
- MVC (Model-View-Controller) mimarisi
- Repository Pattern kullanımı
- Service Layer implementasyonu
- Event-Driven Architecture
- SOLID prensipleri uygulaması
- Dependency Injection kullanımı

### 2.3 Klasör Yapısı
```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   ├── Api/
│   │   └── Web/
│   ├── Middleware/
│   ├── Requests/
│   └── Resources/
├── Models/
├── Services/
├── Repositories/
├── Events/
├── Listeners/
└── Exceptions/
```

### 2.4 Veritabanı Tasarımı
Modüler yapı için ayrı tablo grupları:
- **User Management**: users, roles, permissions
- **CV Module**: user_profiles, experiences, educations, certificates, courses, learned_experiences, learned_educations, about_sections
- **Blog Module**: categories, posts, tags, post_tags
- **Gallery Module**: galleries
- **References Module**: references

## 3. Modüler Fonksiyonel Gereksinimler

### 3.1 CV Modülü

#### 3.1.1 User Profile (card_userprofile)
**Tablo**: `user_profiles`
```sql
- id (Primary Key)
- name (String, 100)
- surname (String, 100)
- profile_image (String, 255) // Dosya yolu
- email (String, 150) // Sisteme giriş için
- password (Hash)
- gender (Enum: male/female/other)
- title (String, 200) // Profesyonel unvan
- username (String, 50, Unique)
- url_email (String, 150) // Görüntüleme için email
- url_linkedin (String, 255)
- url_x (String, 255)
- url_youtube (String, 255)
- url_github (String, 255)
- url_instagram (String, 255)
- url_facebook (String, 255)
- created_at, updated_at
```

#### 3.1.2 Experience (card_experience)
**Tablo**: `experiences`
```sql
- id (Primary Key)
- user_id (Foreign Key)
- company_name (String, 200)
- department (String, 150)
- sector (String, 100)
- start_year (Year)
- end_year (Year, Nullable) // Null = Halen çalışıyor
- created_at, updated_at
```

#### 3.1.3 Education (card_education)
**Tablo**: `educations`
```sql
- id (Primary Key)
- user_id (Foreign Key)
- city (String, 100)
- school_name (String, 200)
- education_level (Enum: high_school/bachelor/master/phd/other)
- start_year (Year)
- end_year (Year, Nullable)
- created_at, updated_at
```

#### 3.1.4 About (card_about)
**Tablo**: `about_sections`
```sql
- id (Primary Key)
- user_id (Foreign Key)
- title (String, 200)
- description (Text)
- order_index (Integer) // Sıralama için
- is_active (Boolean, Default: true)
- created_at, updated_at
```

#### 3.1.5 Certificates (card_certificate)
**Tablo**: `certificates`
```sql
- id (Primary Key)
- user_id (Foreign Key)
- certificate_name (String, 200)
- institution (String, 200)
- activity_field (String, 150)
- issue_date (Date)
- certificate_url (String, 255, Nullable)
- created_at, updated_at
```

#### 3.1.6 Courses (card_course)
**Tablo**: `courses`
```sql
- id (Primary Key)
- user_id (Foreign Key)
- course_name (String, 200)
- institution (String, 200)
- activity_tags (JSON) // Kurs ile ilgili etiketler
- completion_date (Date, Nullable)
- course_url (String, 255, Nullable)
- created_at, updated_at
```

#### 3.1.7 Learned from Experiences (card_learned_from_experiences)
**Tablo**: `learned_experiences`
```sql
- id (Primary Key)
- experience_id (Foreign Key)
- description (Text) // Bir cümlelik açıklama
- activity_field (String, 150)
- activity_tags (JSON) // Deneyim etiketleri
- created_at, updated_at
```

#### 3.1.8 Learned from Education (card_learned_from_education)
**Tablo**: `learned_educations`
```sql
- id (Primary Key)
- education_id (Foreign Key)
- core_learnings (JSON) // Temel kazanımlar
- general_learnings (JSON) // Genel kazanımlar
- created_at, updated_at
```

### 3.2 Blog Modülü

#### 3.2.1 Categories
**Tablo**: `categories`
```sql
- id (Primary Key)
- name (String, 150)
- image (String, 255, Nullable)
- slug (String, 150, Unique)
- tags (JSON, Nullable)
- is_visible (Boolean, Default: true)
- parent_id (Foreign Key, Nullable) // Hiyerarşik yapı
- order_index (Integer)
- meta_description (String, 300, Nullable) // SEO
- created_at, updated_at
```

#### 3.2.2 Blog Posts
**Tablo**: `posts`
```sql
- id (Primary Key)
- user_id (Foreign Key)
- category_id (Foreign Key)
- title (String, 255)
- slug (String, 255, Unique)
- featured_image (String, 255, Nullable)
- content (LongText) // Rich content
- excerpt (Text, Nullable) // Özet
- tags (JSON, Nullable)
- is_published (Boolean, Default: false)
- published_at (DateTime, Nullable)
- meta_title (String, 255, Nullable) // SEO
- meta_description (String, 300, Nullable) // SEO
- read_time (Integer, Nullable) // Dakika cinsinden
- view_count (Integer, Default: 0)
- created_at, updated_at
```

### 3.3 Gallery Modülü

#### 3.3.1 Gallery Items
**Tablo**: `galleries`
```sql
- id (Primary Key)
- user_id (Foreign Key)
- title (String, 200)
- image_path (String, 255)
- alt_text (String, 255) // SEO ve accessibility
- category (String, 100, Nullable)
- description (Text, Nullable)
- order_index (Integer)
- is_featured (Boolean, Default: false)
- created_at, updated_at
```

### 3.4 References Modülü

#### 3.4.1 References
**Tablo**: `references`
```sql
- id (Primary Key)
- user_id (Foreign Key)
- name (String, 200)
- images (JSON) // Birden fazla görsel
- website_url (String, 255, Nullable)
- description (Text, Nullable)
- company_name (String, 200, Nullable)
- position (String, 150, Nullable)
- order_index (Integer)
- is_active (Boolean, Default: true)
- created_at, updated_at
```

## 4. Admin Panel Özellikleri

### 4.1 Güvenlik Gereksinimleri
- **Authentication**: Laravel Sanctum ile token-based auth
- **Authorization**: Role-based access control (Spatie Permission)
- **2FA**: Google Authenticator entegrasyonu
- **Rate Limiting**: Login için brute-force koruması
- **CSRF Protection**: Tüm formlarda aktif
- **XSS Protection**: Blade escaped output kullanımı
- **Custom Admin Route**: `/secure-admin` rotası

### 4.2 Admin Panel Modülleri
```
/secure-admin/
├── dashboard/
├── cv/
│   ├── profile/
│   ├── experiences/
│   ├── educations/
│   ├── certificates/
│   ├── courses/
│   └── about/
├── blog/
│   ├── categories/
│   ├── posts/
│   └── settings/
├── gallery/
├── references/
├── users/
└── settings/
    ├── general/
    ├── seo/
    └── security/
```

### 4.3 Admin Panel Özellikleri
- **Dashboard**: Analytics ve hızlı erişim widget'ları
- **WYSIWYG Editor**: Blog yazıları için rich content desteği
- **File Manager**: Görsel ve dosya yükleme sistemi
- **Batch Operations**: Toplu işlemler desteği
- **Search & Filter**: Gelişmiş arama ve filtreleme
- **Audit Logging**: Tüm kritik işlemler için log kaydı

## 5. UX/UI Gereksinimleri

### 5.1 Frontend Teknolojileri
- **HTML5**: Semantic markup kullanımı
- **CSS3**: Flexbox ve Grid layout sistemleri
- **JavaScript**: ES6+ Vanilla JavaScript
- **Responsive Design**: Mobile-first yaklaşım
- **CSS Variables**: Tutarlı tema yönetimi
- **CSS Animations**: Smooth transitions ve micro-interactions

### 5.2 Design System
```css
:root {
  /* Color Palette */
  --primary-color: #2563eb;
  --secondary-color: #64748b;
  --accent-color: #f59e0b;
  --text-primary: #1e293b;
  --text-secondary: #64748b;
  --background: #ffffff;
  --surface: #f8fafc;
  
  /* Typography */
  --font-primary: 'Inter', sans-serif;
  --font-heading: 'Poppins', sans-serif;
  
  /* Spacing */
  --spacing-xs: 0.25rem;
  --spacing-sm: 0.5rem;
  --spacing-md: 1rem;
  --spacing-lg: 1.5rem;
  --spacing-xl: 2rem;
}
```

### 5.3 Layout Gereksinimleri
- **Header**: Logo, navigasyon menüsü, sosyal medya linkler
- **Main Content Area**: Modüler content blokları
- **Sidebar**: Widget alanı (blog sayfalarında)
- **Footer**: İletişim bilgileri, site haritası
- **Mobile Menu**: Hamburger menu implementasyonu

## 6. Güvenlik Gereksinimleri

### 6.1 Input Validation
```php
// Form Request örneği
class StorePostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'string|max:50',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }
}
```

### 6.2 Mass Assignment Protection
```php
// Model örneği
class Post extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 'category_id', 
        'featured_image', 'is_published', 'tags'
    ];
    
    protected $guarded = ['id', 'user_id', 'view_count'];
}
```

### 6.3 File Upload Security
- Dosya tipi ve boyut validasyonu
- Güvenli dosya adı oluşturma
- Secure storage klasör yapısı
- Image optimization ve resizing

## 7. SEO ve Sosyal Medya Entegrasyonu

### 7.1 SEO Gereksinimleri
- **Meta Tags**: Title, description, keywords
- **Open Graph**: Facebook paylaşım optimizasyonu
- **Twitter Cards**: Twitter paylaşım optimizasyonu
- **Structured Data**: JSON-LD format
- **XML Sitemap**: Otomatik sitemap oluşturma
- **Robots.txt**: Arama motoru direktifleri

### 7.2 URL Yapısı
```
/ (Ana sayfa - CV özeti)
/about (Hakkımda detay)
/experience (İş deneyimleri)
/education (Eğitim bilgileri)
/blog (Blog ana sayfa)
/blog/{category-slug} (Kategori sayfası)
/blog/{post-slug} (Blog yazısı)
/gallery (Proje galerisi)
/references (Referanslar)
/contact (İletişim)
```

### 7.3 Sosyal Medya Entegrasyonu
- Social sharing butonları
- Instagram feed widget
- Twitter timeline embed
- LinkedIn profile integration
- YouTube video embed

## 8. Performans Kriterleri

### 8.1 Database Optimizasyonu
- **Indexing Strategy**: Primary keys, foreign keys, frequently queried columns
- **Query Optimization**: N+1 problem prevention
- **Caching**: Redis ile query result caching
- **Eager Loading**: İlişkili verilerde `with()` kullanımı

### 8.2 Frontend Performans
- **Asset Minification**: CSS ve JS dosyaların sıkıştırılması
- **Image Optimization**: WebP format kullanımı
- **Lazy Loading**: Görsellerde geciktirilmiş yükleme
- **CDN Integration**: Static asset'ler için CDN kullanımı

### 8.3 Performans Hedefleri
- **Page Load Time**: < 3 saniye
- **First Contentful Paint**: < 1.5 saniye
- **Lighthouse Score**: 90+ (Performance, SEO, Accessibility)
- **Core Web Vitals**: Google standartlarına uyum

## 9. API Tasarımı ve Standartları

### 9.1 API Endpoints
```php
// Blog API
GET    /api/v1/posts              // Blog yazıları listesi
GET    /api/v1/posts/{slug}       // Blog yazısı detayı
GET    /api/v1/categories         // Kategori listesi

// CV API
GET    /api/v1/profile           // Profil bilgileri
GET    /api/v1/experiences       // İş deneyimleri
GET    /api/v1/educations        // Eğitim bilgileri

// Gallery API
GET    /api/v1/gallery           // Galeri öğeleri

// References API
GET    /api/v1/references        // Referanslar
```

### 9.2 API Response Format
```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Blog Post Title",
    "slug": "blog-post-title",
    "content": "...",
    "published_at": "2025-07-21T10:30:00Z"
  },
  "meta": {
    "current_page": 1,
    "total": 50,
    "per_page": 10
  }
}
```

### 9.3 API Güvenlik
- **Rate Limiting**: 60 requests/minute
- **API Versioning**: URL-based versioning
- **Error Handling**: Standardized error responses
- **Authentication**: Sanctum token-based auth (admin endpoints)

## 10. Test Stratejileri ve Kalite Kontrol

### 10.1 Test Türleri
- **Unit Tests**: Model ve Service class testleri
- **Feature Tests**: HTTP endpoint testleri
- **Browser Tests**: Laravel Dusk ile E2E testler

### 10.2 Test Coverage Hedefleri
- **Critical Business Logic**: %100 coverage
- **Controllers**: %90 coverage
- **Models**: %80 coverage
- **Overall**: %80 minimum coverage

### 10.3 Kalite Kontrol Araçları
- **PHPStan**: Static analysis (Level 8)
- **Laravel Pint**: Code formatting
- **Pre-commit Hooks**: Git commit öncesi checks
- **CI/CD Pipeline**: Automated testing

## 11. Deployment ve DevOps Gereksinimleri

### 11.1 Environment Konfigürasyonu
```env
# Production Environment
APP_ENV=production
APP_DEBUG=false
APP_URL=https://rifatrahvali.com.tr

# Database
DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=cvblog_prod

# Cache & Queue
CACHE_DRIVER=redis
QUEUE_CONNECTION=redis

# Mail
MAIL_MAILER=smtp
MAIL_FROM_ADDRESS=noreply@rifatrahvali.com.tr
```

### 11.2 Deployment Strategy
- **Zero Downtime Deployment**: Blue-green deployment
- **Database Migrations**: Safe migration strategies
- **Asset Compilation**: Build process automation
- **Health Checks**: Application monitoring endpoints

### 11.3 Monitoring ve Logging
- **Application Logs**: Laravel Log facade kullanımı
- **Error Tracking**: Sentry entegrasyonu (opsiyonel)
- **Performance Monitoring**: Query time tracking
- **Uptime Monitoring**: Health check endpoints

## 12. Gelecek Geliştirme Planları

### 12.1 Faz 1 (MVP) - 4 Hafta
- CV modülü temel CRUD işlemleri
- Blog modülü temel özellikleri
- Admin panel temel functionality
- Responsive frontend tasarım

### 12.2 Faz 2 (Genişletme) - 2 Hafta
- Gallery ve References modülleri
- SEO optimizasyonları
- Sosyal medya entegrasyonları
- Performans optimizasyonları

### 12.3 Faz 3 (İleri Özellikler) - 2 Hafta
- API geliştirme
- Advanced admin features
- Analytics entegrasyonu
- PWA (Progressive Web App) desteği

### 12.4 Gelecek Özellikler (Backlog)
- **Multi-language Support**: İngilizce dil desteği
- **Comment System**: Blog yazılarında yorum sistemi
- **Newsletter**: E-mail abonelik sistemi
- **Portfolio Projects**: Detaylı proje showcase modülü
- **Contact Form**: Ajax ile çalışan iletişim formu
- **Search Functionality**: Site genelinde arama özelliği

## 13. Teknik Geliştirme Notları

### 13.1 Cursor/Windsurf IDE Entegrasyonu
- Rules dosyalarının proje kök dizininde bulundurulması
- AI-assisted development için optimum klasör yapısı
- Code generation için template dosyaları

### 13.2 Git Workflow
```
main (production branch)
├── develop (development branch)
│   ├── feature/cv-module
│   ├── feature/blog-module
│   ├── feature/admin-panel
│   └── feature/frontend-design
└── hotfix/* (acil düzeltmeler için)
```

### 13.3 Code Review Checklist
- [ ] Rules dosyalarına uygunluk
- [ ] Security best practices
- [ ] Performance considerations
- [ ] Test coverage
- [ ] Documentation updates

---

**Bu PRD, CVBlog projesinin teknik ve fonksiyonel gereksinimlerini detaylandırmaktadır. Belirtilen Cursor/Windsurf rules referansları doğrultusunda geliştirilecek olan platform, modern web standartlarına uygun, güvenli ve performanslı bir yapıya sahip olacaktır.**