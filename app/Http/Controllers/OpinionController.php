<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Opinion;
use App\Models\User;

class OpinionController extends Controller
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

            $opinions = Opinion::query()
                ->join('users', 'opinions.petsitter_id', '=', 'users.id')
                ->join('users', 'opinions.customer_id', '=', 'users.id')
                ->select('opinions.*')
                ->where('users.name', 'LIKE', "%{$search}%")
                ->paginate(10);

        } else {
            $opinions = Opinion::paginate(10);
        }
        
        return view('opinions.index', compact('opinions')); // -> resources/views/opinions/index.blade.php 
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('opinions.create'); // -> resources/views/opinions/create.blade.php
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
                'text' => 'required',
                'score' => 'required',
                'petsitter_id' => 'required',
                'customer_id' => 'required'
            ],
            [   
                'required' => 'This field cannot be empty',

            ]
        ); 

        $opinion = new Opinion;
        $opinion->text = $request->get('text');
        $opinion->score = $request->get('score');
        $opinion->petsitter_id = $request->get('petsitter_id');
        $opinion->customer_id = $request->get('customer_id');
        $opinion->save();
 
        return redirect('/opinions')->with('success', 'New inquiry created');   // -> resources/views/opinions/index.blade.php
    }    
 
    /**
     * Display the specified resource. We don't need this one for this tutorial.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('opinions.show', ['opinion' => Opinion::find($id)]);
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $opinion = Opinion::find($id);

        // Users
        $petsitter = User::find($opinion->petsitter_id);
        $other_petsitters = User::where('id', '!=', $opinion->petsitter_id)->where('role', 'Petsitter')->get();

        $customer = User::find($opinion->customer_id);
        $other_customers = User::where('id', '!=', $opinion->customer_id)->where('role', 'Customer')->get();

        // Scores
        $scores = [1, 2, 3, 4, 5];
        $score = $opinion->score; 
        $index = array_search($score, $scores);
        if ($index !== false) {
            array_splice($scores, $index, 1);
        }

        return view('opinions.edit', compact('opinion', 'petsitter', 'other_petsitters', 'customer', 'other_customers', 'scores', 'score'));  // -> resources/views/opinions/edit.blade.php
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
                'text' => 'required'
            ],
            [   
                'required' => 'This field cannot be empty',
            ]
        ); 

        $opinion = Opinion::find($id);

        $opinion->text = $request->get('text');
        $opinion->score = $request->get('score');
        $opinion->petsitter_id = $request->get('petsitter_id');
        $opinion->customer_id = $request->get('customer_id');
        $opinion->status = $request->get('status');
        $opinion->save();

        return redirect()->route('opinions.show', ['opinion' => Opinion::find($id)])->with('success', __('Opinion updated'));
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $opinion = Opinion::find($id);
        $opinion->delete(); // Easy right?
 
        return redirect('/dashboard')->with('success', 'Opinion removed');
    } 
}