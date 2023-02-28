<?php

namespace App\Http\Controllers;

use App\Model\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BEUserCategoryController extends Controller
{
    public function index()
    {
        $page_title = "Các nhóm khách hàng";
        $data = UserCategory::where('parent_id', 0)->where('deleted', 0)->get();
        return view('pages/back_end/clients/category', [
            'data' => $data,
            'page_title' => $page_title
        ]);
    }

    public function save(Request $request)
    {
        $slug = Str::slug($request->title);
        UserCategory::insert([
            'title' => $request->title,
            'slug' => $slug
        ]);
        return redirect()->back();
    }
    public function delete(Request $request)
    {
        $deleteIten = UserCategory::select('*')->where('id', $request->item_id)->first();
        $deleteIten->delete();

    }

    public function add_sub(Request $request)
    {
        $slug = Str::slug($request->title);
        UserCategory::insert([
            'title' => $request->title,
            'slug' => $slug,
            'parent_id' => $request->id_item
        ]);
    }

    public function update(Request $request)
    {
        $data = UserCategory::where('id', '=', $request->id_item)->first();
        $slug = Str::slug($request->title);
        $data->title = $request->title;
        $data->slug = $slug;
        $data->save();
    }

    public function delete_sub(Request $request){
        $deleteIten = UserCategory::select('*')->where('id', $request->id_item)->first();
        $deleteIten->delete();

        return response()->json([
            'data' => $deleteIten
        ]);
    }

    public function update_sub(Request $request){
        $data = UserCategory::where('id', '=', $request->id_item)->first();
        $slug = Str::slug($request->title);
        $data->title = $request->title;
        $data->slug = $slug;
        $data->save();
    }


}
