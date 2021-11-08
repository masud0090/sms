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

        $data = [
            'countries' => $countries,
        ];

        return response()->json($data);
    }


    public function GetDivisions(Request $request){
        $divisions=Division::where('country_id', $request->country_id)->get();
             $data = [
                 'divisions' => $divisions,
             ];
        return response()->json($data);
    }

    public function GetDistricts(Request $request){
        $districts=District::where('division_id', $request->division_id)->get();
        $data = [
            'districts' => $districts,
        ];
        return response()->json($data);
    }


    public function GetAreas(Request $request){
        $areas=Area::where('district_id', $request->district_id)->get();
        $data = [
            'areas' => $areas,
        ];
        return response()->json($data);
    }

    public function GetSubAreas(Request $request){
        $sub_areas=Sub_area::where('area_id', $request->area_id)->get();
        $data = [
            'sub_areas' => $sub_areas,
        ];
        return response()->json($data);
    }

    public function GetRoads(Request $request){
        $roads=Road::where('sub_area_id', $request->sub_area_id)->get();
        $data = [
            'roads' => $roads,
        ];
        return response()->json($data);
    }



    public function storeLocations(Request $request)
    {



        if($request->formData['country_name'] && !isset($request->selectedData['country_id'])){
            $country = new Country();
            $country->country_name = $request->formData['country_name'];
            $country->save();

        }



       else if($request->formData['division_name'] && !isset($request->selectedData['division_id'])) {
           $division = new Division();
           $division->division_name = $request->formData['division_name'];
           $division->country_id = $request->selectedData['country_id'];
           $division->save();
       }

       else if($request->formData['district_name'] && !isset($request->selectedData['district_id'])) {
           $district = new District();
           $district->district_name = $request->formData['district_name'];
           $district->country_id = $request->selectedData['country_id'];
           $district->division_id = $request->selectedData['division_id'];
           $district->save();
       }


       else if($request->formData['area_name'] && !isset($request->selectedData['area_id'])) {
           $area = new Area();
           $area->area_name = $request->formData['area_name'];
           $area->country_id = $request->selectedData['country_id'];
           $area->division_id = $request->selectedData['division_id'];
           $area->district_id = $request->selectedData['district_id'];
           $area->save();

       }


       else if($request->formData['sub_area_name'] && !isset($request->selectedData['sub_area_id'])) {
           $sub_area = new Sub_area();
           $sub_area->sub_area_name = $request->formData['sub_area_name'];
           $sub_area->country_id = $request->selectedData['country_id'];
           $sub_area->division_id = $request->selectedData['division_id'];
           $sub_area->district_id = $request->selectedData['district_id'];
           $sub_area->area_id = $request->selectedData['area_id'];
           $sub_area->save();
           return redirect()->back();
       }

       else if($request->formData['road_name'] && !isset($request->selectedData['road_id'])) {
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

    public function getTree()
    {
        $countries = Country::with('divisions.districts.areas.sub_areas.roads')->get();

        $data = [
            'countries' => $countries,
        ];
        return response()->json($data);
    }




    public function deleteCountry($id){
        $countries = Country::with('divisions.districts.areas.sub_areas.roads')->where('countries.id', $id);

        Division::where('country_id',$id)->delete();
        District::where('country_id',$id)->delete();
        Area::where('country_id',$id)->delete();
        Sub_area::where('country_id',$id)->delete();
        Road::where('country_id',$id)->delete();
        $countries->delete();
//        $data = [
//            'countries' => $countries,
//        ];
        $message=" delete Succesfully";
        return response()->json($message);
    }


    public function deleteDivisions($id){
        $divisions = Division::with('districts.areas.sub_areas.roads')->where('divisions.id', $id);

        District::where('division_id',$id)->delete();
        Area::where('division_id',$id)->delete();
        Sub_area::where('division_id',$id)->delete();
        Road::where('division_id',$id)->delete();
        $divisions->delete();
        $message=" delete Succesfully";
        return response()->json($message);
    }


    public function deleteDistricts($id){
        $districts = District::with('areas.sub_areas.roads')->where('districts.id', $id);

        Area::where('district_id',$id)->delete();
        Sub_area::where('district_id',$id)->delete();
        Road::where('district_id',$id)->delete();
        $districts->delete();
        $message=" delete Succesfully";
        return response()->json($message);
    }


    public function deleteAreas($id){
        $areas = Area::with('sub_areas.roads')->where('areas.id', $id);

        Sub_area::where('area_id',$id)->delete();
        Road::where('area_id',$id)->delete();
        $areas->delete();
        $message=" delete Succesfully";
        return response()->json($message);
    }


    public function deleteSubAreas($id){
        $sub_areas = Sub_area::with('roads')->where('sub_areas.id', $id);

        Road::where('sub_area_id',$id)->delete();
        $sub_areas->delete();
        $message=" delete Succesfully";
        return response()->json($message);
    }


    public function deleteRoads($id){
        $roads = Road::findOrfail($id)->delete();

        $data = [
            'roads' => $roads
        ];
        $message=" delete Succesfully";
        return response()->json($message);
    }

}




