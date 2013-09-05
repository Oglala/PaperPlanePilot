<?php
$zahtev['metoda']=$_SERVER['REQUEST_METHOD'];
$zahtev['putanja']=$_SERVER['REQUEST_URI'];
require_once('routes.php');
require_once('config.php');

if($zahtev['metoda']=='GET'){ 
    switch($zahtev['putanja']){
		case "/pilot/": require_once(CONTROL_ABS.'HomePrikazivac.php');
						HomePrikazivac::formirajStranicu($config); break;
		case ((preg_match('/\/pilot\/home\/[0-9]+/',$zahtev['putanja'])) ? true:false): require_once(CONTROL_ABS.'HomePrikazivac.php');
																						$_GET['pag']=substr($zahtev['putanja'],12,strlen($zahtev['putanja']));
																						HomePrikazivac::formirajStranicu($config); break;
		case "/pilot/home": require_once(CONTROL_ABS.'HomePrikazivac.php');
							HomePrikazivac::formirajStranicu($config); break;
		case "/pilot/onama": require_once(CONTROL_ABS.'OnamaPrikazivac.php');
							OnamaPrikazivac::formirajStranicu($config); break;
		case "/pilot/registracija": require_once(CONTROL_ABS.'RegistracijaPrikazivac.php');
							RegistracijaPrikazivac::formirajStranicu($config); break;
		case "/pilot/prijavljivanje": require_once(CONTROL_ABS.'PrijavljivanjePrikazivac.php');
							PrijavljivanjePrikazivac::formirajStranicu($config); break;
		case "/pilot/odjavljivanje": require_once(CONTROL_ABS.'OdjavljivanjeObradjivac.php');
							OdjavljivanjeObradjivac::formirajStranicu($config); break;	
		case "/pilot/clanci": require_once(CONTROL_ABS.'ClanciPrikazivac.php');
							ClanciPrikazivac::formirajStranicu($config); break;	
		case ((preg_match('/\/pilot\/clanci\/[0-9]+/',$zahtev['putanja'])) ? true:false): require_once(CONTROL_ABS.'ClanciPrikazivac.php');
																					$_GET['pag']=substr($zahtev['putanja'],14,strlen($zahtev['putanja']));	
																					ClanciPrikazivac::formirajStranicu($config); break;	
		case "/pilot/noviclanak": require_once(CONTROL_ABS.'NoviClanakPrikazivac.php');
							NoviClanakPrikazivac::formirajStranicu($config); break;
		case "/pilot/korisnici": require_once(CONTROL_ABS.'KorisniciPrikazivac.php');
							KorisniciPrikazivac::formirajStranicu($config); break;
		case ((preg_match('/\/pilot\/korisnici\/[0-9]+/',$zahtev['putanja'])) ? true:false): require_once(CONTROL_ABS.'KorisniciPrikazivac.php');
																						$_GET['pag']=substr($zahtev['putanja'],17,strlen($zahtev['putanja']));	
																						KorisniciPrikazivac::formirajStranicu($config); break;
		case "/pilot/novikorisnici": require_once(CONTROL_ABS.'NoviKorisniciPrikazivac.php');
							NoviKorisniciPrikazivac::formirajStranicu($config); break;
		case ((preg_match('/\/pilot\/novikorisnici\/[0-9]+/',$zahtev['putanja'])) ? true:false): require_once(CONTROL_ABS.'NoviKorisniciPrikazivac.php');
																						$_GET['pag']=substr($zahtev['putanja'],21,strlen($zahtev['putanja']));	
																						NoviKorisniciPrikazivac::formirajStranicu($config); break;
		case "/pilot/profil": require_once(CONTROL_ABS.'ProfilPrikazivac.php');
							ProfilPrikazivac::formirajStranicu($config); break;
		case ((preg_match('/\/pilot\/korisnik\/[0-9]+/',$zahtev['putanja'])) ? true:false): require_once(CONTROL_ABS.'KorisnikPrikazivac.php');
																						$_GET['korisnik']=substr($zahtev['putanja'],16,strlen($zahtev['putanja']));	
																						KorisnikPrikazivac::formirajStranicu($config); break;
		default: require_once(CONTROL_ABS.'Prikazivac404.php');
				Prikazivac404::formirajStranicu($config);
	}
}
else if($zahtev['metoda']=='POST'){ 
    switch($zahtev['putanja']){
		case "/pilot/registracija": require_once(CONTROL_ABS.'RegistracijaObradjivac.php');
									RegistracijaObradjivac::formirajStranicu($config); break;
		case "/pilot/prijavljivanje": require_once(CONTROL_ABS.'PrijavljivanjeObradjivac.php');
									PrijavljivanjeObradjivac::formirajStranicu($config); break;
		case "/pilot/noviclanak": require_once(CONTROL_ABS.'NoviClanakObradjivac.php');
									NoviClanakObradjivac::formirajStranicu($config); break;
		case "/pilot/clanci/brisanje": require_once(CONTROL_ABS.'BrisanjeClankaObradjivac.php');
									BrisanjeClankaObradjivac::formirajStranicu($config); break;
		case "/pilot/korisnici/brisanje": require_once(CONTROL_ABS.'BrisanjeKorisnikaObradjivac.php');
									BrisanjeKorisnikaObradjivac::formirajStranicu($config); break;
		default: require_once(CONTROL_ABS.'Prikazivac404.php');
				Prikazivac404::formirajStranicu($config);
	}
}
?>