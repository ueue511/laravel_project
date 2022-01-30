<?php

namespace app\Library;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CloudinaryUpload
{
  public static function upload( $file ) {
      $upload = Cloudinary::upload ( $file->getRealPath(), [
          "height" => 800,
          "width" => 560,
          "crop" => "fit",
          "border" => "20px_solid_rgb:ffffff",
          "quality" => "auto",
          "fetch_format" => "auto",
      ]);
      return $upload;
  }
}