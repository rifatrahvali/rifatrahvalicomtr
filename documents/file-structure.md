cvblog/
├── 📁 app/
│   ├── 📁 Console/
│   │   ├── Commands/
│   │   │   ├── OptimizeImagesCommand.php
│   │   │   ├── GenerateSitemapCommand.php
│   │   │   └── CleanTempFilesCommand.php
│   │   └── Kernel.php
│   │
│   ├── 📁 Events/
│   │   ├── BlogPostPublished.php
│   │   ├── UserProfileUpdated.php
│   │   ├── MediaUploaded.php
│   │   └── ContactFormSubmitted.php
│   │
│   ├── 📁 Exceptions/
│   │   ├── Handler.php
│   │   ├── ApiException.php
│   │   ├── FileUploadException.php
│   │   └── SecurityException.php
│   │
│   ├── 📁 Http/
│   │   ├── 📁 Controllers/
│   │   │   ├── 📁 Admin/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── UserController.php
│   │   │   │   ├── BlogController.php
│   │   │   │   ├── GalleryController.php
│   │   │   │   ├── ReferenceController.php
│   │   │   │   └── SettingsController.php
│   │   │   │
│   │   │   ├── 📁 Api/V1/
│   │   │   │   ├── AuthController.php
│   │   │   │   ├── ProfileController.php
│   │   │   │   ├── ExperienceController.php
│   │   │   │   ├── EducationController.php
│   │   │   │   ├── CertificateController.php
│   │   │   │   ├── CourseController.php
│   │   │   │   ├── SkillController.php
│   │   │   │   ├── BlogController.php
│   │   │   │   ├── CategoryController.php
│   │   │   │   ├── GalleryController.php
│   │   │   │   ├── ReferenceController.php
│   │   │   │   ├── MediaController.php
│   │   │   │   └── SearchController.php
│   │   │   │
│   │   │   ├── 📁 Auth/
│   │   │   │   ├── LoginController.php
│   │   │   │   ├── RegisterController.php
│   │   │   │   ├── TwoFactorController.php
│   │   │   │   └── PasswordResetController.php
│   │   │   │
│   │   │   ├── 📁 Public/
│   │   │   │   ├── HomeController.php
│   │   │   │   ├── BlogController.php
│   │   │   │   ├── GalleryController.php
│   │   │   │   ├── ContactController.php
│   │   │   │   └── SitemapController.php
│   │   │   │
│   │   │   └── Controller.php
│   │   │
│   │   ├── 📁 Middleware/
│   │   │   ├── AdminMiddleware.php
│   │   │   ├── TwoFactorMiddleware.php
│   │   │   ├── ApiRateLimitMiddleware.php
│   │   │   ├── SecurityHeadersMiddleware.php
│   │   │   ├── LogUserActivityMiddleware.php
│   │   │   └── MaintenanceModeMiddleware.php
│   │   │
│   │   ├── 📁 Requests/
│   │   │   ├── 📁 Admin/
│   │   │   │   ├── StoreUserRequest.php
│   │   │   │   ├── UpdateUserRequest.php
│   │   │   │   ├── StoreBlogPostRequest.php
│   │   │   │   └── UpdateBlogPostRequest.php
│   │   │   │
│   │   │   ├── 📁 Api/
│   │   │   │   ├── LoginRequest.php
│   │   │   │   ├── RegisterRequest.php
│   │   │   │   ├── ProfileUpdateRequest.php
│   │   │   │   ├── ExperienceRequest.php
│   │   │   │   ├── EducationRequest.php
│   │   │   │   ├── CertificateRequest.php
│   │   │   │   ├── CourseRequest.php
│   │   │   │   ├── SkillRequest.php
│   │   │   │   ├── BlogPostRequest.php
│   │   │   │   ├── CategoryRequest.php
│   │   │   │   ├── GalleryRequest.php
│   │   │   │   ├── ReferenceRequest.php
│   │   │   │   └── MediaUploadRequest.php
│   │   │   │
│   │   │   ├── 📁 Public/
│   │   │   │   └── ContactFormRequest.php
│   │   │   │
│   │   │   └── FormRequest.php
│   │   │
│   │   ├── 📁 Resources/
│   │   │   ├── 📁 Api/V1/
│   │   │   │   ├── UserResource.php
│   │   │   │   ├── ExperienceResource.php
│   │   │   │   ├── EducationResource.php
│   │   │   │   ├── CertificateResource.php
│   │   │   │   ├── CourseResource.php
│   │   │   │   ├── SkillResource.php
│   │   │   │   ├── BlogPostResource.php
│   │   │   │   ├── BlogPostDetailResource.php
│   │   │   │   ├── CategoryResource.php
│   │   │   │   ├── GalleryResource.php
│   │   │   │   ├── ReferenceResource.php
│   │   │   │   └── MediaResource.php
│   │   │   │
│   │   │   └── BaseResource.php
│   │   │
│   │   └── Kernel.php
│   │
│   ├── 📁 Jobs/
│   │   ├── ProcessImageUpload.php
│   │   ├── GenerateBlogSitemap.php
│   │   ├── SendContactNotification.php
│   │   ├── OptimizeMedia.php
│   │   ├── GenerateThumbnails.php
│   │   └── CleanupTempFiles.php
│   │
│   ├── 📁 Listeners/
│   │   ├── SendBlogPublishedNotification.php
│   │   ├── UpdateUserLastActivity.php
│   │   ├── LogSecurityEvent.php
│   │   ├── ClearUserCache.php
│   │   └── SendWelcomeEmail.php
│   │
│   ├── 📁 Mail/
│   │   ├── ContactFormSubmitted.php
│   │   ├── BlogPostPublished.php
│   │   ├── WelcomeNewUser.php
│   │   ├── PasswordResetNotification.php
│   │   └── TwoFactorCode.php
│   │
│   ├── 📁 Models/
│   │   ├── 📁 Traits/
│   │   │   ├── HasSeoAttributes.php
│   │   │   ├── HasSlug.php
│   │   │   ├── LogsActivity.php
│   │   │   ├── HasSortOrder.php
│   │   │   └── Cacheable.php
│   │   │
│   │   ├── User.php
│   │   ├── Experience.php
│   │   ├── Education.php
│   │   ├── Certificate.php
│   │   ├── Course.php
│   │   ├── Skill.php
│   │   ├── BlogPost.php
│   │   ├── BlogCategory.php
│   │   ├── Tag.php
│   │   ├── GalleryItem.php
│   │   ├── GalleryCategory.php
│   │   ├── Reference.php
│   │   ├── Media.php
│   │   ├── Setting.php
│   │   └── ActivityLog.php
│   │
│   ├── 📁 Notifications/
│   │   ├── BlogPostPublished.php
│   │   ├── ContactFormReceived.php
│   │   ├── SecurityAlert.php
│   │   └── SystemMaintenance.php
│   │
│   ├── 📁 Observers/
│   │   ├── BlogPostObserver.php
│   │   ├── UserObserver.php
│   │   ├── MediaObserver.php
│   │   └── GalleryObserver.php
│   │
│   ├── 📁 Policies/
│   │   ├── UserPolicy.php
│   │   ├── BlogPostPolicy.php
│   │   ├── CategoryPolicy.php
│   │   ├── GalleryPolicy.php
│   │   ├── ReferencePolicy.php
│   │   └── MediaPolicy.php
│   │
│   ├── 📁 Providers/
│   │   ├── AppServiceProvider.php
│   │   ├── AuthServiceProvider.php
│   │   ├── BroadcastServiceProvider.php
│   │   ├── EventServiceProvider.php
│   │   ├── RouteServiceProvider.php
│   │   ├── ViewServiceProvider.php
│   │   └── RepositoryServiceProvider.php
│   │
│   ├── 📁 Repositories/
│   │   ├── 📁 Contracts/
│   │   │   ├── UserRepositoryInterface.php
│   │   │   ├── BlogRepositoryInterface.php
│   │   │   ├── GalleryRepositoryInterface.php
│   │   │   └── ReferenceRepositoryInterface.php
│   │   │
│   │   ├── 📁 Eloquent/
│   │   │   ├── BaseRepository.php
│   │   │   ├── UserRepository.php
│   │   │   ├── BlogRepository.php
│   │   │   ├── GalleryRepository.php
│   │   │   └── ReferenceRepository.php
│   │   │
│   │   └── RepositoryInterface.php
│   │
│   ├── 📁 Services/
│   │   ├── 📁 Auth/
│   │   │   ├── AuthService.php
│   │   │   ├── TwoFactorService.php
│   │   │   └── PasswordService.php
│   │   │
│   │   ├── 📁 Blog/
│   │   │   ├── BlogService.php
│   │   │   ├── CategoryService.php
│   │   │   ├── TagService.php
│   │   │   └── SeoService.php
│   │   │
│   │   ├── 📁 CV/
│   │   │   ├── ProfileService.php
│   │   │   ├── ExperienceService.php
│   │   │   ├── EducationService.php
│   │   │   ├── CertificateService.php
│   │   │   ├── CourseService.php
│   │   │   ├── SkillService.php
│   │   │   └── CvExportService.php
│   │   │
│   │   ├── 📁 Gallery/
│   │   │   ├── GalleryService.php
│   │   │   ├── ImageOptimizationService.php
│   │   │   └── ThumbnailService.php
│   │   │
│   │   ├── 📁 Media/
│   │   │   ├── MediaService.php
│   │   │   ├── FileUploadService.php
│   │   │   ├── ImageProcessingService.php
│   │   │   └── FileValidationService.php
│   │   │
│   │   ├── 📁 SEO/
│   │   │   ├── SeoService.php
│   │   │   ├── SitemapService.php
│   │   │   ├── MetaTagService.php
│   │   │   └── SchemaMarkupService.php
│   │   │
│   │   ├── 📁 Search/
│   │   │   ├── SearchService.php
│   │   │   ├── IndexService.php
│   │   │   └── FilterService.php
│   │   │
│   │   ├── 📁 Security/
│   │   │   ├── SecurityService.php
│   │   │   ├── InputSanitizer.php
│   │   │   ├── RateLimitService.php
│   │   │   └── AuditService.php
│   │   │
│   │   ├── CacheService.php
│   │   ├── NotificationService.php
│   │   ├── AnalyticsService.php
│   │   └── BackupService.php
│   │
│   └── 📁 View/
│       └── 📁 Composers/
│           ├── HeaderComposer.php
│           ├── SidebarComposer.php
│           ├── BreadcrumbComposer.php
│           └── MetaComposer.php
│
├── 📁 bootstrap/
│   ├── app.php
│   ├── cache/
│   └── providers.php
│
├── 📁 config/
│   ├── app.php
│   ├── auth.php
│   ├── broadcasting.php
│   ├── cache.php
│   ├── cors.php
│   ├── database.php
│   ├── filesystems.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── sanctum.php
│   ├── services.php
│   ├── session.php
│   ├── view.php
│   ├── cvblog.php              # Custom config
│   ├── seo.php                 # SEO settings
│   ├── media.php              # Media settings
│   └── security.php           # Security settings
│
├── 📁 database/
│   ├── 📁 factories/
│   │   ├── UserFactory.php
│   │   ├── ExperienceFactory.php
│   │   ├── EducationFactory.php
│   │   ├── CertificateFactory.php
│   │   ├── CourseFactory.php
│   │   ├── SkillFactory.php
│   │   ├── BlogPostFactory.php
│   │   ├── BlogCategoryFactory.php
│   │   ├── TagFactory.php
│   │   ├── GalleryItemFactory.php
│   │   ├── GalleryCategoryFactory.php
│   │   ├── ReferenceFactory.php
│   │   └── MediaFactory.php
│   │
│   ├── 📁 migrations/
│   │   ├── 2024_01_01_000000_create_users_table.php
│   │   ├── 2024_01_01_000001_create_password_reset_tokens_table.php
│   │   ├── 2024_01_01_000002_create_sessions_table.php
│   │   ├── 2024_01_01_000003_create_cache_table.php
│   │   ├── 2024_01_01_000004_create_jobs_table.php
│   │   ├── 2024_01_01_000005_create_job_batches_table.php
│   │   ├── 2024_01_01_000006_create_failed_jobs_table.php
│   │   ├── 2024_01_01_000007_create_personal_access_tokens_table.php
│   │   ├── 2024_01_02_000000_create_experiences_table.php
│   │   ├── 2024_01_02_000001_create_educations_table.php
│   │   ├── 2024_01_02_000002_create_certificates_table.php
│   │   ├── 2024_01_02_000003_create_courses_table.php
│   │   ├── 2024_01_02_000004_create_skills_table.php
│   │   ├── 2024_01_03_000000_create_blog_categories_table.php
│   │   ├── 2024_01_03_000001_create_blog_posts_table.php
│   │   ├── 2024_01_03_000002_create_tags_table.php
│   │   ├── 2024_01_03_000003_create_blog_post_tag_table.php
│   │   ├── 2024_01_04_000000_create_gallery_categories_table.php
│   │   ├── 2024_01_04_000001_create_gallery_items_table.php
│   │   ├── 2024_01_05_000000_create_references_table.php
│   │   ├── 2024_01_06_000000_create_media_table.php
│   │   ├── 2024_01_07_000000_create_settings_table.php
│   │   ├── 2024_01_08_000000_create_activity_logs_table.php
│   │   ├── 2024_01_09_000000_add_two_factor_columns_to_users_table.php
│   │   └── 2024_01_10_000000_add_seo_columns_to_tables.php
│   │
│   └── 📁 seeders/
│       ├── DatabaseSeeder.php
│       ├── UserSeeder.php
│       ├── BlogCategorySeeder.php
│       ├── BlogPostSeeder.php
│       ├── GalleryCategorySeeder.php
│       ├── SkillSeeder.php
│       ├── SettingSeeder.php
│       └── DemoDataSeeder.php
│
├── 📁 public/
│   ├── index.php
│   ├── .htaccess
│   ├── robots.txt
│   ├── sitemap.xml
│   ├── favicon.ico
│   ├── 📁 assets/
│   │   ├── 📁 css/
│   │   │   ├── app.css
│   │   │   ├── admin.css
│   │   │   └── components/
│   │   │       ├── header.css
│   │   │       ├── footer.css
│   │   │       ├── sidebar.css
│   │   │       └── forms.css
│   │   │
│   │   ├── 📁 js/
│   │   │   ├── app.js
│   │   │   ├── admin.js
│   │   │   ├── components/
│   │   │   │   ├── gallery.js
│   │   │   │   ├── forms.js
│   │   │   │   ├── modal.js
│   │   │   │   └── notifications.js
│   │   │   └── vendor/
│   │   │
│   │   ├── 📁 images/
│   │   │   ├── logo.png
│   │   │   ├── default-avatar.png
│   │   │   ├── placeholder.jpg
│   │   │   └── icons/
│   │   │
│   │   └── 📁 fonts/
│   │
│   ├── 📁 storage/
│   │   ├── 📁 app/
│   │   │   ├── 📁 public/
│   │   │   │   ├── 📁 avatars/
│   │   │   │   ├── 📁 certificates/
│   │   │   │   ├── 📁 gallery/
│   │   │   │   │   ├── 📁 original/
│   │   │   │   │   ├── 📁 thumbnails/
│   │   │   │   │   └── 📁 webp/
│   │   │   │   ├── 📁 blog/
│   │   │   │   │   ├── 📁 featured/
│   │   │   │   │   └── 📁 content/
│   │   │   │   └── 📁 temp/
│   │   │   │
│   │   │   └── 📁 private/
│   │   │       ├── 📁 exports/
│   │   │       ├── 📁 backups/
│   │   │       └── 📁 logs/
│   │   │
│   │   └── link -> ../../storage/app/public
│   │
│   └── mix-manifest.json
│
├── 📁 resources/
│   ├── 📁 css/
│   │   ├── app.css
│   │   ├── admin.css
│   │   ├── 📁 components/
│   │   │   ├── buttons.css
│   │   │   ├── forms.css
│   │   │   ├── tables.css
│   │   │   ├── cards.css
│   │   │   ├── modals.css
│   │   │   └── notifications.css
│   │   ├── 📁 layouts/
│   │   │   ├── public.css
│   │   │   ├── admin.css
│   │   │   └── auth.css
│   │   └── 📁 pages/
│   │       ├── home.css
│   │       ├── blog.css
│   │       ├── gallery.css
│   │       └── contact.css
│   │
│   ├── 📁 js/
│   │   ├── app.js
│   │   ├── admin.js
│   │   ├── 📁 components/
│   │   │   ├── ImageUploader.js
│   │   │   ├── RichEditor.js
│   │   │   ├── TagSelector.js
│   │   │   ├── DatePicker.js
│   │   │   ├── Modal.js
│   │   │   ├── Notification.js
│   │   │   ├── DataTable.js
│   │   │   ├── Gallery.js
│   │   │   ├── SearchFilter.js
│   │   │   └── FormValidator.js
│   │   ├── 📁 modules/
│   │   │   ├── auth.js
│   │   │   ├── cv.js
│   │   │   ├── blog.js
│   │   │   ├── gallery.js
│   │   │   └── references.js
│   │   └── 📁 utils/
│   │       ├── api.js
│   │       ├── helpers.js
│   │       ├── validation.js
│   │       └── storage.js
│   │
│   ├── 📁 lang/
│   │   ├── 📁 en/
│   │   │   ├── auth.php
│   │   │   ├── messages.php
│   │   │   ├── validation.php
│   │   │   ├── cv.php
│   │   │   ├── blog.php
│   │   │   ├── gallery.php
│   │   │   └── admin.php
│   │   └── 📁 tr/
│   │       ├── auth.php
│   │       ├── messages.php
│   │       ├── validation.php
│   │       ├── cv.php
│   │       ├── blog.php
│   │       ├── gallery.php
│   │       └── admin.php
│   │
│   └── 📁 views/
│       ├── 📁 layouts/
│       │   ├── app.blade.php          # Ana public layout
│       │   ├── admin.blade.php        # Admin panel layout
│       │   ├── auth.blade.php         # Auth layout
│       │   └── email.blade.php        # Email template layout
│       │
│       ├── 📁 components/
│       │   ├── 📁 ui/
│       │   │   ├── button.blade.php
│       │   │   ├── input.blade.php
│       │   │   ├── textarea.blade.php
│       │   │   ├── select.blade.php
│       │   │   ├── checkbox.blade.php
│       │   │   ├── radio.blade.php
│       │   │   ├── file-upload.blade.php
│       │   │   ├── modal.blade.php
│       │   │   ├── alert.blade.php
│       │   │   ├── pagination.blade.php
│       │   │   ├── breadcrumb.blade.php
│       │   │   └── loading.blade.php
│       │   │
│       │   ├── 📁 partials/
│       │   │   ├── header.blade.php
│       │   │   ├── footer.blade.php
│       │   │   ├── sidebar.blade.php
│       │   │   ├── navigation.blade.php
│       │   │   ├── search.blade.php
│       │   │   ├── social-links.blade.php
│       │   │   └── seo-meta.blade.php
│       │   │
│       │   └── 📁 cv/
│       │       ├── profile-card.blade.php
│       │       ├── experience-card.blade.php
│       │       ├── education-card.blade.php
│       │       ├── certificate-card.blade.php
│       │       ├── course-card.blade.php
│       │       ├── skill-card.blade.php
│       │       └── reference-card.blade.php
│       │
│       ├── 📁 pages/
│       │   ├── 📁 public/
│       │   │   ├── home.blade.php
│       │   │   ├── about.blade.php
│       │   │   ├── contact.blade.php
│       │   │   ├── cv.blade.php
│       │   │   ├── 📁 blog/
│       │   │   │   ├── index.blade.php
│       │   │   │   ├── show.blade.php
│       │   │   │   ├── category.blade.php
│       │   │   │   └── tag.blade.php
│       │   │   ├── 📁 gallery/
│       │   │   │   ├── index.blade.php
│       │   │   │   ├── show.blade.php
│       │   │   │   └── category.blade.php
│       │   │   └── 📁 references/
│       │   │       └── index.blade.php
│       │   │
│       │   └── 📁 errors/
│       │       ├── 404.blade.php
│       │       ├── 403.blade.php
│       │       ├── 500.blade.php
│       │       └── 503.blade.php
│       │
│       ├── 📁 auth/
│       │   ├── login.blade.php
│       │   ├── register.blade.php
│       │   ├── verify-email.blade.php
│       │   ├── forgot-password.blade.php
│       │   ├── reset-password.blade.php
│       │   ├── confirm-password.blade.php
│       │   └── two-factor-challenge.blade.php
│       │
│       ├── 📁 admin/
│       │   ├── dashboard.blade.php
│       │   ├── 📁 users/
│       │   │   ├── index.blade.php
│       │   │   ├── create.blade.php
│       │   │   ├── edit.blade.php
│       │   │   └── show.blade.php
│       │   ├── 📁 cv/
│       │   │   ├── profile.blade.php
│       │   │   ├── experience.blade.php
│       │   │   ├── education.blade.php
│       │   │   ├── certificates.blade.php
│       │   │   ├── courses.blade.php
│       │   │   └── skills.blade.php
│       │   ├── 📁 blog/
│       │   │   ├── posts/
│       │   │   │   ├── index.blade.php
│       │   │   │   ├── create.blade.php
│       │   │   │   ├── edit.blade.php
│       │   │   │   └── show.blade.php
│       │   │   ├── categories/
│       │   │   │   ├── index.blade.php
│       │   │   │   ├── create.blade.php
│       │   │   │   └── edit.blade.php
│       │   │   └── tags/
│       │   │       ├── index.blade.php
│       │   │       ├── create.blade.php
│       │   │       └── edit.blade.php
│       │   ├── 📁 gallery/
│       │   │   ├── items/
│       │   │   │   ├── index.blade.php
│       │   │   │   ├── create.blade.php
│       │   │   │   ├── edit.blade.php
│       │   │   │   └── show.blade.php
│       │   │   └── categories/
│       │   │       ├── index.blade.php
│       │   │       ├── create.blade.php
│       │   │       └── edit.blade.php
│       │   ├── 📁 references/
│       │   │   ├── index.blade.php
│       │   │   ├── create.blade.php
│       │   │   ├── edit.blade.php
│       │   │   └── show.blade.php
│       │   ├── 📁 media/
│       │   │   ├── index.blade.php
│       │   │   ├── upload.blade.php
│       │   │   └── library.blade.php
│       │   ├── 📁 settings/
│       │   │   ├── general.blade.php
│       │   │   ├── seo.blade.php
│       │   │   ├── security.blade.php
│       │   │   ├── email.blade.php
│       │   │   └── backup.blade.php
│       │   └── 📁 reports/
│       │       ├── analytics.blade.php
│       │       ├── activity.blade.php
│       │       └── security.blade.php
│       │
│       └── 📁 emails/
│           ├── 📁 auth/
│           │   ├── welcome.blade.php
│           │   ├── password-reset.blade.php
│           │   ├── email-verification.blade.php
│           │   └── two-factor-code.blade.php
│           ├── 📁 blog/
│           │   └── post-published.blade.php
│           ├── 📁 contact/
│           │   ├── form-submitted.blade.php
│           │   └── auto-reply.blade.php
│           └── 📁 system/
│               ├── maintenance.blade.php
│               ├── backup-completed.blade.php
│               └── security-alert.blade.php
│
├── 📁 routes/
│   ├── web.php                        # Public web routes
│   ├── api.php                        # API routes
│   ├── admin.php                      # Admin panel routes
│   ├── auth.php                       # Authentication routes
│   ├── console.php                    # Artisan command routes
│   └── channels.php                   # Broadcasting channels
│
├── 📁 storage/
│   ├── 📁 app/
│   │   ├── 📁 public/
│   │   │   ├── 📁 uploads/
│   │   │   │   ├── 📁 avatars/
│   │   │   │   │   ├── 📁 original/
│   │   │   │   │   ├── 📁 thumbnails/
│   │   │   │   │   └── 📁 webp/
│   │   │   │   ├── 📁 certificates/
│   │   │   │   │   └── 📁 pdf/
│   │   │   │   ├── 📁 gallery/
│   │   │   │   │   ├── 📁 original/
│   │   │   │   │   ├── 📁 large/
│   │   │   │   │   ├── 📁 medium/
│   │   │   │   │   ├── 📁 small/
│   │   │   │   │   ├── 📁 thumbnails/
│   │   │   │   │   └── 📁 webp/
│   │   │   │   ├── 📁 blog/
│   │   │   │   │   ├── 📁 featured/
│   │   │   │   │   ├── 📁 content/
│   │   │   │   │   └── 📁 thumbnails/
│   │   │   │   └── 📁 temp/
│   │   │   │       ├── 📁 uploads/
│   │   │   │       └── 📁 processing/
│   │   │   └── 📁 exports/
│   │   │       ├── 📁 cv/
│   │   │       ├── 📁 data/
│   │   │       └── 📁 reports/
│   │   └── 📁 private/
│   │       ├── 📁 backups/
│   │       │   ├── 📁 database/
│   │       │   ├── 📁 files/
│   │       │   └── 📁 logs/
│   │       ├── 📁 logs/
│   │       │   ├── 📁 application/
│   │       │   ├── 📁 security/
│   │       │   ├── 📁 performance/
│   │       │   └── 📁 error/
│   │       └── 📁 cache/
│   │           ├── 📁 views/
│   │           ├── 📁 config/
│   │           └── 📁 routes/
│   ├── 📁 framework/
│   │   ├── 📁 cache/
│   │   │   └── 📁 data/
│   │   ├── 📁 sessions/
│   │   ├── 📁 testing/
│   │   └── 📁 views/
│   └── 📁 logs/
│       ├── laravel.log
│       ├── security.log
│       ├── performance.log
│       └── api.log
│
├── 📁 tests/
│   ├── 📁 Feature/
│   │   ├── 📁 Auth/
│   │   │   ├── LoginTest.php
│   │   │   ├── RegisterTest.php
│   │   │   ├── TwoFactorTest.php
│   │   │   └── PasswordResetTest.php
│   │   ├── 📁 API/
│   │   │   ├── 📁 V1/
│   │   │   │   ├── AuthTest.php
│   │   │   │   ├── ProfileTest.php
│   │   │   │   ├── ExperienceTest.php
│   │   │   │   ├── EducationTest.php
│   │   │   │   ├── CertificateTest.php
│   │   │   │   ├── CourseTest.php
│   │   │   │   ├── SkillTest.php
│   │   │   │   ├── BlogTest.php
│   │   │   │   ├── CategoryTest.php
│   │   │   │   ├── GalleryTest.php
│   │   │   │   ├── ReferenceTest.php
│   │   │   │   ├── MediaTest.php
│   │   │   │   └── SearchTest.php
│   │   │   └── ApiRateLimitTest.php
│   │   ├── 📁 Admin/
│   │   │   ├── DashboardTest.php
│   │   │   ├── UserManagementTest.php
│   │   │   ├── BlogManagementTest.php
│   │   │   ├── GalleryManagementTest.php
│   │   │   ├── ReferenceManagementTest.php
│   │   │   └── SettingsTest.php
│   │   ├── 📁 Public/
│   │   │   ├── HomePageTest.php
│   │   │   ├── BlogTest.php
│   │   │   ├── GalleryTest.php
│   │   │   ├── ContactTest.php
│   │   │   └── SitemapTest.php
│   │   ├── 📁 CV/
│   │   │   ├── ProfileManagementTest.php
│   │   │   ├── ExperienceManagementTest.php
│   │   │   ├── EducationManagementTest.php
│   │   │   ├── CertificateManagementTest.php
│   │   │   ├── CourseManagementTest.php
│   │   │   ├── SkillManagementTest.php
│   │   │   └── CvExportTest.php
│   │   ├── 📁 Security/
│   │   │   ├── XSSProtectionTest.php
│   │   │   ├── CSRFProtectionTest.php
│   │   │   ├── SQLInjectionTest.php
│   │   │   ├── FileUploadSecurityTest.php
│   │   │   └── RateLimitTest.php
│   │   └── 📁 Performance/
│   │       ├── DatabaseQueryTest.php
│   │       ├── CacheTest.php
│   │       ├── PageLoadTest.php
│   │       └── ApiResponseTest.php
│   │
│   ├── 📁 Unit/
│   │   ├── 📁 Models/
│   │   │   ├── UserTest.php
│   │   │   ├── ExperienceTest.php
│   │   │   ├── EducationTest.php
│   │   │   ├── CertificateTest.php
│   │   │   ├── CourseTest.php
│   │   │   ├── SkillTest.php
│   │   │   ├── BlogPostTest.php
│   │   │   ├── BlogCategoryTest.php
│   │   │   ├── TagTest.php
│   │   │   ├── GalleryItemTest.php
│   │   │   ├── GalleryCategoryTest.php
│   │   │   ├── ReferenceTest.php
│   │   │   └── MediaTest.php
│   │   ├── 📁 Services/
│   │   │   ├── 📁 Auth/
│   │   │   │   ├── AuthServiceTest.php
│   │   │   │   ├── TwoFactorServiceTest.php
│   │   │   │   └── PasswordServiceTest.php
│   │   │   ├── 📁 CV/
│   │   │   │   ├── ProfileServiceTest.php
│   │   │   │   ├── ExperienceServiceTest.php
│   │   │   │   ├── EducationServiceTest.php
│   │   │   │   ├── CertificateServiceTest.php
│   │   │   │   ├── CourseServiceTest.php
│   │   │   │   ├── SkillServiceTest.php
│   │   │   │   └── CvExportServiceTest.php
│   │   │   ├── 📁 Blog/
│   │   │   │   ├── BlogServiceTest.php
│   │   │   │   ├── CategoryServiceTest.php
│   │   │   │   ├── TagServiceTest.php
│   │   │   │   └── SeoServiceTest.php
│   │   │   ├── 📁 Gallery/
│   │   │   │   ├── GalleryServiceTest.php
│   │   │   │   ├── ImageOptimizationServiceTest.php
│   │   │   │   └── ThumbnailServiceTest.php
│   │   │   ├── 📁 Media/
│   │   │   │   ├── MediaServiceTest.php
│   │   │   │   ├── FileUploadServiceTest.php
│   │   │   │   ├── ImageProcessingServiceTest.php
│   │   │   │   └── FileValidationServiceTest.php
│   │   │   ├── 📁 Security/
│   │   │   │   ├── SecurityServiceTest.php
│   │   │   │   ├── InputSanitizerTest.php
│   │   │   │   ├── RateLimitServiceTest.php
│   │   │   │   └── AuditServiceTest.php
│   │   │   └── 📁 SEO/
│   │   │       ├── SeoServiceTest.php
│   │   │       ├── SitemapServiceTest.php
│   │   │       ├── MetaTagServiceTest.php
│   │   │       └── SchemaMarkupServiceTest.php
│   │   ├── 📁 Repositories/
│   │   │   ├── UserRepositoryTest.php
│   │   │   ├── BlogRepositoryTest.php
│   │   │   ├── GalleryRepositoryTest.php
│   │   │   └── ReferenceRepositoryTest.php
│   │   └── 📁 Helpers/
│   │       ├── ValidationHelperTest.php
│   │       ├── FileHelperTest.php
│   │       ├── StringHelperTest.php
│   │       └── DateHelperTest.php
│   │
│   ├── 📁 Browser/
│   │   ├── 📁 Auth/
│   │   │   ├── LoginTest.php
│   │   │   ├── RegisterTest.php
│   │   │   └── TwoFactorTest.php
│   │   ├── 📁 Admin/
│   │   │   ├── DashboardTest.php
│   │   │   ├── UserManagementTest.php
│   │   │   ├── BlogManagementTest.php
│   │   │   ├── GalleryManagementTest.php
│   │   │   └── SettingsTest.php
│   │   ├── 📁 Public/
│   │   │   ├── NavigationTest.php
│   │   │   ├── BlogBrowsingTest.php
│   │   │   ├── GalleryBrowsingTest.php
│   │   │   └── ContactFormTest.php
│   │   └── 📁 Accessibility/
│   │       ├── KeyboardNavigationTest.php
│   │       ├── ScreenReaderTest.php
│   │       └── ColorContrastTest.php
│   │
│   ├── CreatesApplication.php
│   └── TestCase.php
│
├── 📁 vendor/                         # Composer dependencies
│
├── 📁 .github/
│   ├── 📁 workflows/
│   │   ├── ci.yml                     # Continuous Integration
│   │   ├── deploy.yml                 # Deployment workflow
│   │   ├── security.yml               # Security checks
│   │   └── performance.yml            # Performance testing
│   ├── 📁 ISSUE_TEMPLATE/
│   │   ├── bug_report.md
│   │   ├── feature_request.md
│   │   └── security_report.md
│   └── 📁 pull_request_template.md
│
├── 📁 docs/
│   ├── 📁 api/
│   │   ├── authentication.md
│   │   ├── endpoints.md
│   │   ├── rate-limiting.md
│   │   └── examples.md
│   ├── 📁 deployment/
│   │   ├── server-requirements.md
│   │   ├── installation.md
│   │   ├── configuration.md
│   │   ├── ssl-setup.md
│   │   └── backup-strategy.md
│   ├── 📁 development/
│   │   ├── setup.md
│   │   ├── coding-standards.md
│   │   ├── testing.md
│   │   ├── security.md
│   │   └── performance.md
│   ├── 📁 user-guide/
│   │   ├── getting-started.md
│   │   ├── cv-management.md
│   │   ├── blog-management.md
│   │   ├── gallery-management.md
│   │   ├── admin-panel.md
│   │   └── troubleshooting.md
│   ├── 📁 architecture/
│   │   ├── overview.md
│   │   ├── database-design.md
│   │   ├── security-architecture.md
│   │   ├── caching-strategy.md
│   │   └── scalability.md
│   └── README.md
│
├── 📁 scripts/
│   ├── 📁 deployment/
│   │   ├── deploy.sh
│   │   ├── rollback.sh
│   │   ├── backup.sh
│   │   └── maintenance.sh
│   ├── 📁 development/
│   │   ├── setup.sh
│   │   ├── test.sh
│   │   ├── lint.sh
│   │   └── analyze.sh
│   ├── 📁 optimization/
│   │   ├── optimize-images.sh
│   │   ├── cache-warmup.sh
│   │   └── database-optimize.sh
│   └── 📁 monitoring/
│       ├── health-check.sh
│       ├── performance-check.sh
│       └── security-audit.sh
│
├── 📁 .env files/
│   ├── .env.example
│   ├── .env.local
│   ├── .env.staging
│   └── .env.production
│
├── 📁 Configuration Files/
│   ├── .gitignore
│   ├── .gitattributes
│   ├── .editorconfig
│   ├── .php-cs-fixer.php            # PHP CS Fixer config
│   ├── phpstan.neon                 # PHPStan config
│   ├── psalm.xml                    # Psalm config
│   ├── phpunit.xml                  # PHPUnit config
│   ├── vite.config.js               # Vite config
│   ├── tailwind.config.js           # Tailwind CSS config
│   ├── composer.json
│   ├── composer.lock
│   ├── package.json
│   ├── package-lock.json
│   ├── artisan
│   └── server.php
│
└── 📄 Documentation Files/
    ├── README.md
    ├── CHANGELOG.md
    ├── CONTRIBUTING.md
    ├── LICENSE.md
    ├── SECURITY.md
    ├── TODO.md
    └── ARCHITECTURE.md