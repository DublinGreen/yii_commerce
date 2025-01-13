<?php
/* @var $this CGroupController */
/* @var $model CGroup */

$this->breadcrumbs=array(
	'Cgroups'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List CGroup', 'url'=>array('index')),
	array('label'=>'Create CGroup', 'url'=>array('create')),
	array('label'=>'Update CGroup', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CGroup', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CGroup', 'url'=>array('admin')),
);
?>

<h1>View CGroup #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
