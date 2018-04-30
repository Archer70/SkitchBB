<?php

namespace Tests\Unit;

use App\Category;
use App\Post;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;
use App\Traits\Permissible;

class PermissibleTest extends TestCase
{
    public function testNotAllowedToEdit()
    {
        $user = new MockPermissibleUser();
        $this->assertFalse(
            $user->allowedTo('edit', new Category())
        );
    }

    public function testAllowedToEditAny()
    {
        $user = new MockPermissibleUser();
        $user->group_id = 2; // Admin
        $this->assertFalse(
            $user->allowedTo('edit', new Category())
        );
    }

    public function testAllowedToEditOwn()
    {
        $user = new MockPermissibleUser();
        $this->assertFalse(
            $user->allowedTo('edit', new Post())
        );
    }
}

class MockPermissibleUser extends Model
{
    use Permissible;
    public $id = 1;
    public $group_id = 1; // Regular user.
}
