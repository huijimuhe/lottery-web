<?php

use jimu\Repo\UserRepository,
    jimu\Core\Listeners\CreatorListener,
    jimu\Core\Listeners\UpdaterListener,
    jimu\Core\Listeners\DeleterListener;

class UsersController extends BaseController implements CreatorListener, DeleterListener, UpdaterListener {

    protected $userRepo;

    public function __construct(UserRepository $uRepo) {
        parent::__construct();
        $this->userRepo = $uRepo;
    }

    public function index() {
        $users = $this->userRepo->getAllPaginated(50);
        return View::make('users.index', compact('users'));
    }

    public function create() {
        return View::make('users.create_edit');
    }

    public function store() {

        $salt = md5(\Str::random(64) . time());
        $inputs = [
            'name' => Input::get('name'),
            'phone' => Input::get('phone'),
            'avatar' => !is_null(Input::get('avatar')) ? 'http://' . QiNiu\Config::APP_URL . '/' . Input::get('avatar') : '-1',
            'salt' => $salt,
            'password' => Hash::make($salt . Input::get('password')),
            'gender' => Input::get('gender')
        ];
        $validator = Validator::make(Input::all(), [
                    'name' => 'required|max:10|unique:users',
                    'password' =>  'required|min:6|unique:users|alpha_dash',
                    'phone' => ['required', 'regex:/^0?(13[0-9]|15[012356789]|18[0-9]|14[57])[0-9]{8}$/'],
                    'gender' => 'required|in:m,f',
        ]);
        return $this->userRepo->create($this, $inputs, $validator);
    }

    public function show($id) {
        $user = User::find($id);
        return View::make('users.create_edit', compact('user'));
    }

    public function edit($id) {
        //
        $model = $this->userRepo->requireById($id);
        return View::make('users.create_edit')->with('user', $model);
    }

    public function update($id) {
        $model = $this->userRepo->requireById($id);
        $data = [
            'name' => Input::get('name'),
            'phone' => Input::get('phone'),
            'avatar' => Input::get('avatar'),
            'password' => Input::get('password'),
            'gender' => Input::get('gender')
        ];
        $validator = Validator::make(Input::all(), [
                    'name' => 'required|max:10|unique:users',
                    'phone' => ['required', 'regex:/^0?(13[0-9]|15[012356789]|18[0-9]|14[57])[0-9]{8}$/'],
                    'gender' => 'required|in:m,f',
        ]);
        return $this->userRepo->update($this, $model, $data, $validator);
    }

    public function destroy($id) {
        $model = $this->userRepo->requireById($id);
        return $this->userRepo->deleteModel($this, $model);
    }

    /*     * ***************
     * 
     * ENTRUST 权限系统
     * 
     * ******************* */

    public function roleIndex() {
        try {
            $roles = new Role();
            $roles = $roles->paginate(50);
        } catch (Exception $ex) {
            
        }
        try {
            $perms = new Permission();
            $perms = $perms->paginate(50);
        } catch (Exception $ex) {
            
        }
        return View::make('entrust.role', compact('roles', 'perms'));
    }

    public function getRolePerm($id) {

        try {
            $perms = new Permission();
            $perms = $perms->paginate(50);
        } catch (Exception $ex) {
            
        }
        $role = Role::find($id);
        return View::make('entrust.show', compact('role', 'perms'));
    }

    public function postCreateRole() {
        //
        $name = Input::get('name');

        $role = new Role;
        $role->name = $name;
        $role->save();

        return Redirect::route('roles.index');
    }

    public function postCreatePerm() {
        //  
        $name = Input::get('name');
        $dname = Input::get('display_name');
        $perm = new Permission();
        $perm->name = $name;
        $perm->display_name = $dname;
        $perm->save();

        return Redirect::route('roles.index');
    }

    public function CreateError($errors) {
        Flash::error('错误' . $errors->first());
        return Redirect::back()->withInput();
    }

    public function Created($model) {
        Flash::success('添加成功');
        return Redirect::back();
    }

    public function Deleted($model) {
        Flash::success('删除成功');
        return Redirect::back();
    }

    public function UpdateError($errors) {
        Flash::error('错误' . $errors->first());
        return Redirect::back();
    }

    public function Updated($model) {
        Flash::success('修改成功');
        return Redirect::back()->withInput();
    }

}
