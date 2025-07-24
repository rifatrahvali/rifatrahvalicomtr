@extends('layouts.app')

@section('title', 'Arama: ' . $q . ' | rifatrahvali.com.tr')
@section('meta_description', 'Arama sonuçları: ' . $q)

@section('content')
<!-- Modern Arama Sonuçları Sayfası -->
<div style="max-width: 1200px; margin: 0 auto; padding: 24px 12px;">
    <!-- Modern Başlık Bölümü -->
    <div style="text-align: center; margin-bottom: 32px;">
        <div style="display: flex; align-items: center; justify-content: center; gap: 16px; margin-bottom: 16px;">
            <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                <span style="color: white; font-size: 20px;">🔍</span>
            </div>
            <h1 style="font-size: clamp(24px, 5vw, 32px); font-weight: 700; color: #1e293b; margin: 0;">Arama Sonuçları</h1>
        </div>
        <p style="color: #64748b; font-size: clamp(14px, 3vw, 16px); margin: 0;">"{{ $q }}" için bulunan sonuçlar</p>
    </div>

    <!-- Modern Arama Formu -->
    <form action="{{ route('blog.search') }}" method="get" style="margin-bottom: 32px;">
        <div style="display: flex; justify-content: center;">
            <div style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); padding: 8px; border: 1px solid #e2e8f0; display: flex; gap: 8px; max-width: 500px; width: 100%;">
                <input type="text" name="q" value="{{ $q }}" placeholder="Yazı, etiket veya kategori ara..." style="flex: 1; border: none; background: transparent; padding: 12px 16px; border-radius: 8px; font-size: 16px; color: #1e293b; outline: none;" />
                <button type="submit" style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: white; border: none; padding: 12px 24px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 8px;" onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 8px 20px rgba(59, 130, 246, 0.4)';" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                    <span>🔍</span>
                    <span>Ara</span>
                </button>
            </div>
        </div>
        <!-- Türkçe yorum: Modern arama formu tasarımı -->
    </form>

    @if($posts->count())
        <!-- Modern Blog Kartları -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 32px;">
            @foreach($posts as $post)
                <article style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); overflow: hidden; border: 1px solid #e2e8f0; transition: all 0.3s ease; height: fit-content;" onmouseover="this.style.transform='translateY(-8px) scale(1.02)'; this.style.boxShadow='0 25px 50px rgba(0,0,0,0.2)';" onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)';">
                    @if($post->image)
                        <!-- Blog Görseli -->
                        <div style="position: relative; height: 200px; overflow: hidden;">
                            <img src="{{ asset('storage/' . $post->image) }}" 
                                 style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;"
                                 alt="{{ $post->title }}"
                                 onerror="this.src='https://via.placeholder.com/400x200/3b82f6/ffffff?text=📝+Blog+Görseli'"
                                 onmouseover="this.style.transform='scale(1.1)';"
                                 onmouseout="this.style.transform='scale(1)';" />
                            
                            <!-- Kategori Badge -->
                            @if($post->category)
                                <div style="position: absolute; top: 12px; left: 12px; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 600; box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);">
                                    {{ $post->category->name }}
                                </div>
                            @endif
                        </div>
                    @endif
                    
                    <!-- İçerik Bölümü -->
                    <div style="padding: 24px;">
                        <!-- Başlık -->
                        <h2 style="margin: 0 0 12px 0;">
                            <a href="{{ route('blog.show', $post->slug) }}" style="color: #1e293b; text-decoration: none; font-size: 18px; font-weight: 700; line-height: 1.4; transition: color 0.3s ease;" onmouseover="this.style.color='#3b82f6';" onmouseout="this.style.color='#1e293b';">
                                {{ $post->title }}
                            </a>
                        </h2>
                        
                        <!-- Tarih -->
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px; color: #64748b; font-size: 14px;">
                            <span style="font-size: 16px;">📅</span>
                            <span>{{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}</span>
                        </div>
                        
                        <!-- Etiketler -->
                        @if($post->tags->count())
                            <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 16px;">
                                @foreach($post->tags as $tag)
                                    <a href="{{ route('blog.tag', $tag->slug) }}" style="background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%); color: #475569; padding: 4px 8px; border-radius: 6px; font-size: 12px; font-weight: 500; text-decoration: none; transition: all 0.3s ease;" onmouseover="this.style.background='linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%)'; this.style.color='white';" onmouseout="this.style.background='linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%)'; this.style.color='#475569';">
                                        #{{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                        
                        <!-- Özet -->
                        <p style="color: #64748b; font-size: 14px; line-height: 1.6; margin: 0 0 20px 0;">
                            {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 120) }}
                        </p>
                        
                        <!-- Devamını Oku Butonu -->
                        <a href="{{ route('blog.show', $post->slug) }}" style="display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 8px 20px rgba(59, 130, 246, 0.4)';" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                            <span>📖</span>
                            <span>Devamını Oku</span>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
        
        <!-- Modern Sayfalama -->
        @if($posts->hasPages())
            <div style="display: flex; justify-content: center; margin-top: 48px;">
                <div style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); padding: 16px; border: 1px solid #e2e8f0;">
                    {{ $posts->withQueryString()->links() }}
                </div>
            </div>
        @endif
    @else
        <!-- Sonuç Bulunamadı -->
        <div style="text-align: center; padding: 64px 32px; background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border: 1px solid #e2e8f0;">
            <div style="font-size: 64px; margin-bottom: 16px;">🔍</div>
            <h3 style="color: #1e293b; font-size: 24px; font-weight: 700; margin-bottom: 8px;">Sonuç Bulunamadı</h3>
            <p style="color: #64748b; font-size: 16px; margin-bottom: 24px;">"{{ $q }}" için herhangi bir sonuç bulunamadı.</p>
            <a href="{{ route('blog.index') }}" style="display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 8px 20px rgba(59, 130, 246, 0.4)';" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                <span>📝</span>
                <span>Tüm Blog Yazılarını Gör</span>
            </a>
        </div>
    @endif
</div>
<!-- Türkçe yorum: Modern arama sonuçları sayfası, inline CSS ile framework bağımsız tasarım -->
@endsection

{{-- Türkçe yorum: Arama sonuçları sayfası, arama kutusu ve sonuçları listeler. --}} 