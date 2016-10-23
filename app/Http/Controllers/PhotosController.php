<?php

namespace App\Http\Controllers;

use App\Services\PhotosLocationNearby;
use Illuminate\Http\Request;

use App\Entities\Photo;

class PhotosController extends Controller
{
    protected $photo;

    protected $photosLocationNearby;

    /**
     * Create a new controller instance.
     * @param Photo $photo
     * @param PhotosLocationNearby $locationNearby
     * @internal param $Photo
     */
    public function __construct(Photo $photo, PhotosLocationNearby $locationNearby)
    {
        $this->photosLocationNearby = $locationNearby;
        $this->photo = $photo;
    }

    public function index($latitude, $longitude)
    {
        return response()->json(
            $this->photosLocationNearby->getNearLocationPhotos($latitude, $longitude)
        );
    }
}
