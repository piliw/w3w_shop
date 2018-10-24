<?php 
	function getCates(){
		if($data=DB::table('cate')->get()){
			
			return $data;
		}
	}
 ?>