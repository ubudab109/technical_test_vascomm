<?php


if (!function_exists('storeImages')) {
  function storeImages($path, $files) {    

    if(is_array($files)){
      $imgs = [];
      foreach($files as $file){
        $extension = $file['file']->getClientOriginalExtension();
        $imageName = generateImageName($extension);
        $file['file']->storeAs(
            $path, $imageName
        );

        array_push($imgs, $imageName);
      }
      return $imgs;
    }else{
      $extension = $files->getClientOriginalExtension();
      $imageName = generateImageName($extension);
      $files->storeAs(
          $path, $imageName
      );
      return $imageName;
    }
  }
}

if (!function_exists('storeFiles')) {
  function storeFiles($path, $file) {
    $uniqueFileName = uniqid() . ' - ' . $file->getClientOriginalName();
    $file->storeAs(
        $path, $uniqueFileName
    );
    return $uniqueFileName;
  }
}

if(!function_exists('generateImageName')) {
  function generateImageName($extension) {
    return preg_replace('/(0)\.(\d+) (\d+)/', '$3$1$2', microtime()).'.'.$extension;
  }
}