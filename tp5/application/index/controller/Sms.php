<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Session;
class Sms extends Controller{

public function send_sms(){
    header('content-type:text/html;charset=utf-8');
  
    $sendUrl = 'http://v.juhe.cn/sms/send'; //短信接口的URL
    //$iphone = '18120178553';
    $iphone= input('post.iphone');
    //echo 'iphone';
    $time = date("Y-m-d H:i:s");
    $json = '车辆距离过近,请发出指令。';
    if(preg_match("/^1[34578]\d{9}$/",$iphone)){
        $smsConf = array(
            'key'   => '3c8c5dc66414b686e79674f05f3e82c6', //您申请的APPKEY
            'mobile'    => $iphone, //接受短信的用户手机号码
            'tpl_id'    => '140169', //您申请的短信模板ID，根据实际情况修改
            'tpl_value' =>'' //您设置的模板变量，根据实际情况修改
        );
         
        $content = $this->juhecurl($sendUrl,$smsConf,1); //请求发送短信
         
        if($content){
            $result = json_decode($content,true);
            $error_code = $result['error_code'];
            if($error_code == 0){
                //状态为0，说明短信发送成功
                Db::table('i_sms')
                    ->insert([
                    'time'=>$time,
                    'json'=>$json,
                    'iphone'=>$iphone
                     ]);
            echo '成功发送';
            }else{
                $smsConf = array(
                    'key'   => 'd9b4075d1a26280564b2a74aa4bda4a0', //您申请的APPKEY
                    'mobile'    => $iphone, //接受短信的用户手机号码
                    'tpl_id'    => '140480', //您申请的短信模板ID，根据实际情况修改
                    'tpl_value' =>'' //您设置的模板变量，根据实际情况修改
                );
                $content = $this->juhecurl($sendUrl,$smsConf,1); //请求发送短信
                echo '二号接口，成功发送';
            }
        }else{
            $smsConf = array(
                'key'   => 'd9b4075d1a26280564b2a74aa4bda4a0', //您申请的APPKEY
                'mobile'    => $iphone, //接受短信的用户手机号码
                'tpl_id'    => '140480', //您申请的短信模板ID，根据实际情况修改
                'tpl_value' =>'' //您设置的模板变量，根据实际情况修改
            );
            $content = $this->juhecurl($sendUrl,$smsConf,1); //请求发送短信
            echo '二号接口，成功发送';
        }
        
    }else{
        echo "请输入正确的手机号";
    }
     
    /**
     * 请求接口返回内容
     * @param  string $url [请求的URL地址]
     * @param  string $params [请求的参数]
     * @param  int $ipost [是否采用POST形式]
     * @return  string
*/}
    public function juhecurl($url,$params=false,$ispost=0){
        $httpInfo = array();
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
        curl_setopt( $ch, CURLOPT_USERAGENT , 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22' );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 30 );
        curl_setopt( $ch, CURLOPT_TIMEOUT , 30);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
        if( $ispost )
        {
            curl_setopt( $ch , CURLOPT_POST , true );
            curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
            curl_setopt( $ch , CURLOPT_URL , $url );
        }
        else
        {
            if($params){
                curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
            }else{
                curl_setopt( $ch , CURLOPT_URL , $url);
            }
        }
        $response = curl_exec( $ch );
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
        $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
        curl_close( $ch );
        return $response;
    }

}
//短信记录



