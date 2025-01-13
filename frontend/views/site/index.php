<?php
/**
 * index.php
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * Date: 7/22/12
 * Time: 8:30 PM
 */
?>
<?php $this->beginClip('column2');
	$this->widget('frontend.widgets.Column2', array('state'=>'home')); 
$this->endClip();
	?>
<div class="flexslider">
	<ul class="slides">
		<li class="first">
		  <a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/slide-1.png" /></a>
		</li>
		<li>
		  <a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/slide-1.png" /></a>
		</li>
		<li>
		  <a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/slide-1.png" /></a>
		</li>
		<li>
		  <a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/slide-1.png" /></a>
		</li>
	</ul>
	
</div>
