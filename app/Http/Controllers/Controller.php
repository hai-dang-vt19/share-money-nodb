<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(Request $request){
        if(empty($request->all()) or $request->total == null){
            return view('welcome');
        }
        $dt['data'] = $request->all();
        
        $count = $request->inp_qlty_num;
        // dd($request->all());
        // return $dt;
        return view('welcome', compact('count'), $dt);
    }
}
