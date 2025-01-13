<?php
/* @var $this CGroupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cgroups',
);

$this->menu=array(
	array('label'=>'Create CGroup', 'url'=>array('create')),
	array('label'=>'Manage CGroup', 'url'=>array('admin')),
);
?>

<h1>Cgroups</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
