<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FEErrorController extends Controller
{
    public function invalid()
    {
        die('Trang nay không tồn tại.');
    }
}
