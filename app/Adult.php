<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Adult extends Model
{

    /**
     * Each adult has one family they belong to
     */
    public function family()
    {
        return $this->belongsTo('App\Family');
    }

    /**
     * Save requires adult to have full info (name & phone)
     */
    public function save(array $options = Array())
    {
        if (strlen($this->lastname) == 0 || strlen($this->firstname) == 0 || strlen($this->phone) == 0) {
            throw new \Exception('Missing data.');
        }
        return parent::save($options);
    }

    /**
     * Search for an adult by name or phone
     *
     * @param string $value Value to search for
     * @return Collection
     */
    public function search($value)
    {
        return $this::query()->whereLike(['lastname', 'firstname', 'phone'], $value)->with('family')->get();
    }
}
