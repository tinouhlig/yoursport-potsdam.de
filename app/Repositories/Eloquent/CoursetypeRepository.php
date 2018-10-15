<?php

namespace Yours\Repositories\Eloquent;

use Yours\Repositories\Contracts\RepositoryInterface;
use Yours\Repositories\Eloquent\Repository;

class CoursetypeRepository extends Repository
{
    public function model()
    {
        return 'Yours\Models\Coursetype';
    }
}
