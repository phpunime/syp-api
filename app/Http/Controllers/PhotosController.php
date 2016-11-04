<?php

namespace App\Http\Controllers;

use App\Services\PhotosLocationNearby;
use App\Services\SavePhotos;
use Illuminate\Http\Request;

use App\Entities\Photo;

class PhotosController extends Controller
{
    protected $photo;

    protected $photosLocationNearby;

    protected $savePhotos;

    /**
     * Create a new controller instance.
     * @param Photo $photo
     * @param PhotosLocationNearby $locationNearby
     * @param SavePhotos $savePhotos
     * @internal param $Photo
     */
    public function __construct(Photo $photo, PhotosLocationNearby $locationNearby, SavePhotos $savePhotos)
    {
        $this->photosLocationNearby     = $locationNearby;
        $this->photo                = $photo;
        $this->savePhotos           = $savePhotos;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $latitude   = (float) $request->get('latitude');
        $longitude  = (float) $request->get('longitude');

        return response()->json(
            $this->photosLocationNearby->getNearLocationPhotos($latitude, $longitude)
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        try {
            $photo = $this->savePhotos->save($request);

            return response()->json([
                'success' => true
            ], 201);

        } catch (\HttpRequestException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 503);
        }
    }
}
