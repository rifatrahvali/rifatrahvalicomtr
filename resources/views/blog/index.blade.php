@extends('layouts.app')

@section('title', 'Blog | rifatrahvali.com.tr')
@section('meta_description', 'Kişisel blog yazıları, güncel içerikler ve teknik makaleler.')

@section('content')
<!-- Modern Blog Sayfası -->
<div style="max-width: 1200px; margin: 0 auto; padding: 24px 12px;">
    <!-- Modern Arama ve Filtre Bölümü -->
    <div style="margin-bottom: 32px;">center; margin-bottom: 32px;">
        <div style="display: flex; align-items: center; justify-content: center; gap: 16px; margin-bottom: 16px;">
            <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                <span style="color: white; font-size: 20px;">📝</span>
            </div>
            <h1 style="font-size: clamp(24px, 5vw, 32px); font-weight: 700; color: #1e293b; margin: 0;">Blog</h1>
        </div>
        <p style="color: #64748b; font-size: clamp(14px, 3vw, 16px); margin: 0;">Teknoloji, web geliştirme ve kişisel deneyimler</p>
    </div>

    <!-- Modern Arama Formu -->
    <form action="{{ route('blog.search') }}" method="get" style="margin-bottom: 48px;">
        <div style="max-width: 500px; margin: 0 auto; position: relative;">
            <input type="text" name="q" placeholder="Yazı, etiket veya kategori ara..." style="width: 100%; padding: 16px 60px 16px 20px; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 16px; background: #ffffff; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0,0,0,0.05);" onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 8px 20px rgba(16,185,129,0.15)';" onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.05)';">
            <button type="submit" style="position: absolute; right: 8px; top: 50%; transform: translateY(-50%); background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; padding: 8px 16px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.background='linear-gradient(135deg, #059669 0%, #047857 100)';" onmouseout="this.style.background='linear-gradient(135deg, #10b981 0%, #059669 100)';">
                🔍 Ara
            </button>
        </div>
    </form>

    <!-- Modern Blog Kartları -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 32px;">
        @foreach($posts as $post)
            <article style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); overflow: hidden; border: 1px solid #e2e8f0; transition: all 0.3s ease; position: relative;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 25px 50px rgba(0,0,0,0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)';">
                <!-- Görsel Bölümü -->
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" style="width: 100%; height: 200px; object-fit: cover; border-radius: 12px 12px 0 0;">
                @else
                    <img src="/images/placeholder-blog.jpg" alt="Placeholder" style="width: 100%; height: 200px; object-fit: cover; border-radius: 12px 12px 0 0;">
                @endif

                <!-- İçerik Bölümü -->
                <div style="padding: 24px;">
                    <!-- Başlık -->
                    <h2 style="font-size: 20px; font-weight: 700; color: #1e293b; margin-bottom: 12px; line-height: 1.4;">
                        <a href="{{ route('blog.show', $post->slug) }}" style="color: inherit; text-decoration: none; transition: color 0.3s ease;" onmouseover="this.style.color='#10b981';" onmouseout="this.style.color='#1e293b';">
                            {{ $post->title }}
                        </a>
                    </h2>

                    <!-- Meta Bilgiler -->
                    <div style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center; margin-bottom: 16px;">
                        <span style="font-size: 12px; color: #94a3b8; background: #f1f5f9; padding: 4px 8px; border-radius: 6px;">
                            📅 {{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}
                        </span>
                        @if($post->category)
                            <a href="{{ route('blog.category', $post->category->slug) }}" style="font-size: 12px; color: white; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); padding: 4px 8px; border-radius: 6px; text-decoration: none; transition: all 0.3s ease;" onmouseover="this.style.background='linear-gradient(135deg, #7c3aed 0%, #6d28d9 100)';" onmouseout="this.style.background='linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100)';">
                                🏷️ {{ $post->category->name }}
                            </a>
                        @endif
                    </div>

                    <!-- Etiketler -->
                    @if($post->tags->count() > 0)
                        <div style="display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 16px;">
                            @foreach($post->tags as $tag)
                                <a href="{{ route('blog.tag', $tag->slug) }}" style="font-size: 11px; color: #64748b; background: #f1f5f9; padding: 3px 6px; border-radius: 4px; text-decoration: none; transition: all 0.3s ease;" onmouseover="this.style.background='#e2e8f0'; this.style.color='#374151';" onmouseout="this.style.background='#f1f5f9'; this.style.color='#64748b';">
                                    #{{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    @endif

                    <!-- Özet -->
                    <p style="color: #64748b; font-size: 14px; line-height: 1.6; margin-bottom: 20px;">
                        {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 120) }}
                    </p>

                    <!-- Okuma Butonu -->
                    <a href="{{ route('blog.show', $post->slug) }}" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 12px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; display: inline-block; transition: all 0.3s ease;" onmouseover="this.style.background='linear-gradient(135deg, #059669 0%, #047857 100)'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='linear-gradient(135deg, #10b981 0%, #059669 100)'; this.style.transform='translateY(0)';">
                        📖 Devamını Oku
                    </a>
                </div>
            </article>
        @endforeach
    </div>

    <!-- Modern Sayfalama -->
    @if($posts->hasPages())
        <div style="display: flex; justify-content: center; margin-top: 48px;">
            <div style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); padding: 16px; border: 1px solid #e2e8f0;">
                {{ $posts->links() }}
            </div>
        </div>
    @endif
</div>
@endsection

{{-- Türkçe yorum: Blog ana sayfasında her kartta görsel optimize ve responsive şekilde gösterilir. Görsel yoksa placeholder kullanılır. --}} 