<?php

namespace App\Http\Controllers;

use App\Models\Ajax;
use App\Models\Post;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        $data              =new Post;
        $data->title       = $request->title;
        $data->description = $request->description;
        $data->save();

        return response()->json(['message'=>'data uploaded successfully']);
    }


}
