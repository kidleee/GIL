<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Session;
use think\Request;


class Getinfo extends Controller{
    //权限判断
    public function a_auth(){
        $office = session::get('office');
        echo $office;
    }
    //信息记录插
    public function sms(){
        $time = date("Y-m-d H:i:s");
        $json = input('post.content');
        $iphone = input('post.iphone');
        $json = '车辆距离过近,请发出指令。';
        if(preg_match("/^1[34578]\d{9}$/",$iphone)){
            Db::table('i_sms')
            ->insert([
            'time'=>$time,
            'json'=>$json,
            'iphone'=>$iphone
                ]);
            echo '成功发送';
            
        }else{
            echo '请输入正确手机号';
        }
        
    }
    //信息记录读
    public function r_sms(){
        header('Content-type:text/json');
        $data=Db::table('i_sms')
        ->select();
        echo json_encode($data);
    }
    //历史记录存储
    public function history(){
        $car_info  = session::get('shuju');
        $date = $car_info[0][0]['start_time'];
        //运行情况
        $info = input ('post.info');
        Db::table('i_history')
        ->insert([
            'info' => $info,
            'json' => $car_info,
            'date' => $date,
        ]);
        return;
    }
    //历史纪录读取
    public function r_history(){
        header('Content-type:text/json');
        $arr = Db::table('i_history')
            ->limit(10)
            ->select();
        echo json_encode($arr);
    }
    //添加人员
    public function body(){
        //巡视人员，管理维护人员，数据处理人员，领导
        $number = input('post.number');
        $account = input('post.account');
        $bool1 = Db::table('i_user')
        ->where('account',$account)
        ->find();
        $bool = Db::table('i_user')
        ->where('number',$number)
        ->find();
        $account = null;
        $password = null;
        if($bool == null){
            if($bool1 == null){
            $name = input('post.name');
            $old =  input('post.old');
            $office = input('post.office');
            $account = input('post.account');
            $password = input('post.password');
            $iphone = input('post.iphone');
            Db::table('i_user')
            ->insert([
                'number' => $number,
                'name' => $name,
                'old' => $old,
                'office' => $office,
                'account' => $account,
                'password' => $password,
                'iphone' => $iphone,
            ]);
            echo '插入成功';
            }else{
                echo '该账号已存在，请输入其他账号。';
            }
            
        }else{
            echo '编号已存在，请重新输入。';
        }
    }
    //添加车辆
    public function car(){
        $number = input('post.number');
        $car_name = input('post.carname');
        $weight = input('post.weight');
        $xinghao = input('post.xinghao');
        // $number = 8;
        // $car_name =  1;
        // $weight = 1;
        $bool = Db::table('i_car')
        ->where('number',$number)
        ->find();
        if($bool == null){
            $car_info = array(
                [
                    'number' => $number,
                    'changjia' => $car_name,
                    'zhongliang' => $weight,
                    'xinghao'=>$xinghao,
                ]
            );
       Db::table('i_car')->insert([
            'number' => $number,
            'changjia' => $car_name,
            'zhongliang' => $weight,
            'xinghao'=>$xinghao,
        ]);
            echo "车辆添加成功";
        }else{
            echo '该编号已存在，请重新输入。';
        }
    }
    //人员登录
    public function login(){
        $account = input('post.account');
        $password = input('post.password');
        $office = input('post.office');
        // $account = 'l123456';
        // $password = 'l123456';
        // $office = '巡视人';
        $bool = Db::table('i_user')
                ->where('account',$account)
                ->find();
        if($bool == null){
            echo '账号不存在，请寻找管理员注册账号。';
        }else{
            if($password == $bool['password']){
                if($office == $bool['office']){
                    session::set('office',$office);
                    if($office == '巡视人员'){echo '巡视人员';}
                    if($office == '管理维护人员'){echo '管理维护人员';}
                    if($office == '数据处理人员'){echo '数据处理人员';}
                    if($office == '领导'){echo '领导';}        
                }else{
                    echo '请选择正确的职位登录';
                }
                
            }else{
                echo '密码不正确,请重新输入';
            }
        }
    }

    //数据读取
    public function car_history(){
        $car_history = Db::table('i_history')
                ->select();
        $json = json_encode($car_history);
        return $json;
    }
    //用于回放的数据读取
    public function car_history_back(){
        $number = input('post.number');
        $car_history = Db::table('i_history')
              ->where('number',$number)
              ->value('json');
        echo $car_history;
    }
    //人员读取
    public function personnel(){
        header('Content-type:text/json');
        $personnel = Db::table('i_user')
          ->select();
        echo json_encode($personnel);
    }
    //车辆读取
    public function car_info(){
        //分别标识为 changjia、zhongliang、number
        header('Content-type:text/json');
        $car_info = Db::table('i_car')
           ->select();
        $json = json_encode($car_info);
        return $json;
    }
    //历史记录删除
    public function d_history(){
        $id = input("post.id");
        Db::table('i_history')
        ->where('id',$id)
        ->delete();
        return;
    }
    //不知道是啥
    public function s_history(){
        $id = input("post.id");
        session::set('id',$id);
    }
    //取数据
    public function q_history(){
        //$id = input("post.id");
        header('Content-type:text/json');
        $id = session::get('id');
        $data = Db::table("i_history")
        ->where('id',$id)
        ->value("json");
        echo $data;
    }
    public function q_history1(){
        //$id = input("post.id");
        header('Content-type:text/json');
        $id = session::get('id');
        $data = Db::table("i_history")
        ->where('id',$id)
        ->value("number");
        echo $data;
    }
}