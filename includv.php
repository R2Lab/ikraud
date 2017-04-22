<?php
session_start();

function dbconnect()
 {
		define('DBLink',mysql_pconnect('localhost', 'ikru', 'H2b7W2j1'));
		if(!DBLink) die('Error connect to Database');
		if(!mysql_select_db('ikr',DBLink)) die('Error select Database');
		mysql_query("set character_set_client='utf8'",DBLink);
		mysql_query("set character_set_results='utf8'",DBLink);
		mysql_query("set collation_connection='utf8_general_ci'",DBLink);
		return DBLink;
 }

function hu_is()
	{		echo '<h1>Административная часть</h1>';
		echo '<form action="" method="post">';
		echo '<input type="submit" name="popolnenie" value="USER PANEL">';
		echo '<input type="submit" name="pravila" value="OPLATA">';
		echo '<input type="submit" name="korzina" value="ZAKAZI">';
		echo '<input type="submit" name="parol" value="News">';
		echo '</form><hr>';		if(isset($_POST['popolnenie'])){echo "<h3>User Panel</h3>";uzer_panel();	}
		if(isset($_POST['pravila'])){echo "Pravila";}
		if(isset($_POST['korzina'])){echo "Korzina";}
		if(isset($_POST['parol'])){echo "<h2>News</h2>";news();}	}

function kabinet_usera()
 {
  global $xuser,$login,$password;
	 if (isset($login)&&isset($password))
	  {
	  	echo '<h1>Добро пожаловать в личный кабинет '.$login.'</h1>';
	  	echo '<b>Приятной работы в нашем сервисе</b>';
	  	echo '<table align="center"><form action="?" method="post">';
 	  echo '<tr>'.
	 	      '<td class="tdno"><input type="submit" value="Создать проект" name="create_progect"></td>'.
	 	      '<td class="tdno"><input type="submit" value="Пополнить баланс" name="popolnyalka"></td>'.
	 	      '</tr>';
	   echo '</form></table>';
	   $flag=false;
	   if(isset($_POST['create_progect']))//Rabota s sozdaniem proekta
	    {
	    	if(isset($_POST['progect_name']))//esli zadan url proecta delaem insert
	    	 {
	    	 	$z='INSERT INTO projects(userid,title,data)Values("'.$xuser['idx'].'","'.$_POST['progect_name'].'","'.Date('Y-m-d').'")';
	    	 	if(!mysql_query($z,DBLink))
	  	     {	  	      echo 'Error';
	  	     }
	    	 }
	    	else
	    	 {
		     	echo '<b>create progekt</b>';
		     	echo '<table align="center"><form action="?" method="post">';
		 	 	  echo '<tr>'.
			 	        '<td><input type="text" value="insert_name_progect" name="progect_name"></td>'.
			 	        '<td><input type="submit" value="Создать проект" name="create_progect"></td>'.
			 	        '</tr>';
			     echo '</form></table>';
		     }

	    }
    if(isset($_POST['popolnyalka']))
	    {
     	echo '<b>Popolnit balanse</b>';
     }
    $zz='Select * from projects Where userid="'.$xuser['idx'].'"';
	 	 $rr=mysql_query($zz,DBLink);
	 	 if(mysql_num_rows($rr)>0)
 	 	 {
  			 echo '<hr><table border="1" cellspacing="0">';
	  		 echo '<tr><th>Name progect</th><th>Data</th><th>Link</th><th>Balance</th><th></th></tr>';
		    while ($row=mysql_fetch_array($rr,MYSQL_ASSOC))
			    {			 	   echo '<tr><td>'.$row['title'].'</td><td>'.$row['data'].'</td><td>';
        if(isset($_POST['idx_progect']))
         {      	   $zzzz='INSERT INTO links(projectid,link,opis)Values("'.$_POST['idx_progect'].'","'.$_POST['link'].'","'.$_POST['opisanie'].'")';
	    		   if(!mysql_query($zzzz,DBLink))
	          {	           echo 'Error';
	          }         }
        echo '<table width="100%" border=1><form action="?" method="post">';
        $zzz='Select * from links Where projectid="'.$row['idx'].'"';
   	    $rrr=mysql_query($zzz,DBLink);
		 	    if(mysql_num_rows($rrr)>0)
			 	    {
    	 	   while ($roww=mysql_fetch_array($rrr,MYSQL_ASSOC))
			        {			         echo '<tr><td>'.$roww['link'].'</td><td>'.$roww['opis'].'</td></tr>';			        }
   			 	 }
        echo '<tr><td><input class="inputs" type="text" value="" name="link"></td><td>url</td></tr>'.
             '<tr><td><input class="inputs" type="text" value="" name="opisanie"></td><td>описание</td></tr>'.
             '<tr><td colspan="2"><input type="submit" value="Добавить страницу в проект" name="insert_page_in_progect">'.
             '<input type="hidden" value="'.$row['idx'].'" name="idx_progect"></td></tr>';
        echo '</form></table>';
        echo '<td></td><td></td></tr>';
   	 	 }
 	    echo '</table>';
   	 }
   } }

function uzer_panel()
	{	 if(isset($_POST['save_user']))
	 {	 	$zz='UPDATE user SET nick="'.$_POST['nick'].'", login="'.$_POST['login'].'", status="'.$_POST['status'].'", email="'.$_POST['email'].'" WHERE idx="'.$_POST['save_user'].'"';
	 	if(!mysql_query($zz,DBLink))
	  	{echo 'Error';}
	  else
	 	 {echo '<h3>infomation for user '.$_POST['login'].' is update</h3>';}	 }	 $z='Select * from user';
	 $r=mysql_query($z,DBLink);
	 $id=0;
	 echo "<table border='1' cellspacing='0'>";
	 echo '<tr><th>user id</th><th>nick</th><th>Login</th><th>password</th><th>Balanse</th><th>Data regi</th><th>User status<br>1-emailOK<br>2-user_shet<br>3-gold_user<br>4-admin</th><th>email</th><th>Подтверждение мыла</th><th></th></tr>';
		while ($row=mysql_fetch_array($r,MYSQL_ASSOC))
		 {     echo '<form action="?" method="post">';
	 	 	echo '<tr>';
		 	 echo '<td>'.$row['idx'].'</td>';
		 	 echo '<td><input type="text" name="nick" value="'.$row['nick'].'"</td>';
		 	 echo '<td><input type="text" name="login" value="'.$row['login'].'"</td>';
		 	 echo '<td>'.$row['password'].'</td>';
		 	 echo '<td>'.$row['balance'].'</td>';
		 	 echo '<td>'.$row['data'].'</td>';
		 	 echo '<td>';
		 	  echo '<select name="status">';
		 	   for($k=0;$k<5;$k++)
		 	   {		 	   	if($k==$row['status'])
		 	   	{echo '<option value="'.$k.'" selected>'.$k.'</option>';}
		 	   	else
		 	   	{ 	echo '<option value="'.$k.'" >'.$k.'</option>';}		 	   }
		 	  echo '</select>';
		 	 echo '</td>';
		 	 echo '<td><input type="text" name="email" value="'.$row['email'].'"</td>';
		 	 if($row['emailok']==-99)
 		 	 {	 	 	 	echo '<td>e-mail подтверждён</td>';		  	 }
		 	 else
		  	 {		  	  echo '<td bgcolor="red">e-mail не подтверждён</td>';
		  	 }
		 	 echo '<td><input type="submit" value="Сохранить">'.
		 	      '<input type="hidden" name="save_user" value="'.$row['idx'].'">'.
		 	      '<input type="hidden" name="popolnenie" value="'.$row['idx'].'"></td></tr>';
		   echo "</form>";
		 }
		 echo "</table>";	}

function news()
 {  $pr=(isset($_POST['parol'])) ? $_POST['parol'] : 0;
  $id=(isset($_POST['idx'])) ? $_POST['idx'] : 0;
	 $opis=(isset($_POST['opis'])) ? $_POST['opis'] : '';
  $sn=(isset($_POST['save_news'])) ? true : false;
  $foto=''; $flag=false;
  if($sn)
		 {
	   $folder = $_SERVER['DOCUMENT_ROOT'].'/img/news/';
	   @mkdir($folder,0777);
		  $name_img=$_FILES['uploadFile']['name'];
		  $uploadedFile  = $folder."".$name_img;
		  if(is_uploaded_file($_FILES['uploadFile']['tmp_name']))
		   {		    $fz='Файл не  загружен';
			   if(move_uploaded_file($_FILES['uploadFile']['tmp_name'],$uploadedFile))
			    {
	  	    $fz="Файл загружен";
			     $foto=$name_img;
			     $flag=true;
	  		  }
		   }
    //echo $fz;
   }
  if($pr==1) // new post
  	{
  		$zz='Insert Into news(foto,nazva,txt,avtor,data)Values("'.$foto.'","'.$_POST['nazva'].'","'.$opis.'","'.$_POST['avtor'].'","'.Date('Y-m-d H:i:s').'")';
    if(mysql_query($zz,DBLink))
     {
     	echo "Новость добавлена";
     }
    $pr=0;
  	}
 	if($pr==4) // edit post update
 	 { 	  if ($flag)
 	   {   	  $zz='UPDATE news SET foto="'.$foto.'", nazva="'.$_POST['nazva'].'", txt="'.$opis.'", avtor="'.$_POST['avtor'].'" Where id='.$id; 	   }
 	  else
 	   {   	  $zz='UPDATE news SET nazva="'.$_POST['nazva'].'", txt="'.$opis.'", avtor="'.$_POST['avtor'].'" Where id='.$id;
   	 }
 	  mysql_query($zz,DBLink);
 	  $pr=0;
   }
 	if($pr==0) // new post
 	 {
			 echo '<table border="1" cellspacing="0"><form enctype="multipart/form-data" action="?" method="post">';
			 echo '<tr><td colspan="2"><input  type="hidden" name="MAX_FILE_SIZE" value="3000000"/><input type="hidden" name="parol" value="1">';
			 echo '<input type="file" name="uploadFile"/></td></tr>';
			 echo '<tr><th>Название статьи</th><td><input type="text" name="nazva" value=""></td></tr>';
			 echo '<tr><th>Текст новости</th><th><textarea rows="4" cols="80" name="opis"></textarea></th></tr>';
			 echo '<tr><th>Автор статьи</th><td><input type="text" name="avtor" value=""></td></tr>';
			 echo '<tr><th colspan="2"><input  type="submit" name="save_news" value="Сохранить новость"/></th></tr>';
			 echo '</form></table>';
	  }
 	if($pr==3) // edit post
 	 {
		 	$z='Select * from news Where id='.$id;
		 	$r=mysql_query($z,DBLink);
		 	$row=mysql_fetch_array($r,MYSQL_ASSOC);
			 echo '<table border="1" cellspacing="0"><form enctype="multipart/form-data" action="?" method="post">';
			 echo '<tr><td colspan="2"><input  type="hidden" name="MAX_FILE_SIZE" value="3000000"/><input type="hidden" name="parol" value="4">';
			 echo '<img src="/img/news/'.$row['foto'].'" width="40px">'.$row['foto'].'<br><input type="file" name="uploadFile"/></td></tr>';
			 echo '<tr><th>Название статьи</th><td><input type="text" name="nazva" value="'.$row['nazva'].'"><input type="hidden" name="idx" value="'.$row['id'].'"></td></tr>';
			 echo '<tr><th>Текст новости</th><th><textarea rows="4" cols="80" name="opis">'.$row['txt'].'</textarea></th></tr>';
			 echo '<tr><th>Автор статьи</th><td><input type="text" name="avtor" value="'.$row['avtor'].'"></td></tr>';
			 echo '<tr><th colspan="2"><input  type="submit" name="save_news" value="Сохранить новость"/></th></tr>';
			 echo '</form></table>';
	  }

 	$z='Select * from news';
 	$r=mysql_query($z,DBLink);
	 echo '<hr><table border="1" cellspacing="0">';
	 echo '<tr><th>id</th><th>Image</th><th>Title</th><th>News</th><th>Author</th><th>Edit</th></tr>';
	 while ($row=mysql_fetch_array($r,MYSQL_ASSOC))
	 {
	 	echo '<tr><td>'.$row['id'].'</td><td><a href="/img/news/'.$row['foto'].'"><img src="/img/news/'.$row['foto'].'" width="40px"></a></td><td>'.$row['nazva'].'</td><td>'.$row['txt'].'</td><td>'.$row['avtor'].'</td>';
	 	echo '<form action="?" method="post"><th><input type="hidden" name="parol" value="3"><input type="hidden" name="idx" value="'.$row['id'].'"><input type="submit" name="edit" value="Edit"/></th></form></tr>';
	 } }

/**
* Registration user
*/
function reg_user($login,$pass,$email)
 {
  $random=rand(100000,99999999999);
  $ret=true;
  $to=$email;
  $subject="Подтверждение регистрации";
  $msg='Для подтверждения регистрации на сайте ikraud.ru вам необходимо перейти по ссылке http://ikraud.ru/register.php?cod='.$random.' Подтвердить регистрацию';
  // Конвертируем ее в кодировку KOI8-R
  $subject = convert_cyr_string ($subject,'w','k');
  /* А теперь конвертируем ее в MIME-кодировку, заодно указывая, то это KOI8-R */
  $subject = '=?koi8-r?B?'.base64_encode($subject).'?=';
  // Конвертируем тело письма в KOI8-R
  $msg = convert_cyr_string ($msg,'w','k');
  $headers = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/plain; charset=koi8-r' . "\r\n";
  $headers .= 'To: '.$email. "\r\n";
  $headers .= "From:admin@ikraud.ru\r\n";
  mail($to,$subject, $msg, $headers);
  $z='INSERT INTO user(login,password,email,data,emailok)Values("'.$login.'","'.$pass.'","'.$email.'","'.Date('Y-m-d').'","'.$random.'")';
  if(!mysql_query($z,DBLink))
   {
    $ret=false;
   }
  return $ret;
 }

function debugs() // Show Errors-messages
 {  error_reporting(E_ALL ^ E_DEPRECATED); ini_set('display_errors', 1); }

/**
* Get or Set Login and Password into Cookies
*/
function get_logins()
 {
 	global $login,$password;
  $timecookie=604800;
  if (isset($_SESSION['password']))
   {
		  $login=$_SESSION['login'];
		  $password=$_SESSION['password'];
			}
		if (@$_POST['sn']== 3) // log-in
		 {
		  $login=isset($_POST['login']) ? $_POST['login'] : '';
		  $password=isset($_POST['password']) ? $_POST['password'] : '';
		  $_SESSION['login']=$login;
		  $_SESSION['password']=$password;
		 }
		if (@$_POST['sn']==99) // log-out
		 {
		  unset($_SESSION['login']);
		  unset($_SESSION['password']);
		  unset($_SESSION['xuser']);
		  $login='';
		  $password='';
		 }
 }

/**
* Drawing Authorization form
*/
function log_in_out()
 {
 	global $xuser,$login,$password;
  $x=0;
  if ((isset($_SESSION['password']))&&(isset($_SESSION['xuser'])))
   {
   	$xuser=$_SESSION['xuser'];
   	$x=1;
   }
  elseif (($login!='')&&($password!=''))
   {
    $z='SELECT * FROM user WHERE (login="'.$login.'" AND password="'.$password.'") LIMIT 1';
    $r=mysql_query($z,DBLink);
    if (mysql_num_rows($r)==1)
     {
      $xuser=mysql_fetch_array($r);
      $x=1;
      $_SESSION['xuser']=$xuser;
     }
   }
  if ($x==0)
   {    echo '<ul><form action="?" method="post"><li>Логин: <input type="text" name="login" id="login" maxlength="20"></li><li>Пароль: <input type="password" name="password" id="password" maxlength="20"></li>';
    echo '<li><input type="hidden" name="sn" value="3"><input type="submit" value="Войти"></li></form></ul><ul><form action="register.php" method="post"><li><input type="submit" value="Регистрация"></li></form></ul>';
   }
  if ($x==1)
   {
    echo '<ul><form action="?" method="post"><li>Вы вошли как <a href="/user_panel.php" title="войти в личный кабинет">"'.$login.'"</a></li><input type="hidden" name="sn" value="99">';
    echo '<li><input type="submit" value="Выйти"></li></form></ul>';
   }
 }

/**
* Check User rights (by $login and $password) for access to specified $level
* @param string $login
* @param string $password
* @param string $level
* @return $ret ia true or false
*/
function isaccess($login,$password,$level)
 {
  global $xuser;
  $ret=false;
  if (@($xuser['login']==$login)&&@($xuser['password']==$password)&&@($xuser[$level]==1))
   {
    $ret=true;
   }
  return $ret;
 }


function pagehead($t='',$s='')
 {
  $out='<!DOCTYPE html><html lang="ru">'.
 	'<head>'.
		'<title>Крауд-маркетинг'.$t.'</title>'.
  '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>'.
  '<meta http-equiv="Content-Language" content="ru"/>'.
		'<meta name="viewport" content="width=device-width, initial-scale=1.0" />'.
		'<meta name="description" content="крауд-маркетинг" />'.
		'<meta name="keywords" content="крауд-маркетинг" />'.
		'<link rel="stylesheet" type="text/css" href="/css/style';
		if ($s!='') {$out.='z';}
		$out.='.css">'.
		'</head>'.
		'<body>'.
		'<div class="navcont">'.
		'<div class="logo"><a href="/"><img height="76" width="105" src="/img/logo.png" title="Крауд-маркетинг"></a></div>'.
		'<div class="navm"><ul><li>Новости</li><li>Цены</li><li>Как это работает?</li></ul></div>'.
  '<div class="vhod">';
  echo $out;
  log_in_out();
  $out='</div>'.
  '</div>'.
  '<div class="bgcont"><div class="bgconti">';
  echo $out;
 }

function pagefoot()
 {
  $out='</div></div>'.
  '<div class="footer"></div>'.
  '</body>'.
  '</html>';
  echo $out;
 }
//-------------------------------------------------------------------------------------------------------
debugs();
$login=''; $password=''; $xuser=array('login'=>chr(2));
dbconnect();
get_logins();

?>