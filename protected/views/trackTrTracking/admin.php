<?php
$this->breadcrumbs=array(
	'Track Tr Trackings'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TrackTrTracking','url'=>array('index')),
	array('label'=>'Create TrackTrTracking','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('track-tr-tracking-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Track Tr Trackings</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'track-tr-tracking-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		#'id',
		#'lote',
		'receipt',
		'manifest',
		#'awb',
		'date',
		#'shipper',
		'account_rg',
		'account_id',
		'consignee',
		#'pieces',
		#'weight_lb',
		#'weight_kg',
		'tracking',
		#'value',
		#'comodity',
		#'dimm_in',
		#'dimm_cm',
		#'comment',
		#'timestamp',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template'=>'{view}' //removed {update} {delete}
		),
	),
)); ?>
