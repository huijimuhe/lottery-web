<?php

use huijimuhe\Repo\ConfRepository,
    huijimuhe\Core\Listeners\CreatorListener,
    huijimuhe\Core\Listeners\UpdaterListener,
    huijimuhe\Core\Listeners\DeleterListener;

class ConfsController extends BaseController implements CreatorListener, DeleterListener, UpdaterListener {

    protected $confRepo;

    public function __construct(ConfRepository $repo) {
        parent::__construct();
        $this->confRepo = $repo;
    }

    public function index() {
        $confs = $this->confRepo->getAllPaginated(50);
        return View::make('confs.index', compact('confs'));
    }

    public function create() {
        return View::make('confs.create_edit');
    }

    public function store() {

        $data = [
            'param' => Input::get('param'),
            'val' => Input::get('val'),
            'val2' => Input::get('val2'),
        ];

        $validator = Validator::make($data, [
                    'param' => 'required',
                    'val' => 'required',
                    'val2' => 'required',
        ]);
        return $this->confRepo->create($this, $data, $validator);
    }

    public function edit($id) {
        //
        $model = $this->confRepo->requireById($id);
        return View::make('confs.create_edit')->with('conf', $model);
    }

    public function update($id) {
        $model = $this->confRepo->requireById($id);

        $data = [
            'param' => Input::get('param'),
            'val' => Input::get('val'),
            'val2' => Input::get('val2'),
        ];

        $validator = Validator::make($data, [
                    'param' => 'required',
                    'val' => 'required',
                    'val2' => 'required',
        ]);

        return $this->confRepo->update($this, $model, $data, $validator);
    }

    public function destroy($id) {
        $model = $this->confRepo->requireById($id);
        return $this->confRepo->deleteModel($this, $model);
    }

    public function CreateError($errors) {
        Flash::error('出现错误' . $errors->first());
        return Route::back()->withInput();
    }

    public function Created($model) {
        Flash::success('操作成功');
        return Redirect::back()->withInput();
    }

    public function Deleted($model) {
        Flash::success('操作成功');
        return Redirect::back();
    }

    public function UpdateError($errors) {
        Flash::error('出现错误' . $errors->first());
        return Route::back()->withInput();
    }

    public function Updated($model) {
        Flash::success('操作成功');
        return Redirect::back();
    }

}
