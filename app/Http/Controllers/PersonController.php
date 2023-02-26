<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $person = Person::filter($request, '');

        if($request->has('items')) {
            $person = $person->paginate($request->items);
        } else {
            $person = $person->get();
        }

        return response()->json(
            [
             'persons' => $person,
            ], 200
         );
        //return Person::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'first_name' => 'required',
            'sex' => 'required',
            'date_of_birth' => 'required',
            'civil_status' => 'required',
            'is_verified' => 'required',
            'is_active' => 'required',
        ]);
        if($validator->fails()){
            return $validator->errors();
        }
        $person = Person::create($input);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        $person = Person::filter($request, '');

        if($request->has('items')) {
            $person = $person->paginate($request->items);
        } else {
            $person = $person->get();
        }

        return response()->json(
            [
             'persons' => $person,
            ], 200
        );
        //return Person::find($person);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        $person = Person::filter($request, '');

        if($request->has('items')) {
            $person = $person->paginate($request->items);
        } else {
            $person = $person->get();
        }

        return response()->json(
            [
             'persons' => $person,
            ], 200
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'last_name' => 'nullable',
            'sex' => 'required',
            'date_of_birth' => 'required',
            'civil_status' => 'required',
            'is_verified' => 'required',
            'is_active' => 'required',
        ]);
        if($validator->fails()){
            return $validator->errors();
        }
        
        $person->first_name = $input['first_name'];
        $person->middle_name = $input['middle_name'];
        $person->last_name = $input['last_name'];
        $person->sex = $input['sex'];
        $person->date_of_birth = $input['date_of_birth'];
        $person->civil_status = $input['civil_status'];
        $person->is_verified = $input['is_verified'];
        $person->is_active = $input['is_active'];
        $person->save();
        //$todo = Todo::find($todo);
        //$todo = Todo::update($input);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        $person->delete();
    }
}
