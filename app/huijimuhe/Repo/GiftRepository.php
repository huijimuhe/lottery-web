<?php

namespace huijimuhe\Repo;

use Gift,
    huijimuhe\Core\Listeners\CreatorListener,
    huijimuhe\Core\Listeners\UpdaterListener,
    huijimuhe\Core\Listeners\DeleterListener,
    huijimuhe\Core\Exceptions\EntityNotFoundException;

class GiftRepository extends \huijimuhe\Core\Repo\EloquentRepository {

    public function __construct(Gift $model) {
        $this->model = $model;
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

    public function update(UpdaterListener $observer, $model, $data, $validator = null) {
        // check the passed in validator
        if ($validator && $validator->fails()) {
            return $observer->CreateError($validator->messages());
        }
        //导入数据
        $model->fill($data);
        // check the model validation
        if (!$this->save($model)) {
            return $observer->UpdateError($model->getErrors());
        }
        return $observer->Updated($model);
    }

    public function deleteModel(DeleterListener $observer, $model) {
        $this->delete($model);
        return $observer->Deleted($model);
    }

}
