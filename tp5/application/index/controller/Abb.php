<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Session;
use think\Request;

class Abb extends Controller{ 
    public function suiji()
    {
        //先随机生成400组数据 然后拼接 最后到数据库
    }


    //正常运行的系统
    public function suijishengcheng(){
      $arrc = array('number'=>'1','name'=>'nick');
      $json1 = json_encode($arrc);
      Db::table('i_history')
       ->insert(['number'=>'1','json'=>$json1]);  
      for($i=0;$i<10;$i++){
          $json = Db::table('i_history')
          ->where('number','1')
          ->find('json');
          $arr = array(['number'=>$i,'name'=>$i]);
          $arrcm = array_merge($arr,$json);
          $arrcmm = json_encode($arrcm);
          Db::table('i_history')
            ->where('number',1)
            ->update(['json'=>$arrcmm]);
      }
    }
    //用来生成各个小车的运行数据
    public function shishigengxin(){
        $s=0;
        $youliang=75;
        $start_time=$this->time1();;
        $arrc['0']=array(
            'v'=>'0','start_time'=>$start_time,'youliang'=>'75',
            'changjia'=>'红旗','zhongliang'=>'2t','s'=>'0'
        );
        for($i=1;$i<=400;$i++){
            $v=$this->v();
            $s=$s+$this->s();
            $youliang=$youliang-0.02;
            $youliang1=round($youliang,1);
            $zhongliang='2t';
            $changjia='红旗';
            $car_number='1';
            $start_time=$this->time1();
            $arr[$i]=array(
                'v'=>$v,'start_time'=>$start_time,'youliang'=>$youliang1,
                'changjia'=>$changjia,'zhongliang'=>$zhongliang,'s'=>$s
            );
            $json = json_encode($arr);
            echo $json;
            //$arrc=array_merge($arrc,$arr);
        }
        //$json = json_encode($arrc);
        //echo $json;
        //Db::table('i_history')
        //->insert(['number'=>'1','json'=>$shuju]);
    }
    public function v($name){
		$json = session::get("json");
		$arr = json_decode($json,true);
		$arr1 = end($arr[$name]); 
        //$arr1["s"]
        if($arr[$name][count($arr[$name])-1]['stopping'] == false)
		{
            if($name == "5")
            {
                $v = rand(10,20);
            }	
            else if($name == "4")
            {
                $v = rand(10,15);
            }	
            else if($name == "3")
            {
                $v = rand(5,10);
            }
            else if($name == "2")
            {
                $v = rand(10,15);
            }
            else if($name == "1")
            {
                $v = rand(10,15);
            }
            else if($name == "0")
            {
                $v = rand(10,15);
            }
        }
        else
        {
            $v = 0;
        }
        return $v;
    }
    public function s($name){
        $json = session::get("json");
        $arr = json_decode($json,true);
        $arr1 = end($arr[$name]); 
        //$arr1["s"]
		if($arr[$name][count($arr[$name])-1]['stopping'] == false)
		{
			if($name == "5")
			{
				$s = $arr1["s"] + rand(30,40)/10;
			}	
			else if($name == "4")
			{
				$s = $arr1["s"] + rand(20,30)/10;
			}	
			else if($name == "3")
			{
				$s = $arr1["s"] + rand(10,20)/10;
			}
			else if($name == "2")
			{
				$s = $arr1["s"] + rand(10,20)/10;
			}
			else if($name == "1")
			{
				$s = $arr1["s"] + rand(10,20)/10;
			}
			else if($name == "0")
			{
				$s = $arr1["s"] + rand(10,20)/10;
			}
		}
		else
		{
			$s = $arr1["s"];
		}	
        return $s;
    }
    public function time1(){
        $start_time = date("Y-m-d H:i:s");
        return $start_time;
    }
    public function youliang(){
        $json = session::get("json");
        $arr = json_decode($json,true);
        $arr1 = end($arr["5"]);
        $s= $arr1["youliang"] - 0.02;
        return $youliang;
    }
   
    // public function jishu(){
    //     $json = session::get("json");
    //     $arr = json_decode($json,true);
    //     $arr1 = end($arr["5"]);
        
    //     //$s= $arr1[""] + 1;
    //     //return $jishu;
    // }
    public function shuzupinjie(){
        // $arr['5']=array(
        //     'v'=>0,'start_time'=>0,'youliang'=>0,
        //     'changjia'=>0,'zhongliang'=>0,'s'=>0,
        // );
        // $json = json_encode($arr);
        // $arr=Db::table('i_history')
        // ->where('number',1)
        // ->update(['json'=>$json]);
        // $arr=Db::table('i_history')
        // ->field('json')
        // ->where('number',1)
        // ->find();
        // $json = json_encode($arr);
        // echo $json;
        //先随机生成400组数据 然后拼接 最后到数据库
        //session::clear();
        $json = session::get("json");
        $arr = json_decode($json,true);
        if(session::get("json"))
        {
			foreach($arr as $name=>$value)
			{
				if($arr[$name][count($arr[$name])-1]['state'] == true)
				{
					$youliang = $arr[$name][count($arr[$name])-1]['youliang'];
					//$s = 0;
					$s=$this->s($name);
					$v=$this->v($name);
					$start_time = $this->time1();
					//$car_number = 5;
					$youliang = $youliang-0.02;
					$changjia = '红旗';
					$zhongliang = '2t';
					$state = $arr[$name][count($arr[$name])-1]['state'];
					$qcheju = $arr[$name][count($arr[$name])-1]['qcheju'];
					$hcheju = $arr[$name][count($arr[$name])-1]['hcheju'];
					$stopping = $arr[$name][count($arr[$name])-1]['stopping'];
					$number = count($arr[$name]);
					$arr[$name][$number]=array(
						'v'=>$v,'starttime'=>$start_time,'youliang'=>$youliang,
						'changjia'=>$changjia,'zhongliang'=>$zhongliang,'s'=>$s,'state'=>$state,'qcheju'=>$qcheju,'hcheju'=>$hcheju,'warning'=>false,'stopping'=>$stopping);
					$json = json_encode($arr);
					session::set("json",$json);    
				}	
			}
        }
        else
        {
            $arr["5"][0]=array(
                'v'=>0,'starttime'=>0,'youliang'=>75,
                'changjia'=>1,'zhongliang'=>1,'s'=>10,'state'=>true,'qcheju'=>null,'hcheju'=>null,'warning'=>false,'stopping'=>false
            );
			$arr["4"][0]=array(
                'v'=>0,'starttime'=>0,'youliang'=>75,
                'changjia'=>1,'zhongliang'=>1,'s'=>200,'state'=>true,'qcheju'=>null,'hcheju'=>null,'warning'=>false,'stopping'=>false
            );
			$arr["3"][0]=array(
                'v'=>0,'starttime'=>0,'youliang'=>75,
                'changjia'=>1,'zhongliang'=>1,'s'=>640,'state'=>true,'qcheju'=>null,'hcheju'=>null,'warning'=>false,'stopping'=>false
            );
			$arr["2"][0]=array(
                'v'=>0,'starttime'=>0,'youliang'=>75,
                'changjia'=>1,'zhongliang'=>1,'s'=>0,'state'=>false,'qcheju'=>null,'hcheju'=>null,'warning'=>false,'stopping'=>false
            );
			$arr["1"][0]=array(
                'v'=>0,'starttime'=>0,'youliang'=>75,
                'changjia'=>1,'zhongliang'=>1,'s'=>0,'state'=>false,'qcheju'=>null,'hcheju'=>null,'warning'=>false,'stopping'=>false
            );
			$arr["0"][0]=array(
                'v'=>0,'starttime'=>0,'youliang'=>75,
                'changjia'=>1,'zhongliang'=>1,'s'=>0,'state'=>false,'qcheju'=>null,'hcheju'=>null,'warning'=>false,'stopping'=>false
			);	
            $json = json_encode($arr);
            session::set("json",$json);  
        }
        // $arr=Db::table('i_history')
        // ->where('number',1)
        // ->find('json');
        
        // $json = json_encode($arr);       
        // Db::table('i_history')
        // ->where('number',1)
        // ->update(['json'=>$json]);
         //}
        // $arr=Db::table('i_history')
        // ->where('number',1)
        // ->find('json');
        echo json_encode($arr);
    }
	
	//车辆出边界自动停止
    public function maxcar()
	{
		$json = session::get("json");
		$key = input('post.key');
		//$key = "5";
		$arr = json_decode($json,true);
		$arr[$key][count($arr[$key])-1]["state"] = false;
		$json = json_encode($arr);
		$start_time = $arr[$key][1]["starttime"];
        $end_time = $arr[$key][count($arr[$key])-1]["starttime"];
        $data1 = Db::table("i_history")
        ->select();
        $id1 = count($data1);
        $id2 = $id1-1;
        $id = $data1[$id2]['id']+1;
		Db::table("i_history")
		->insert([
            'id'=>$id,
			'number'=>$key,
			'start_time'=>$start_time,
			'end_time'=>$end_time,
			'json'=>$json,
		]);
		$arr[$key]=array(0=>array(
                'v'=>0,'starttime'=>0,'youliang'=>75,
                'changjia'=>1,'zhongliang'=>1,'s'=>0,'state'=>false,'qcheju'=>null,'hcheju'=>null,'warning'=>false,'stopping'=>false
            ));
		$json = json_encode($arr);
		session::set("json",$json);
	}
	
	
	public function stopcars()
	{
		$json = session::get("json");
		$key = input('post.key');
		$arr = json_decode($json,true);
		$arr[$key][count($arr[$key])-1]["state"] = false;
		$json = json_encode($arr);
		session::set("json",$json);
	}
	//车辆画布中急停
	public function stopcars1()
	{
		$json = session::get("json");
		$key = input('post.key');
		$arr = json_decode($json,true);
		$arr[$key][count($arr[$key])-1]["stopping"] = true;
		$json = json_encode($arr);
		session::set("json",$json);
	}
	//车辆画布中启动
	public function startcars1()
	{
		$json = session::get("json");
		$key = input('post.key');
		$arr = json_decode($json,true);
		if($arr[$key][count($arr[$key])-1]["state"] == false)
		{
			$arr[$key][count($arr[$key])-1]["state"] = true;
		}	
		else
		{
			$arr[$key][count($arr[$key])-1]["stopping"] = false;
		}	
		$json = json_encode($arr);
		session::set("json",$json);
	}
	//车辆撤回
	public function backcars1()
	{
		$json = session::get("json");
		$key = input('post.key');
		//$key = "5";
		$arr = json_decode($json,true);
		$arr[$key][count($arr[$key])-1]["state"] = false;
		$json = json_encode($arr);
		$start_time = $arr[$key][1]["starttime"];
        $end_time = $arr[$key][count($arr[$key])-1]["starttime"];
        $data1 = Db::table("i_history")
        ->select();
        $id1 = count($data1);
        $id2 = $id1-1;
        $id = $data1[$id2]['id']+1;
		Db::table("i_history")
		->insert([
            'id'=>$id,
			'number'=>$key,
			'start_time'=>$start_time,
			'end_time'=>$end_time,
			'json'=>$json,
		]);
		$arr[$key]=array(0=>array(
                'v'=>0,'starttime'=>0,'youliang'=>75,
                'changjia'=>1,'zhongliang'=>1,'s'=>0,'state'=>false,'qcheju'=>null,'hcheju'=>null,'warning'=>false,'stopping'=>false
            ));
		$json = json_encode($arr);
		session::set("json",$json);
	}
    public function chushihua(){
        //$v=$this->v();
        $start_time=$this->time1();
        $youliang=$this->youliang();
        //$car_number=$this->car();
        if(session::has('shuju'))
        {
            $json = session::get('shuju');
            $arr = (array)json_decode($json,true);

            $car_number=5;
            $lucheng=$v*1;
            $car_info = Db::table('i_car')
                ->where('number',$car_number)
                ->find();
            $changjia=$car_info['changjia'];
            $zhongliang=$car_info['zhongliang'];
            $arr[$car_number][$start_time] =array(
                'v'=>$v,'start_time'=>$start_time,'youliang'=>$youliang,
                'changjia'=>$changjia,'zhongliang'=>$zhongliang,'s'=>$lucheng,
            );
        }
        else
        {
            $car_number=5;
            $lucheng=$v*1;
            $car_info = Db::table('i_car')
                ->where('number',$car_number)
                ->find();
            $changjia=$car_info['changjia'];
            $zhongliang=$car_info['zhongliang'];
            $arr[$car_number][$start_time] =array(
                'v'=>$v,'start_time'=>$start_time,'youliang'=>$youliang,
                'changjia'=>$changjia,'zhongliang'=>$zhongliang,'s'=>$lucheng,
            );
           
        }
        
       // $zifuchuan = urldecode($arr);
        $zifuchuan2 = json_encode($arr);   
        $arr=session::set('shuju',$zifuchuan2);
        echo $zifuchuan2;
    }
    public function youlianggengxin(){
        $now_time=date("Y-m-d H:i:S");
        $start_time = input('post.start_time');

        $sec=($now_time-$start_time)/60;
        $i=$sec/90;
        $youliang = 75-$i;
        return $youliang;
    }
    public function car(){
        session::set('$carnumber1',0);
        session::set('$carnumber2',0);
        session::set('$carnumber3',0);
        session::set('$carnumber4',0);
        session::set('$carnumber5',0);
        $car_number = rand(1,5);
        switch($car_number){
            case 1:
                session::set('$carnumber1',$car_number);
                break;
            case 2:
                session::set('$carnumber2',$car_number);
                break;
            case 3:
                session::set('$carnumber3',$car_number);
                break;
            case 4:
                session::set('$carnumber4',$car_number);
                break;
            case 5:
                session::set('$carnumber5',$car_number);
                break;
        }
        $car_number1=session::get('$carnumber1');
        $car_number2=session::get('$carnumber2');
        $car_number3=session::get('$carnumber3');
        $car_number4=session::get('$carnumber4');
        $car_number5=session::get('$carnumber5');
        //清空session session::clear();
        //清空think作用域session session::clear('think');
        if($car_number.$car_number==$car_number) {
               car();
           }else{
        return $car_number;       
        }
    }
    public function gengxin(){
        v();
        time();
    }
	public function shujuku1(){
		$a=Db::table('a')
		->select();
		echo dump($a);
	}
    public function connect()
	{
		Db::table("i_history")
		->insert([
		'number'=>1,
		'start_time'=>1,
		'end_time'=>1,
		'json'=>1,
		]);
	}
}