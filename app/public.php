<?php
use App\SMS\SendSMS;
    //发送短信
    function sendDuanxin($P,$code,$tempid)
    {
    	//填写在开发者控制台首页上的Account Sid
        $options['accountsid']='2c59af626775f0f2f6cd46a9cfea0f17';
        //填写在开发者控制台首页上的Auth Token
        $options['token']='324b9f43693bbf0ffbec6bb80afbcb24';

        //初始化 $options必填
        $ucpass = new SendSMS($options);

        $appid = "2488a38bd06b4660a0b984ecc9666759";    //应用的ID，可在开发者控制台内的短信产品下查看
        $templateid = $tempid;    //365738//可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID
        $param = $code; //多个参数使用英文逗号隔开（如：param=“a,b,c”），如为参数则留空
        $mobile = $P;
        $uid = "";

        //70字内（含70字）计一条，超过70字，按67字/条计费，超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。

        return $ucpass->SendSms($appid,$templateid,$param,$mobile,$uid);	    
    }

    //获取几天前几小时前
    function time_ago($agoTime)
    {
        $agoTime = (int)$agoTime;
        // 计算出当前日期时间到之前的日期时间的毫秒数，以便进行下一步的计算
        $time = time() - $agoTime;
        if ($time >= 31104000) { // N年前
            $num = (int)($time / 31104000);
            return $num.'年前';
        }
        if ($time >= 2592000) { // N月前
            $num = (int)($time / 2592000);
            return $num.'月前';
        }
        if ($time >= 86400) { // N天前
            $num = (int)($time / 86400);
            return $num.'天前';
        }
        if ($time >= 3600) { // N小时前
            $num = (int)($time / 3600);
            return $num.'小时前';
        }
        if ($time > 60) { // N分钟前
            $num = (int)($time / 60);
            return $num.'分钟前';
        }
        return '1分钟前';
    }

    //处理邮箱星号
    function substr_cut($user_name){
        $strlen     = mb_strlen($user_name, 'utf-8');
        $firstStr     = mb_substr($user_name, 0, 3, 'utf-8');
        $lastStr     = mb_substr($user_name, -1, 12, 'utf-8');
        return $strlen == 1 ? $firstStr . str_repeat('*', mb_strlen($user_name, 'utf-8') - 10) : $firstStr . str_repeat("*", $strlen - 10) . $lastStr;
    }
?>