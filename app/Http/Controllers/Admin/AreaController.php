<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function getDistrict(Request $request, Area $area)
    {
        $getArea = $area->where('katakana_name', $request->name)->first();
        $district = $area->district($getArea->id);
        return response()->json($district);
    }

}
