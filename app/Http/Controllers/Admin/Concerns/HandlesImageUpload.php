<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Http\Request;

trait HandlesImageUpload
{
    protected function uploadImage(Request $request, string $field = 'image'): ?string
    {
        if (!$request->hasFile($field)) {
            return null;
        }

        $file = $request->file($field);
        $filename = $file->hashName();
        $file->move(base_path('../images'), $filename);

        return $filename; // just the filename, blade adds 'images/' prefix
    }

    protected function deleteImage(?string $path): void
    {
        if ($path) {
            $fullPath = base_path('../images/' . $path);
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }
    }
}
