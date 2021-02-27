<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Request;

class Add extends Controller
{
    //显示
    public function show_show()
    {
        $arr=Db::table('brand')->select();
        return  view('add',['arr'=>$arr]);

    }

   //展示
    public function show_do()
    {
        $arr=Db::table('s_sore')->paginate(10);;
//        dump($arr);die();
        return   view('show',['arr'=>$arr]);


    }

    /**
     * 添加
     */
    public function add_do(Request $request)
    {
        // 获取表单上传文件
            $files = request()->file('image');
//return  $files;
  foreach($files as $file){
      // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
      if($info){
          $img_name=$info->getFilename();
//          Db::table('image')->insert($img_name);
          return [
              'code'=>200,
              'msg'=>'上传成功',
              'data'=>$img_name
          ];

//          return
      }else{
    // 上传失败获取错误信息
            return [
              'code'=>500,
              'msg'=>'上传失败',
              'data'=>$file->getError()
            ];
       }
    }

    }


}
