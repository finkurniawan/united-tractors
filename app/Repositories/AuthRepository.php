<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;

class AuthRepository extends BaseRepository
{
    public function __construct(private User $user){
        parent::__construct($user);
    }
}
