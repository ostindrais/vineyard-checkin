<?php

namespace Tests\Unit;

use App\Checkin;
use App\Event;
use App\Adult;
use App\Family;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FamilyTest extends TestCase
{
    use RefreshDatabase;

    public function testSearchMethodNeedsOneArgument()
    {
        $family = new Family;
        $this->expectException('ArgumentCountError');
        $result = $family->search();
    }

    public function testSearchMethodReturnsEmptyCollectionIfNotFound()
    {
        $family = new Family;
        $result = $family->search('Notfound');
        $this->assertEquals(0, $result->count());
    }

    public function testSearchMethodReturnsCollectionIfNameFoundForAdult()
    {
        // build the family first
        $family = new Family;
        $family->name = "Test Family";
        $family->save();
        // make the adult
        $adult = new Adult;
        $adult->firstname = 'Test';
        $adult->lastname = 'Test';
        $adult->phone = '2223334444';
        $adult->save();
        // associate the adult w/ the family
        $family->adults()->save($adult);
        // reset the family object
        $family = new Family;
        // run a search by name
        $result = $family->search('notfound');
        $this->assertEquals(0, $result->count());
        $result = $family->search('Test');
        $this->assertEquals(1, $result->count());
    }
}
