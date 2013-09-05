<?php

class BrisanjeKorisnikaObradjivac{

	static $poruka="";
	static $boja="";
	static $boja_ivica;
	static $stranica='izvestaj.php';
	
	/** 
	 * Metoda za formiranje stranice
	 */
	static function formirajStranicu($config){
		$info=self::obrisiKorisnika();
		$izvestaj['poruka']=self::$poruka;
		$izvestaj['boja']=self::$boja;
		$izvestaj['boja_ivica']=self::$boja_ivica;
		$meni=static::definisiMeni();
		$stilovi=static::listaStilova();
		$skripte=static::listaStilova();
		$sesija=self::definisiSesiju();
		$nalog_meni=self::nalogMeni($sesija);
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
	 * Metoda koja definise ucitavanje css stranica
	 */
	static function listaStilova(){
		$stilovi="";
		return $stilovi;
	}
	
	/** 
	 * Metoda koja definise ucitavanje js stranica
	 */
	static function listaSkripti(){
		$skripte="";
		return $skripte;
	}
	
	/** 
	 * Metoda koja definise sesiju
	 */
	static function definisiSesiju(){
		if(session_id()==''){
			session_start();
		}
		isset($_SESSION['id']) ? $sesija['id']=$_SESSION['id'] : $sesija['id']=null;
		isset($_SESSION['kor_ime']) ? $sesija['kor_ime']=$_SESSION['kor_ime'] : $sesija['kor_ime']=null;
		isset($_SESSION['pravo']) ? $sesija['pravo']=$_SESSION['pravo'] : $sesija['pravo']=null;
		
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
	
	/** 
	 * Metoda za brisanje clanka iz baze
	 */

	static function obrisiKorisnika(){
		require_once(MODEL_ABS.'DB_DAO/Broker_baze.php');
		require_once(MODEL_ABS.'DB_DAO/Korisnik.php');
		
		$broker=new Broker();
		$korisnik=new Korisnik($broker);
		
		$rezultat=$korisnik->obrisiKorisnika($_POST['id_korisnika']);
		if($rezultat==false || !$rezultat){
			self::$poruka='Brisanje nije uspelo.';
			self::$boja='#f2dede';
			self::$boja_ivica='#b94a48';
			return;
		}
		self::$poruka='Clanak je uspesno obrisan. Povratak na stranicu sa listom <a href="/pilot/korisnici">korisnika</a>.';
		self::$boja="#DAE1CC";
		self::$boja_ivica="#829066";
		return;
		
	}

}
?>