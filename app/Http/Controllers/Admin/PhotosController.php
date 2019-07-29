<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PhotosController extends Controller
{
    public function store(){
        try{
            $this->validate(request(),[
                'photo' => 'required|image|max:50'
            ]);
            $photo = request()->file('photo');
            return \request()->all('photo');
        }catch (\Exception $e){
            \Log::error($e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
