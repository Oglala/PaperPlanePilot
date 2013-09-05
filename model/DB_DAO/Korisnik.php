<?php
class Korisnik{
	
	private $broker;
	private $tabela="korisnik";
	
	public function __construct($broker){
		$this->broker=$broker;
	}

	public function noviKorisnik($user,$pass,$mail,$avatar="",$ime="John Doe"){
		$kolone="user,pass,mail,avatar,ime";
		$vrednosti="'{$this->broker->obradiString($user)}','{$this->broker->obradiString($pass)}','{$this->broker->obradiString($mail)}','{$this->broker->obradiString($avatar)}','{$this->broker->obradiString($ime)}'";
		$rezultat=$this->broker->unesi($this->tabela,$kolone,$vrednosti);
		return $rezultat;
	}
	
	/*public function izmeniPodatkeKorisnika($id,$mail,$ime,$pravo){
		$vrednosti="mail='{$this->broker->obradiString($mail)}',id_pravo='{$this->broker->obradiString($pravo)}',ime='{$this->broker->obradiString($ime)}'";
		$uslov="id_korisnik={$this->broker->obradiString($id)}";
		$rezultat=$this->broker->osvezi($this->tabela,$vrednosti,$uslov);
		return $rezultat;
	}*/
	
	public function obrisiKorisnika($id){
		$uslov="id={$this->broker->obradiString($id)}";
		$rezultat=$this->broker->obrisi($this->tabela,$uslov);
		return $rezultat;
	}
	
	public function dajKorisnika($id){
		$kolone="*";
		$uslov="id={$this->broker->obradiString($id)}";
		$rezultat=$this->broker->vratiRed($this->tabela,$kolone,$uslov);
		return $rezultat;
	}
	
	public function dajKorisnike($kljuc="",$vrednost=""){
		$kolone="*";
		if($kljuc!="" && $vrednost!=""){
			$uslov="{$kljuc}='{$this->broker->obradiString($vrednost)}'";
		}
		else{
			$uslov="";
		}
		$poredak="";
		$limit="";
		$rezultat=$this->broker->vratiRedove($this->tabela,$kolone,$uslov,$poredak,$limit);
		return $rezultat;
	}
	
	public function promenaLozinke($id,$pass){
		if(strlen($pass)<6){
			return false;
		}
		else{
			$uslov="id={$this->broker->obradiString($id)}";
			$vrednost="pass='{$this->broker->obradiString($pass)}'";
			$rezultat=$this->broker->osvezi($this->tabela,$vrednost,$uslov);
			return $rezultat;
		} 
	}
	
	public function promenaAvatara($id,$putanja){
		$uslov="id={$this->broker->obradiString($id)}";
		$vrednost="avatar='{$this->broker->obradiString($putanja)}'";
		$rezultat=$this->broker->osvezi($this->tabela,$vrednost,$uslov);
		return $rezultat;
	}
	
	public function dajKorisnikeLimit($pag,$korak,$kljuc="",$vrednost=""){
		$kolone="*";
		$uslov="";
		if($kljuc!="" && $vrednost!=""){
			$uslov="{$kljuc}='{$this->broker->obradiString($vrednost)}'";
		}
		$pocetak=$pag*$korak;
		$poredak="user DESC";
		$limit="{$pocetak} , {$korak}";
		$rezultat=$this->broker->vratiRedove($this->tabela,$kolone,$uslov,$poredak,$limit);
		return $rezultat;
	}
	
	public function brojanjeKorisnika($uslov=""){
		$kolona="id";
		$rezultat=$this->broker->brojRedova($this->tabela,$kolona,$uslov);
		return $rezultat;
	}
}
?>