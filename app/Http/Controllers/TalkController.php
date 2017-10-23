<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\BaseController;

class TalkController extends BaseController
{
    //对我说
    function talkMe(){
    	
    	  return view('talk.talkMe');
    }



    //获取平台有话说角色接口
    function getLginInfo(){
        $info=session('user');
        if($info){
            return response()->json(['uid'=>$info->uid,'token'=>$info->imtoken]);
        }else{
            return response()->json(array());
        }

    }


}
