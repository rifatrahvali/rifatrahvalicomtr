<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MediaUploadRequest;
use App\Services\Media\FileUploadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class MediaController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Media dosyası yükleme endpointi
     */
    public function upload(MediaUploadRequest $request): JsonResponse
    {
        $userId = Auth::id();
        $media = $this->fileUploadService->upload($request->file('file'), $userId);
        if ($request->filled('alt')) {
            $media->alt = $request->input('alt');
            $media->save();
        }
        return response()->json([
            'success' => true,
            'data' => $media,
        ], 201);
        // Türkçe yorum: Dosya yüklenir, optimize edilir ve Media kaydı döndürülür.
    }
} 