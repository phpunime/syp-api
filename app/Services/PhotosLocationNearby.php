<?php

namespace App\Services;

use App\Entities\Photo;
use Illuminate\Database\Eloquent\Model;
use JeroenDesloovere\Distance\Distance;

class PhotosLocationNearby
{
    protected $photo;

    public function __construct(Photo $photo)
    {
        $this->photo = $photo;
    }

    /**
     * @param   $latitude
     * @param   $longitude
     * @return  array|Model
     */
    public function getNearLocationPhotos($latitude, $longitude)
    {
        $photos     = $this->photo->all(['id', 'photo', 'latitude', 'longitude']);
        $photosNear = [];

        foreach ($photos as $photo) {
            $distance = $this->calculateDistance($latitude, $longitude, $photo->latitude, $photo->longitude);

            if ($distance > 10) {
                continue;
            }

            $photosNear['fotos'][] = [
                'id'    => $photo->id,
                'url'   => $photo->photo
            ];
        }

        return $photosNear;
    }

    /**
     * @param $latitudeOrigin
     * @param $longitudeOrigin
     * @param $latitudeDestiny
     * @param $longitudeDestiny
     * @return float
     */
    private function calculateDistance($latitudeOrigin, $longitudeOrigin, $latitudeDestiny, $longitudeDestiny)
    {
        return Distance::between($latitudeOrigin, $longitudeOrigin, $latitudeDestiny, $longitudeDestiny);
    }

    /**
     * @param $coordinate
     * @return mixed
     */
    private function decodeCoordinates($coordinate)
    {
        return $coordinate;
    }
}