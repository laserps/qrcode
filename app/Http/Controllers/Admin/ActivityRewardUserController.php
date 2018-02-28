<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
use QRCode;
class ActivityRewardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['main_menu'] = 'ActivityRewardUser';
        $data['sub_menu'] = 'ActivityRewardUser';
        $data['title_page'] = 'ActivityRewardUser';
        $data['menus'] = \App\Models\AdminMenu::ActiveMenu()->get();

        return view('Admin.activity_reward_user',$data);
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

        $validator = Validator::make($request->all(), [

        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = $input_all;
                \App\Models\ActivityRewardUser::insert($data_insert);
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
        $result = \App\Models\ActivityRewardUser::find($id);

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

        $validator = Validator::make($request->all(), [

        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = $input_all;
                \App\Models\ActivityRewardUser::where('id',$id)->update($data_insert);
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
            \App\Models\ActivityRewardUser::where('id',$id)->delete();
            \DB::commit();
            $return['status'] = 1;
            $return['content'] = 'สำเร็จ';
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status'] = 0;
            $return['content'] = 'ไม่สำรเ็จ'.$e->getMessage();
        }
        $return['title'] = 'ลบข่อมูล';
        return $return;
    }

    public function Lists(){
        $result = \App\Models\ActivityRewardUser::leftjoin('users','activity_reward_user.user_id','=','users.id')
        ->leftjoin('reward','activity_reward_user.reward_id','=','reward.id')
        ->leftjoin('activity','activity_reward_user.activity_id','=','activity.activity_id')
        ->leftjoin('admin_users','activity_reward_user.staff_id','=','admin_users.id')
        ->select('activity_reward_user.*','users.firstname','users.lastname','reward.name','activity.activity_name','admin_users.firstname as staff_firstname','admin_users.lastname as staff_lastname');
        return \Datatables::of($result)
        ->editColumn('user_id', function($rec) {
            return $rec->firstname.' '.$rec->lastname;
        })
        ->editColumn('staff_id', function($rec) {
            return $rec->staff_firstname.' '.$rec->staff_lastname;
        })
        ->editColumn('activity_id', function($rec) {
            return $rec->activity_name;
        })
        ->editColumn('reward_id', function($rec) {
            return $rec->name;
        })
        ->addColumn('url',function($rec){
            return '<a href="'.url("ActivityRewardUser/accept/".base64_encode($rec->id.'/'.$rec->reward_id)).'">'.url("ActivityRewardUser/accept/".base64_encode($rec->id.'/'.$rec->reward_id)).'</a>';

        })
        ->addColumn('qrcode',function($rec){
            return \QrCode::size(100)->generate(url("ActivityRewardUser/accept/".base64_encode($rec->id.'/'.$rec->reward_id)));
        })
        ->addColumn('action',function($rec){
            $str = '';
            if($rec->staff_id==null) {
                $str='
                    <!--<button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-warning btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$rec->id.'" title="แก้ไข">
                        <i class="ace-icon fa fa-edit bigger-120"></i>
                    </button> -->
                    <button  class="btn btn-xs btn-danger btn-condensed btn-delete btn-tooltip" data-id="'.$rec->id.'" data-rel="tooltip" title="ลบ">
                        <i class="ace-icon fa fa-trash bigger-120"></i>
                    </button>
                ';
            }
            return $str;
        })
        ->rawColumns(['url', 'qrcode', 'action'])
        ->make(true);
    }
    public function acceptRewardUser($id) {
        $encode = base64_decode($id);
        $val = explode('/',$encode);
        $check = \App\Models\ActivityRewardUser::where('id',$val[0])->where('staff_id',NULL)->first();
        if($check) {
            $staff = \App\Models\ActivityStaff::where('activity_id',$check->activity_id)->first();
            if (in_array(\Auth::guard('admin')->user()->id, json_decode($staff->staff_id))) {
                \App\Models\ActivityRewardUser::where('id',$val[0])->update([
                    'updated_at' => date('Y-m-d H:i:s'),
                    'staff_id' =>\Auth::guard('admin')->user()->id,
                ]);
                $get_reward_balance = \App\Models\Reward::find($val[1])->amount;
                \App\Models\Reward::where('id',$val[1])->update([
                    'updated_at' => date('Y-m-d H:i:s'),
                    'amount' => --$get_reward_balance,
                ]);
            }
        }
        return redirect('admin/ActivityRewardUser');
    }
}
