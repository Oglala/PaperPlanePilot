<?php

class OdjavljivanjeObradjivac{
	
	static $poruka;
	static $boja;
	static $stranica;
	static $boja_ivica;
	
	/** 
	 * Metoda za formiranje stranice
	 */
	static function formirajStranicu($config){
		$sesija=self::obrisiSesiju();
		$nalog_meni=self::nalogMeni($sesija);
		$meni=self::definisiMeni();
		$izvestaj['poruka']=self::$poruka;
		$izvestaj['boja']=self::$boja;
		$izvestaj['boja_ivica']=self::$boja_ivica;
		$sadrzaj=VIEW_ABS.self::$stranica;
		require_once(VIEW_ABS.'template.php');
	}
	
	/** 
	 * Metoda koja definise meni stranice
	 */
	static function definisiMeni(){
		 $stavke[0]=array('naziv'=>'home','link'=>'/pilot/home');
		 $stavke[1]=array('naziv'=>'o nama','link'=>'/pilot/onama');
		 if(session_id()!='pilot1sesija1'){
			session_id('pilot1sesija1');
			session_start();
		 }
		 if(isset($_SESSION['pravo'])){
			 if($_SESSION['pravo']==1 || $_SESSION['pravo']==2){ 
				$stavke[2]=array('naziv'=>'clanci','link'=>'/pilot/clanci');  
				$stavke[3]=array('naziv'=>'korisnici','link'=>'/pilot/korisnici');  
			 }
		 
		 }
		 return $stavke;
	}
	
	/** 
	 * Metoda koja definise sesiju
	 */
	static function obrisiSesiju(){
		if(session_id()==''){
			session_start();
		}
			session_destroy();
			self::$boja="#DAE1CC";
			self::$boja_ivica="#829066";
			self::$poruka="Odjavili ste se. <br /> Povratak na <a href='/pilot/'>pocetnu</a> stranicu.";
			self::$stranica="izvestaj.php";		
		
		$sesija=array('id' => null,'kor_ime' => null,'pravo' => null);
		
		return $sesija;
	}
	
	/** 
	 * Metoda koja definise meni za registraciju/prijavljivanje/odjavljivanje
	 */
	static function nalogMeni($sesija){
		$meni="";
		($sesija['id']!=null) ? $meni.="<a class='stavka_nalog_menija' href='/pilot/odjavljivanje'>odjavi se [ ".$sesija['kor_ime']." ]</a><a class='stavka_nalog_menija' href='/pilot/profil'>profil</a>" : 
									  $meni.="<a class='stavka_nalog_menija' href='/pilot/prijavljivanje'>prijavi se</a>
											<a class='stavka_nalog_menija' href='/pilot/registracija'>registruj se</a>";
		return $meni;
	}
}

?>