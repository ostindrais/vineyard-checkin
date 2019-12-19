<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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

    /**
     * Search for a child by name
     *
     * @param string $value Name to search for
     * @return Collection
     */
    public function search($value)
    {
        return $this::query()->whereLike(['lastname', 'firstname'], $value)->get();
    }
}
