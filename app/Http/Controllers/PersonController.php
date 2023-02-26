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
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
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
}
