<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function getAll(){
        $services = Service::all();
        return $services;
    }
}
