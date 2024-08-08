<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\HomeDataResource;
use App\Http\Resources\SettingsResource;

class GeneralController extends Controller
{
    public function getSettings()
    {
        return SettingsResource::make(null);
    }

    public function getHomeData()
    {
        return HomeDataResource::make(null);
    }
}
