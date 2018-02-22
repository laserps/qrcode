<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
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
        $input_all = $request->all();
        $input_all['created_at'] = date('Y-m-d H:i:s');
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
                \App\Models\Activities::insert($data_insert);
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'สำเร็จ';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'ไม่สำรเ็จ'.$e->getMessage();;
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
                $return['content'] = 'ไม่สำรเ็จ'.$e->getMessage();;
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
            $return['content'] = 'ไม่สำรเ็จ'.$e->getMessage();;
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
        ->addColumn('qr_code', function($rec){
            $str = 'QR CODE';
            return $str;
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
        })->make(true);
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

        $validator = Validator::make($request->all(), [

        ]);
        if (!$validator->fails()) {
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
                $return['content'] = 'ไม่สำรเ็จ'.$e->getMessage();;
            }
        }else{
            $return['status'] = 0;
        }
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
}
