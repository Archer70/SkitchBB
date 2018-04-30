<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;
use App\Traits\Ownable;

class OwnableTest extends TestCase
{
    public function testEntityOwnedByUser()
    {
        $entity = new MockEntity();
        $this->assertTrue(
            $entity->ownedBy(new MockUser())
        );
    }

    public function testEntityNotOwnedByUser()
    {
        $entity = new MockEntity();
        $entity->user_id = 2;
        $this->assertFalse(
            $entity->ownedBy(new MockUser())
        );
    }

    public function testEntityWithCustomIdProperty()
    {
        $entity = new MockEntityWithCustomIdProperty();
        $this->assertTrue(
            $entity->ownedBy(new MockUser())
        );
    }
}

class MockUser extends Model
{
    public $id = 1;
}

class MockEntity
{
    use Ownable;
    public $user_id = 1;
}

class MockEntityWithCustomIdProperty
{
    use Ownable;
    public $other_id = 1;
    protected function ownerProperty()
    {
        return 'other_id';
    }
}
