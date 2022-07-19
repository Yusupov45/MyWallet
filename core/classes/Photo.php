<?php

class Photo
{
    public static function photoProcessing($photo) {
        global $arSettings;
        $result = [];
        if ($photo['size'] <= $arSettings['sizephoto']) {
            $path = '../uploads/'.time().$photo['name'];
            if($photo['type'] == 'image/png') {
                $image = imagecreatefrompng($photo['tmp_name']);
                $imageResized = imagescale($image,60,60);
                if(imagepng($imageResized, $path)) {
                    $result['status'] = true;
                    $result['path'] = $path;
                }
                else {
                    $result['status'] = false;
                    $result['message'] = 'Ошибка загрузки аватарки';
                }
            }
            elseif($photo['type'] == 'image/jpg' || $photo['type'] == 'image/jpeg') {
                $image = imagecreatefromjpeg($_FILES['avatar']['tmp_name']);
                $imageResized = imagescale($image,60,60);
                if(imagejpeg($imageResized, $path)){
                    $result['status'] = true;
                    $result['path'] = $path;
                }
                else {
                    $result['status'] = false;
                    $result['message'] = 'Ошибка загрузки аватарки';
                }
            }
            else {
                $result['status'] = false;
                $result['message'] = "Ошибка в формате";
            }
        }
        else {
            $result['status'] = false;
            $result['message'] = "Большой размер";
        }
        return $result;
    }
}