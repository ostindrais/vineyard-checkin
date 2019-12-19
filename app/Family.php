<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Family extends Model
{
    public function adults()
    {
        return $this->hasMany('App\Adult');
    }

    public function children()
    {
        return $this->hasMany('App\Child');
    }

    /**
     * Search for a family
     * Can be either name or phone number
     *
     * @param string $value Value to search
     * @return Collection
     */
    public function search($value)
    {
        $adults = new Adult;
        $foundAdults = $adults->search($value);
        $collection = $this->newCollection();
        foreach ($foundAdults as $foundAd) {
            $collection->push($foundAd->family);
        }
        $children = new Child;
        $foundChildren = $children->search($value);
        foreach ($foundChildren as $foundChild) {
            $collection->push($foundChild->family);
        }
        return $collection;
    }
}
