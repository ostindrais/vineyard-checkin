<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    /**
     * Set the default attribute values
     */
    protected $attributes = [
        'type'  =>  'kids'
    ];

    /**
     * Each child has one family they belong to
     */
    public function family()
    {
        return $this->belongsTo('App\Family');
    }

}
