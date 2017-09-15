<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Base\BaseController;
use App\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploaderController extends BaseController
{
    //上传图片
    function uploadImg(Request $request){
        $file=$request->file('file');
        if ($file->isValid()){
            //文件类型
            $file_types=["image/jpeg","image/png"];
            $file_type=$file->getMimeType();
            if (!in_array($file_type,$file_types)){
                return response()->json(['error'=>'只支持jpeg,png']);
            }
            //文件大小
            $file_size=$file->getSize();
            if($file_size>1024*1024*2){
                return response()->json(['error'=>'图片小于2M']);
            }
            //按天存储
            $path='upload'.'/'.date('Y-m-d');
            $path=$file->store($path);

            //存储文件信息
            $UploadFile=UploadFile::create([
                'uid'=>session('user')->uid,
                'file_path'=>$path,
                'original_name'=>$file->getClientOriginalName(),
            ]);


            return response()->json(['url'=>Storage::url($path),'id'=>$UploadFile->id,'status'=>200]);

            //
        }


    }

    //上传视频
    function uploadVideo(Request $request){
        $file=$request->file('file');
        if ($file->isValid()){
            //文件类型
            $file_types=["video/mp4"];
            $file_type=$file->getMimeType();
            if (!in_array($file_type,$file_types)){
                return response()->json(['error'=>'只支持mp4','status'=>1]);
            }
            //文件大小
            $file_size=$file->getSize();
            if($file_size>1024*1024*2*10){
                return response()->json(['error'=>'视频小于20M','status'=>2]);
            }
            //按天存储
            $path='upload'.'/'.date('Y-m-d');
            $path=$file->store($path);

            //存储文件信息
            $UploadFile=UploadFile::create([
                'uid'=>session('user')->uid,
                'file_path'=>$path,
                'original_name'=>$file->getClientOriginalName(),
            ]);


            return response()->json(['url'=>Storage::url($path),'id'=>$UploadFile->id,'status'=>200]);

            //
        }


    }
    //删除上传的图片
    function deleteUploadImg(Request $request){
        $id=$request->id;
        if (!isset($id)){
            return response()->json(['error'=>'上传失败缺少参数id']);
        }
        $UploadFile=UploadFile::find($id);
        //删除物理存储文件
        Storage::delete($UploadFile->file_path);
        //删除存储记录
        $UploadFile->delete();
        return response()->json(['status'=>200]);


    }

}
