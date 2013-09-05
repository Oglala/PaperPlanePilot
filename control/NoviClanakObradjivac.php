<?php

class NoviClanakObradjivac{

	static $poruka="";
	static $boja="";
	static $boja_ivica;
	static $stranica='izvestaj.php';
	
	/** 
	 * Metoda za formiranje stranice
	 */
	static function formirajStranicu($config){
		$info=self::sacuvajClanak();
		$izvestaj['poruka']=self::$poruka;
		$izvestaj['boja']=self::$boja;
		$izvestaj['boja_ivica']=self::$boja_ivica;
		$meni=static::definisiMeni();
		$stilovi=static::listaStilova();
		$skripte=static::listaStilova();
		$sesija=self::definisiSesiju();
		$nalog_meni=self::nalogMeni($sesija);
		$clanci=self::listaClanaka();
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
	
	static function sacuvajClanak(){
		$podaci=self::obradiPodatke();
		if($_FILES['slika']['name']!=""){
			require_once(MODEL_ABS.'pomocnici/Slika.php');
			$slika=new Slika();
			$putanja=$slika->unesi($_FILES['slika']);
			if($putanja==false || !isset($putanja)){
				self::$poruka='Doslo je je do greske prilikom cuvanja slike. Ime je zauzeto ili je tip nedozvoljen.';
				self::$boja='#f2dede';
				self::$boja_ivica='#b94a48';
				return;
			}
			$podaci['slika']=$putanja;
		}
		else $podaci['slika']="";
		
		require_once(MODEL_ABS.'DB_DAO/Broker_baze.php');
		require_once(MODEL_ABS.'DB_DAO/Clanak.php');
		
		$broker=new Broker();
		$clanak=new Clanak($broker);
		
		$rezultat=$clanak->noviClanak($podaci['id_korisnika'],$podaci['id_kategorije'],$podaci['naslov'],$podaci['opis'],$podaci['tekst'],$podaci['slika']);
		if($rezultat==false || !$rezultat){
			self::$poruka='Doslo je je do greske prilikom cuvanja clanka.';
			self::$boja='#f2dede';
			self::$boja_ivica='#b94a48';
			return;
		}
		self::$poruka='Clanak je uspesno sacuvan. Povratak na stranicu sa <a href="/pilot/clanci">clancima</a>';
		self::$boja="#DAE1CC";
		self::$boja_ivica="#829066";
		return;
		
	}
	
	static function obradiPodatke(){
		$clanak['naslov']=strip_tags($_POST['naslov']);
		$clanak['opis']=strip_tags($_POST['opis']);
		$clanak['tekst']=strip_tags($_POST['tekst']);
		$clanak['id_kategorije']=strip_tags($_POST['id_kategorije']);
		if(session_id()!='pilot1sesija1'){
			session_id('pilot1sesija1');
			session_start();
		}
		$clanak['id_korisnika']=$_SESSION['id'];
		
		return $clanak;
	}
}
?>