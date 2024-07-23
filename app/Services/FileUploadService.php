<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class FileUploadService{

    /**
     * Upload multiple files to a specified folder.
     *
     * @param array $files
     * @param string $folder
     * @return array
     */
    public function uploadMultipleFiles(array $files, string $folder): array
    {
        $uploadedFiles = [];

        foreach ($files as $file) {
            $uploadedFiles[] = $this->uploadFile($file, $folder);
        }

        return $uploadedFiles;
    }

    /**
     * Upload a single file to a specified folder.
     *
     * @param UploadedFile $file
     * @param string $folder
     * @return string
     */
    public function uploadFile(UploadedFile $file, string $folder): string
    {
        
        $path = $file->store($folder);

        return basename($path);
    }
}
