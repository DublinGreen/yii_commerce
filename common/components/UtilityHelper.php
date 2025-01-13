<?php

class UtilityHelper
{

	public static function changePassword($find,$mesg='Message')
	{

	}
	
	public static function yiiparam($name, $default = null)
	{
		if ( isset(Yii::app()->params[$name]) )
			return Yii::app()->params[$name];
		else
			return $default;
	}
	
		/**
	 * Send to user mail
	 */
	public static function sendMail($from='',$to,$subject,$message) {
    	 if (!$from) $from = Yii::app()->params['adminEmail'];
	    $headers = "MIME-Version: 1.0\r\nFrom: $from\r\nReply-To: $from\r\nContent-Type: text/html; charset=utf-8";
	    $message = wordwrap($message, 70);
	    $message = str_replace("\n.", "\n..", $message);
	    return mail($to,'=?UTF-8?B?'.base64_encode($subject).'?=',$message,$headers);
	}

    /**
     * Send to user mail
     */
    public function sendMailToUser($user_id,$subject,$message,$from='') {
        $user = User::model()->findbyPk($user_id);
        if (!$from) $from = Yii::app()->params['adminEmail'];
        $headers="From: ".$from."\r\nReply-To: ".Yii::app()->params['adminEmail'];
        return mail($user->email,'=?UTF-8?B?'.base64_encode($subject).'?=',$message,$headers);
    }
	
	public static function formatPrice($price){
		$f = new CNumberFormatter(Yii::app()->language);
		return '&#8358;'.Yii::app()->numberFormatter->format("#,##0.##",$price);
	}
	
	public static function getCurrency(){
		return '&#8358;';
	}
	
	public static function productLink($id) {
		$arry = array();
		$product = Product::model()->findByPk($id);
		if(!empty($product)){
			$arry['product'] = $product->getLink();
			$category = $product->categories;
			$parent = $category[0]->parent;
			if(!empty($parent)){
				$arry['subcategory'] = $category[0]->getLink();
				$arry['category'] = $category[0]->parent->getLink();
			}
			else{
				$arry['category'] = $category[0]->getLink();
			}
		}
		
		return $arry;
	}
}

?>