<?php

require_once(CONTROL_ABS.'ProfilPrikazivac.php');

class KorisnikPrikazivac extends ProfilPrikazivac{
	
	static $stranica='';
	
	/** 
	 * Metoda za formiranje stranice
	 */
	static function formirajStranicu($config){
		$meni=self::definisiMeni();
		$stilovi=self::listaStilova();
		$skripte=self::listaSkripti();
		$sesija=self::definisiSesiju();
		if(isset($_GET['korisnik']) && empty($_GET['korisnik'])){
			self::$stranica='page404.php';
		}
		else{
			$profil=self::profilniPodaci($_GET['korisnik']);
			if(isset($profil) && $profil!=false && $profil!=0){
				self::$stranica='profil.php';
			}
			else self::$stranica='page404.php';
		}
		$sadrzaj=VIEW_ABS.self::$stranica;
		$nalog_meni=self::nalogMeni($sesija);
		require_once(VIEW_ABS.'template.php');
	}
}
?>