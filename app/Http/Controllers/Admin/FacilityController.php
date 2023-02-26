<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facility;
use App\Http\Requests\Facility\StoreRequest;
use App\Http\Requests\Facility\UpdateRequest;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $facility = Facility::filter($request, '');

        if($request->has('items')) {
            $facility = $facility->paginate($request->items);
        } else {
            $facility = $facility->get();
        }

        return response()->json(
            [
             'facilities' => $facility,
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
        $facility = Facility::create($request->all());
        return response()->json(
            [
             'facilities' => $facility,
             'message'  => 'successfully added.'
            ], 200
         );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function show(Facility $facility)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, Facility $facility)
    {
        $facility->label = $request['label'];
        $facility->description = $request['description'];
        $facility->type = $request['type'];
        $person->parent_id = $request['parent_id'];
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
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facility $facility)
    {
        //
    }
}
