<?php

namespace huijimuhe\Core\Repo;

use Illuminate\Database\Eloquent\Model;
use huijimuhe\Core\Exceptions\EntityNotFoundException;

abstract class EloquentRepository {

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    public function __construct($model = null) {
        $this->model = $model;
    }

    public function getModel() {
        return $this->model;
    }

    public function setModel($model) {
        $this->model = $model;
    }

    public function getAll() {
        return $this->model->all();
    }

    public function getAllPaginated($count) {
        return $this->model->paginate($count);
    }

    public function getTimeLine($query, $since_id, $max_id) {
        //分页
        if ($since_id == 0) {
            if ($max_id != 0) {
                $query = $query->where('id', '<', $max_id);
            }
        } else {
            $query = $query->where('id', '>', $since_id);
        }
        //取得经验
        $query = $query->orderBy('id', 'desc')
                ->take(20)
                ->get();
        return $query;
    }

    public function getList($query, $page) {
        $query = $query->skip($page * 20)
                ->take(20)
                ->get();
        return $query;
    }

    public function getById($id) {
        return $this->model->find($id);
    }

    public function requireById($id) {
        $model = $this->getById($id);

        if (!$model) {
            throw new EntityNotFoundException;
        }

        return $model;
    }

    public function getNew($attributes = array()) {
        return $this->model->newInstance($attributes);
    }

    public function save($data) {
        if ($data instanceOf Model) {
            return $this->storeEloquentModel($data);
        } elseif (is_array($data)) {
            return $this->storeArray($data);
        }
    }

    public function delete($model) {
        return $model->delete();
    }

    protected function storeEloquentModel($model) {
        if ($model->getDirty()) {
            return $model->save();
        } else {
            return $model->touch();
        }
    }

    protected function storeArray($data) {
        $model = $this->getNew($data);
        return $this->storeEloquentModel($model);
    }

}
