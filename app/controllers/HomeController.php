<?php

class HomeController extends BaseController {

    public function Welcome() {
        
    }

    public function dashBoard() {
        $size = [
        ];
        return View::make('dashboard', compact('size'));
    }

    public function setup() {
        //检查是否已初始化
        $file = app_path() . '/config/install.lock';
        if (is_file($file)) {
            echo '安装文件已存在<br>已经初始化';
            return;
        }
        //初始化用户
        $salt = md5(\Str::random(64) . time());
        $user = new User();
        $data = [
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make($salt . 'admin'),
            'salt' => $salt,];
        $user->fill($data);
        $user->save();
        echo '生成管理员.....完成<br>';

        //初始化配置
        $conf = new Conf();
        $conf->param = 'week';
        $conf->val = 200;
        $conf->val2 = 200;
        $conf->save();

        $conf2 = new Conf();
        $conf2->param = 'base_rate';
        $conf2->val = 1000;
        $conf2->save();

        //生成lock文件
        fopen($file, "w");
        echo '生成lock文件.....完成<br>';
    }

}
