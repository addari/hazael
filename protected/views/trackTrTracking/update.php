<?php
$this->breadcrumbs=array(
	'Track Tr Trackings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TrackTrTracking','url'=>array('index')),
	array('label'=>'Create TrackTrTracking','url'=>array('create')),
	array('label'=>'View TrackTrTracking','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage TrackTrTracking','url'=>array('admin')),
);
?>

<h1>Update TrackTrTracking <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>