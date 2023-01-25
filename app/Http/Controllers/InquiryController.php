<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Models\User;
use App\Models\Service;
use App\Models\City;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class InquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $inquiry = Inquiry::with('service')->first();

        if($request->filled('search')) {
            $search = $request->input('search');

            $inquiries = Inquiry::query()
                ->join('services', 'inquiries.service_id', '=', 'services.id')
                ->join('cities', 'inquiries.city_id', '=', 'cities.id')
                ->join('users as petsitter', 'inquiries.petsitter_id', '=', 'petsitter.id')
                ->join('users as customer', 'inquiries.customer_id', '=', 'customer.id')
                ->select('inquiries.*', 'services.name as service_name', 'cities.name as city_name', 'petsitter.name as petsitter_name', 'customer.name as customer_name')
                ->where(function($query) use ($search) {
            $query->where('services.name', 'LIKE', "%{$search}%")
                ->orWhere('cities.name', 'LIKE', "%{$search}%")
                ->orWhere('petsitter.name', 'LIKE', "%{$search}%")
                ->orWhere('customer.name', 'LIKE', "%{$search}%");
            })
            ->paginate(10);

        } else {
            $inquiries = Inquiry::paginate(10);
        }
        
        return view('inquiries.index', compact('inquiries')); // -> resources/views/inquiries/index.blade.php 
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        $cities = City::all();
        $petsitters = User::where('role', 'Petsitter')->where('status', 'Published')->get();
        $customers = User::where('role', 'Customer')->where('status', 'Published')->get();

        return view('inquiries.create', [
            'services' => $services,
            'cities' => $cities,
            'petsitters' => $petsitters,
            'customers' => $customers
        ]); // -> resources/views/inquiries/create.blade.php
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation for required fields (and using some regex to validate our numeric value)
        $request->validate(
            [
                'service_id' => 'required',
                'city_id' => 'required',
                'weight' => 'required',
                'age' => 'required',
                'message' => 'required',
                'petsitter_id' => 'required',
                'customer_id' => 'required',
            ],
            [   
                'required' => 'This field cannot be empty',

            ]
        ); 

        $inquiry = new Inquiry;
        $inquiry->service_id = $request->get('service_id');
        $inquiry->city_id = $request->get('city_id');
        $inquiry->weight = $request->get('weight');
        $inquiry->age = $request->get('age');
        $inquiry->message = $request->get('message');
        $inquiry->petsitter_id = $request->get('petsitter_id');
        $inquiry->customer_id = $request->get('customer_id');
        $inquiry->status = 'New';
        $inquiry->save();
 
        return redirect('/inquiries')->with('success', 'New inquiry created');   // -> resources/views/inquiries/index.blade.php
    }    
 
    /**
     * Display the specified resource. We don't need this one for this tutorial.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('inquiries.show', ['inquiry' => Inquiry::find($id)]);
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inquiry = Inquiry::find($id);

        // Service 
        $service = Service::find($inquiry->service_id);
        $other_services = Service::where('id', '!=', $inquiry->service_id)->get();

        // Cities
        $city = City::find($inquiry->city_id);
        $other_cities = City::where('id', '!=', $inquiry->city_id)->get();

        // Users
        $petsitter = User::find($inquiry->petsitter_id);
        $other_petsitters = User::where('id', '!=', $inquiry->petsitter_id)->where('role', 'Petsitter')->get();

        $customer = User::find($inquiry->customer_id);
        $other_customers = User::where('id', '!=', $inquiry->customer_id)->where('role', 'Customer')->get();

        return view('inquiries.edit', compact('inquiry', 'petsitter', 'other_petsitters', 'customer', 'other_customers', 'city', 'other_cities', 'service', 'other_services'));  // -> resources/views/stocks/edit.blade.php
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validation for required fields (and using some regex to validate our numeric value)
        $request->validate(
            [
                'message' => 'required'
            ],
            [   
                'required' => 'This field cannot be empty',
            ]
        ); 

        $inquiry = Inquiry::find($id);

        $inquiry->service_id = $request->get('service_id');
        $inquiry->city_id = $request->get('city_id');
        $inquiry->weight = $request->get('weight');
        $inquiry->age = $request->get('age');
        $inquiry->petsitter_id = $request->get('petsitter_id');
        $inquiry->customer_id = $request->get('customer_id');
        $inquiry->save();

        return redirect()->route('inquiries.show', ['inquiry' => Inquiry::find($id)])->with('success', __('Inquiry updated'));
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inquiry = Inquiry::find($id);
        $inquiry->delete(); // Easy right?
 
        return redirect('/dashboard')->with('success', 'Inquiry removed');
    } 
}