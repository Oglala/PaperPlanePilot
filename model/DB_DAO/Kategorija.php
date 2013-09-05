<?php
class Kategorija{
	
	private $broker;
	private $tabela="kategorija";
	
	public function __construct($broker){
		$this->broker=$broker;
	}
	
	public function novaKategorija($naziv,$opis){
		$kolone="naziv,opis";
		$vrednosti="'{$naziv}','{$opis}'";
		$rezultat=$this->broker->unesi($this->tabela,$kolone,$vrednosti);
		return $rezultat;
	
	}
	
	public function izmeniKategoriju($id,$naziv,$opis){
		$vrednosti="naziv='{$naziv}',opis='{$opis}'";
		$uslov="id={$id}";
		$rezultat=$this->broker->osvezi($this->tabela,$vrednosti,$uslov);
		return $rezultat;
	}
	
	public function obrisiKategoriju($id){
		$uslov="id={$id}";
		$rezultat=$this->broker->obrisi($this->tabela,$uslov);
		return $rezultat;
	}
	
	public function dajKategoriju($id){
		$kolone="*";
		$uslov="id={$id}";
		$rezultat=$this->broker->vratiRed($this->tabela,$kolone,$uslov);
		return $rezultat;
	}
	
	public function dajKategorije($kljuc="",$vrednost=""){
		$kolone="*";
		if($kljuc!="" && $vrednost!=""){
			$uslov="{$kljuc}='{$vrednost}'";
		}
		$uslov="";
		$poredak="naziv ASC";
		$limit="";
		$rezultat=$this->broker->vratiRedove($this->tabela,$kolone,$uslov,$poredak,$limit);
		return $rezultat;
	}
}
?>