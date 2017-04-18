<!DOCTYPE html>
<?php
if(defined('VERSION') && !defined('version'))
	define('version', VERSION);
if(version<'2.0.0')
	defined('INC_ROOT') OR die('Direct access is not allowed.');

wCMS::addListener('menu', 'colorSelector');

function colorSelector ($args) {
	$args[0] .= '
<li>
	<ul class="color-selector">
		<li><a href="" id="colorred"><span class="glyphicon glyphicon-globe" style="color: red;" aria-hidden="true"></span></a></li><li><a href="" id="colorgreen"><span class="glyphicon glyphicon-globe" style="color: green;" aria-hidden="true"></span></a></li><li><a href="" id="colorblue"><span class="glyphicon glyphicon-globe" style="color: blue;" aria-hidden="true"></span></a></li>
	</ul>
</li>';
	return $args;
}
if(isset($_COOKIE['stylesheet'])) {
	switch($_COOKIE['stylesheet']) {
		case 'colorred':
			$css = 'css/style-red.css';
			break;
		case 'colorgreen':
			$css = 'css/style-green.css';
			break;
		default:
			$css = 'css/style-blue.css';
			break;
	}
} else {
	$css = 'css/style-blue.css';
}
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=wCMS::get('config','siteTitle')?> - <?=wCMS::page('title')?></title>
	<meta name="description" content="<?=wCMS::page('description')?>">
	<meta name="keywords" content="<?=wCMS::page('keywords')?>">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link id="stylesheet" rel="stylesheet" href="<?=wCMS::asset($css)?>">
	<?=wCMS::css()?>

</head>
<body>
	<?=wCMS::alerts()?>
	<?=wCMS::settings()?>

	<nav class="navbar navbar-default">
		<div class="container css3-shadow colorBackground">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-collapse">
					<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?=wCMS::url()?>">
					<?=wCMS::get('config','siteTitle')?>

				</a>
			</div>
			<div class="collapse navbar-collapse" id="menu-collapse">
				<ul class="nav navbar-nav navbar-right">
					<?=wCMS::menu()?>

				</ul>
			</div>
		</div>
	</nav>

	<div class="container-fluid">
		<div class="row-fluid">
			<div class="col-xs-12 col-sm-8">
			<div class="box css3-shadow whiteBackground padding40">
				<?=wCMS::page('content')?>

			</div>
			</div>
			<div class="col-xs-12 col-sm-4">
			<div class="box css3-shadow whiteBackground padding40">
				<?=wCMS::block('subside')?>

			</div>
			</div>
		</div>
	</div>

	<footer class="container-fluid">
		<div class="box css3-shadow whiteFont colorBackground padding20">
			<?=wCMS::footer()?>

		</div>
	</footer>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/jquery.autosize/3.0.17/autosize.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<?=wCMS::js()?>
	<script src="<?=wCMS::asset('js/js.cookie.js')?>"></script>
	<script>
		$( document ).ready(function() {
			$('body').css('margin-bottom', $('footer').height()+'px');
			
			function change_stylesheet(c) {
				switch(c) {
					case 'colorred':
						var stylesheet = $('#stylesheet').attr('href').replace(/css\/style\-(.*)/g, 'css/style-red.css');
						break;
					case 'colorgreen':
						var stylesheet = $('#stylesheet').attr('href').replace(/css\/style\-(.*)/g, 'css/style-green.css');
						break;
					case 'colorblue':
						var stylesheet = $('#stylesheet').attr('href').replace(/css\/style\-(.*)/g, 'css/style-blue.css');
						break;
				}
				Cookies.set("stylesheet", c);
				$("#stylesheet").attr({href: stylesheet});
			}
			
			if(Cookies.get("stylesheet")) {
				change_stylesheet(Cookies.get("stylesheet"));
			}
			
			$('.color-selector li a').click(function(e){
				e.preventDefault();
				change_stylesheet($(this).attr('id'));
			});
		});
	</script>
</body>
</html>
