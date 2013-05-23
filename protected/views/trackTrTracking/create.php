<?php
$this->breadcrumbs=array(
	'Track Tr Trackings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TrackTrTracking','url'=>array('index')),
	array('label'=>'Manage TrackTrTracking','url'=>array('admin')),
);
?>

<h1>Create TrackTrTracking</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>