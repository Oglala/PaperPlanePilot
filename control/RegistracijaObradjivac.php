<?php
class RegistracijaObradjivac{
	
	static $poruka="";
	static $boja="";
	static $boja_ivica;
	
	/** 
	 * Metoda za formiranje stranice
	 */
	static function formirajStranicu($config){
		self::registruj();
		$izvestaj['poruka']=self::$poruka;
		$izvestaj['boja']=self::$boja;
		$izvestaj['boja_ivica']=self::$boja_ivica;
		$meni=self::definisiMeni();
		$sesija=self::definisiSesiju();
		$nalog_meni=self::nalogMeni($sesija);
		$sadrzaj=VIEW_ABS."izvestaj.php";
		require_once(VIEW_ABS.'template.php');
	}
	
	/** 
	 * Metoda za registraciju korisnika
	 */
	static function registruj(){
		$podaci=self::obradiPodatke();
		if(!$podaci) return;
		require_once(MODEL_ABS.'DB_DAO/Broker_baze.php');
		require_once(MODEL_ABS.'DB_DAO/Korisnik.php');
		
		$broker=new Broker();
		$korisnik=new Korisnik($broker);
		
		if($korisnik->noviKorisnik($podaci['user'],$podaci['pass'],$podaci['mail'])!=false){
			self::$poruka="Uspesno ste registrovani. Povratak na <a href='/pilot'>home</a> stranicu.";
			self::$boja="#DAE1CC";
			self::$boja_ivica="#829066";
		}
		else{
			self::$poruka="Doslo je do greske prilikom pokusaja registracije, molimo Vas pokusajte ponovo. Povratak na stranicu za <a href='/pilot/registracija'>registraciju</a> stranicu.";
			self::$boja="#f2dede";
			self::$boja_ivica="#b94a48";
		}	
	}
	
	
	/** 
	 * Metoda koja ucitava i obradjuje unesene podatke
	 */
	static function obradiPodatke(){
		$podaci['user']=trim($_POST['user']);
		$podaci['pass']=trim($_POST['pass']);
		$podaci['repass']=trim($_POST['repass']);
		$podaci['mail']=trim($_POST['mail']);
		
		$podaci['user']=strip_tags($podaci['user']);
		$podaci['pass']=strip_tags($podaci['pass']);
		$podaci['repass']=strip_tags($podaci['repass']);
		$podaci['mail']=strip_tags($podaci['mail']);
		
		if(strlen($podaci['user'])<3){
			self::$poruka="Korisnicko ime mora da sadrzi najmanje 3 karaktera. Povratak na stranicu za <a href='/pilot/registracija'>registraciju</a>.";
			self::$boja="#f2dede";
			self::$boja_ivica="#b94a48"; return;
		}
		
		if($podaci['pass']!=$podaci['repass']){
			self::$poruka="Pogresili ste prilikom unosa lozinke. Povratak na stranicu za <a href='/pilot/registracija'>registraciju</a>."; return false;
			self::$boja="#f2dede";
			self::$boja_ivica="#b94a48"; return;
		}
		
		if(strlen($podaci['pass'])<6){
			self::$poruka="Lozinka mora da sadrzi najmanje 6 karaktera. Povratak na stranicu za <a href='/pilot/registracija'>registraciju</a>."; return false;
			self::$boja="#f2dede";
			self::$boja_ivica="#b94a48"; return;
		}
		
		$podaci['pass']=hash('md5',$podaci['pass']);
		
		if(!preg_match('/@/',$podaci['mail'])){
			self::$poruka="Uneli ste neispravan format e-mail adrese. Povratak na stranicu za <a href='/pilot/registracija'>registraciju</a>."; return false;
			self::$boja="#f2dede";
			self::$boja_ivica="#b94a48"; return;
		}
		
		return $podaci;
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
}
?>