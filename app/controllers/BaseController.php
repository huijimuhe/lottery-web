<?php

use jimu\Auth\Guard;

class BaseController extends Controller {
 
    public function __construct() {
       
        // csrf check for every post request
        //$this->beforeFilter('csrf', ['on' => 'post']); 
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout() {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
        View::share('currentUser', Auth::user());
    }

}
