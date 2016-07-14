<?php

use Laracasts\Presenter\PresentableTrait;

class Account extends \Eloquent {

    public $timestamps = false;

    public static function isOverTodayTimes($id) {
        if (Cache::has($id)) {
            //是否超过10次限制
            if (Cache::get($id) >= 10) {
                return true;
            } else {
                Cache::increment($id);
                return false;
            }
        } else {
            //创建一个，过期时间设置为第二天0点
            $expiresAt = Carbon::tomorrow();
            Cache::put($id, 1, $expiresAt);
            return false;
        }
    } 
    
    public static function surplus($id) {
        if (Cache::has($id)) {
            return 10 - Cache::get($id);
        } else {
            return 9;
        }
    } 
}
