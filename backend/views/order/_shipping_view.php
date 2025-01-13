<?php $this->widget('bootstrap.widgets.TbAlert'); ?> 
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
		'shipping_firstname',
		'shipping_lastname',
		'shipping_company',
		'shipping_address_1',
		'shipping_address_2',
		'shipping_city',
		'shipping_postcode',
		'shipping_country',
		'shipping_country_id',
		'shipping_zone',
		'shipping_zone_id',
		'shipping_address_format',
		'shipping_method',
		'shipping_code',
	),
)); ?>
<div class="hlinks hide">
<div class="uid"><?php echo $model->id; ?></div>
</div>