<?php

use Account,
    Cache;

class Lottery {

    /**
     *  引入参数$data[] = ['id' => $gift->id, 'name' => $gift->name, 'rate' => $gift->rate];
     */
    function xRand($arr) {
        $r = rand(1, 1000);
        $k = 0;
        foreach ($arr as $key => $v) {
            $k+=$v['rate'];
            if ($r <= $k) {
                return $key;
            }
        }
    }

    function get_rand($data) {
        // 计算总概率精度
        $rand_num_max = 0;
        foreach ($data as $k => $v) {
            $rand_num_max += $v['rate'];
        }

        // 初始化随机数，奖品区间
        $rand_num = mt_rand(1, $rand_num_max);
        $left_interval = 0;
        $right_interval = 0;
        $last_right_interval = 0;

        foreach ($data as $k => $v) {
            // 左区间
            $left_interval = $last_right_interval;
            // 右区间
            $right_interval = $left_interval + $v['rate'];
            // 上一个右区间
            $last_right_interval = $right_interval;
            // 判断随机数是否落在对应的区间
            if ($left_interval < $rand_num && $rand_num <= $right_interval) {
                return $k;
            }
        }
    }

}
