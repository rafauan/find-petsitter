<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\City;
use App\Models\PetsitterServices;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search() 
    {
        $cities = City::all();
        $services = Service::all();

        return view('website.search', [
            'cities' => $cities,
            'services' => $services
        ]); // -> resources/views/website/search_results.blade.php
    }

    /**
     * Show the form for creating a new resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function find(Request $request) 
    {
        $service_id = $request->get('service_ide');
        $city_id = $request->get('city_id');

        $users = PetsitterServices::where('service_id', $service_id)->get();
        



        return view('website.search', [
            'cities' => $cities,
            'services' => $services
        ]); // -> resources/views/website/search_results.blade.php
    }
}