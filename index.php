<?php session_start(); echo '<!DOCTYPE html>';?>
<html lang="ru">
	<head>
		<title>Крауд-маркетинг</title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
                <meta http-equiv="Content-Language" content="ru"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="крауд-маркетинг" />
		<meta name="keywords" content="крауд-маркетинг" />
		<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<div class="navcont">
<div class="logo"><a href="/"><img height="76" width="105" src="/img/logo.png" title="Крауд-маркетинг"></a></div>
<div class="navm"><ul><li>Новости</li><li>Цены</li><li>Как это работает?</li></ul></div>
<div class="vhod"><?php include 'loginout.php'; ?></div>
</div>
<div class="bgcont"><div class="bgconti">
<div class="kak"><a class="title">Крауд-маркетинг продвижение естественными ссылками</a>
<div class="col">
                <img src="/img/brand.png" alt="Продвижение бренда">
                <div class="bl">
                    <em>Продвижение бренда.</em><br>
                   Положительные отзывы о вашей продукции и услугах
                </div>
            </div>
			<div class="col">
                <img src="/img/vot.png" alt="Продвижение бренда">
                <div class="bl">
                    <em>Рост позиций.</em><br>
                  Стабильный рост позиций, трафика и потока клиентов
                </div>
            </div>
			<div class="col">
                <img src="/img/che.png" alt="Продвижение бренда">
                <div class="bl">
                    <em>Вечные ссылки.</em><br>
                  Дополнительный трафик. Отсутствие арендной платы за ссылки.
                </div>
            </div>
	<div class="row">
			<a href="/" class="btn">Начать продвижение</a></div>
</div>
<div class="hedinf"><div class="infl">1
<?php require 'newsout.php';?>
</div>
<div class="infr"><div class="infone"><img src="/img/up.png" alt="Продвижение бренда" style="height: 120px; border-radius: 10px 0 0 10px;"></div><div class="inftho"><img src="/img/ro.png" alt="Продвижение бренда" style="height: 120px; border-radius: 10px 0 0 10px;">2</div><div class="inf3"><img src="/img/bld.png" alt="Продвижение бренда" style="height: 120px; border-radius: 10px 0 0 10px;">3</div></div></div>
<div class="preim"><div class="row"><a class="title">Преимущества</a></div>
<div class="colomn">
<img alt="Преимущества" src="/img/1.svg">
Защита от санкций поисковых систем</div>
<div class="colomn">
<img alt="Преимущества" src="/img/2.svg">
Улучшение поведенческих факторов</div>
<div class="colomn">
<img alt="Преимущества" src="/img/3.svg">
Только тематические ссылки
</div>
</div>
<div class="preim">Как работает?</div>
<div class="preim">Что получите?</div>
</div></div>
<div class="footer"></div>
</body>
</html>