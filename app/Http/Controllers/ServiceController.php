<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceType;
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

    public function catalog()
    {
        $services = Service::where('published', true)->get();

        return view('services.catalog', [
            'services' => $services
        ]);
    }

    public function dashboard()
    {
        $data = [['Tip usluge', 'Broj rezervacija']];
        $tipovi = ServiceType::withCount(['services as rezervacija_count' => function ($q) {
            $q->join('reservations', 'services.id', '=', 'reservations.service_id');
        }])->get();

        foreach ($tipovi as $tip) {
            $data[] = [$tip->name, $tip->rezervacija_count];
        }

        return view('dashboard', [
            'chartData' => $data
        ]);
    }

    public function list()
    {
        $services = Service::all();

        return view('services.list', [
            'services' => $services
        ]);
    }

    public function togglePublished($id)
    {
        $service = Service::findOrFail($id);
        $service->published = !$service->published;
        $service->save();

        return redirect()->back()->with('success', 'Status prikazivanja je izmenjen.');
    }

    public function toggleFeatured($id)
    {
        $service = Service::findOrFail($id);
        $service->featured = !$service->featured;
        $service->save();

        return redirect()->back()->with('success', 'Status istaknutosti je izmenjen.');
    }

    public function create()
    {
        $types = ServiceType::all();
        return view('services.create', [
            'types'=>$types
        ]);
    }

    public function createSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'service_type_id' => 'nullable|exists:service_types,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $path=null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $filename);
            $path = 'images/' . $filename;
        }

        Service::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'service_type_id' => $request->service_type_id,
            'image' => $path,
            'published' => true,
            'featured' => false,
        ]);

        return redirect()->route('admin.services.list')->with('success', 'Usluga je uspešno dodata.');
    }

    public function update($id)
    {
        $service = Service::findOrFail($id);
        $types = ServiceType::all();

        return view('services.update', [
            'service' => $service,
            'types' => $types
        ]);
    }

    public function updateSubmit(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'service_type_id' => 'nullable|exists:service_types,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $service = Service::findOrFail($id);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'service_type_id' => $request->service_type_id,
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $filename);
            $data['image'] = 'images/' . $filename;
        }

        $service->update($data);

        return redirect()->route('admin.services.list')->with('success', 'Usluga je izmenjena.');
    }


    public function delete($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.services.list')->with('success', 'Usluga je obrisana.');
    }

    public function single($id)
    {
        $service = Service::findOrFail($id);
        return view('services.single', compact('service'));
    }

}
