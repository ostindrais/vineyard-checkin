<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function save(array $options = Array())
    {
        // If start time is not set, we set it to now()
        if (is_null($this->start_time)) {
            $this->start_time = time();
        }
        return parent::save($options);
    }
}
