<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index ()
    {
        $services = Service::all();

        return view('admin.services.index', ['services' => $services]);
    }

    public function create(Request $request)
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|min:3",
            'description' => "required",
            'status' => "in:on,off",
        ]);

        $service = Service::create([
            'name' => $request->input('name'),
            'description' =>  $request->input('description'),
            'status' => $request->input('status'),
            'icon_class' => 'flaticon-worker',
        ]);

        return redirect()->route('admin.services.index');
    }

    public function edit ($id)
    {
        $service = Service::find($id);

        return view('admin.services.edit', ['service' => $service]);
    }

    public function update (Request $request, $id)
    {
        $request->validate([
            'name' => "required|min:3",
            'description' => "required",
            'status' => "in:on,off",
        ]);

        $service = Service::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'status' => $request->input('status'),
            ]);

        return redirect()->route('admin.services.edit', ['service' => $request->input('id')]);
    }

    public function destroy ($id)
    {
        $row = Service::find($id);

        if (Service::find($id)) {

            $row->delete();
        }

        return redirect()->route('admin.services.index');
    }
}
