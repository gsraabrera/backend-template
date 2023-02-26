<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use DB;

class ActivityLogController extends Controller
{
            /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $activity = Activity::all()->last();
        if($request->has('subject_id')) {
            $activity = $activity->where('subject_id',$request->subject_id);
        } 
        if($request->has('fields')) {
            foreach ($request->fields as $key => $value) {
                $newField = $value;
                if($value === 'log_name'){
                    $newField = DB::raw("CONCAT(causer_id,' ', created_at) as logs");
                }
                // if($key === 0){
                //     $activity = $activity->select($newField);
                // }else{
                //     $activity = $activity->addSelect($newField);
                // }
                $activity = $activity->select($newField);
             }
        }
        if($request->has('event')) {    
            $activity = $activity->where('event',$request->event);
        } 
        if($request->has('from_date')) {
            $activity = $activity->where('created_at','>=', $request->from_date);
        } 
        if($request->has('to_date')) {
            $activity = $activity->where('created_at','<=', $request->to_date);
        } 
        if($request->has('action_by')) {
            $activity = $activity->where('causer_id', $request->action_by);
        } 
        if($request->has('items')) {
            $activity = $activity->paginate($request->items);
        } else {
            $activity = $activity->get();
        }


        return response()->json(
            [
             'activity_logs' => $activity,
            ], 200
        );
        
    }
}
