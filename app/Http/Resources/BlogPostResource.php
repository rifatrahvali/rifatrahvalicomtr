<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogPostResource extends JsonResource
{
    /**
     * Blog yazısı API çıktısı.
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'image' => $this->image ? asset('storage/' . $this->image) : null,
            'status' => $this->status,
            'published_at' => $this->published_at,
            'category' => new BlogCategoryResource($this->whenLoaded('category')),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'reading_time' => $this->readingTime(),
        ];
        // Türkçe yorum: Blog yazısı için temel alanlar ve ilişkiler döndürülür.
    }
} 