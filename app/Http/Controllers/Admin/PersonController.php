<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Person;
use App\Http\Requests\Person\StoreRequest;
use App\Http\Requests\Person\UpdateRequest;
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $person = Person::create($request->all());
        return response()->json(
            [
             'persons' => $person,
             'message'  => 'successfully added.'
            ], 200
         );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {   
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Person $person)
    {   
        $person->first_name = $request['first_name'];
        $person->middle_name = $request['middle_name'];
        $person->last_name = $request['last_name'];
        $person->sex = $request['sex'];
        $person->date_of_birth = $request['date_of_birth'];
        $person->civil_status = $request['civil_status'];
        $person->save();
        return response()->json(
            [
             'persons' => $person,
             'message'  => 'successfully updated.'
            ], 200
         );
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
