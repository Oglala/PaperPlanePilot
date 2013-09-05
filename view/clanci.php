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
		.clanak{
			margin-left:50px;
			min-height:102px;
			overflow:hidden;
			border-bottom:1px solid #e5e5e5;
			padding:5px;
		}
		.clanak:hover{
			border-color:#08c;
			background:#f7f7f7;
		}
		.clanak_slika{
			float:left;
			width:120px;height:100px;
			border:1px solid gray;
			padding:1px;overflow:hidden;
		}
		.clanak_slika IMG{
			width:120px;height:100px;
		}
		.clanak_tekst{
			width:500px;
			float:left;
			margin-left:20px;
			margin-right:0px;
		}
		.clanak_naslov{
			border-bottom:1px solid #a2b480;
			color:#a2b480;font-size:20px;
		}
		.clanak_opis{
			font-size:15px;
			color:gray;
			margin-top:5px;margin-bottom:5px;margin-right:5px;
		#clanci_lista{
			border-top:1px solid #e5e5e5;
		}
	</style>
	<div style='float:left;width:25%;/*background:gray;*/margin:0px;'>
		<div class='kat' style='border-color:#08c;'><a class='linkovi' href='/pilot/clanci'>Clanci</a></div>
		<div class='kat'><a class='linkovi' href='/pilot/noviclanak'>Novi clanak</a></div>
	</div>
	<div style='float:left;width:75%;'>
		<div id='clanci_lista'>
			<?php
				if(isset($clanci['clanci']) && $clanci['clanci']!=0){
					foreach($clanci['clanci'] as $clanak){
						echo  <<<EOT
						<div class='clanak'>
							<div class='clanak_slika'>
								<img src='{$clanak['slika']}'>
							</div>
							<div class='clanak_tekst'>
								<div class='fdesno'><form method='POST' action='/pilot/clanci/brisanje'><input type='hidden' value='{$clanak['id']}' name='id_clanka'><input style='width:15px;opacity:0.5;' type='image' src='/pilot/img/x.jpg'></form></div>
								<div class='clanak_naslov'>{$clanak['naslov']}</div>
								<div class='clanak_opis'>{$clanak['opis']}</div>
							</div>
						</div>
EOT;
					}
				}
				$paginacija='';
				if($clanci['pag']>0){
					$paginacija.='<a class="flevo linkovi" style="margin-left:50px;" href="/pilot/clanci/'.($clanci['pag']-1).'">< prethodno</a>';
				}
				if($clanci['pag']<($clanci['pags']-1)){
					$paginacija.='<a class="fdesno linkovi" style="margin-left:50px;" href="/pilot/clanci/'.($clanci['pag']+1).'">sledece ></a>';
				}
				
				echo $paginacija;
			?>
		</div>
	</div>
</div>