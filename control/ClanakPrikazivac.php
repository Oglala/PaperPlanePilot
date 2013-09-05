<?php

require_once(CONTROL_ABS."Prikazivac");

class ClanakPrikazivac extends Prikazivac{
	
	static $stranica;
	
	/** 
	 * Metoda za formiranje stranice
	 */
	static function formirajStranicu($config){
		$sesija=self::definisiSesiju();
		$meni=self::definisiMeni();
		$stilovi=self::listaStilova();
		$skripte=self::listaStilova();
		$nalog_meni=self::nalogMeni($sesija);
		$sadrzaj=VIEW_ABS.static::$stranica;
		require_once(VIEW_ABS.'template.php');
	}
	
	
}
?>