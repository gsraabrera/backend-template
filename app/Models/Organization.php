<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Organization extends Model
{
    use HasFactory;
    use HasUuids;
    use LogsActivity;
    // use DetectsChanges;
    protected $keyType = 'string';
    protected $guarded = [];  

    protected static $logAttributes = ['acronym','description','name'];
    protected static $logName = 'Organization';
    
    public function children() {
        return $this->hasMany(Organization::class,'parent_id')->with('children');
    }

    public function parent() {
        return $this->belongsTo('Organization','parent_id');
    }
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name', 'acronym','description'])
        ->useLogName('Organizations')
        ->dontLogIfAttributesChangedOnly(['acronym'])
        ->logOnlyDirty()
        ->setDescriptionForEvent(fn(string $eventName) => "Has been {$eventName}");
    }
    
    
    public function scopeFilter($query, $filters){
        if($filters->has('fields')) {
            $field_alias = array(); 
            foreach ($filters->fields as $key => $value) {
                $value = "organizations.".$value;
                array_push($field_alias, $value);
             }
            $query->select($field_alias);
        }
        if($filters->has('distinct')) {
            $query->select($filters->column_name)->distinct();
            if($filters->has('fields')) {
                $field_alias = array(); 
                foreach ($filters->fields as $key => $value) {
                    $value = "organizations.".$value;
                    array_push($field_alias, $value);
                 }
                $query->addSelect($field_alias);
            }
        }

        //order
        if($filters->has('order_type')) {
            if($filters->order_field === 'parent'){
                $filters->order_field =  "org_parent.acronym";
            }
            $query->orderBy($filters->order_field, $filters->order_type);
        }

        if($filters->has('with_parent_name')) {
            $query->leftJoin('organizations as org_parent', 'org_parent.id', '=', 'organizations.parent_id')
                ->addSelect('org_parent.acronym as parent','organizations.id');
        }

        if($filters->has('with_child')) {
            $query->with('children');
        }

        if($filters->has('acronym')) {
            $query->where('organizations.acronym',$filters->acronym);
        }

        if($filters->has('parent_acronym')) {
            $query->where('org_parent.acronym',$filters->parent_acronym);
        }
    }

}
