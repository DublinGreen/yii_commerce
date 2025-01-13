<?php $this->widget('bootstrap.widgets.TbAlert'); ?> 
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
		'payment_firstname',
		'payment_lastname',
		'payment_company',
		'payment_company_id',
		'payment_tax_id',
		'payment_address_1',
		'payment_address_2',
		'payment_city',
		'payment_postcode',
		'payment_country',
		'payment_country_id',
		'payment_zone',
		'payment_zone_id',
		'payment_address_format',
		'payment_method',
	),
)); ?>
<div class="hlinks hide">
<div class="uid"><?php echo $model->id; ?></div>
</div>