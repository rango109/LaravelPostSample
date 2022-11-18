<?php
namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

trait UploadTrait
{
    public function uploadFile($file, $uploadPath = '/', $disk = 'public', $options = [])
    {
        try {
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $filename = Carbon::now()->format('YmdHis') . '_' . $filename;
            $path = $uploadPath . '/' . $filename;

            Storage::disk($disk)->putFileAs($uploadPath, $file, $filename);

            return $path;
        } catch (\Exception $e) {
            \Log::error('[UploadTrait@upload] ' . $e->getMessage());
            return null;
        }
    }
}