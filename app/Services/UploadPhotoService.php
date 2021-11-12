<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class UploadPhotoService
{
    private $file_name;
    private $image_url;

    public function setImage ($upload)
    {
        if($upload)
        {
            $file_name           = $upload->hashName();
            $image_uploaded_path = $upload->storeAs('stalls', $file_name, 's3');

            $image_url           = Storage::disk('s3')->url($image_uploaded_path);

            $this->image_url = $image_url;
            $this->file_name = $file_name;

        }else {
            $this->file_name = 'default';
            $this->image_url = Storage::disk('s3')->url('stalls/default.png');

        }
    }

    public function getPhotoUrl()
    {
        return $this->image_url;
    }

    public function getPhotoName()
    {
        return $this->file_name;
    }
}

?>
