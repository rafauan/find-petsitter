<?php
 
namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Service;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Http\Controllers\RouteServiceProvider;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->filled('search')) {
            $search = $request->input('search');

            $services = Service::query()
                ->where('name', 'LIKE', "%{$search}%")
                ->orWhere('slug', 'LIKE', "%{$search}%")
                ->paginate(10);
        } else {
            $services = Service::paginate(10);
        }
        
        return view('services.index', compact('services')); // -> resources/views/services/index.blade.php 
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create'); // -> resources/views/services/create.blade.php
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
                'name' => ['required', 'string', 'max:255', 'unique:'.Service::class]
            ],
            [   
                'required' => 'This field cannot be empty',
                'unique' => 'This service already exists'
            ]
        ); 

        $service = new Service;
        $service->name =  $request->get('name');
        $service->slug = Str::slug($request->get('name'));
        $service->save();
 
        return redirect('/services')->with('success', 'New service created');   // -> resources/views/users/index.blade.php
    }    

    /**
     * Display the specified resource. We don't need this one for this tutorial.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('services.show', ['service' => Service::find($id)]);
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
        return view('services.edit', compact('service'));  // -> resources/views/cities/edit.blade.php
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
                'name' => 'required',
            ],
            [   
                'name.required' => 'Please Provide Your Email Address For Better Communication, Thank You.',
            ]
        ); 

        $service = Service::find($id);

        $service->name =  $request->get('name');
        $service->save();
 
        return redirect()->route('services.show', ['service' => Service::find($id)])->with('success', __('Service updated.'));
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        $service->delete(); 
 
        return redirect('/dashboard')->with('success', 'Service removed.');
    } 
}