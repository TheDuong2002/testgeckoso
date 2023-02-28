<?php

namespace App\Exports;

use App\Model\UserCart;
use App\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelExportsUserCart implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'name', 'phone', 'email', 'date order new'
        ];
    }
    public function collection()
    {
   return   collect(UserCart::select('users.name', 'users.phone', 'users.email', DB::raw('min(user_carts.created_at) as latest_cart'))
          ->where('user_carts.deleted' ,'===', 0 )
          ->where('users.deleted' ,'===', 0 )
          ->where('user_carts.status' , '!=', 'moi_tao')
          ->join('users', 'user_carts.user_id', '=', 'users.id')
          ->groupBy( 'users.name', 'users.phone', 'users.email')
          ->get()) ;


    }
}
