<?php

class LotteryController extends BaseController {

    public function getIndex() {
        return View::make('mobile.index');
    }

    public function postMobileScratch() {
        $phone = Input::get('phone');
        $account = Account::where('phone', '=', $phone)->first();
        //是否存在此号码
        if (!isset($account)) {
            return View::make('mobile.no_gift')->withRes('无此号码');
        }
        $res['phone'] = $phone;
        //是否超过用户当天抽奖次数并计数
        if (Account::isOverTodayTimes($account->id)) {
            return View::make('mobile.no_gift')->withRes('超过抽奖次数');
        }
        $res['time'] = Account::surplus($account->id);
        //是否超过当周抽奖次数
        if (Conf::isOverWeekTimes()) {
            $res['prize'] = '本周奖品已送完';
            return View::make('mobile.scratch')->withRes($res);
        }
        //随机抽奖 
        $gift = Gift::Lottery();
        if (!$gift) {
            $res['prize'] = '没中奖';
            return View::make('mobile.scratch')->withRes($res);
        }

        //更新本周奖品数并最后检查并发 
        $isLast = FALSE;
        DB::transaction(function()use($gift, $account, &$isLast) {
            if (!Conf::isOverWeekTimes()) {
                $weekTimes = Conf::where('param', '=', 'week');
                $weekTimes->decrement('val2');
                //添加用户中奖记录
                WinnerLog::NewLog($gift, $account);
                //用户中奖计数
                $account->increment('win_count');
            } else {
                $isLast = true;
            }
        });
        if ($isLast) {
            $res['prize'] = '本周奖品已送完';
            return View::make('mobile.scratch')->withRes($res);
        } else {
            $res['prize'] = $gift->name;
            $res['win'] = 1;
            return View::make('mobile.scratch')->withRes($res);
        }
    }

    public function postMobileEgg() {
        $phone = Input::get('phone');
        $account = Account::where('phone', '=', $phone)->first();
        //是否存在此号码
        if (!isset($account)) {
            return View::make('mobile.no_gift')->withRes('无此号码');
        }
        $res['phone'] = $phone;
        //是否超过用户刷卡次数并计数
        if ($account->chance_count == 0) {
            return View::make('mobile.no_gift')->withRes('超过抽奖次数');
        }
        $account->decrement('chance_count');
        $res['time'] = $account->chance_count;
        //是否超过当周抽奖次数
        if (Conf::isOverWeekTimes()) {
            $res['prize'] = '本周奖品已送完';
            return View::make('mobile.egg')->withRes($res);
        }
        //随机抽奖 
        $gift = Gift::Lottery();
        if (!$gift) {
            $res['prize'] = '没中奖';
            return View::make('mobile.egg')->withRes($res);
        }

        //更新本周奖品数并最后检查并发 
        $isLast = FALSE;
        DB::transaction(function()use($gift, $account, &$isLast) {
            if (!Conf::isOverWeekTimes()) {
                $weekTimes = Conf::where('param', '=', 'week');
                $weekTimes->decrement('val2');
                //添加用户中奖记录
                WinnerLog::NewLog($gift, $account);
                //用户中奖计数
                $account->increment('win_count');
            } else {
                $isLast = true;
            }
        });
        if ($isLast) {
            $res['prize'] = '本周奖品已送完';
            return View::make('mobile.egg')->withRes($res);
        } else {
            $res['prize'] = $gift->name;
            $res['win'] = 1;
            return View::make('mobile.egg')->withRes($res);
        }
    }

    
    public function getMobileEgg() {
        $phone = Input::get('phone');
        $account = Account::where('phone', '=', $phone)->first();
        //是否存在此号码
        if (!isset($account)) {
            return View::make('mobile.no_gift')->withRes(0);
        }
        $res['phone'] = $phone;
        //是否超过用户刷卡次数并计数
        if ($account->chance_count == 0) {
            return View::make('mobile.no_gift')->withRes(1);
        }
        $account->decrement('chance_count');
        $res['time'] = $account->chance_count;
        //是否超过当周抽奖次数
        if (Conf::isOverWeekTimes()) {
            $res['prize'] = '本周奖品已送完';
            return View::make('mobile.egg')->withRes($res);
        }
        //随机抽奖 
        $gift = Gift::Lottery();
        if (!$gift) {
            $res['prize'] = '没中奖';
            return View::make('mobile.egg')->withRes($res);
        }

        //更新本周奖品数并最后检查并发 
        $isLast = FALSE;
        DB::transaction(function()use($gift, $account, &$isLast) {
            if (!Conf::isOverWeekTimes()) {
                $weekTimes = Conf::where('param', '=', 'week');
                $weekTimes->decrement('val2');
                //添加用户中奖记录
                WinnerLog::NewLog($gift, $account);
                //用户中奖计数
                $account->increment('win_count');
            } else {
                $isLast = true;
            }
        });
        if ($isLast) {
            $res['prize'] = '本周奖品已送完';
            return View::make('mobile.egg')->withRes($res);
        } else {
            $res['prize'] = $gift->name;
            $res['win'] = 1;
            return View::make('mobile.egg')->withRes($res);
        }
    }

    
    /**
     * 并发检查
     */
    public function test() {
        $model = Conf::where('param', '=', 'week')->lockForUpdate()->first();
        $model->val2 = 1;
        $model->save();

        $postUrl = 'localhost/lotter/mobile/scratch';
        $post_data['phone'] = '110';
        $o = "";
        foreach ($post_data as $k => $v) {
            $o.= "$k=" . urlencode($v) . "&";
        }
        $curlPost[] = substr($o, 0, -1);

        $post_data2['phone'] = '112';
        $o2 = "";
        foreach ($post_data2 as $k => $v) {
            $o2.= "$k=" . urlencode($v) . "&";
        }
        $curlPost[] = substr($o2, 0, -1);

        $mh = curl_multi_init(); //多线程
        for ($i = 0; $i < 2; $i++) {
            $ch[$i] = curl_init(); //初始化curl
            curl_setopt($ch[$i], CURLOPT_URL, $postUrl); //抓取指定网页
            curl_setopt($ch[$i], CURLOPT_HEADER, 0); //设置header
            curl_setopt($ch[$i], CURLOPT_RETURNTRANSFER, 1); //要求结果为字符串且输出到屏幕上
            curl_setopt($ch[$i], CURLOPT_POST, 1); //post提交方式
            curl_setopt($ch[$i], CURLOPT_POSTFIELDS, $curlPost[$i]);
            curl_multi_add_handle($mh, $ch[$i]);
        }
        $active = null;
        do {
            $mrc = curl_multi_exec($mh, $active);
        } while ($active > 0);

        for ($i = 0; $i < 2; $i++) {
            $res[$i] = curl_multi_getcontent($ch[$i]);
            curl_close($ch[$i]);
        }
        curl_multi_close($mh);
        print_r($res);
    }

    public function getMobileScratch() {
        return View::make('mobile.scratch');
    }

    public function getMobileEgg2() {
        return View::make('mobile.egg');
    }

}
