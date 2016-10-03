<?php

namespace Metrique\Building\Contracts\Page;

use Illuminate\Http\Request;

interface GroupRepositoryInterface
{
    /**
     * Destroy a group.
     * @param  int $id
     * @return mixed
     */
    public function destroy($id);
}
