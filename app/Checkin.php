<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    /**
     * Each checkin has one event associated
     */
    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    /**
     * Each checkin has one child associated
     */
    public function child()
    {
        return $this->belongsTo('App\Child');
    }

    /**
     * Requires event & child before saving is allowed
     */
    public function save(array $options = Array())
    {
        if (is_null($this->event) || is_null($this->child)) {
            throw new \Exception('Missing event');
        }
    }
}
