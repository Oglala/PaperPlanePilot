<?php

require(CONTROL_ABS.'Prikazivac.php');

class ClanciPrikazivac extends Prikazivac{

	static $stranica='clanci.php';
	
	/** 
	 * Metoda za formiranje stranice
	 */
	static function formirajStranicu($config){
		$meni=self::definisiMeni();
		$stilovi=self::listaStilova();
		$skripte=self::listaStilova();
		$sesija=self::definisiSesiju();
		$nalog_meni=self::nalogMeni($sesija);
		$clanci=self::listaClanaka();
		$sadrzaj=VIEW_ABS.static::$stranica;
		require_once(VIEW_ABS.'template.php');
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