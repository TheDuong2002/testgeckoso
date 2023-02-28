<?php

namespace App\Http\Controllers;

use App\Model\PageFooter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BEPageFooterCotroller extends Controller
{
    public function index()
    {
        $Tile = 'Danh sách các chính sách';
        $data =  PageFooter::select('*')->get();
        return view('pages.back_end.page_footer.index', [
            'pageTitle' => $Tile,
            'data' => $data
        ]);
    }

    public function add()
    {
        return view('pages.back_end.page_footer.add');
    }

    public function save(Request $request){
        $data = new PageFooter();
        $slug = Str::slug($request->tile);
        $latestSlug = PageFooter::whereRaw("href REGEXP '^{$slug}(-[0-9]+)?$'")
            ->latest('id')
            ->value('href');
        if ($latestSlug) {
            $parts = explode('-', $latestSlug);
            $number = intval(end($parts)) + 1;
            $slug = "{$slug}-{$number}";
        }
        $data->fill([
            'tile' => $request->tile,
            'href' => $slug,
            'status' => $request->status,
            'body' => $request->body
        ]) ;
        $data->save();

        return redirect(url('/admin/page-footer'))->with('msg','Thêm thành công');
    }

    public function delete($id, Request $request){
        PageFooter::destroy($id);
        return redirect()->back()->with('msg','Xóa thành công');
    }

    public function updateStatus($id, Request $request){
        $statuUpdate = PageFooter::select('status')
            ->where('id',$id)
            ->first();

        if($statuUpdate->status == 0){
            $status = 1;
        }else{
            $status = 0;
        }
        PageFooter::where('id',$id)->update(['status' => $status]);
        return redirect()->back()->with('msg','Đã cập nhật trạng thái');
    }

    public function edit($id, Request $request){
        $data = PageFooter::find($id);
        return view('pages.back_end.page_footer.edit', [
            'data' => $data,
        ]);
    }

    public function saveUpate($id, Request $request){
        $data = PageFooter::find($id);
        $data->fill($request->all());
        $data->save();
        return redirect(url('/admin/page-footer'))->with('msg','Cập nhật thành công');
    }
}
