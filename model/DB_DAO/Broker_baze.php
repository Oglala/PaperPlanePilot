<?php

class Broker{
	
	private $mysqli;
	private $adresa_db="localhost";
	private $korisnik_db="root";
	private $lozinka_db="";
	private $ime_db="pilot";
	
	public function __construct(){
		$this->mysqli=new mysqli($this->adresa_db,$this->korisnik_db,$this->lozinka_db,$this->ime_db);
		if($this->mysqli->connect_errno)
			throw new Exception("Greska pri konekciji: {$this->mysqli->connect_errno}, {$this->mysqli->connect_error}");
	}

	public function unesi($tabela,$kolone,$vrednosti){
		$upit="INSERT INTO $tabela ($kolone) VALUES ($vrednosti)";
		//echo $upit;
		$rezultat=$this->mysqli->query($upit);
		
		if($rezultat){
			//$this->dnevnik("\n Novi red dodat u tabelu '{$tabela}'.");
			return $this->mysqli->insert_id;
		}
		else{
			//$this->dnevnik("\n Neuspeo pokusaj dodavanja novog reda u tabelu '{$tabela}'.");
			return false;
		}
	}
	
	
	public function osvezi($tabela,$vrednosti,$uslov) {
		$upit="UPDATE $tabela SET $vrednosti WHERE $uslov";
		//echo $upit;
		$rezultat=$this->mysqli->query($upit);
		
		if($rezultat){
			//$this->dnevnik("\n Izvrsena modifikacije u tabeli '{$tabela}'.");
			return true;
		}
		else{
			//$this->dnevnik("\n Greska prilikom pokusaja modifikacije u tabeli '{$tabela}'.");
			return false;
		}
	}
	
	public function obrisi($tabela,$uslov) {
		$upit="DELETE FROM $tabela WHERE $uslov";
		$rezultat=$this->mysqli->query($upit);
		
		if($rezultat){
			//$this->dnevnik("\n Brisanje u tabeli '{$tabela}'.");
			return true;
		}
		else{
			//$this->dnevnik("\n Greska prilikom pokusaja brisanja u tabeli '{$tabela}'.");
			return false;
		}
	}
	
	public function vratiRed($tabela,$kolone,$uslov) {
		$upit="SELECT $kolone FROM $tabela WHERE $uslov";
		//echo $upit;
		$rezultat=$this->mysqli->query($upit);
		if($rezultat==false){
			return 0;
		} 
		else{
			$br_redova=$rezultat->num_rows;
			if($br_redova==0){
				return 0;
			} 
			else 
			{
					$red=$rezultat->fetch_assoc();
					return $red;
			}
		}
	}
	
	public function vratiRedove($tabela,$kolone,$uslov,$poredak,$limit) {	
		$upit="SELECT $kolone FROM $tabela";
		if(!empty($uslov)) $upit= $upit." WHERE $uslov";
		if(!empty($poredak)) $upit=$upit." ORDER BY $poredak";
		if(!empty($limit)) $upit=$upit." LIMIT $limit";
		//echo $upit;
		$rezultat=$this->mysqli->query($upit);
		if($rezultat==false){
			return 0;
		} else {
			$br_redova=$rezultat->num_rows;
			if($br_redova==0){
				return 0;
			} else {
				while($red=$rezultat->fetch_assoc()) {
				$redovi[]=$red;
				}
				return $redovi;
			}
		}
	}
	
	public function vratiSpojeneRedove($tabela1,$tabela2,$kolone,$kolona,$poredak="",$limit="",$uslov=""){
		$upit="SELECT * FROM {$this->mysqli->real_escape_string($tabela1)} 
		INNER JOIN {$this->mysqli->real_escape_string($tabela2)} 
		ON {$this->mysqli->real_escape_string($tabela1)}.{$this->mysqli->real_escape_string($kolona)}={$this->mysqli->real_escape_string($tabela2)}.{$this->mysqli->real_escape_string($kolona)}"; 
		if($uslov!="") $upit.=" WHERE {$this->mysqli->real_escape_string($uslov)}";
		if($poredak!="") $upit.=" ORDER BY {$this->mysqli->real_escape_string($poredak)}";
		if($limit!="") $upit.=" LIMIT {$this->mysqli->real_escape_string($limit)}";
		$rezultat=$this->mysqli->query($upit);
		if($rezultat==false){
			return 0;
		} else {
			$br_redova=$rezultat->num_rows;
			if($br_redova==0){
				return 0;
			} else {
				while($red=$rezultat->fetch_assoc()) {
				$redovi[]=$red;
				}
				return $redovi;
			}
		}
	}
	
	public function obradiString($string) {
		$rezultat=$this->mysqli->real_escape_string($string);
		return $rezultat;
	}
	
	/*public function dnevnik($poruka) {
		$file=fopen("log","a");
		fputs($file,$poruka);
		fclose($file);
	}*/
	
	public function brojRedova($tabela,$kolona,$uslov=""){
		$upit="SELECT COUNT({$kolona}) as broj FROM {$tabela}";
		if($uslov!=""){$upit.=" WHERE {$uslov}";}
		//echo $upit;
		$broj_redova=$this->mysqli->query($upit);
		$rez=$broj_redova->fetch_assoc();
		return $rez['broj'];
	}
}
?>