<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Country;
use App\Models\District;
use App\Models\Division;
use App\Models\Road;
use App\Models\Sub_area;
use Illuminate\Http\Request;

class GeoLocationController extends Controller
{
    public function getLocations()
    {
        $countries = Country::get();
        $divisions = Division::get();
        $districts = District::get();
        $areas = Area::get();
        $sub_areas = Sub_area::get();
        $roads = Road::get();

        $data = [
            'countries' => $countries,
            'divisions' => $divisions,
            'districts' => $districts,
            'areas' => $areas,
            'sub_areas' => $sub_areas,
            'roads' => $roads,
        ];

        return response()->json($data);
    }

    public function storeLocations(Request $request)
    {


        if($request->formData['country_name']){
            $country = new Country();
            $country->country_name = $request->formData['country_name'];
            $country->save();
        }



       else if($request->formData['division_name']) {
           $division = new Division();
           $division->division_name = $request->formData['division_name'];
           $division->country_id = $request->selectedData['country_id'];
           $division->save();
       }

       else if($request->formData['district_name']) {
           $district = new District();
           $district->district_name = $request->formData['district_name'];
           $district->country_id = $request->selectedData['country_id'];
           $district->division_id = $request->selectedData['division_id'];
           $district->save();
       }


       else if($request->formData['area_name']) {
           $area = new Area();
           $area->area_name = $request->formData['area_name'];
           $area->country_id = $request->selectedData['country_id'];
           $area->division_id = $request->selectedData['division_id'];
           $area->district_id = $request->selectedData['district_id'];
           $area->save();
       }


       else if($request->formData['sub_area_name']) {
           $sub_area = new Sub_area();
           $sub_area->sub_area_name = $request->formData['sub_area_name'];
           $sub_area->country_id = $request->selectedData['country_id'];
           $sub_area->division_id = $request->selectedData['division_id'];
           $sub_area->district_id = $request->selectedData['district_id'];
           $sub_area->area_id = $request->selectedData['area_id'];
           $sub_area->save();
       }

       else if($request->formData['road_name']) {
           $road = new Road();
           $road->road_name = $request->formData['road_name'];
           $road->country_id = $request->selectedData['country_id'];
           $road->division_id = $request->selectedData['division_id'];
           $road->district_id =  $request->selectedData['district_id'];
           $road->area_id = $request->selectedData['area_id'];
           $road->sub_area_id = $request->selectedData['sub_area_id'];
           $road->save();
       }
    }

}
