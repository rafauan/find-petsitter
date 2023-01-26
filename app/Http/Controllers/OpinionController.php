<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Opinion;
use App\Models\User;
use App\Mail\OpinionApprovedMail;
use Illuminate\Support\Facades\Mail;


class OpinionController extends Controller
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

            $opinions = Opinion::query()
                ->join('users as customer', 'opinions.customer_id', '=', 'customer.id')
                ->join('users as petsitter', 'opinions.petsitter_id', '=', 'petsitter.id')
                ->select('opinions.*', 'customer.name as customer_name', 'petsitter.name as petsitter_name')
                ->where(function($query) use ($search) {
                    $query->where('customer.name', 'LIKE', "%{$search}%")
                        ->orWhere('petsitter.name', 'LIKE', "%{$search}%");
                    })
                ->paginate(10);

        } else {
            $opinions = Opinion::with('petsitter', 'customer')->paginate(10);
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
        $petsitters = User::where('role', 'Petsitter')->where('status', 'Published')->get();
        $customers = User::where('role', 'Customer')->where('status', 'Published')->get();
        $statuses = ['Pending', 'Published'];
        $scores = [1, 2, 3, 4, 5];

        return view('opinions.create', [
            'petsitters' => $petsitters,
            'customers' => $customers,
            'statuses' => $statuses,
            'scores' => $scores
        ]); // -> resources/views/opinions/create.blade.php
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
                'customer_id' => 'required',
                'status' => 'required'
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
        $opinion->status = $request->get('status');
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
        $opinion = Opinion::find($id);
        $petsitter = User::find($opinion->petsitter_id);
        $customer = User::find($opinion->customer_id);

        return view('opinions.show', [
            'opinion' => $opinion,
            'petsitter' => $petsitter,
            'customer' => $customer
        ]);
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

        $petsitter = User::find($opinion->petsitter_id);
        $customer = User::find($opinion->customer_id);

        $url = url('/petsitter_opinions/' . $opinion->id);

        if($request->get('status') == 'Published') {
            Mail::to($petsitter->email)->send(new OpinionApprovedMail($customer->name, $customer->email, $url));
        } 

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