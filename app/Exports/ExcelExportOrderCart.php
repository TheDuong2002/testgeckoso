<?php

namespace App\Exports;

use App\Model\UserCart;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelExportOrderCart implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'Thời gian đặt hàng', 'Mã đơn hàng','Tên Khách hàng','Số điện thoại', 'Địa chỉ nhận hàng','Ghi chú', 'Câu chúc', 'Tổng tiền hàng',
            'Phí ship', 'Tổng tiền thanh toán', 'Phương thức thanh toán',
            'Trạng thái đơn hàng'
        ];
    }
    public function collection()
    {
     return collect(UserCart::query('user_carts')
         ->select('user_carts.created_at as u_order_date','user_carts.href as u_order_ma', 'users.name as u_name','users.phone as u_phone',
             'user_carts.address as u_order_address','user_carts.note','user_carts.text_wish','user_carts.total_cart','user_carts.total_ship',
             'user_carts.total_price', 'user_carts.payment_by','user_carts.status' )
         ->where('user_carts.deleted' , '===', 0)
         ->where('user_carts.status' , '!=', 'moi_tao')
         ->join('users', 'users.id', '=', 'user_carts.user_id')
         ->get()) ;

    }
}
