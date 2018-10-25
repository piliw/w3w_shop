<?php 

	// 调用支付宝接口
	function pay($out_trade_no,$subject,$total_fee,$body){
		require_once("alipay.config.php");
		require_once("lib/alipay_submit.class.php");

		/**************************请求参数**************************/
		        //商户订单号，商户网站订单系统中唯一订单号，必填
		        $out_trade_no = $out_trade_no;

		        //订单名称，必填
		        $subject = $subject;

		        //付款金额，必填
		        $total_fee = $total_fee;

		        //商品描述，可空
		        $body = $body;





		/************************************************************/

		//构造要请求的参数数组，无需改动
		$parameter = array(
				"service"       => $alipay_config['service'],
				"partner"       => $alipay_config['partner'],
				"seller_id"  => $alipay_config['seller_id'],
				"payment_type"	=> $alipay_config['payment_type'],
				"notify_url"	=> $alipay_config['notify_url'],
				"return_url"	=> $alipay_config['return_url'],
				
				"anti_phishing_key"=>$alipay_config['anti_phishing_key'],
				"exter_invoke_ip"=>$alipay_config['exter_invoke_ip'],
				"out_trade_no"	=> $out_trade_no,
				"subject"	=> $subject,
				"total_fee"	=> $total_fee,
				"body"	=> $body,
				"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
				//其他业务参数根据在线开发文档，添加参数.文档地址:https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.kiX33I&treeId=62&articleId=103740&docType=1
		        //如"参数名"=>"参数值"
				
		);

		//建立请求
		$alipaySubmit = new AlipaySubmit($alipay_config);
		$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
		echo $html_text;
	}

	// 获取物流信息
	function getExpress($com,$no){
			require_once("exp.php");
			header('Content-type:text/html;charset=utf-8');
			$params = array(
			  'key' => '814c563f8a392953e9d00617874edc81', //您申请的快递appkey
			  'com' => $com, //快递公司编码，可以通过$exp->getComs()获取支持的公司列表
			  'no'  => $no //快递编号
			);
			$exp = new exp($params['key']); //初始化类
			 
			$result = $exp->query($params['com'],$params['no']); //执行查询
			 
			if($result['error_code'] == 0){//查询成功
			  $list = $result['result']['list'];
			  return$list;
			}else{
			  echo "获取失败，原因：".$result['reason'];
			}
			 
	}
 ?>