<?php
$this->breadcrumbs=array(
	'Track Tr Trackings',
);

$this->menu=array(
	array('label'=>'Create TrackTrTracking','url'=>array('create')),
	array('label'=>'Manage TrackTrTracking','url'=>array('admin')),
);
?>

<h1>Track Tr Trackings</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
