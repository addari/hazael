<?php

class TrackTrTrackingController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','load_url', 'add_url', 'treat_url','create'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionLoad_url(){
		$this->render('load_url'); //muestra la vista para escribir la url
	}

	public function actionTreat_url($url){
		 
	$pattern='|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i'; //secuencia de posibles patrones de caracteres en una url
   	if(preg_match($pattern, $url) > 0){ //compara si existe un patron
	
		$tiempo=date('Y-m-d H:i:s');// Asigna la fecha y hora actual a la variable tiempo
		$lote = md5($tiempo); // Genera el lote de carga de datos con la fecha de lectura
					
		$dom = new DOMDocument(); //objeto de DomDocument
                $html = @$dom->loadHTMLFile($url);//obtiene objeto de la url
    	
		$dom->preserveWhiteSpace = false; // no conservar los espacios
                $tables = $dom->getElementsByTagName('table'); //selecciona las tablas del html
                $rows = $tables->item(3)->getElementsByTagName('tr'); //obitiene las filas 
        	
		$vistatabla = file_get_contents($url); //obtiene contenido del html 
		$html1=explode("<div>", $vistatabla); //obtenemos del contenido los tag div
		$ht=$html1[3]; //guardamos el div que contiene las tablas del contenido
		$content=explode('</table>', $ht); //obtenemos las tablas 
		$title=$content[1]; //guardamos el contenido de la tabla
				

		foreach($rows as $data)// Recorrido de la tabla HTML, pasando y evaluando cada registro ($row) para ir tratando datos 
		{
		$cols= $data->getElementsByTagName('td');  // Declaración de Elemento Cols que es el indice de cada columna de la tabla HTML
		$cols_0[]=$cols->item(0)->nodeValue; // Asigna cada valor de la Columna 0 del HTML (RECEIPT, MANIFEST)
		$cols_1[]=$cols->item(1)->nodeValue; // Asigna cada valor de la Columna 1 del HTML (AWB#, DATE)
		$cols_2[]=$cols->item(2)->nodeValue; // Asigna cada valor de la Columna 2 del HTML (SHIPPER)
		$cols_3[]=$cols->item(3)->nodeValue; // Asigna cada valor de la Columna 3 del HTML (ACCOUNT_ID, ACCOUNT_RG, CONSIGNEE)
		$cols_4[]=$cols->item(4)->nodeValue; // Asigna cada valor de la Columna 4 del HTML (PIECES, WEIGHT_LB, WEIGHT_KG)
		$cols_5[]=$cols->item(5)->nodeValue; // Asigna cada valor de la Columna 5 del HTML (TRACKING)
		$cols_6[]=$cols->item(6)->nodeValue; // Asigna cada valor de la Columna 6 del HTML (VALUE. COMODITY)
		$cols_7[]=$cols->item(7)->nodeValue; // Asigna cada valor de la Columna 7 del HTML (DIMM_IN, DIMM_CM, COMMENTS) 
		}
		
		#echo '<pre>';
		#print_r(sizeof($cols_0));	
		#echo '<pre>';	
		#yii::app()->end();
		#$j=0;  	
		//para cada item del arreglo (rm[]) 
		for($i=1;$i<sizeof($cols_0)-1;$i++): //recorrido a partir del indice 1 se omite el indice 0 que es el encabezado y el ultimo 
      		
                    //lote
//                    $lotes[$j]=$lote; //Guarda el lote de carga de datos con la fecha de lectura
//                    $j++;

                    //tratamiento de cols 0 -- se crean 2 array ( receipt, manifest)  
                    $array_cols_0=explode(' ',preg_replace('/\s+/', ' ', $cols_0[$i])); //eliminamos saltos y extraemos por cada espacio
                    $receipt[]=trim($array_cols_0[1]); // (receipt)
                    $manifest[]=trim($array_cols_0[2]);// (manifest)

                    //tratamiento de cols 1 -- se crea 2 array( awb, date )
                    $array_cols_1=explode(' ',preg_replace('/\s+/', ' ', $cols_1[$i]));
                    $awb[]=trim(substr($array_cols_1[1], 0, 12)); // Asgina AWB# al arreglo AWB[] tras extraccion   
                    $times=substr($array_cols_1[1], 13,-5); // Extraccion de la fecha
                    $hora=substr($array_cols_1[1], 22);     // Extraccion de la hora
                    $array_hora=explode(':', $hora); // Separa la hora en horas y minutos
                    $horas=$array_hora[0];           // Asignamos solo la hora   
                    if($array_cols_1[2]=='PM') 
                    {
                        $horas=$array_hora[0]+12; // Le suma 12 a la hora si es PM
                    }
                    $hora_real=$horas . ':' . $array_hora[1]; //Hora real
                    $parts = explode('/', $times); //separ por (/) la variable times
		    $mydate = $parts[2] . '-' . $parts[0] . '-' . $parts[1]." ".$hora_real; //asgina la fecha en orden al formato mysql
		    $date[]=$mydate;  // Asigna la fecha al arreglo DATE[]
	            
                    //tratamiento de cols 2  se crea un array ( shipper )
		    $shipper[]=trim(preg_replace('/\s+/', ' ', $cols_2[$i])); // (shipper)

		    //tratamiento de cols 3 -- se crean 3 array (consignee, account_rg, account_id)  
                    $account=preg_replace('/\s+/', ' ', $cols_3[$i]);
                    $array_cols_3 = explode(' ', $account); 
                    if (strpos($array_cols_3[1], '-')) { // si existen account_id y account_rg
                        $array_account = explode('-', $array_cols_3[1]);
                        $consignee[] = trim(str_replace($array_cols_3[1], '', $account)); //(consignee)
                        $account_rg[] = trim($array_account[1]); // (account_id)
                        $account_id[] = trim($array_account[0]); // (account_rg)
                    } 
                    else //de lo contario
                    {
                        $consignee[] = trim($account); //(consignee)
                        $account_rg[] = null; //nulo
                        $account_id[] = null; //nulo
                    }
            
                    //tratamiento de cols 4 -- se crean 3 array (pieces, weight_kb, weight_lb)  
                    $array_cols_4 =explode(' ',preg_replace('/\s+/', ' ', $cols_4[$i]));
                    $pieces[] = trim($array_cols_4[1]); //(pieces)
                    $weight_lb[] = trim($array_cols_4[2]); //(weight_lb)
                    $weight_kg[] = trim(str_replace('LB', '', $array_cols_4[3])); //(weight_kg)

                    //tratamiento de cols 5 -- se crean un array (tracking)  
                    $tracking[]=trim(preg_replace('/\s+/', ' ', $cols_5[$i])); //(tracking)

                    //tratamiento de cols 6 -- se crean 2 array ( value, comodity )  
                    $array_cols_6=explode(' ',preg_replace('/\s+/', ' ', $cols_6[$i]));
                    $value[] = trim($array_cols_6[1]); //(value)
                    $comodity[] = trim($array_cols_6[2]); //(comodity)
	        
                    //tratamiento de cols 7 -- se crean 3 array (dimm_in, dimm_cm, comments)  
                    $array_cols_7=explode('cm',preg_replace('/\s+/', ' ', $cols_7[$i])); //Extraer por cm
                    $comments= preg_replace('/\s+/', ' ', $cols_7[$i]); 

                    if (strpos($comments, 'in') && strpos($comments, 'cm')) {  //si existe dimm_in dimm_cm
                        $array_cols_7_2= explode('in',  $array_cols_7[0]); //extraemos dimm_in
                        $dimm_in[] = trim($array_cols_7_2[0]); //(dimm_in)
                        $array_cols_7_2 = explode('in',  $array_cols_7[0]); 
                        $dimm_cm[] = trim(str_replace('in', '', $array_cols_7_2[1])); //(dimm_cm)
                        $comment[] = trim($array_cols_7[1]); //(comment)
                    }
                    else //si no existe dato alguno
                    {
                            $dimm_in[]=null; // nulo
                            $dimm_cm[]=null; // nulo
                            $comment[]=trim($array_cols_7[0]); // (comments)
                    }  	
         
             endfor; 
             
            //guardamos cada array de las columnas en cache con SET
            Yii::app()->cache->set('lote',$lote);
            Yii::app()->cache->set('receipt',$receipt);
            Yii::app()->cache->set('manifest',$manifest);
            Yii::app()->cache->set('awb',$awb);
            Yii::app()->cache->set('date',$date);
            Yii::app()->cache->set('shipper',$shipper);
            Yii::app()->cache->set('consignee',$consignee);
            Yii::app()->cache->set('account_rg',$account_rg);
            Yii::app()->cache->set('account_id',$account_id);
            Yii::app()->cache->set('pieces',$pieces);
            Yii::app()->cache->set('weight_lb',$weight_lb);
            Yii::app()->cache->set('weight_kg',$weight_kg);
            Yii::app()->cache->set('tracking',$tracking);
            Yii::app()->cache->set('value',$value);
            Yii::app()->cache->set('comodity',$comodity);
            Yii::app()->cache->set('dimm_in',$dimm_in);
            Yii::app()->cache->set('dimm_cm',$dimm_cm);
            Yii::app()->cache->set('comment',$comment);
            yii::app()->cache->set('url',$url); //guardamos en cache la url
            $this->render('treat_url', array('url'=>$url, 'lote'=>$lote, 'title'=>$title)); //enviamos  title, lote, url a la vista treat_url
			
			
	}
			
		
	else // si no hay url
	{
            $this->render('load_url'); //carga la vista y accion load_url
	}
}

	public function actionAdd_url(){
	
		
		//captura los array de todas las variables guardadas en cache llamadas por su nombre con GET	
		$lote=Yii::app()->cache->get('lote');
		$receipt=Yii::app()->cache->get('receipt');
  	    $manifest=Yii::app()->cache->get('manifest');
        $awb=Yii::app()->cache->get('awb');
        $date=Yii::app()->cache->get('date');
        $shipper=Yii::app()->cache->get('shipper');
        $consignee=Yii::app()->cache->get('consignee');
        $account_rg=Yii::app()->cache->get('account_rg');
        $account_id=Yii::app()->cache->get('account_id');
        $pieces=Yii::app()->cache->get('pieces');
        $weight_lb=Yii::app()->cache->get('weight_lb');
        $weight_kg =Yii::app()->cache->get('weight_kg');
        $tracking =Yii::app()->cache->get('tracking');
        $value =Yii::app()->cache->get('value');
        $comodity=Yii::app()->cache->get('comodity');
        $dimm_in=Yii::app()->cache->get('$dimm_in');
        $dimm_cm=Yii::app()->cache->get('dimm_cm');
        $comment=Yii::app()->cache->get('comment');
        $url=yii::app()->cache->get('url'); //captura de url

        $consulta=TrackTrTracking::model()->findAll(); //encuentra todos los registros en la db
		$cantidad=count($consulta); //cuenta cuantos registros existen
		$t=null; //variable al que se le va a asignar el arreglo de tracking

		for($i=0;$i<sizeof($tracking);$i++){
			$trk= $tracking[$i]; //asignamos cada arreglo a una variable
		
		$sql="SELECT tracking FROM track_tr_tracking WHERE tracking = '$trk'"; //consulta si existe un tracking igual
		$sqlTracking = yii::app()->db->createCommand($sql)->query(); //ejecuta la consulta
			
			if(count($sqlTracking)==0){ //si por cada arreglo cuenta 0 (no hay un tracking similar), cuenta 1 (ya existe un tracking)
			//asignamos nuevos registro a los arreglos: l[], r[], m[], a[]......
				$l[]=$lote[$i]; 
				$r[]=$receipt[$i];
				$m[]=$manifest[$i];
				$a[]=$awb[$i];
				$d[]=$date[$i];
				$s[]=$shipper[$i];
				$ce[]=$consignee[$i];
				$ai[]=$account_id[$i];
				$ar[]=$account_rg[$i];
				$p[]=$pieces[$i];
				$wl[]=$weight_lb[$i];
				$wk[]=$weight_kg[$i];
				$t[]=$tracking[$i];
				$v[]=$value[$i];
				$cy[]=$comodity[$i];
				$di[]=$dimm_in[$i];
				$dc[]=$dimm_cm[$i];
				$co[]=$comments[$i];

			}
		}
		$new_num=sizeof($t); //numero de nuevos registros
		
		if(sizeof($t)!=0){ //si existen nuevos registros

        for($i=0;$i<sizeof($t);$i++): //por cada nuevo valor del arreglo t[] (similar para todos los array ya que poseen el mismo index)
			$saveurl= new SaveUrl(); //objeto del modelo saveurl

			//Se guardan cada array a la base de dato	
      	 	$saveurl->lote=$l[$i];
           	$saveurl->receipt=$r[$i];
 		    $saveurl->manifest=$m[$i];
            $saveurl->awb=$a[$i];
            $saveurl->date=$d[$i];
            $saveurl->shipper=$s[$i];
    	   	$saveurl->account_rg=$ar[$i];
            $saveurl->account_id=$ai[$i];
            $saveurl->consignee=$ce[$i];
            $saveurl->pieces=$p[$i];
            $saveurl->weight_lb=$wl[$i];
            $saveurl->weight_kg=$wk[$i];
            $saveurl->tracking=$t[$i];
            $saveurl->value=$v[$i];
            $saveurl->comodity=$cy[$i];
            $saveurl->dimm_in=$di[$i];
            $saveurl->dimm_cm=$dc[$i];
            $saveurl->comment=$co[$i];
            $saveurl->save(); //guarda
				
    	endfor;
		$new_data=TrackTrTracking::model()->findAll("id >'$cantidad'"); //encuentra los registros nuevos 
		
		Yii::app()->user->setFlash('success','Se han Guardado Exitoxamente'); //enviamos mensaje flash
		$this->render('add_url',array('new_data'=>$new_data, 'new_num'=>$new_num, 'url'=>$url)); //enviamos varaibles a la vista add_url
		}
	
		else{ // de lo contrario si t[]= null
			Yii::app()->user->setFlash('notice','No existe ningun registro nuevo que guardar según el Tracking');//enviamos mensaje flash
			$this->render('load_url'); //carga la vista y accion load_url
		}
		
	}

	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
	/*	$model=new TrackTrTracking;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TrackTrTracking']))
		{
			$model->attributes=$_POST['TrackTrTracking'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	*/
		$this->render('load_url');
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TrackTrTracking']))
		{
			$model->attributes=$_POST['TrackTrTracking'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('TrackTrTracking');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TrackTrTracking('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TrackTrTracking']))
			$model->attributes=$_GET['TrackTrTracking'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=TrackTrTracking::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='track-tr-tracking-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
