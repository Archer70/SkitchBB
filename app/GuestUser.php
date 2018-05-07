<?php

namespace App;

use Pseudo\Contracts\GuestContract;

class GuestUser extends User implements GuestContract
{
    public function getNameAttribute()
    {
        return __('Guest');
    }
}
