<?php
class Slika{

	public function unesi($slika){
		if($slika['type']=="image/jpeg" || $slika['type']=="image/png" || $slika['type']=="image/gif"){
			if(!file_exists(IMG_ROOT.$_FILES['slika']['name'])){
				$putanja=IMG_ROOT.$slika['name'];
				move_uploaded_file($slika['tmp_name'],IMG_ABS.$slika['name']);	
			}
			else{
				$putanja=NULL;
				$putanja=IMG_ROOT.$slika['name'];
				return false;
			}
		}
		else{
			$putanja=NULL;
			//echo "Nedozvoljen format fajla.";
			return false;
		}
		return $putanja;
	}
	
	public function obrisi($link){
		unlink($link);
	}
}

?>