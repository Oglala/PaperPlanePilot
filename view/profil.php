<style>
	.pp{color:gray;font-style:italic;}
	.ppl{color:gray;font-weight:bold;}
</style>
<div style='margin-top:30px;'>
	<div style='float:left;margin-left:50px;'>
		<div><img style='width:190px;padding:1px;border:2px solid #e5e5e5;' src='<?php echo $profil['avatar'] ?>' /></div>
		<div style='text-align:center;color:#08c'><?php echo $profil['user'] ?></div>
	</div>
	<div style='float:left;margin-left:50px;'>
		<div><label class='ppl'>Adresa elektronske poste: </label><span class='pp'><?php echo $profil['mail'] ?></span></div><br />
		<div><label class='ppl'>Sistemsko pravo: </label><span class='pp'><?php echo $profil['id'] ?></span></div><br />
		<div><label class='ppl'>Ime: </label><span class='pp'><?php echo $profil['ime'] ?></span></div><br />
		<div><label class='ppl'>Vreme registracije: </label><span class='pp'><?php echo $profil['vreme'] ?></span></div>
	</div>
</div>