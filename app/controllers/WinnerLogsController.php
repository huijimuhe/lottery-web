<?php

use huijimuhe\Repo\WinnerLogRepository;

class WinnerLogsController extends BaseController {

    protected $winnerLogRepo;

    public function __construct(WinnerLogRepository $repo) {
        parent::__construct();
        $this->winnerLogRepo = $repo;
    }

    public function index() {
        $logs = $this->winnerLogRepo->getAllPaginated(50);
        return View::make('winnerLogs.index', compact('logs'));
    }

    public function getListOfAccount($id) {
        $winnerLogs = $this->winnerLogRepo->getWinnerLogOfAccountByPaginated($id, 50);
        return View::make('winnerLogs.index', compact('winnerLogs', 'id'));
    }

}
