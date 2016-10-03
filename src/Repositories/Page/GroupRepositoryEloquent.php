<?php

namespace Metrique\Building\Repositories\Page;

use Metrique\Building\Contracts\Page\GroupRepositoryInterface;
use Metrique\Building\Eloquent\Page\Group;

class GroupRepositoryEloquent implements GroupRepositoryInterface
{
    /**
     * {@inheritdocs}
     */
    public function destroy($id)
    {
        return Group::destroy($id);
    }
}
