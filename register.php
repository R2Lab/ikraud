<?php
include_once 'includv.php';
pagehead(' - Регистрация');
 $flag=false;
 $login="";
 $ohibka_name="";
 $pass="";
 $ohibka_pass="";
 $email="";
 $ohibka_mail="";
 $agree="";
 if(isset($_GET['cod']))
 {
 	$flag=true;
 	$z='Select * from user where emailok="'.$_GET['cod'].'"';
 	$r=mysql_query($z,DBLink);
 	$id=0;
 	 while ($row=mysql_fetch_array($r,MYSQL_ASSOC))
	 {
	 	$id=$row['idx'];
	 }
	 if($id>0)
	 {
	 	$zz='Update user Set emailok="-99", status="1" Where idx="'.$id.'"';
	 	if(mysql_query($zz,DBLink))
	 	{
	 		echo '<div class="kak"><a class="title">Почтовый ящик подтверждён</a></br>';
	        echo 'Можете войти в личный кабинет</div>';
	 	}
	 }


 }
 if(isset($_POST['registraciya']))
 {
 	$login=$_POST['login'];
 	$pass=$_POST['pass'];
 	$email=$_POST['email'];

 	$schetcik=0;

   	if(strlen($_POST['login'])>=3)
   	{

   		$z='Select * from user where login="'.$_POST['login'].'"';
   		$zz=mysql_query($z,DBLink);
   		if(mysql_num_rows($zz)>0)
   		{
   			$ohibka_name="Пользователь с таким именем уже зарегистрирован";
   		}
   		else{$schetcik++;}

   	}
   	else{$ohibka_name="Имя должно содержать минимум 3 символа";}

   	if(strlen($_POST['pass'])>=3)
    {$schetcik++;}
    else{$ohibka_pass="Пароль должен содержать минимум 3 символа";}

    if(substr_count($_POST['email'],"@")==1)
    {$schetcik++;}
    else{$ohibka_mail="e-mail введён неправильно";}
 	//echo '<div class="kak"><a class="title">Регистрация прошла успешно!</a></div>';
 	if(isset($_POST['agree']))
 	{$schetcik++;}
 	else{$agree="Для регистрации обязательно нужно принять условия";}
 	if($schetcik==4)
 	{

 		if(reg_user($login,$pass,$email))
 		{
	 		$flag=true;
	 		echo '<div class="kak"><a class="title">Регистрация прошла успешно!</a></br>';
	 		echo 'После подтверждения почтового ящика Вам будет доступенличный кабинет</div>';
 		}
 		else
 		{
 			echo "Регистрация невозможна, сервер недоступен. Попробуйте позже";
 		}
 	}
 }

 if($flag==false)
 {
echo '
<div class="kak"><a class="title">Регистрация</a>
<table align="center">
<form action="/register.php" method="post" name="regform">
<tr><td>Логин:</td><td><input type="text" name="login" maxlength="100" value="'.$login.'"></td><td>'.$ohibka_name.'</td></tr>
<tr><td>Пароль:</td><td><input type="text" name="pass" maxlength="100" value="'.$pass.'"></td><td>'.$ohibka_pass.'</td></tr>
<tr><td>E-Mail:</td><td><input type="text" name="email" maxlength="100" value="'.$email.'"></td><td>'.$ohibka_mail.'</td></tr>
<tr><td colspan="2"><input type="checkbox" name="agree" checked="checked"> Принимаю условия сервиса</td><td>'.$agree.'</td></tr>
<tr><td colspan="2"><a href="javascript:document.regform.submit()" class="btn">ЗАРЕГИСТРИРОВАТЬСЯ</a>
<input type="hidden" name="registraciya" value="1">
</td><td></td></tr>
</form>
</table>
</div>
';

 }

pagefoot();
?>
