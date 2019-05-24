<?php

namespace Tests\Unit;

use App\Checkin;
use App\Event;
use App\Child;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheckinTest extends TestCase
{
    use RefreshDatabase;

    public function testSavingRequiresSomeDataToBeSet()
    {
        $checkin = new Checkin;
        $this->expectException(\Exception::class);
        $checkin->save();
        
    }

    public function testSavingRequiresEvent()
    {
        $child = new Child;
        $child->firstname = "Test";
        $child->lastname = "Test";
        $child->save();
        $checkin = new Checkin;
        $checkin->child()->associate($child);
        $this->expectException(\Exception::class);
        $checkin->save();
    }

    public function testSavingRequiresChild()
    {
        $event = new Event;
        $event->name = "Test Event";
        $event->save();
        $checkin = new Checkin;
        $checkin->event()->associate($event);
        $this->expectException(\Exception::class);
        $checkin->save();
    }
}
