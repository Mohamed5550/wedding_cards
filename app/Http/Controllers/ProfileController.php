<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProfileResource;

class ProfileController extends Controller
{
    public function index()
    {
        return ProfileResource::make(null);
    }

    public function user()
    {
        return response([
            'user' => auth()->user()
        ]);
    }
}
