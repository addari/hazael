<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lote')); ?>:</b>
	<?php echo CHtml::encode($data->lote); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('receipt')); ?>:</b>
	<?php echo CHtml::encode($data->receipt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('manifest')); ?>:</b>
	<?php echo CHtml::encode($data->manifest); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('awb')); ?>:</b>
	<?php echo CHtml::encode($data->awb); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shipper')); ?>:</b>
	<?php echo CHtml::encode($data->shipper); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('account_rg')); ?>:</b>
	<?php echo CHtml::encode($data->account_rg); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('account_id')); ?>:</b>
	<?php echo CHtml::encode($data->account_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('consignee')); ?>:</b>
	<?php echo CHtml::encode($data->consignee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pieces')); ?>:</b>
	<?php echo CHtml::encode($data->pieces); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('weight_lb')); ?>:</b>
	<?php echo CHtml::encode($data->weight_lb); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('weight_kg')); ?>:</b>
	<?php echo CHtml::encode($data->weight_kg); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tracking')); ?>:</b>
	<?php echo CHtml::encode($data->tracking); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('value')); ?>:</b>
	<?php echo CHtml::encode($data->value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comodity')); ?>:</b>
	<?php echo CHtml::encode($data->comodity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dimm_in')); ?>:</b>
	<?php echo CHtml::encode($data->dimm_in); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dimm_cm')); ?>:</b>
	<?php echo CHtml::encode($data->dimm_cm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('timestamp')); ?>:</b>
	<?php echo CHtml::encode($data->timestamp); ?>
	<br />

	*/ ?>

</div>