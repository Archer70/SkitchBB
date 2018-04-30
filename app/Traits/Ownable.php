<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait Ownable
{
    protected function ownerProperty()
    {
        return 'user_id';
    }

    public function ownedBy(Model $owner)
    {
        return $this->{$this->ownerProperty()} == $owner->id;
    }
}
