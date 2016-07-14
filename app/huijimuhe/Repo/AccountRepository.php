<?php

namespace huijimuhe\Repo;

use Account,
    huijimuhe\Core\Listeners\CreatorListener,
    huijimuhe\Core\Listeners\UpdaterListener,
    huijimuhe\Core\Listeners\DeleterListener,
    huijimuhe\Core\Exceptions\EntityNotFoundException;

class AccountRepository extends \huijimuhe\Core\Repo\EloquentRepository {

    public function __construct(Account $model) {
        $this->model = $model;
    } 
}
