<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Entities\Photo;

class PhotosController extends Controller
{
    protected $photo;

    /**
     * Create a new controller instance.
     * @param Photo $photo
     * @internal param $Photo
     */
    public function __construct(Photo $photo)
    {
        $this->photo = $photo;
    }

    public function index()
    {
        return response()->json($this->photo->all());
    }
}
