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

    public function testChildSearchReturnsEmptyIfNoMatch()
    {
        $Child = new Child;
        $found = $Child->search('notfound');
        $this->assertEquals(0, $found->count());
    }

    public function testChildSearchReturnsMatchingLastname()
    {
        // make the Child
        $Child = new Child;
        $Child->firstname = 'Test';
        $Child->lastname = 'Lastname';
        $Child->save();
        $Child = new Child;
        $found = $Child->search('notfound');
        $this->assertEquals(0, $found->count());
        $found = $Child->search('Lastname');
        $this->assertEquals(1, $found->count());
    }

    public function testChildSearchReturnsMatchingFirstname()
    {
        // make the Child
        $Child = new Child;
        $Child->firstname = 'Firstname';
        $Child->lastname = 'Test';
        $Child->save();
        $Child = new Child;
        $found = $Child->search('notfound');
        $this->assertEquals(0, $found->count());
        $found = $Child->search('Firstname');
        $this->assertEquals(1, $found->count());
    }
}
