<?php
class Clanak{
	
	private $broker;
	private $tabela="clanak";
	
	public function __construct($broker){
		$this->broker=$broker;
	}

	public function noviClanak($id_kor,$id_kat,$naslov,$opis,$tekst,$slika=""){
		$kolone="id_korisnik,id_kategorija,naslov,opis,tekst,slika";
		$vrednosti="{$id_kor},{$id_kat},'{$this->broker->obradiString($naslov)}','{$this->broker->obradiString($opis)}','{$this->broker->obradiString($tekst)}','{$this->broker->obradiString($slika)}'";
		$rezultat=$this->broker->unesi($this->tabela,$kolone,$vrednosti);
		return $rezultat;
	}
	
	public function izmeniClanak($id,$id_kat,$naslov,$opis,$tekst/*,$slika*/){
		$vrednosti="id_kategorija={$this->broker->obradiString($id_kat)},naslov='{$this->broker->obradiString($naslov)}',opis='{$this->broker->obradiString($opis)}',tekst='{$this->broker->obradiString($tekst)}'"; //",slika='{$this->broker->obradiString($slika)}'";
		$uslov="id={$id}";
		$rezultat=$this->broker->osvezi($this->tabela,$vrednosti,$uslov);
		return $rezultat;
	}
	
	public function obrisiClanak($id){
		$uslov="id={$id}";
		$rezultat=$this->broker->obrisi($this->tabela,$uslov);
		return $rezultat;
	}
	
	public function dajClanak($id){
		$kolone="*";
		$uslov="id={$id}";
		$rezultat=$this->broker->vratiRed($this->tabela,$kolone,$uslov);
		return $rezultat;
	}
	
	public function dajClanke($kljuc="",$vrednost=""){
		$kolone="*";
		if($kljuc!="" && $vrednost!=""){
			$uslov="{$kljuc}='{$this->broker->obradiString($vrednost)}'";
		}
		$uslov="";
		$poredak="id DESC";
		$limit="0,10";
		$rezultat=$this->broker->vratiRedove($this->tabela,$kolone,$uslov,$poredak,$limit);
		return $rezultat;
	}
	
	public function limitClanci($pag,$korak,$kljuc="",$vrednost=""){
		$kolone="*";
		if($kljuc!="" && $vrednost!=""){
			$uslov="{$kljuc}='{$this->broker->obradiString($vrednost)}'";
		}
		$uslov="";
		$pocetak=$pag*$korak;
		$poredak="id DESC";
		$limit="{$pocetak} , {$korak}";
		$rezultat=$this->broker->vratiRedove($this->tabela,$kolone,$uslov,$poredak,$limit);
		return $rezultat;
	}
	
	public function pretragaClanci($pag,$korak,$pojam){
		$kolone="*";
		$uslov="naslov LIKE '%{$pojam}%' OR opis LIKE '%{$pojam}%' OR tekst LIKE '%{$pojam}%'";
		$pocetak=$pag*$korak;
		$poredak="id DESC";
		$limit="{$pocetak} , {$korak}";
		$rezultat=$this->broker->vratiRedove($this->tabela,$kolone,$uslov,$poredak,$limit);
		return $rezultat;
	}
	
	public function brojanjeClanaka($uslov=""){
		$kolona="id";
		$rezultat=$this->broker->brojRedova($this->tabela,$kolona,$uslov);
		return $rezultat;
	}
}
?>