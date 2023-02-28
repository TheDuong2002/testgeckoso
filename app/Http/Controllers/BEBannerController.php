<?php

namespace App\Http\Controllers;

use App\Model\ChildBanner;
use App\Model\PageFooter;
use App\Model\ParentBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BEBannerController extends Controller
{
    public function show_parent_banner(){
        $Tile = 'Quản lý chung banner';
        $data  = ParentBanner::all();
        return view('pages.back_end.banner.index', [
            'pageTitle' => $Tile,
            'data' => $data
        ]);
    }
    public function save_parent_banner(Request $request){
        $banner = new ParentBanner();
        $banner->fill($request->all());
        $banner->save();
        return redirect()->back()->with('msg', 'tạo danh mục thành công. Bạn vui lòng truy cập banner chi tiết để thêm thuộc tính');
    }
    public function updateStatus($id, Request $request){
        $statuUpdate = ParentBanner::select('status')
            ->where('id',$id)
            ->first();

        if($statuUpdate->status == 0){
            $status = 1;
        }else{
            $status = 0;
        }
        ParentBanner::where('id',$id)->update(['status' => $status]);
        return redirect()->back()->with('msg','Đã cập nhật trạng thái');
    }
    public function delete($id, Request $request){
        ParentBanner::destroy($id);
        return redirect()->back()->with('msg','Xóa thành công');
    }

    public function show_banner_detail(Request $request, $id){
        $Tile = 'Chi tiết danh mục banner';
        $parent_baner = ParentBanner::where('id',$id)->first();
           $data = ChildBanner::query('child_banner')->select('child_banner.parent_id as pr_id','child_banner.id as chi_id','child_banner.img_banner_mt','child_banner.img_banner_dt',
           'child_banner.link', 'parent_banner.*')
           ->join('parent_banner', 'parent_banner.id', '=' , 'child_banner.parent_id')
            ->where('child_banner.parent_id', '=' , $id)
           ->get();

        return view('pages.back_end.banner.banner_detail',compact('data','Tile','parent_baner'));
    }

    public function banner_attr_save(Request $request, $id){
        if (!empty($request->file('img_banner_mt'))) {
            //remove old
            $imageName = 'banner_image_mt' . $request->id . '.' . $request->file('img_banner_mt')->getClientOriginalExtension();
            $imagePath = "/uploaded/banner/" . $imageName;
             $request->file('img_banner_mt')->move(public_path('/uploaded/banner/'), $imageName);
            $chirdBanner_mt = basename( '/uploaded/banner/'.$imageName);
        }
        if (!empty($request->file('img_banner_dt'))) {
            //remove old
            $imageName = 'banner_image_dt' . $request->id . '.' . $request->file('img_banner_mt')->getClientOriginalExtension();
            $imagePath = "/uploaded/product/" . $imageName;
            $request->file('img_banner_dt')->move(public_path('/uploaded/banner/'), $imageName);
            $chirdBanner_dt = basename('/uploaded/banner/'. $imageName);
        }
//
        DB::table('child_banner')
            ->where($request->id , '==' ,$id)
            ->insert([
            'img_banner_mt' => $chirdBanner_mt,
            'img_banner_dt' => $chirdBanner_dt,
            'link' => $request->link,
            'parent_id' => $request->parent_id
        ]);
        return redirect()->back()->with('msg', 'thêm thành công');
    }

    public function banner_attr_delete(Request $request, $chi_id){
        ChildBanner::destroy($chi_id);
        return redirect()->back()->with('msg','Xóa thành công');
    }
    public function banner_attr_update($chi_id){
             $banner = ChildBanner::find($chi_id);
        return response()->json($banner);
    }
    public function banner_attr_save_update(Request $request){
        if (!empty($request->file('img_banner_mt'))) {
            //remove old
            $imageName = 'banner_image_mt' . $request->id . '.' . $request->file('img_banner_mt')->getClientOriginalExtension();
            $imagePath = "/uploaded/banner/" . $imageName;
            $request->file('img_banner_mt')->move(public_path('/uploaded/banner/'), $imageName);
            $chirdBanner_mt = basename( '/uploaded/banner/'.$imageName);
        }
        if (!empty($request->file('img_banner_dt'))) {
            //remove old
            $imageName = 'banner_image_dt' . $request->id . '.' . $request->file('img_banner_mt')->getClientOriginalExtension();
            $imagePath = "/uploaded/product/" . $imageName;
            $request->file('img_banner_dt')->move(public_path('/uploaded/banner/'), $imageName);
            $chirdBanner_dt = basename('/uploaded/banner/'. $imageName);
        }
//
        DB::table('child_banner')
            ->where('id' , '==' ,$request->id)
            ->insert([
                'img_banner_mt' => $chirdBanner_mt,
                'img_banner_dt' => $chirdBanner_dt,
                'link' => $request->link,
                'parent_id' => $request->parent_id
            ]);
        return redirect()->back()->with('msg', 'cập nhật thành công');
    }
}
