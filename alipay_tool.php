<?php
/**
 * Created by PhpStorm.
 * User: sunjignjie
 * Date: 2019/8/9
 * Time: 9:51
 */
namespace app\admin\controller;
use think\alipay\aop\AopClient;
use think\alipay\aop\request\AlipayFundTransToaccountTransferRequest;
class alipay_tool {
        public function alipayTf($out){
            $config = config('alipay');
            $aop = new AopClient ();
            $aop->gatewayUrl = $config['gatewayUrl'];
            $aop->appId = $config['appId'];
            $aop->rsaPrivateKey = $config['rsaPrivateKey'];
            $aop->alipayrsaPublicKey=$config['alipayrsaPublicKey'];
            $aop->apiVersion = $config['apiVersion'];
            $aop->signType = $config['signType'];
            $aop->postCharset= $config['postCharset'];
            $aop->format= $config['format'];
            $request = new AlipayFundTransToaccountTransferRequest ();
            $request->setBizContent(json_encode($out));
            $result = $aop->execute ( $request);
            $responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";
            $resultCode = $result->$responseNode->code;
            if(!empty($resultCode)&&$resultCode == 10000){
                $data=array(
                    'code'=>$resultCode,
                    'msg'=>$result->$responseNode->msg,
                    'order_id'=>$result->$responseNode->order_id,
                    'out_biz_no'=>$result->$responseNode->out_biz_no,
                    'pay_date'=>$result->$responseNode->pay_date
                );
            } else {
                $data=array(
                    'code'=>$resultCode,
                    'msg'=>$result->$responseNode->sub_msg,
                    'order_id'=>'',
                    'out_biz_no'=>$out['out_biz_no'],
                    'pay_date'=>date('Y-m-d H:i:s',time())
                );
            }
            return json_encode($data);
        }
}