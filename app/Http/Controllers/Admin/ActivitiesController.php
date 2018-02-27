<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
use QRCode;
use QR_Code\Types\QR_Url;
use View;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['main_menu'] = 'Activities';
        $data['sub_menu'] = 'Activities';
        $data['title_page'] = 'Activities';
        $data['menus'] = \App\Models\AdminMenu::ActiveMenu()->get();
        return view('Admin.activities',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input_all                 = $request->all();
        $input_all['created_at']   = date('Y-m-d H:i:s');
        $input_all['updated_at']   = date('Y-m-d H:i:s');
        $gen_links                 = md5($input_all['activity_name'].date('Y-m-d H:i:s'));
        //$links                     = url('/admin/Activities/'.$gen_links);
        $links                     = $gen_links;
        $input_all['code'] = $links;
        $validator = Validator::make($request->all(), [

        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = $input_all;
                \App\Models\Activities::insert($data_insert);
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'สำเร็จ';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'ไม่สำเร็จ'.$e->getMessage();;
            }
        }else{
            $return['status'] = 0;
        }
        $return['title'] = 'เพิ่มข้อมูล';
        return json_encode($return);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = \App\Models\Activities::find($id);

        return json_encode($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input_all = $request->all();

        $input_all['updated_at'] = date('Y-m-d H:i:s');
        $qrcode = md5($input_all['activity_name'].date('Y-m-d H:i:s'));
        $qrcode = url('/admin/Activities/'.$qrcode);
        $input_all['activity_url'] = $qrcode;
        $validator = Validator::make($request->all(), [

        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = $input_all;
                \App\Models\Activities::where('activity_id',$id)->update($data_insert);
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'สำเร็จ';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'ไม่สำเร็จ'.$e->getMessage();;
            }
        }else{
            $return['status'] = 0;
        }
        $return['title'] = 'เพิ่มข้อมูล';
        return json_encode($return);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::beginTransaction();
        try {
            \App\Models\Activities::where('activity_id',$id)->delete();
            \DB::commit();
            $return['status'] = 1;
            $return['content'] = 'สำเร็จ';
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status'] = 0;
            $return['content'] = 'ไม่สำเร็จ'.$e->getMessage();;
        }
        $return['title'] = 'ลบข่อมูล';
        return $return;
    }

    public function Lists(){
        $result = \App\Models\Activities::select();
        return \Datatables::of($result)
        ->editColumn('status', function($rec){
            $str =($rec->status == 'T')? 'เปิดใช้งาน':'ปิดการใช้งาน';
            return $str;
        })
        ->editColumn('activity_url', function($rec){
            $str ='<a href="'.url("admin/QRCODE/".$rec->code).'">'.url("admin/QRCODE/".$rec->code).'</a>';
            return $str;
        })
        ->addColumn('qr_code', function($rec){
            // $urlgen = str_replace("http://","",$rec->activity_url);
            //return '<img src="'.url('admin/gen_qr_code').'?url='.url("admin/Activities/".$rec->code).'" width="150px" height="150px">';
            return \QrCode::size(100)->generate(url("admin/QRCODE/".$rec->code));
        })
        ->addColumn('action',function($rec){
            $str='
                <button class="btn btn-xs btn-primary btn-condensed btn-add-question btn-tooltip" data-id="'.$rec->activity_id.'" data-rel="tooltip" title="" data-original-title="เพิ่มคำตอบ">
                    <i class="ace-icon fa fa-plus-square bigger-120"></i>
                </button>
                <button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-warning btn-condensed btn-reward btn-tooltip" data-rel="tooltip" data-id="'.$rec->activity_id.'" title="จัดการของรางวัล">
                    <i class="ace-icon fa fa-key bigger-120"></i>
                </button>
                <button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-info btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$rec->activity_id.'" title="จัดการผู้ใช้งาน">
                    <i class="ace-icon fa fa-key bigger-120"></i>
                </button>
                <button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-warning btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$rec->activity_id.'" title="แก้ไข">
                    <i class="ace-icon fa fa-edit bigger-120"></i>
                </button>
                <button  class="btn btn-xs btn-danger btn-condensed btn-delete btn-tooltip" data-id="'.$rec->activity_id.'" data-rel="tooltip" title="ลบ">
                     <i class="ace-icon fa fa-trash bigger-120"></i>
                </button>
            ';
            return $str;
        })
        ->rawColumns(['activity_url','qr_code', 'action'])
        ->make(true);
    }
    public function RewardLists() {
        $result = \App\Models\Reward::select();
        return \Datatables::of($result)
        ->addColumn('reward',function($rec) {
            $str = '<input class="checkbox" type="checkbox" name="reward_id[]" value="'.$rec->id.'">';
            return $str;
        })
        ->addColumn('action',function($rec){
            $str='
                <input class="checkbox" type="checkbox" name="status_t[]" value="T">
                <label for="add_show">
                    true
                </label>
                <input class="checkbox" type="checkbox" name="status_f[]" value="F">
                <label for="add_show">
                    false
                </label>
            ';
            return $str;
        })
        ->rawColumns(['reward', 'action'])
        ->make(true);
    }
    public function RewardAccept(Request $request) {
        $input_all = $request->all();
        $input_all['created_at'] = date('Y-m-d H:i:s');

        // $validator = Validator::make($request->all(), [
        //
        // ]);
        // if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $reward_t = array();
                $reward_f = array();
                foreach ($request->reward_id as $key => $value) {
                    if(!empty($request->status_t[$key])) {
                        $reward_t[] = $value;
                    }
                    if(!empty($request->status_f[$key])) {
                        $reward_f[] = $value;
                    }
                }
                // return $reward_t;
                unset($input_all['status_f']);
                unset($input_all['status_t']);
                unset($input_all['RewardList_length']);
                \App\Models\ActivityReward::where('activity_id',$request->activity_id)->delete();
                if(sizeof($reward_t)!=0) {
                    $reward_t = json_encode($reward_t);
                    $input_all['reward_id'] = $reward_t;
                    $input_all['status'] = 'T';
                    $data_insert = $input_all;
                    \App\Models\ActivityReward::insert($data_insert);
                }
                if(sizeof($reward_f)!=0) {
                    $reward_f = json_encode($reward_f);
                    $input_all['reward_id'] = $reward_f;
                    $input_all['status'] = 'F';
                    $data_insert = $input_all;
                    \App\Models\ActivityReward::insert($data_insert);
                }
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'สำเร็จ';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'ไม่สำเร็จ'.$e->getMessage();;
            }
        // }else{
        //     $return['status'] = 0;
        // }
        $return['title'] = 'เพิ่มข้อมูล';
        return json_encode($return);
    }
    public function getReward($id)
    {
        $all = \App\Models\ActivityReward::where('activity_id',$id)->get();
        foreach ($all as $key => $value) {
            $result[$value->status] = json_decode($value->reward_id);
        }
        return json_encode($result);
    }
    public function gen_qr_code(Request $request){
        $url_real = $request->input('url');
        $url = new QR_Url($url_real);
        $url->setSize(8)->setMargin(2)->png();
    }
    public function QRCODE($code)
    {
        $return['activity'] = \App\Models\Activities::where('code',$code)->first();
        return View::make('Admin.qr_code',$return);
    }
    public function StoreQRCODE(Request $request)
    {
        // $input_all                 = $request->all();
        $input_all['phone']   = $request->phone;
        $input_all['created_at']   = date('Y-m-d H:i:s');
        $input_all['updated_at']   = date('Y-m-d H:i:s');
        $validator = Validator::make($request->all(), [

        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = $input_all;
                $return['user_id'] = \App\Models\Guest::insertGetId($data_insert);
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'สำเร็จ';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'ไม่สำเร็จ'.$e->getMessage();;
            }
        }else{
            $return['status'] = 0;
        }
        $return['title'] = 'เพิ่มข้อมูล';
        return json_encode($return);
    }
    public function getQuestion($code,$userid){
        $return['userid'] = $userid;
        $return['code'] = $code;
        $activity = \App\Models\Activities::where('code',$code)->first();
        $question_group_id = json_decode(\App\Models\ActivityQuestion::where('activity_id',$activity->activity_id)->first()->question_group_id);
        $return['activity'] = $activity;
        $test =[];
        $limit_question = 3;
        for($i=0;$i<$limit_question;$i++) {
            if(sizeof($question_group_id)!=0) {
                $test[$i] = \App\Models\Question::with('Answer')->whereIn('id',$question_group_id)->orderBy(\DB::raw('rand()'))->limit(1)->get()[0];
                foreach ($question_group_id as $key => $value) {
                    if($value == $test[$i]['id']) {
                        unset($question_group_id[$key]);
                    }
                }
            }
        }
        $return['question'] = $test;
        // return $return['question'];
        return View::make('Admin.randomQuestion',$return);
    }

    public static function checkResult($question_id,$answer_id){
        return \App\Models\AnswerRight::where([
            'question_id' => $question_id,
            'answer_id' => $answer_id,
        ])->count();
    }
    public function storeHistory(Request $request){
        $input_all = $request->all();
        unset($input_all['_token']);
        unset($input_all['activity_id']);
        unset($input_all['user_id']);

        $result = 0; $qtyQustion = 0;
        foreach($input_all as $ia){
            $str = explode('|',$ia);
            $data_insert[] = array(
                'activity_id' => $request->activity_id,
                'user_id' => $request->user_id,
                'question_id' => $str[0],
                'answer_id' => $str[1],
                'result' => $this->checkResult($str[0],$str[1]),
                'created_at' => date('Y-m-d H:i:s')
            );
            $qtyQustion++;
            $result += $this->checkResult($str[0],$str[1]);
        }
        $validator = Validator::make($request->all(), []);

        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                if(\App\Models\AnswerHistory::insert($data_insert)){
                    \DB::commit();
                    $return['status'] = 1;
                    $return['content'] = 'สำเร็จ';
                }else{
                    throw new $e;
                }
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'ไม่สำเร็จ'.$e->getMessage();;
            }
        }else{
            $return['status'] = 0;
        }

        $return['title'] = 'เพิ่มข้อมูล';

        $returns['activity_id'] = $request->activity_id;
        $returns['user_id'] = $request->user_id;
        $returns['result'] = $result/$qtyQustion;
        $string = $returns['activity_id'].'/'.$returns['user_id'].'/'.$returns['result'];

        $return['code'] = base64_encode($string);

        return json_encode($return);
    }

    public function randomReward($code){
        $str = base64_decode($code);
        $str = explode('/',$str);
        $activity_id=$str[0];$user_id=$str[1];$result=$str[2];

        $listReward = \App\Models\ActivityReward::where([
            'activity_id' => $activity_id,
            'status' => $result>0?'T':'F'
        ])->first()->reward_id;
        $listReward = json_decode($listReward);
        $randomReward = \App\Models\Reward::where('amount','<>',0)->whereIn('id',$listReward)->with('getRewardPicture')->orderBy(\DB::raw('rand()'))->limit(1)->get()->first();
        $return['reward'] = $randomReward;

        \App\Models\ActivityRewardUser::insert([
            'activity_id'=>$activity_id,
            'reward_id'=>$user_id,
            'user_id'=>$randomReward->id,
            'created_at'=>date('Y-m-d H:i:s')
        ]);

        return View::make('Admin.randomReward',$return);
    }

    public function AddQuestion(Request $request, $id) {
        $question = $request->question_group_id;
        $question_group_id = array();
        foreach ($question as $k => $v) {
            $question_group_id[$k] = $v;
        }
        $input_all['question_group_id'] = json_encode($question_group_id);
        $input_all['created_at']   = date('Y-m-d H:i:s');
        $input_all['status']   = 'T';
        $input_all['activity_id']   = $id;
        $validator = Validator::make($request->all(), [

        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = $input_all;
                \App\Models\ActivityQuestion::where('activity_id',$id)->delete();
                \App\Models\ActivityQuestion::insert($data_insert);
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'สำเร็จ';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'ไม่สำเร็จ'.$e->getMessage();;
            }
        }else{
            $return['status'] = 0;
        }
        $return['title'] = 'เพิ่มข้อมูล';
        return json_encode($return);
    }

    public function getActivityQuestion($id) {
        $all = \App\Models\ActivityQuestion::where('activity_id',$id)->get();
        foreach ($all as $key => $value) {
            $result[$key] = json_decode($value->question_group_id);
        }
        return json_encode($result);
    }
}
