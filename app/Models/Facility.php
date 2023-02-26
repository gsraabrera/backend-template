<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Facility extends Model
{
    use HasFactory;
    use HasUuids;
    use LogsActivity;
    protected $keyType = 'string';
    protected $guarded = [];
    protected static $logName = 'Facility';  
    
    public function children() {
        return $this->hasMany(Facility::class,'parent_id')->with('children');
    }

    public function parent() {
        return $this->belongsTo('Facility','parent_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['label', 'description','type','parent_id'])
        ->useLogName('Facility')
        ->logOnlyDirty()
        ->setDescriptionForEvent(fn(string $eventName) => "Has been {$eventName}");
    }

    public function scopeFilter($query, $filters){
        if($filters->has('fields')) {
            $field_alias = array(); 
            foreach ($filters->fields as $key => $value) {
                $value = "facilities.".$value;
                array_push($field_alias, $value);
             }
            $query->select($field_alias);
        }
        if($filters->has('distinct')) {
            $query->select($filters->column_name)->distinct();
            if($filters->has('fields')) {
                $field_alias = array(); 
                foreach ($filters->fields as $key => $value) {
                    $value = "facilities.".$value;
                    array_push($field_alias, $value);
                 }
                $query->addSelect($field_alias);
            }
        }

        //order
        if($filters->has('type')) {
            if($filters->order_field === 'parent'){
                $filters->order_field =  "fac_parent.acronym";
            }
            $query->orderBy($filters->order_field, $filters->order_type);
        }

        if($filters->has('with_parent_name')) {
            $query->leftJoin('facilities as fac_parent', 'fac_parent.id', '=', 'facilities.parent_id')
                ->addSelect('fac_parent.label as parent','facilities.id');
        }

        if($filters->has('with_child')) {
            $query->with('children');
        }

        if($filters->has('label')) {
            $query->where('facilities.label',$filters->label);
        }

        if($filters->has('parent_label')) {
            $query->where('org_parent.label',$filters->parent_label);
        }

        if($filters->has('description')) {
            $query->where('facilties.description',$filters->description);
        }
    }
}
