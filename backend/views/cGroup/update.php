<?php
/* @var $this CGroupController */
/* @var $model CGroup */

$this->breadcrumbs=array(
	'Cgroups'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CGroup', 'url'=>array('index')),
	array('label'=>'Create CGroup', 'url'=>array('create')),
	array('label'=>'View CGroup', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CGroup', 'url'=>array('admin')),
);
?>

<h1>Update CGroup <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>