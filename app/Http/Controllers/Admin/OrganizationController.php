<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organization;
use Spatie\Activitylog\Contracts\Activity;
use App\Http\Requests\Organization\StoreRequest;
use Illuminate\Support\Facades\Auth;

// use Spatie\Activitylog\Models\Activity;
class OrganizationController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $org = Organization::filter($request, '');

        if($request->has('items')) {
            $org = $org->paginate($request->items);
        } else {
            $org = $org->get();
        }

        return response()->json(
            [
             'organizations' => $org,
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
        $org = Organization::create($request->all());
        return response()->json(
            [
             'organizations' => $org,
             'message'  => 'successfully added.'
            ], 200
         );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    {
        $organization->acronym = $request->input('acronym');
        $organization->name = $request->input('name');
        $organization->description = $request->input('description');
        $organization->save();

        return response()->json(
            [
             'organizations' => 'Sucessfully Updated'
            ], 200
         );
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        //
    }
}
