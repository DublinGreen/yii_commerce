<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
'id',
'name',
'url',
'ssl',
	),
)); ?>

<h2><?php echo GxHtml::encode($model->getRelationLabel('categories')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->categories as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('category/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?><h2><?php echo GxHtml::encode($model->getRelationLabel('products')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->products as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('product/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?>
<div class="uid hide"><a href="<?php echo $this->createUrl('delete', array('id' => $model->id)) ?>" class="del-link"></a><a href="<?php echo $this->createUrl('update', array('id' => $model->id)) ?>" class="up-link"></a></div>