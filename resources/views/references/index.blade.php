@extends('layouts.app')
@section('content')
<!-- Modern Referanslar Sayfası -->
<div style="max-width: 1200px; margin: 0 auto; padding: 24px 12px;">
    <!-- Modern Başlık Bölümü -->
    <div style="text-align: center; margin-bottom: 32px;">
        <div style="display: flex; align-items: center; justify-content: center; gap: 16px; margin-bottom: 16px;">
            <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                <span style="color: white; font-size: 20px;">🤝</span>
            </div>
            <h1 style="font-size: clamp(24px, 5vw, 32px); font-weight: 700; color: #1e293b; margin: 0;">Referanslar</h1>
        </div>
        <p style="color: #64748b; font-size: clamp(14px, 3vw, 16px); margin: 0;">Birlikte çalıştığım kişiler ve projeler</p>
    </div>

    <!-- Modern Referans Kartları -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 32px;">
        @foreach($references as $ref)
            <div style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); overflow: hidden; border: 1px solid #e2e8f0; transition: all 0.3s ease; position: relative;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 25px 50px rgba(0,0,0,0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)';">
                
                <!-- Üst Gradient Çizgi -->
                <div style="height: 4px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);"></div>
                
                <!-- Kart İçeriği -->
                <div style="padding: 32px;">
                    <!-- Kişi Bilgileri -->
                    <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 20px;">
                        <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <span style="color: white; font-size: 18px; font-weight: 700;">{{ substr($ref->name, 0, 1) }}</span>
                        </div>
                        <div style="flex: 1;">
                            <h2 style="font-size: 20px; font-weight: 700; color: #1e293b; margin-bottom: 4px;">{{ $ref->name }}</h2>
                            <div style="display: flex; flex-wrap: wrap; gap: 8px; align-items: center;">
                                <span style="font-size: 14px; font-weight: 600; color: #f59e0b;">{{ $ref->company_name }}</span>
                                @if($ref->position)
                                    <span style="color: #cbd5e1;">•</span>
                                    <span style="font-size: 14px; color: #64748b;">{{ $ref->position }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Açıklama -->
                    @if($ref->description)
                        <div style="background: #f8fafc; border-radius: 12px; padding: 20px; margin-bottom: 20px; border-left: 4px solid #f59e0b;">
                            <p style="color: #64748b; font-size: 15px; line-height: 1.6; margin: 0; font-style: italic;">
                                "{{ $ref->description }}"
                            </p>
                        </div>
                    @endif
                    
                    <!-- Görseller -->
                    @php $images = is_array($ref->images) ? $ref->images : json_decode($ref->images, true); @endphp
                    @if($images && count($images) > 0)
                        <div style="margin-bottom: 20px;">
                            <h3 style="font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                                <span>📸</span>
                                <span>Proje Görselleri</span>
                            </h3>
                            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                                @foreach($images as $img)
                                    <div style="position: relative; overflow: hidden; border-radius: 8px; transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.05)';" onmouseout="this.style.transform='scale(1)';">
                                        <img src="{{ asset('storage/' . $img) }}" alt="{{ $ref->name }} - Proje Görseli" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);" loading="lazy" onerror="this.src='/images/placeholder-reference.jpg';">
                                        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(245, 158, 11, 0.8) 0%, rgba(217, 119, 6, 0.6) 100%); opacity: 0; transition: opacity 0.3s ease; display: flex; align-items: center; justify-content: center; border-radius: 8px;" onmouseover="this.style.opacity='1';" onmouseout="this.style.opacity='0';">
                                            <span style="color: white; font-size: 16px;">🔍</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    <!-- Web Sitesi Butonu -->
                    @if($ref->website_url)
                        <div style="display: flex; justify-content: flex-end;">
                            <a href="{{ $ref->website_url }}" target="_blank" rel="noopener" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(245, 158, 11, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(245, 158, 11, 0.3)';">
                                <span style="font-size: 16px;">🌐</span>
                                <span>Web Sitesi</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    
    <!-- Boş Durum -->
    @if($references->isEmpty())
        <div style="text-align: center; color: #64748b; font-size: 16px; padding: 80px 20px; background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); border-radius: 16px; border: 2px dashed #cbd5e1;">
            <div style="font-size: 64px; margin-bottom: 24px;">🤝</div>
            <h2 style="font-size: 24px; font-weight: 700; color: #1e293b; margin-bottom: 12px;">Henüz Referans Eklenmemiş</h2>
            <p style="margin: 0; max-width: 400px; margin: 0 auto;">Yakında müşteri görüşleri ve iş ortaklıkları hakkında bilgiler burada yer alacak.</p>
        </div>
    @endif
</div>
@endsection
<!-- Türkçe yorum: Modern referanslar sayfası, kişi kartları, proje görselleri ve hover efektleriyle --> 