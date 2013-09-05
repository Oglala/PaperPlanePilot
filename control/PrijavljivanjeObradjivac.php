<?php

class PrijavljivanjeObradjivac{
	
	static $poruka;
	static $boja;
	static $stranica;
	static $boja_ivica;
	
	/** 
	 * Metoda za formiranje stranice
	 */
	static function formirajStranicu($config){
		self::prijavi();
		$meni=self::definisiMeni();
		$izvestaj['poruka']=self::$poruka;
		$izvestaj['boja']=self::$boja;
		$izvestaj['boja_ivica']=self::$boja_ivica;
		$sesija=self::definisiSesiju();
		$nalog_meni=self::nalogMeni($sesija);
		$sadrzaj=VIEW_ABS.self::$stranica;
		require_once(VIEW_ABS.'template.php');
	}
	
	/** 
	 * Metoda koja definise meni stranice
	 */
	static function prijavi(){
		$podaci['user']=trim($_POST['user']);
		$podaci['pass']=trim($_POST['pass']);
	
		$podaci['user']=strip_tags($podaci['user']);
		$podaci['pass']=strip_tags($podaci['pass']);
		
		require_once(MODEL_ABS.'DB_DAO/Broker_baze.php');
		require_once(MODEL_ABS.'DB_DAO/Korisnik.php');
		
		$broker=new Broker();
		$korisnik=new Korisnik($broker);
		
		$rezultat=$korisnik->dajKorisnike('user',$podaci['user']);
		if(!$rezultat || $rezultat==0 || $rezultat==false){
			self::$poruka="Neispravno korisnicko ime i/ili lozinka.";
			self::$stranica="izvestaj.php";
			self::$boja="#f2dede";
			self::$boja_ivica="#b94a48";
			return;
		}
		
		if(self::verifikatorLozinke($podaci['pass'],$rezultat[0]['pass'])==false){
			self::$poruka="Neispravno korisnicko ime i/ili lozinka.";
			self::$stranica="izvestaj.php";
			self::$boja="#f2dede";
			self::$boja_ivica="#b94a48";
			return;
		}
		$sesija=self::punjenjeSesije($rezultat[0]);
		self::$stranica='izvestaj.php';
		self::$poruka="Dobro dosli {$sesija['kor_ime']}.<br /> Povratak na <a href='/pilot/'>pocetnu</a> stranicu.";
		self::$boja="#DAE1CC";
		self::$boja_ivica="#829066";
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
	 * Metoda za verifikaciju lozinke
	 */
	static function verifikatorLozinke($unos,$hash){
		$unos=hash('md5',$unos);
		if($unos==$hash) return true;
		else return false;
	}
	
	/** 
	 * Metoda koja definise meni stranice
	 */
	static function punjenjeSesije($korisnik){
		//if(session_status()!==PHP_SESSION_ACTIVE) session_start();
		if(session_id()==''){
			session_start();
		}
		
		$_SESSION['id']=$korisnik['id'];
		$_SESSION['kor_ime']=$korisnik['user'];
		$_SESSION['pravo']=$korisnik['id_pravo'];
		$sesija=array('id'=>$korisnik['id'],'kor_ime'=>$korisnik['user'],'pravo'=>$korisnik['id_pravo']);
		
		return $sesija;
	}
	
	/** 
	 * Metoda koja definise sesiju
	 */
	static function definisiSesiju(){
		if(session_id()=='') session_start();
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