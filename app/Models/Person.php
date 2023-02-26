<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Person extends Model
{
    use HasFactory;
    use HasUuids;
    use LogsActivity;
    protected $keyType = 'string';
    protected $guarded = [];

    // protected static $logAttributes = ['first_name', 'middle_name','last_name','sex','date_of_birth','civil_status'];
    protected static $logName = 'Persons';
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['first_name', 'middle_name','last_name','sex','date_of_birth','civil_status'])
        ->useLogName('Persons')
        // ->dontLogIfAttributesChangedOnly(['acronym'])
        ->logOnlyDirty()
        ->setDescriptionForEvent(fn(string $eventName) => "Has been {$eventName}");
    }

    public function scopeFilter($query, $filters){
        if($filters->has('fields')) {
            $field_alias = array(); 
            foreach ($filters->fields as $key => $value) {
                $value = "people.".$value;
                array_push($field_alias, $value);
             }
            $query->select($field_alias);
        }

        //order
        /*if($filters->has('order_type')) {
            if($filters->order_field === 'parent'){
                $filters->order_field =  "org_parent.acronym";
            }
            $query->orderBy($filters->order_field, $filters->order_type);
        }

        if($filters->has('with_parent_name')) {
            $query->leftJoin('organizations as org_parent', 'organizations.id', '=', 'org_parent.parent_id')
                ->addSelect('org_parent.acronym as parent','organizations.id');
        } */

        if($filters->has('first_name')) {
            $query->where('people.first_name',$filters->first_name);
        }

        if($filters->has('middle_name')) {
            $query->where('people.middle_name',$filters->middle_name);
        }

        if($filters->has('last_name')) {
            $query->where('people.last_name',$filters->last_name);
        }

        if($filters->has('sex')) {
            $query->where('people.sex',$filters->sex);
        }

        if($filters->has('date_of_birth')) {
            $query->where('people.date_of_birth',$filters->date_of_birth);
        }

        if($filters->has('civil_status')) {
            $query->where('people.civil_status',$filters->civil_status);
        }


    }
}


