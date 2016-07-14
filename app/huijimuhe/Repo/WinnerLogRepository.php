<?php

namespace huijimuhe\Repo;

use WinnerLog,
    huijimuhe\Core\Listeners\CreatorListener,
    huijimuhe\Core\Exceptions\EntityNotFoundException;

class WinnerLogRepository extends \huijimuhe\Core\Repo\EloquentRepository {

    public function __construct(WinnerLog $model) {
        $this->model = $model;
    }

    public function getWinnerLogOfScriptByPaginated($id, $count) {
        return $this->model
                        ->where('user_id', '=', $id)
                        ->paginate($count);
    }

    public function create(CreatorListener $observer, $data, $validator = null) {
        //验证
        if ($validator && $validator->fails()) {
            return $observer->CreateError($validator->messages());
        }
        //建MODEL
        $model = $this->getNew($data);
        //存MODEL
        if (!$this->save($model)) {
            return $observer->CreateError($model->getErrors());
        }

        return $observer->Created($model);
    }

}
