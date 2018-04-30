<?php

namespace App\Traits;
use Illuminate\Database\Eloquent\Model;

trait Permissible
{
    /**
     * Whether or not the user has permission to do a thing.
     *
     * @var string The action we want to perform.
     * @var Model The entity we want to modify.
     * @return @boolean
     */
    public function allowedTo($action, Model $entity)
    {
        $groupPermissionSet = config('entity_permissions.'.$this->groupName());

        if (!in_array(get_class($entity), $groupPermissionSet)) {
            return false;
        }
        $entityPermissionSet = $groupPermissionSet[get_class($entity)];

        if (!in_array($action, $entityPermissionSet)) {
            return false;
        }
        $permission = $entityPermissionSet[$action];

        if ($permission == 'all') {
            return true;
        } elseif ($permission == 'none') {
            return false;
        } else { // own
            return $this->checkOwned($entity);
        }
    }

    /**
     * Checks if the entity is owned by the "user".
     *
     * @param Model $entity
     * @return bool
     */
    private function checkOwned(Model $entity)
    {
        if (!in_array('App\Traits\Ownable', class_uses($entity))) {
            return false;
        }

        return $entity->ownedBy($this->owner());
    }

    /**
     * Gets the human readable array key for group permissions.
     *
     * @return string
     */
    private function groupName()
    {
        switch ($this->{$this->groupProperty()}) {
            case 1:
                return 'user';
            case 2:
                return 'admin';
            case 3:
                return 'global_moderator';
        }
    }

    /**
     * Gets the owner model object of the resource.
     *
     * @return $this
     */
    protected function owner()
    {
        return $this;
    }

    /**
     * Gets the property to look under for the group id.
     *
     * @return string
     */
    protected function groupProperty()
    {
        return 'group_id';
    }
}