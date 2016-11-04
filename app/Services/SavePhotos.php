<?php

namespace App\Services;

use App\Entities\Photo;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class SavePhotos
{
    protected $photo;

    public function __construct(Photo $photo)
    {
        $this->photo = $photo;
    }

    /**
     * @param $data
     * @return static
     */
    public function save($data)
    {
        $photo              = [];
        $photo['latitude']  = $data->latitude;
        $photo['longitude'] = $data->longitude;

        try {
            $photo['photo'] = $this->decodePhoto($data->picture);
        } catch (FileException $e) { echo $e->getMessage(); }

        return $this->photo->create($photo);

    }

    /**
     * @param $photoBase64
     * @return string
     */
    public function decodePhoto($photoBase64)
    {
        $photoBase64 = explode("base64,", $photoBase64);

        $image = base64_decode($photoBase64[1]);
        $imageNamePath = 'img/' . rand(1, 45655) . '.jpg';

        file_put_contents($imageNamePath, $image);

        return $imageNamePath;
    }
}