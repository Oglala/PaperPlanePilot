<?php
class Pravo{
	
	private $broker;
	private $tabela="pravo";
	
	public function __construct($broker){
		$this->broker=$broker;
	}
	
	public function dajPravo($id){
		$kolone="*";
		$uslov="id={$this->broker->obradiString($id)}";
		$rezultat=$this->broker->vratiRed($this->tabela,$kolone,$uslov);
		return $rezultat;
	}
	
	public function dajPrava($kljuc="",$vrednost=""){
		$kolone="*";
		if($kljuc!="" && $vrednost!=""){
			$uslov="{$kljuc}='{$this->broker->obradiString($vrednost)}'";
		}
		else{
			$uslov="";
		}
		$poredak="id ASC";
		$limit="";
		$rezultat=$this->broker->vratiRedove($this->tabela,$kolone,$uslov,$poredak,$limit);
		return $rezultat;
	}
}
?>