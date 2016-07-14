<?php

use huijimuhe\Repo\AccountRepository,
    huijimuhe\Core\Listeners\CreatorListener,
    huijimuhe\Core\Listeners\DeleterListener;

class AccountsController extends BaseController implements CreatorListener, DeleterListener {

    protected $accountRepo;

    public function __construct(AccountRepository $repo) {
        parent::__construct();
        $this->accountRepo = $repo;
    }

    public function index() {
        $accounts = $this->accountRepo->getAllPaginated(50);
        return View::make('accounts.index', compact('accounts'));
    }

    public function getListOfScript($id) {
        $accounts = $this->accountRepo->getAccountOfScriptByPaginated($id, 50);
        return View::make('accounts.index', compact('accounts', 'id'));
    }

    public function create() {
        return View::make('accounts.create_edit');
    }

    public function store() {

        $data = [
            'url' => QiNiu\Config::FULL_URL . Input::get('url'),
            'user_id' => Input::get('user_id'),
            'script_id' => Input::get('script_id')];

        $validator = Validator::make($data, [
                    'user_id' => 'required|numeric',
                    'script_id' => 'required|numeric',
        ]);
        return $this->accountRepo->create($this, $data, $validator);
    }

    public function show($id) {
        $account = $this->accountRepo->requireById($id);
        return View::make('accounts.show', compact('account'))->with($id);
    }

    public function destroy($id) {
        $model = $this->accountRepo->requireById($id);
        return $this->accountRepo->deleteModel($this, $model);
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

}
