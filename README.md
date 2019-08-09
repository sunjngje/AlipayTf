/**
 * Created by txt.
 * User: sunjignjie
 * Date: 2019/8/9
 * Time: 10:09
 */
# AlipayTf
支付宝转账thinkphp封装
Thinkphp使用Alipay转账Tool封装的使用说明

1，将根目录的  alipay文件夹  复制至Thinkphp的 /thinkphp/library/think 目录中

2，将根目录文件  alipay_tool.php  复制至Thinkphp的 /application/模块目录/controller 目录中

3，配置支付宝参数值config.php
   
    参数有//支付宝配置
    
    'alipay'                 =>[
            'gatewayUrl'         => '网关',
            'appId'              => '商户id',
            'rsaPrivateKey'      => '自己私钥',
            'alipayrsaPublicKey' => '支付宝公钥',
            'apiVersion'         => 'api版本\1.0',
            'signType'           => 'sign类型\RSA2',
            'postCharset'        => '编码\UTF-8',
            'format'             => '数据类型\json',
    ],


4,在自己的controller使用此tool
  
     头部加use app\admin\controller\alipay_tool;
  
     function中
    
     定义转账参数
        $data=array(
            "out_biz_no" => "314112224412332",
            "payee_type"=> "ALIPAY_LOGONID",
            "payee_account"=> "账号",
            "amount"=> "钱",
            "payer_show_name"=> "上海交通卡退款",
            "payee_real_name"=> "沙箱环境",
            "remark"=> "转账备注"
        );
        new 对象
        $alipay_tool = new alipay_tool();
        使用new后的alipayTffunction
        $returnData = $alipay_tool->alipayTf($data);


/**本Tool为自己使用时封装，如有bug请及时反馈。联系email：sunjingjie@yeah.net*/
