<div style='margin-top:20px;'>
	<style>
		.kat{
			height:20px;
			border-bottom:1px solid #e5e5e5;
			margin-top:5px;padding-left:10px;
		}
		#novi_clanak{
			margin-left:50px;
			min-height:102px;
			overflow:hidden;
			border-bottom:1px solid #e5e5e5;
			padding:5px;
			text-align:left;
		}
		.labele{
			color:#a2b480;
		}
	</style>
	<div style='float:left;width:25%;/*background:gray;*/margin:0px;'>
		<div class='kat'><a class='linkovi' href='/pilot/clanci'>Clanci</a></div>
		<div class='kat' style='border-color:#08c;'><a class='linkovi' href='/pilot/noviclanak'>Novi clanak</a></div>
	</div>
	<div style='float:left;width:68%;text-align:center;'>
		<form method='post' action='/pilot/noviclanak' enctype="multipart/form-data">
			<div id='novi_clanak'>
				<div class='fdesno'><label class='labele'>Kategorija: </label>
				<select name='id_kategorije' style='color:gray;'>
					<option value='1'>Vesti</option>
				</select></div><br /><br />
				<label class='labele'>NASLOV</label><br />
				<input style='width:550px;color:gray;' type='text' name='naslov'><br /><br />
				<label class='labele'>OPIS</label><br />
				<textarea name='opis' style='color:gray;width:550px;max-width:550px;height:50px;'></textarea><br /><br />
				<label class='labele'>TEKST CLANKA</label><br />
				<textarea name='tekst' style='color:gray;width:550px;max-width:550px;height:350px;'></textarea><br /><br />
				<input type='file' name='slika'><br /><br />
			</div>
			<input type='submit' name='sacuvaj' value='sacuvaj'><br /><br />
		</form>
	</div>
</div>