<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function index()
    {
        // Optional Data
        $data=[];
        for($i=0;$i<=100;$i++)
        {
            $data[]='Name '.$i;
        }

        // Optional Breadcumb
        $breadcumb=[];
        $breadcumb[]=[
            'name'=>'Homepage',
            'link'=> route('core.account.dashboard')
        ];
        $breadcumb[] = [
            'name' => 'Example Page',
            'link' => '#'
        ];

        // Optional Data Header

        return zeus_view('example',[
            'title'=>'Example Title',
            'breadcrumb'=>$breadcumb,
            'keyword'=>'This is Keyword'
        ],compact('data'));
    }

}