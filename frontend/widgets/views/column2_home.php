<a href="#" class="column_ad"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/beauty-banner.png" title=""/></a>

<div class="newsletter">
<?php

//Brute Force Approach

	if(isset($_POST['newsletterEmail']) && !empty($_POST['newsletter'])){
		try{
				$connect = mysql_connect("localhost", "root", "steeldubs007");
				mysql_select_db("yorshop");
				//exit($_POST['newsletter']);
				$newletterEmail = mysql_real_escape_string($_POST['newsletter']);
				$sql = "INSERT INTO newsletter(email) VALUES('{$newletterEmail}')";
				if($query = mysql_query($sql)){
					unset($connect);
				}else{
					//exit( mysql_error());
				}
			}catch(Exception $e){
				unset($connect);
				echo 'Message: ' .$e->getMessage();
			}
	}
	
?>
	<form method="post"  action="#">
		<input type="text" class="nl_input" name='newsletter' /><input type="submit" class="nl_submit" name='newsletterEmail' value=""/>
	</form>
	<div class="clear"></div>
</div>

<a href="#" class="column_ad"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/clinique-banner.png" title=""/></a>