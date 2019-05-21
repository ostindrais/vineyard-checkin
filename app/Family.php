<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    public function adults()
    {
        return $this->hasMany('App\Adult');
    }

    public function children()
    {
        return $this->hasMany('App\Child');
    }
}
