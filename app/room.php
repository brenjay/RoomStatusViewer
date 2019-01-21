<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class room extends Model
{
    protected $fillable = ['number', 'cleaned', 'passing', 'assigned_to', 'last_cleaned', 'last_checked', 'building', 'assigned_to', 'full_name'];
   
    public $timestamps = false;
   
   
     public function building()
    {
        return $this->belongsTo('App\building','building');
    }
    
     public function owner()
    {
        return $this->belongsTo('App\building','building');
    }
    
}
