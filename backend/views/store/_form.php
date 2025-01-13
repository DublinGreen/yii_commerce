<?php $this->widget('bootstrap.widgets.TbAlert'); ?><div class="aform form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'store-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		Fields with <span class="required">*</span> are required.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model, 'name', array('maxlength' => 64)); ?>
		<?php echo $form->error($model,'name'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model, 'url', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'url'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'ssl'); ?>
		<?php echo $form->textField($model, 'ssl', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'ssl'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('categories')); ?></label>
		<?php echo $form->checkBoxList($model, 'categories', GxHtml::encodeEx(GxHtml::listDataEx(Category::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('products')); ?></label>
		<?php echo $form->checkBoxList($model, 'products', GxHtml::encodeEx(GxHtml::listDataEx(Product::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton('Save');
$this->endWidget();
?>
</div><!-- form -->
<div class="uid hide"><a href="<?php echo $this->createUrl('delete', array('id' => $model->id)) ?>" class="del-link"></a><a href="<?php echo $this->createUrl('update', array('id' => $model->id)) ?>" class="up-link"></a></div>