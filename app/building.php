<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class building extends Model
{
    protected $fillable = ['name', 'abbreviation'];
   
    public $timestamps = false;
    
    public function room()
    {
        return $this->hasMany('App\room','building','id');
    }
}
