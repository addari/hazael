<h1>Cargando Datos del HTML</h1>
<?php
    echo CHtml::beginForm('treat_url','get'); //envia la url a la accion treat_url
    echo CHtml::label('URL o Link de la Web','url',array('class'=>'small'));
    echo CHtml::textField('url','',array('class'=>"span7",
        'size'=>"100",
        'name'=>"url",
        'type'=>'Text',
        'placeholder'=>"Ejemplo: http://tupaginaweb.com",
        'required'=>true
        )
    );

?>
<span class="help-block">Escriba aquí el URL donde está la tabla a cargar</span>
<?php
    echo CHtml::submitButton('Cargar', array('class'=>"btn btn-success"));
    echo CHtml::endForm();
?>




