<?php

namespace App\Repositories\Eloquent;

use App\Models\User;

class UserRepository
{
    public function fetch($filter, $page = null)
    {
        $users = User::latest();
        if (isset($filter['q'])) {
            $users->where('name', 'like', '%' . $filter['q'] . '%');
        }
        if ($page) {
            return $users->paginate($page);
        }
        return $users->get();
    }
}
