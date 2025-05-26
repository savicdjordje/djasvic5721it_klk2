<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function homepage()
    {
        $services = Service::where('featured', true)
                            ->where('published', true)
                            ->get();

        return view('services.homepage', [
            'services' => $services
        ]);
    }

    public function detail($id)
    {
        $service = Service::findOrFail($id);
        return view('services.detail', [
            'service' => $service
        ]);
    }
}
