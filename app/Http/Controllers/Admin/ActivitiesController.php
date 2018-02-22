<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
use QRCode;
use QR_Code\Types\QR_Url;
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
        ->editColumn('activity_url', function($rec){
            $str ='<a href="'.url("admin/QRCODE/".$rec->code).'">'.url("admin/QRCODE/".$rec->code).'</a>';
            return $str;
        })
        ->addColumn('qr_code', function($rec){
            // $urlgen = str_replace("http://","",$rec->activity_url);
            return '<img src="'.url('admin/gen_qr_code').'?url='.url("admin/Activities/".$rec->code).'" width="150px" height="150px">';
        })
        ->addColumn('action',function($rec){
            $str='
                <button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-primary btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$rec->activity_id.'" title="จัดการคําถาม">
                    <i class="ace-icon fa fa-key bigger-120"></i>
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

    public function gen_qr_code(Request $request){
        $url_real = $request->input('url');
        $url = new QR_Url($url_real);
        $url->setSize(8)->setMargin(2)->png();
    }
    public function QRCODE($code)
    {
        return view('Admin.qr_code');
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
                \App\Models\Guest::insert($data_insert);
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

}
