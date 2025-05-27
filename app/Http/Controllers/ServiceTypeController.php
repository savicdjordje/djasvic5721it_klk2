<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    public function list()
    {
        $types = ServiceType::all();

        return view('service_types.list', [
            'types' => $types
        ]);
    }

    public function single($id)
    {
        $type = ServiceType::findOrFail($id);
        return view('service_types.single', [
            'type' => $type
        ]);
    }

    public function create()
    {
        return view('service_types.create');
    }

    public function createSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);

        ServiceType::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.service-types.list')->with('success', 'Tip usluge uspešno dodat.');
    }

    public function update($id)
    {
        $type = ServiceType::findOrFail($id);
        return view('service_types.update', [
            'type' => $type
        ]);
    }

    public function updateSubmit(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);

        $type = ServiceType::findOrFail($id);
        $type->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.service-types.list')->with('success', 'Tip usluge je izmenjen.');
    }

    public function delete($id)
    {
        $type = ServiceType::findOrFail($id);
        $type->delete();

        return redirect()->route('admin.service-types.list')->with('success', 'Tip usluge obrisan.');
    }
}
