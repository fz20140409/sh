<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TalkController extends Controller
{
    //对我说
    function talkMe(){
    	
    	  return view('talk.talkMe');
    }
}
