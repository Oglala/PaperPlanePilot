<div style='margin-left:auto;margin-right:auto;width:360px;margin-top:100px;'>
	<form method='POST' action='/pilot/registracija'>
		<fieldset style='border-radius:3px;border:1px solid gray;'>
		<legend> Registracija</legend>
		<table style='margin-left:auto;margin-right:auto;'>
			<tr><td>Korisnicko ime</td><td><input name='user' type='text'></td></tr>
			<tr><td>Lozinka</td><td><input name='pass' type='password'></td></tr>
			<tr><td>Ponovite lozinku</td><td><input name='repass' type='password'></td></tr>
			<tr><td>E-mail adresa</td><td><input name='mail' type='text'></td></tr>
		</table>
		<input name='kor_ime' type='submit' value='ok' style='margin-left:320px;'>
		</fieldset>
	</form>
</div>