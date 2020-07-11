<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;

class AreaController extends Controller
{
    public function index()
    {
        return Area::all();
    }
 
    public function show($id)
    {
        return Area::find($id);
    }

    public function store(Request $request)
    {
        return Area::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $area = Area::findOrFail($id);
        $area->update($request->all());

        return $area;
    }

    public function delete(Request $request, $id)
    {
        $area = Area::findOrFail($id);
        $area->delete();

        return 204;
    }
}
