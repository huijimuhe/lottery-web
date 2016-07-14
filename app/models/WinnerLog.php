<?php

class WinnerLog extends \Eloquent {

    protected $fillable = ['account_id', 'phone', 'name', 'gift_id'];

    public static function NewLog($gift, $account) {
        $log = new WinnerLog();
        $log->account_id = $account->id;
        $log->phone = $account->phone;
        $log->name = $account->name;
        $log->gift_id = $gift->id;
        $log->save();
    }

    public function account() {
        return $this->belongsTo('Account');
    }

    public function gift() {
        return $this->belongsTo('Gift');
    }

}
