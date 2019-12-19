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

    public function testEventNewMethodSetsName_DefaultIsEvent()
    {
        $event = new Event;
        $newEvent = $event->new();
        $this->assertEquals('Event', $newEvent->name);
    }

    public function testEventNewMethodSetsName_ParameterIsEventName()
    {
        $event = new Event;
        $newEvent = $event->new('Event Name');

        $this->assertEquals('Event Name', $newEvent->name);
    }

    public function testStartingEventSetsNameAndSaves()
    {
        $event = new Event;
        $startedEvent = $event->start();
        $this->assertNotNull($startedEvent->id);
        $this->assertEquals('Started Event', $startedEvent->name);
    }

    public function testStartingEventWithActiveOneDoesNotMakeNewOneButReturnsPreExisting()
    {
        $event = new Event;
        $event->save();
        $oldEventID = $event->id;
        // now start an Event
        $newEvent = $event->start('Event Name');
        $this->assertEquals($oldEventID, $newEvent->id);
    }

    public function testEndUninitializedEventDoesNotSetEndTime()
    {
        $event = new Event;
        $event->end();
        $this->assertNull($event->end_time);
    }

    public function testEndUninitializedEventDoesNotSave()
    {
        $event = new Event;
        $event->end();
        $this->assertNull($event->id);
    }

    public function testEndInitializedEventSetsEndTime()
    {
        $event = new Event;
        $startedEvent = $event->start();
        $startedEvent->end();
        $this->assertNotNull($startedEvent->id);
        $this->assertNotEmpty($startedEvent->end_time);
    }

    public function testActiveEventExistsReturnsFalseByDefault()
    {
        $event = new Event;
        $this->assertFalse($event->activeEventExists());
    }

    public function testActiveEventExistsReturnsTrueIfActiveEvent()
    {
        $event = new Event;
        $startedEvent = $event->start();
        $this->assertTrue($event->activeEventExists());
    }

    public function testActiveEventExistsReturnsFalseIfEventIsNotActive()
    {
        $event = new Event;
        $startedEvent = $event->start();
        $this->assertTrue($event->activeEventExists());
    }

    public function testActiveReturnsFalseIfNoActiveEvent()
    {
        $event = new Event;
        $this->assertFalse($event->active());
    }

    public function testActiveReturnIsNotEmptyIfActiveEventExists()
    {
        $event = new Event;
        $startedEvent = $event->start();
        $this->assertNotEmpty($event->active());
    }

    public function testActiveReturnIsActiveEventIfOneExists()
    {
        $event = new Event;
        $startedEvent = $event->start();
        $activeEvent = $event->active();
        $this->assertEquals($startedEvent->toArray(), $activeEvent->toArray());
    }
}
