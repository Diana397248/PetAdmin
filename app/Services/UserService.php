<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function fetchAllUsers($page)
    {
        $perPage = 10;
        $users = User::orderBy('created_at', 'DESC')->paginate($perPage, ['*'], 'page', $page);

        return [

            'users' => $users,
            'links' => $users->links(),
            'count' => User::all()->count(),
            'meta' => [
                'currentPage' => $users->currentPage(),
                'lastPage' => $users->lastPage(),
                'totalItems' => $users->total(),
                'perPage' => $users->perPage(),
            ],
        ];
    }
}
