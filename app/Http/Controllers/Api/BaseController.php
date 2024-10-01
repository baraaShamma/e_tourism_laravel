<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

class BaseController extends Controller{

    public function sendResponse ($respons,$state="Success",$code="200"){
        return response()->json(['data'=>$respons,'state'=>$state],$code);

    }
}