<?php
/**
 * CategoryController.php
 *
 */
class PaymentController extends Controller {
	
	public $layout='//layouts/column3';
		
	public $defaultAction = 'view2';
	
	
	public function accessRules() {
		return array(
			// not logged in users should be able to login and view captcha images as well as errors
			array('allow', 'actions' => array('index', 'view', 'captcha', 'login', 'error', 'KK')),
			// logged in users can do whatever they want to
			array('allow', 'users' => array('@')),
			// not logged in users can't do anything except above
			array('deny'),
		);
	}
	public function actionView2() 
	
		$client=new SoapClient('https://demo.globalpay.com.ng/GlobalpayWebService_demo/service.asmx?wsdl', true);
		
		$soapaction = "http://www.eazypaynigeria.com/globalpay_demo/getTransactions";
		$namespace = "http://www.eazypaynigeria.com/globalpay_demo/";
		$client->soap_defencoding = 'UTF-8';
		if(isset($_GET["txnref"])){
			$txnref = $_GET["txnref"];
			$order = Order::model()->findByAttributes(array('payment_code'=>$txnref));
		
			$merch_txnref=$txnref; 
			$channel=""; 
			//change the merchantid to the one sent to you
			$merchantID="3344"; 
			$start_date=""; 
			$end_date=""; 
			//change the uid and pwd to the one sent to you
			$uid="yl_ws_user"; 
			$pwd="yl_ws_password"; 
			$payment_status="" ; 
		
			$err = $client->getError();
		
			if ($err) {
				$this->render('view2',array('response'=>$err, 'error'=>1));
			}
			// Doc/lit parameters get wrapped
			$MethodToCall= "getTransactions";
			//$MethodToCall= "Checkcenter";
			
			$param = array(
				'merch_txnref' => $merch_txnref, 
				'channel' => $channel,
				'merchantID' => $merchantID,
				'start_date' => $start_date,
				'end_date' => $end_date,
				'uid' => $uid,
				'pwd' => $pwd,
				'payment_status' => $payment_status
			);

			$result = $client->call(
				'getTransactions', 
				array('parameters' => $param), 
				'http://www.eazypaynigeria.com/globalpay_demo/', 
				'http://www.eazypaynigeria.com/globalpay_demo/getTransactions', 
				false,  
				true
			);

			// Check for a fault
			if ($client->fault) {
				echo '<h2>Fault</h2><pre>';
				print_r($result);
				echo '</pre>';
				return $result;
			} 
			else {
				// Check for errors
				$err = $client->getError();
				if ($err) {
					// Display the error
					//echo '<h2>Error</h2><pre>' . $err . '</pre>';
					$this->render('view2',array('response'=>$err, 'error'=>1));
				} 
				else {
					//This gives getTransactionsResult
					$WebResult=$MethodToCall."Result";
					// Pass the result into XML
					$xml = simplexml_load_string($result[$WebResult]);
					
					
					//echo $xml;
					$trans = array();
					$trans['amount'] = $xml->record->amount;
					$trans['txn_date'] = $xml->record->payment_date;
					$trans['pmt_method'] = $xml->record->channel;
					$trans['pmt_status'] = $xml->record->payment_status;
					$trans['pmt_txnref'] = $xml->record->txnref;
					$trans['currency'] = $xml->record->field_values->field_values->field[2]->currency;
				   // $pnr = 'PNR';
					$trans['trans_status'] = $xml->record->payment_status_description;
					
					$merch_name = "{$order->firstname} {$order->lastname}";
					$merch_phoneno  = $order->phone;
					$merch_amt = $order->total;
				
					
					$pay = new PaymentTransaction;
					$pay->transaction_date = $trans['txn_date'];
					$pay->reference_number = $trans['pmt_txnref'];
					//$pay->payment_reference = ;
					$pay->response_description = $trans['trans_status'];
					$pay->response_code = $trans['pmt_status'];
					$pay->approved_amount = $trans['amount'];
					$pay->transaction_amount = $merch_amt;
					$pay->transaction_currency = $trans['currency'];
					$pay->customer_name = $merch_name;
					$pay->save();
				} 
				
			 
				$trans_pay_status = $trans['pmt_status'];
				if($trans['amount'] != $merch_amt)
					$trans['pmt_status'] .= " ( Amount does not match and no service will be rendered)";
					
				$message = "Dear {$order->firstname} {$order->lastname},<br/><br/>You have just attempted making payment for order #{$order->id} on {$order->store_url}. Find the details below.<br/>Name : {$order->firstname} {$order->lastname} <br/><br/>Phone number : {$order->phone} <br/><br/>Amount : {$trans['amount']} <br/><br/>Transaction Date : {$trans['txn_date']} <br/><br/>Payment Method : {$trans['pmt_method']} <br/><br/>Payment Status : {$trans['pmt_status']} <br/><br/>Transaction Reference Number : {$trans['pmt_txnref']} <br/><br/>Currency : {$trans['currency']} <br/><br/>Transaction Status : {$trans['$trans_status']} <br/><br/>";
				if($trans['pmt_status'] == 'successful' && $trans['amount'] == $merch_amt)
					UtilityHelper::sendMail('',$order->email,UtilityHelper::yiiparam('salesEmail'), 'Successful Payment Notification',$message);
				else if($trans['pmt_status'] == 'pending'){
				}
				else
					UtilityHelper::sendMail('',$order->email,UtilityHelper::yiiparam('salesEmail'), 'Failed Payment Notification',$message);
				$this->render('view2',array('response'=>$trans, 'error'=>0, 'order'=>$order));
					
			}
		}
	
	}
	
	public function actionView() {
		//if(!empty($_GET['txnref']) || !empty($_GET['payRef']) || !empty($_GET['retRef'])){
		if(!empty($_POST['txnref']) || !empty($_POST['payRef']) || !empty($_POST['retRef'])){
			$ref = $_POST['txnref'];
			$order = Order::model()->findByAttributes(array('payment_code'=>$ref));
			$url = UtilityHelper::yiiparam('interswitchGet').'?productid='.'4903'.'&transactionreference='.$ref.'&amount='.($order->total*100);
			$cURL = curl_init();

			curl_setopt($cURL, CURLOPT_URL, $url);
			curl_setopt($cURL, CURLOPT_HTTPGET, true);
			curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Accept: application/json',
				'Hash: '.hash('sha512', '4903'.$ref.UtilityHelper::yiiparam('MAC_key'))
			));
			$result = curl_exec($cURL);
			curl_close($cURL);
			$json = json_decode($result, true);
			$pay = new PaymentTransaction;
			$pay->transaction_date = $json['TransactionDate'];
			$pay->reference_number = $ref;
			$pay->payment_reference = $json['PaymentReference'];
			$pay->response_description = $json['ResponseDescription'];
			$pay->response_code = $json['ResponseCode'];
			$pay->transaction_amount = $json['Amount'];
			//$pay->customer_name = ;
			$pay->save();
			
			$total = UtilityHelper::formatPrice($order->total);
			$siteurl = UtilityHelper::yiiparam('siteUrl');
			if($pay->response_code != '00')
				UtilityHelper::sendMail('',$order->email,UtilityHelper::yiiparam('salesEmail'), 'Failed Payment Notification',"Dear {$order->firstname} {$order->lastname},<br/><br/>You have just attempted making payment for order #{$order->id} on {$order->store_url}. Find the details below.<br/>Response Description: {$json['ResponseDescription']}<br/><br/>Amount: $total<br/><br/>Response Code: {$json['ResponseCode']}<br/><br/>Transaction Ref No: {$ref}<br/>");
			else
				UtilityHelper::sendMail('',$order->email,UtilityHelper::yiiparam('salesEmail'), 'Successful Payment Notification',"Dear {$order->firstname} {$order->lastname},<br/><br/>You have successful made payment for order #{$order->id} on {$order->store_url}. Find the details below.<br/>Response Description: {$json['ResponseDescription']}<br/><br/>Amount: $total<br/><br/>Response Code: {$json['ResponseCode']}<br/><br/>Transaction Ref No: {$ref}<br/>");
			$this->render('view',array('response'=>$json, 'ref'=>$ref));
		}else
			throw new CHttpException(400, Yii::t('info', 'Your request is invalid.')); 
		
	}

}