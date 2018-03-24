<?php
 $arrContextOptions=array(
						"ssl"=>array(
						"verify_peer"=>false,
						"verify_peer_name"=>false,
					),
				);  
 $terms = $_GET['data'];

 $data = file_get_contents("https://maps.googleapis.com/maps/api/place/autocomplete/json?input=".$terms."&types=geocode&key=APIKEY",false,stream_context_create($arrContextOptions));


 $arr = array();
 $i=0;
 foreach(json_decode($data)->predictions as $item){
 $arr[$i] = array(
 'id' => $i,
 'text' => $item->description
 );
 $i++;
 }

 echo json_encode($arr);

?>