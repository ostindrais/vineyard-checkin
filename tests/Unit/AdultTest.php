<?php

namespace Tests\Unit;

use App\Adult;
use App\Family;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdultTest extends TestCase
{
    use RefreshDatabase;


    public function testAdultThrowsExceptionWhenNoDataSet()
    {
        $this->expectException(\Exception::class);
        $adult = new Adult;
        $adult->save();
    }


    public function testAdultThrowsExceptionWhenOneDataSet()
    {
        $adult = new Adult;
        $adult->firstname = 'Test';
        $this->expectException(\Exception::class);
        $adult->save();
    }

    public function testAdultThrowsExceptionWhenTwoDataSet()
    {
        $adult = new Adult;
        $adult->firstname = 'Test';
        $adult->lastname = 'Tester';
        $this->expectException(\Exception::class);
        $adult->save();
    }


    public function testAdultThrowsNoExceptionWhenAllDataSet()
    {
        $adult = new Adult;
        $adult->firstname = 'Test';
        $adult->lastname = 'Tester';
        $adult->phone = '2223334444';
        $adult->save();
        $adult->fresh();
        $this->assertEquals('Test', $adult->firstname);
    }


    public function testAdultHasFamily()
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
        // reload the family
        $family = Family::find($family->id);
        // now check the association
        $this->assertEquals('App\Family', get_class($adult->family));
        $familyCheck = $adult->family;
        $this->assertEquals($family, $familyCheck);
    }

    public function testAdultSearchReturnsEmptyIfNoMatch()
    {
        $adult = new Adult;
        $found = $adult->search('notfound');
        $this->assertEquals(0, $found->count());
    }

    public function testAdultSearchReturnsMatchingLastname()
    {
        // make the adult
        $adult = new Adult;
        $adult->firstname = 'Test';
        $adult->lastname = 'Lastname';
        $adult->phone = '2223334444';
        $adult->save();
        $adult = new Adult;
        $found = $adult->search('notfound');
        $this->assertEquals(0, $found->count());
        $found = $adult->search('Lastname');
        $this->assertEquals(1, $found->count());
    }

    public function testAdultSearchReturnsMatchingFirstname()
    {
        // make the adult
        $adult = new Adult;
        $adult->firstname = 'Firstname';
        $adult->lastname = 'Test';
        $adult->phone = '2223334444';
        $adult->save();
        $adult = new Adult;
        $found = $adult->search('notfound');
        $this->assertEquals(0, $found->count());
        $found = $adult->search('Firstname');
        $this->assertEquals(1, $found->count());
    }

    public function testAdultSearchReturnsMatchingPhone()
    {
        // make the adult
        $adult = new Adult;
        $adult->firstname = 'Firstname';
        $adult->lastname = 'Test';
        $adult->phone = '5554447777';
        $adult->save();
        $adult = new Adult;
        $found = $adult->search('notfound');
        $this->assertEquals(0, $found->count());
        $found = $adult->search('77');
        $this->assertEquals(1, $found->count());
    }
}
