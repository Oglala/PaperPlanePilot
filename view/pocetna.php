<div>
	<style>
		.clanak{
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
			width:400px;
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
		}
		#clanci_lista{
			border-top:1px solid #e5e5e5;
		}
	</style>
	<div style='min-height:309px;overflow:hidden;'>
		<div style='float:left;width:50%;height:300px;'>
			<div id='galerija' style='position:relative;border:1px solid gray;width:400px;height:300px;padding:1px;margin-left:0px;'>
				<?php
					if(isset($clanci['clanci']) && $clanci['clanci']!=0){
						foreach($clanci['clanci'] as $clanak){
							echo "<div style='position:absolute;width:400px;height:300px;'><img style='width:400px;height:300px;' src='".$clanak['slika']."' /><div class='naslov'>".$clanak['naslov']."</div></div>";
						}
					}					
				?>
			</div>
		</div>
		<div style='float:right;width:50%;height:300px;text-align:center;'><i>free space</i></div>
	</div>
	<div>
		<div id='clanci_lista' style='width:600px;padding:3px;margin-top:3px;'>
		<?php
				if(isset($clanci['clanci']) && $clanci['clanci']!=0){
					foreach($clanci['clanci'] as $clanak){
						echo  <<<EOT
						<div class='clanak'>
							<div class='clanak_slika'>
								<img src='{$clanak['slika']}'>
							</div>
							<div class='clanak_tekst'>
								<div class='clanak_naslov'>{$clanak['naslov']}</div>
								<div class='clanak_opis'>{$clanak['opis']}</div>
							</div>
						</div>
EOT;
					}
				}
				$paginacija='';
				if($clanci['pag']>0){
					$paginacija.='<a class="flevo linkovi" href="/pilot/home/'.($clanci['pag']-1).'">< prethodno</a>';
				}
				if($clanci['pag']<($clanci['pags']-1)){
					$paginacija.='<a class="fdesno linkovi" href="/pilot/home/'.($clanci['pag']+1).'">sledece ></a>';
				}
				
				echo $paginacija;
		?>
		</div>
	</div>
</div>