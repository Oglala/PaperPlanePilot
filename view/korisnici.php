<div style='margin-top:20px;'>
	<style>
		.kat{
			height:20px;
			border-bottom:1px solid #e5e5e5;
			margin-top:5px;padding-left:10px;
		}
		.kat a{
			//text-decoration:none;
			//color:#636365;
		}
		.tabela{
			border-collapse:collapse;
			margin-bottom:10px;
			width:100%
		}
		.tabela td{
			border-top:1px solid #e5e5e5;
			padding:10px;
			text-align:center;
			border-right:1px solid #e5e5e5;
		}
		.tabela th{
			height:20px;
			color:#333333;
			border-right:1px solid #e5e5e5;
		}
		.tabela tr:first-child:hover{
			background:#ffffff;
		}
		.tabela tr:last-child:hover{
			background:#ffffff;
		}
		.tabela tr:hover{
			background:#f7f7f7;
		}
		#korisnici_lista{
			margin-top:20px;
			margin-left:50px;padding:0px;
		}
	</style>
	<div style='float:left;width:25%;margin:0px;'>
		<div class='kat' style='border-color:#08c;'><a class='linkovi' href='/pilot/korisnici'>Korisnici</a></div>
		<div class='kat'><a class='linkovi' href='/pilot/novikorisnici'>Novi korisnici</a></div>
	</div>
	<div style='float:left;width:75%;margin:0px;'>
		<div id='korisnici_lista'>
			<?php
				if(isset($korisnici['korisnici']) && $korisnici['korisnici']!=0){
					echo "<table class='tabela'><th>#</th><th>Korisnicko ime</th><th>E-mail</th><th>Pravo</th><th style='border-right:0px;'></th>";
					foreach($korisnici['korisnici'] as $korisnik){
						switch($korisnik['id_pravo']){
							case '1': $pravo='administrator'; break;
							case '2': $pravo='moderator'; break;
							case '3': $pravo='korisnik'; break;
							case '4': $pravo='neaktivan'; break;
							default: $pravo='bez prava'; break;
						}
						echo  <<<EOT
						<tr style='border-top:1px solid gray;'>
							<td>{$korisnik['id']}</td><td><a class='linkovi' href='/pilot/korisnik/{$korisnik['id']}'>{$korisnik['user']}</a></td><td>{$korisnik['mail']}</td>
							<td>{$pravo}</td><td style='border-right:0px;'><form method='POST' action='/pilot/korisnici/brisanje'><input type='hidden' value='{$korisnik['id']}' name='id_korisnika'><input style='width:15px;opacity:0.5;' type='image' src='/pilot/img/x.jpg'></form></td>
						</tr>
EOT;
					}
					echo "<td></td><td></td><td></td><td></td><td style='border-right:0px;'></td></table>";
				}
				$paginacija='';
				if($korisnici['pag']>0){
					$paginacija.='<a class="flevo linkovi" style="margin-left:0px;" href="/pilot/korisnici/'.($korisnici['pag']-1).'">< prethodno</a>';
				}
				if($korisnici['pag']<($korisnici['pags']-1)){
					$paginacija.='<a class="fdesno linkovi" href="/pilot/korisnici/'.($korisnici['pag']+1).'">sledece ></a>';
				}
				
				echo $paginacija;
			?>
		</div>
	</div>
</div>