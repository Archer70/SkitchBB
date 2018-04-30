<?php

namespace Tests\Unit;

use App\Category;
use App\Post;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;
use App\Traits\Permissible;

class PermissibleTest extends TestCase
{
    // ENTITY PERMISSIONS
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

    // ACCESS PERMISSIONS
    public function testAccessKeyNotFoundIsFalse()
    {
        $user = new MockPermissibleUser();
        $this->assertFalse($user->accessTo('green_eggs_and_ham'));
    }

    public function testCannotAccessArea()
    {
        $user = new MockPermissibleUser();
        $this->assertFalse($user->accessTo('admin'));
    }

    public function testAllowedToAccessArea()
    {
        $user = new MockPermissibleUser();
        $this->assertTrue($user->accessTo('post_feed'));
    }
}

class MockPermissibleUser extends Model
{
    use Permissible;
    public $id = 1;
    public $group_id = 1; // Regular user.

    // OVERRIDE, gets access permissions for that user's group.
    protected function accessPermissions()
    {
        return [
            'admin' => false,
            'post_feed' => true
        ];
    }
}
