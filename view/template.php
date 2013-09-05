<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $config['ime_sajta'] ?></title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<link rel="shortcut icon" href="<?php echo IMG_ROOT ?>paperplane.png" type="image/png">
		<link rel="stylesheet" type="text/css" href='<?php echo CSS_ROOT ?>stil.css'>
		<?php if(isset($stilovi)) echo $stilovi; ?>
		<script src='<?php echo JS_ROOT ?>skripta.js'></script>
		<?php if(isset($skripte)) echo $skripte; ?>
	</head>
	<body>
		<div id='sektor_prvi' class='sektor'>
			<div id='ceona_linija'><?php echo $nalog_meni ?></div>
			<div id='zaglavlje'><span><?php echo $config['ime_sajta'] ?></span><img src='<?php echo IMG_ROOT ?>pplogo.png' /></div>
		<div>
		<div id='sektor_drugi' class='sektor'>
			<div id='meni'>
				<?php
					if(isset($meni))
					foreach($meni as $stavka_menija){
						echo "<a class='stavka_menija' href='{$stavka_menija['link']}'>{$stavka_menija['naziv']}</a>";
					}
				?>
			</div>
		</div>
		<div id='sektor_treci' class='sektor'>
			<div id='sadrzaj'><?php include($sadrzaj) ?></div>
		</div>
		<div id='sektor_cetvrti' class='sektor'>
			<div id='futer'><img src='<?php echo IMG_ROOT ?>ppp.png' /></div>
		</div>
	</body>
</html>