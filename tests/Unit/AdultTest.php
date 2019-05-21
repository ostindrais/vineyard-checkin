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

    
}
