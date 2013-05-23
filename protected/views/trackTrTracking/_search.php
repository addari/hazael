<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'lote',array('class'=>'span5','maxlength'=>32)); ?>

	<?php echo $form->textFieldRow($model,'receipt',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'manifest',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'awb',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'shipper',array('class'=>'span5','maxlength'=>256)); ?>

	<?php echo $form->textFieldRow($model,'account_rg',array('class'=>'span5','maxlength'=>64)); ?>

	<?php echo $form->textFieldRow($model,'account_id',array('class'=>'span5','maxlength'=>64)); ?>

	<?php echo $form->textFieldRow($model,'consignee',array('class'=>'span5','maxlength'=>256)); ?>

	<?php echo $form->textFieldRow($model,'pieces',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'weight_lb',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'weight_kg',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'tracking',array('class'=>'span5','maxlength'=>256)); ?>

	<?php echo $form->textFieldRow($model,'value',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'comodity',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'dimm_in',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'dimm_cm',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'comment',array('class'=>'span5','maxlength'=>256)); ?>

	<?php echo $form->textFieldRow($model,'timestamp',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
