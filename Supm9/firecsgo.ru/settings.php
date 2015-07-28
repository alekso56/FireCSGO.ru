<?php 
@include_once "langdoc.php";
if(!isset($_COOKIE['lang'])) {
	setcookie("lang","ru",2147485547);
	$lang = "ru";
} else $lang = $_COOKIE["lang"];
$sitename = "FIRECSGO.RU";
$title = "$sitename - TOP10";
@include_once('set.php');
@include_once('steamauth/steamauth.php');
if(!isset($_SESSION["steamid"])) {
	Header("Location: index.php");
	exit;
}
@include_once('steamauth/userInfo.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $title ?></title>
	<link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="fav.ico" type="image/x-icon">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/noty/packaged/jquery.noty.packaged.min.js"></script>
	<script src="js/main.js"></script>
</head>
<body>
		<header id="header">
		<div style="  width: 1100px;  margin: auto;">
			<strong class="logo"><a href="/"><?php echo $title ?></a></strong>	 
			<div style="float: right;">
				<?php
				if(!isset($_SESSION["steamid"])) {
					steamlogin();
					//echo '<div style="display: inline-block; margin: 35px 90px 0 0; color: #474747; font-size: 12pt;"><a href=en.php><img src=img/en.gif></a><a href=ru.php><img src=img/ru.gif></a></div>';
					echo "<a class=\"btns\">ВОЙТИ С ПОМОЩЬЮ </a>";
					echo "<a class=\"btn\" href=\"?login\">".$msg[$lang]["login2"]."</a>";
					
				} else {
					//echo '<div style="display: inline-block; margin: 35px 90px 0 0; color: #474747; font-size: 12pt;"><a href=en.php><img src=img/en.gif></a><a href=ru.php><img src=img/ru.gif></a>    '.$msg[$lang]["loggedin"].' sf</div>';
					echo '<div style="display: inline-block; margin: 35px 110px 0 0; color: #474747; font-size: 12pt;">'.$msg[$lang]["loggedin"].' '.$steamprofile['personaname'].' </div><div style="display: inline-block; position: absolute; margin-top: 28px; margin-left: -100px "><img src="'.$steamprofile['avatar'].'"></div>';
					echo "<a class=\"btn\" href=\"steamauth/logout.php\">".$msg[$lang]["logout"]."</a>";
					mysql_query("UPDATE users SET name='".$steamprofile['personaname']."', avatar='".$steamprofile['avatarfull']."' WHERE steamid='".$_SESSION["steamid"]."'");
				}
				?>
    		</div>
		</div>
	    </header>
	<div id="wrapper">
			<div id="main">
				<div class="sidebar">
					<nav id="nav">
						<h2><?php echo $msg[$lang]["menu"]; ?></h2>
						<ul>
							<li><a href="/"><?php echo $msg[$lang]["mainpage"]; ?></a></li>
							<li><a href="/history"><?php echo $msg[$lang]["history"]; ?></a></li>
							<li><a href="/top"><?php echo $msg[$lang]["top"]; ?></a></li>
							<li><a href="/about"><?php echo $msg[$lang]["about"]; ?></a></li>
							<li><a href="http://vk.com/csgo_stf"><?php echo $msg[$lang]["support"]; ?></a></li>
						</ul>
					</nav>
					<?php 
					if(isset($_SESSION["steamid"])) {
						?>
					<nav id="nav">
						<h2><?php echo $msg[$lang]["pmenu"]; ?></h2>
						<ul>
							<li><a href="./settings.php"><?php echo $msg[$lang]["settings"]; ?></a></li>
							<li><a href="steamauth/logout.php"><?php echo $msg[$lang]["logout"]; ?></a></li>
						</ul>
					</nav>
					<?php } ?>
					<div class="bonus-block">
						<div class="box">
							<div class="visual">
								<img src="./img/img1.png" width="41" height="50">
							</div>
							<p style="text-align: center;"><?php echo $msg[$lang]["bonus"]; ?></p>
							
						</div>
						<div class="text-box">
								<p style=""><?php echo $msg[$lang]["fp"]; ?></p>
						</div>
					</div>
					
					<h3>Последний победитель</h3>
					<div class="last-winner">
						
						<?php 
							$lastgame = fetchinfo("value","info","name","current_game");
							$lastwinner = fetchinfo("userid","games","id",$lastgame-1);
							$winnercost = fetchinfo("cost","games","id",$lastgame-1);
							$winnerpercent = round(fetchinfo("percent","games","id",$lastgame-1),1);
							$winneravatar = fetchinfo("avatar","users","steamid",$lastwinner);
							$winnername = fetchinfo("name","users","steamid",$lastwinner);
						?>
						<div class="visual">
							<img src="<?php echo $winneravatar ?>" alt="image description" width="109" height="109">
						</div>
						<h3 style="border-radius: 0px 0px 0px 0px;"><?php echo $winnername ?></h3>
						<ul>
							<li>
								<span class="val"><?php echo $msg[$lang]["win"]; ?>:</span>
								<span class="price">$<?php echo round($winnercost,2); ?></span>
							</li>
							<li>
								<span class="val"><?php echo $msg[$lang]["chance"]; ?>:</span>
								<span class="price"><?php echo $winnerpercent ?>%</span>
							</li>
						</ul>
					</div>
					
					<h2><?php echo $msg[$lang]["online"]; ?></h2>
					<div class="online">
						<div class="box">
						  <span id='on_now'>
								<script type="text/javascript" src="http://indexsite.ru/online_user.php?site=ваш сайт"></script> 
								<p>игроков</p>
						  </span> 
						</div>
					</div>


				</div>	
				<div class="content">
				<h2>Настройки</h2>
					<div class="history_game">
					<form method="POST" action="./updatelink.php">
						<div style="padding: 30px;">
						<label for="link" style="color: #474747; font-size: 17pt;">Ссылка на обмен: </label>
						<input type="text" name="link" style="min-width: 600px; height: 25px; margin-top: -5px;" id="link" value="<?php	echo fetchinfo("tlink","users","steamid",$_SESSION["steamid"]); ?>" placeholder="Ссылка на обмен">
						<p style="color: #474747; font-size: 14pt;">Получить ссылку можно тут - <a href="http://steamcommunity.com/id/me/tradeoffers/privacy#trade_offer_access_url" target="_blank" style="color: #474747; font-size: 12pt;">http://steamcommunity.com/id/me/tradeoffers/privacy</a></p>
						<p style="color: #474747; font-size: 12pt;">Обязательно откройте инвентарь в Steam!</p>
						<p style="color: #474747; font-size: 12pt;">Если вы указали НЕПРАВИЛЬНУЮ ссылку на оффер, администрация в праве не вернуть вещи.</p>
			        	<input type="submit" class="btn" href="#" value="Сохранить">
			        	</div>
		        	</form>
					</div>
				</div>
</body>
</html>