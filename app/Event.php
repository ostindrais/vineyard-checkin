<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    public function start($eventName = "Started Event")
    {
        $activeEvent = Event::whereNull('end_time');
        if ($activeEvent->count() > 0) {
            return $activeEvent->first();
        }
        $startedEvent = $this->new($eventName);
        $startedEvent->save();
        return $startedEvent;
    }

    public function end()
    {
        if (is_null($this->id)) {
            return;
        }
        $this->end_time = date('Y-m-d H:i:s');
    }

    public function new($eventName = "Event")
    {
        $newEvent = new Event;
        $newEvent->name = $eventName;
        $newEvent->end_time = null;
        return $newEvent;
    }

    public static function activeEventExists()
    {
        return Event::whereNull('end_time')->count() > 0;
    }

    public static function active()
    {
        if (Event::activeEventExists()) {
            return Event::whereNull('end_time')->first();
        }
        return false;
    }

    public function save(array $options = Array())
    {
        // If start time is not set, we set it to now()
        if (is_null($this->start_time)) {
            $this->start_time = date('Y-m-d H:i:s');
        }
        return parent::save($options);
    }
}
