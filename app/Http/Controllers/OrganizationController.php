<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    {
        //
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
