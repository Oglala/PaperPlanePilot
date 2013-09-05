<?php

require(CONTROL_ABS.'KorisniciPrikazivac.php');

class NoviKorisniciPrikazivac extends KorisniciPrikazivac{
	
	static $stranica='novikorisnici.php';
	
	/** 
	 * Metoda za formiranje stranice
	 */
	static function formirajStranicu($config){
		$meni=self::definisiMeni();
		$stilovi=self::listaStilova();
		$skripte=self::listaStilova();
		$sesija=self::definisiSesiju();
		$nalog_meni=self::nalogMeni($sesija);
		$korisnici=static::listaKorisnika();
		$sadrzaj=VIEW_ABS.static::$stranica;
		require_once(VIEW_ABS.'template.php');
	}
	
	/** 
	 * Metoda koja definise niz osnovnih informacija o clancima iz baze
	 */
	static function listaKorisnika(){
		require_once(MODEL_ABS.'DB_DAO/Broker_baze.php');
		require_once(MODEL_ABS.'DB_DAO/Korisnik.php');
		
		$broker=new Broker();
		$korisnik=new Korisnik($broker);
		(isset($_GET['pag'])) ? $pag=$_GET['pag'] : $pag=0;
		(isset($_GET['korak'])) ? $korak=$_GET['korak'] : $korak=10;
		$kljuc='id_pravo';
		$vrednost=4;
		$uslov="id_pravo='4'";
		
		$rezultat['korisnici']=$korisnik->dajKorisnikeLimit($pag,$korak,$kljuc,$vrednost);
		$br_korisnika=$korisnik->brojanjeKorisnika($uslov);
		$rezultat['pags']=ceil($br_korisnika/$korak);
		$rezultat['pag']=$pag;
		
		return $rezultat;
	}
}
?>