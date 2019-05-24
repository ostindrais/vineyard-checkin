<?php

namespace Tests\Unit;

use App\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    public function testSavingEventSetsStartTimeToNow()
    {
        $event = new Event;
        $event->save();
        $this->assertLessThan(1, time() - strtotime($event->start_time));
    }

}
