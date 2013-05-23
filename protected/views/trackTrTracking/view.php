<?php
$this->breadcrumbs=array(
	'Track Tr Trackings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TrackTrTracking','url'=>array('index')),
	array('label'=>'Create TrackTrTracking','url'=>array('create')),
	array('label'=>'Update TrackTrTracking','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete TrackTrTracking','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TrackTrTracking','url'=>array('admin')),
);
?>

<h1>View TrackTrTracking #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'lote',
		'receipt',
		'manifest',
		'awb',
		'date',
		'shipper',
		'account_rg',
		'account_id',
		'consignee',
		'pieces',
		'weight_lb',
		'weight_kg',
		'tracking',
		'value',
		'comodity',
		'dimm_in',
		'dimm_cm',
		'comment',
		'timestamp',
	),
)); ?>
