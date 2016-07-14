<?php

use huijimuhe\Repo\GiftRepository,
    huijimuhe\Core\Listeners\CreatorListener,
    huijimuhe\Core\Listeners\UpdaterListener,
    huijimuhe\Core\Listeners\DeleterListener;

class GiftsController extends BaseController implements CreatorListener, DeleterListener, UpdaterListener {

    protected $giftRepo;

    public function __construct(GiftRepository $repo) {
        parent::__construct();
        $this->giftRepo = $repo;
    }

    public function getTestRate() {
        $gifts = Gift::all();
        foreach ($gifts as $gift) {
            $data[] = ['id' => $gift->id, 'name' => $gift->name, 'rate' => $gift->rate];
             $bingo_test[] = 0;
        }
        
        // 中奖概率测试 
        $lottery_count = 10000;
        $i = 0;

        while ($i++ < $lottery_count) {
            $bingo_index = $this->xRand($data);
            if (isset($bingo_index))
                $bingo_test[$bingo_index] ++;
        }

        foreach ($bingo_test as $k => $v) {
            echo $data[$k]['name'], '中奖几率：', ($v / $lottery_count) * 100, '%<br />';
        }
    }

    function xRand($arr) {
        $baseRate = Conf::where('param', '=', 'base_rate')->first();
        $r = rand(1, $baseRate->val);
        $k = 0;
        foreach ($arr as $key => $v) {
            $k+=$v['rate'];
            if ($r <= $k) {
                return $key;
            }
        }
    } 

    public function index() {
        $gifts = $this->giftRepo->getAllPaginated(50);
        return View::make('gifts.index', compact('gifts'));
    }

    public function create() {
        return View::make('gifts.create_edit');
    }

    public function store() {

        $data = [
            'name' => Input::get('name'),
            'grade' => Input::get('grade'),
            'rate' => Input::get('rate'),
        ];

        $validator = Validator::make($data, [
                    'name' => 'required',
                    'grade' => 'required|numeric',
                    'rate' => 'required|numeric',
        ]);
        return $this->giftRepo->create($this, $data, $validator);
    }

    public function edit($id) {
        //
        $model = $this->giftRepo->requireById($id);
        return View::make('gifts.create_edit')->with('gift', $model);
    }

    public function update($id) {
        $model = $this->giftRepo->requireById($id);

        $data = [
            'name' => Input::get('name'),
            'grade' => Input::get('grade'),
            'rate' => Input::get('rate'),
        ];

        $validator = Validator::make($data, [
                    'name' => 'required',
                    'grade' => 'required|numeric',
                    'rate' => 'required|numeric'
        ]);

        return $this->giftRepo->update($this, $model, $data, $validator);
    }

    public function destroy($id) {
        $model = $this->giftRepo->requireById($id);
        return $this->giftRepo->deleteModel($this, $model);
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
