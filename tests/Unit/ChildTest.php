<?php

namespace Tests\Unit;

use App\Child;
use App\Family;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChildTest extends TestCase
{
    use RefreshDatabase;

    public function testNewChildDefaultsToTypeKids()
    {
        $child = new Child();
        $this->assertEquals('kids', $child->type);
    }

    public function testChildHasFamily()
    {
        // build the family first
        $family = new Family;
        $family->name = "Test Family";
        $family->save();
        // make the child
        $child = new Child;
        $child->firstname = 'Test';
        $child->lastname = 'Test';
        $child->save();
        // associate the child w/ the family
        $family->children()->save($child);
        // reload the family and child
        $child = Child::find($child->id);
        $family = Family::find($family->id);
        // now check the association
        $this->assertEquals('App\Child', get_class($family->children->first()));
        // load the children relation by accessing
        $familyChildren = $child->family->children;
        $familyCheck = $child->family;
        $this->assertEquals($family->toArray(), $familyCheck->toArray());
    }

}
