<?php

namespace App\Services;
use Spatie\Activitylog\Models\Activity;

class ActivityLogService {
 
    public function filter($input)
    {
        $activity = Activity::all()->last();
        if($input->has('fields')) {
            $activity = $activity->select($input->fields);
        }
        if($input->has('subject_id')) {
            $activity = $activity->where('subject_id',$input->subject_id);
        } 
        if($input->has('event')) {    
            $activity = $activity->where('event',$input->event);
        } 
        if($input->has('from_date')) {
            $activity = $activity->where('created_at','>=', $input->from_date);
        } 
        if($input->has('to_date')) {
            $activity = $activity->where('created_at','<=', $input->to_date);
        } 
        if($input->has('action_by')) {
            $activity = $activity->where('causer_id', $input->action_by);
        } 
        if($input->has('log_name')) {
            $activity = $activity->where('log_name', $input->log_name);
        } 
        if($input->has('order_type')) {
            $activity = $activity->orderBy($input->order_field, $input->order_type);
        }
        if($input->has('items')) {
            return $activity = $activity->paginate($input->items);
        } else {
            return $activity = $activity->get();
        }
    }
}