
<?php
$this->breadcrumbs=array(
	'Track Tr Trackings',
);

$this->menu=array(
	array('label'=>'Create TrackTrTracking','url'=>array('create')),
	array('label'=>'Manage TrackTrTracking','url'=>array('admin')),
);
?>


<h3><?php echo $new_num;?> Nuevo(s) Registro(s)</h3>

<table border='1'>
<tr colspan="4">DE: <?php echo $url;?></tr>
<tr>
	<th>Id</th>
	<th>Receipt</th>
	<th>Manifest</th>
	<th>Date</th>
	<th>Tracking</th>
</tr>
<?php foreach ($new_data as $data){?>
	
<tr>
<td><?php echo $data->id; ?></td>
<td><?php echo $data->receipt; ?></td>
<td><?php echo $data->manifest; ?></td>
<td><?php echo $data->date; ?></td>
<td><?php echo $data->tracking; ?></td>
</tr>
<?php } ?>
</table>