<?php

require(CONTROL_ABS.'Prikazivac.php');

class HomePrikazivac extends Prikazivac{
	
	static $stranica="pocetna.php";
	
	/** 
	 * Metoda za formiranje stranice
	 */
	static function formirajStranicu($config){
		$meni=self::definisiMeni();
		$stilovi=static::listaStilova();
		$skripte=static::listaSkripti();
		$sesija=self::definisiSesiju();
		$clanci=static::listaClanaka();
		$nalog_meni=self::nalogMeni($sesija);
		$sadrzaj=VIEW_ABS.static::$stranica;
		require_once(VIEW_ABS.'template.php');
	}
	
	/** 
	 * Metoda koja definise ucitavanje css stranica
	 */
	static function listaStilova(){
		$stilovi="<link rel='stylesheet' type='text/css' href='".CSS_ROOT."galerija.css'>";
		return $stilovi;
	}
	
	/** 
	 * Metoda koja definise ucitavanje js stranica
	 */
	static function listaSkripti(){
		$skripte="<script src='".JS_ROOT."galerija.js'></script>";
		return $skripte;
	}
	
	/** 
	 * Metoda koja definise niz osnovnih informacija o clancima iz baze
	 */
	static function listaClanaka(){
		require_once(MODEL_ABS.'DB_DAO/Broker_baze.php');
		require_once(MODEL_ABS.'DB_DAO/Clanak.php');
		
		$broker=new Broker();
		$clanak=new Clanak($broker);
		(isset($_GET['pag'])) ? $pag=$_GET['pag'] : $pag=0;
		(isset($_GET['korak'])) ? $korak=$_GET['korak'] : $korak=5;
		
		$rezultat['clanci']=$clanak->limitClanci($pag,$korak);
		$br_clanaka=$clanak->brojanjeClanaka();
		$rezultat['pags']=ceil($br_clanaka/$korak);
		$rezultat['pag']=$pag;
		
		return $rezultat;
	}
}
?>