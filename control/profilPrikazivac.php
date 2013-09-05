<?php

require(CONTROL_ABS.'Prikazivac.php');

class ProfilPrikazivac extends Prikazivac{
	
	static $stranica='profil.php';
	
	/** 
	 * Metoda za formiranje stranice
	 */
	static function formirajStranicu($config){
		$meni=self::definisiMeni();
		$stilovi=self::listaStilova();
		$skripte=self::listaSkripti();
		$sesija=self::definisiSesiju();
		$profil=self::profilniPodaci($sesija['id']);
		if(isset($profil) && $profil!=false && $profil!=0){
			self::$stranica='profil.php';
		}
		else self::$stranica='page404.php';
		$sadrzaj=VIEW_ABS.self::$stranica;
		$nalog_meni=self::nalogMeni($sesija);
		require_once(VIEW_ABS.'template.php');
	}
	
	/** 
	 * Metoda koja definise niz osnovnih informacija o clancima iz baze
	 */
	static function profilniPodaci($id){
		require_once(MODEL_ABS.'DB_DAO/Broker_baze.php');
		require_once(MODEL_ABS.'DB_DAO/Korisnik.php');
		
		$broker=new Broker();
		$korisnik=new Korisnik($broker);
		
		$profil=$korisnik->dajKorisnika($id);
		
		return $profil;
	}
}
?>