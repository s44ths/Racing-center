<?php
if(!isset($_POST['race_id']))
{
	header('Location: /');
}
?>

<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Racing Center</title>
<link rel="stylesheet" href="/style.css" type="text/css">
</head>
<body>
<!-- start header -->
<div id="header">
	<h1><a style="margin-left: 50px" href="/">РСК<span>Г</span></a></h1>
	<h2><a>Регистрация на соревнования</a></h2>
</div>
<!-- end header -->
<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content">
		<h2>Вы собираетесь зарегистрироваться на соревнование</h2>
		<div id="req-form">
			<b>Название соревнования: </b> <?php echo $_POST['race_name']?>
			<div class = "longmeta">Для продолжения введите информацию об автомобиле, на котором вы будете участвовать. Заявка поступит в секретариат для дальнейшего рассмотрения. Вы можете узнать статус вашей заявки в разделе "Мои заявки". В случае одобрения вашей заявки вы будете допущены для участия в гонке.</div>
			<form method="POST" action="sendrequest.php">
			    Марка/модель автомобиля: <input class="medium-inp" name="model" type="text">
			   </br>
			   Мощность двигателя: <input class="small-inp" name="power" type="text">
			   </br>
			   Тип ремней безопасности: <input class="small-inp" name="belt" type="text">
			   </br>
			   Ширина шины: <input class="small-inp" name="tire" type="text">
			   </br>
			   </br>
			   </br>
			   Присутствует ли в вашем автомобиле каркас?
			   <input type="radio" id="cage-choise1" name="rollcage" value="1">
			   <label for="cage-choise1">Да</label>
			   <input type="radio" id="cage-choise2" name="rollcage" value="0">
			   <label for="cage-choise2">Нет</label>
			   </br>
			   </br>
			   Была ли тюнингована ваша машина?
			   <input type="radio" id="tun-choise1" name="tuning" value="1">
			   <label for="tun-choise1">Да</label>
			   <input type="radio" id="tun-choise2" name="tuning" value="0">
			   <label for="tun-choise2">Нет</label>
			   <input type="hidden" name="s_id" value=<?php echo '"'.$_COOKIE['id'].'"'?>>
			   <input type="hidden" name="race_id" value=<?php echo '"'.$_POST['race_id'].'"'?>>
			   </br>
			   </br>
			   </br>
			   <input class="common-button" type="submit" value="Отправить заявку">
			</form>
		</div>
	</div>
	<!-- end content -->
	<!-- start sidebar -->
	<div id="sidebar">
		<ul>
			<?php
			if(isset($_COOKIE['Role']) && $_COOKIE['Role'] != 0){
				echo 
				'<li>
				    <h2>Рабочая зона</h2>
				    <ul>
					    <li><a href="/workspace.php">Заявки, ожидающие рассмотрения</a></li>';
					if($_COOKIE['Role'] == 2)
					    echo '<li><a id="add-r-button">Добавить новую гонку</a></li>';
			echo    '</ul>
				</li>';
			}
			?>
			<?php
			if(isset($_COOKIE['id'])){
				echo 
				'<li>
				    <h2>Кабинет пользователя</h2>
				    <ul>
					    <li><a href="/userinfo.php">Изменить личную информацию</a></li>
					    <li><a href="/my.php">Мои заявки</a></li>
					</ul>
			    </li>';
			}
			?>
			<li>
				<h2>Меню сайта</h2>
				<ul>
				    <?php 
				    	if(isset($_COOKIE['id']))
						    echo '<li><a href="logout.php">Выход</a></li>';
						else
						    echo '<li><a id="show-login">Вход</a></li>
							      <li><a id="show-register">Регистрация</a></li>';
					?>
					<li><a href="/">Список гонок</a></li>
				</ul>
			</li>
		</ul>
		<div style="clear: both;">&nbsp;</div>
	</div>
	
	<!-- dialogues -->
	<?php
	if(!isset($_COOKIE['id'])){
	echo '
	<dialog id="login-dialog">
        <div class="dialog-area">
		    <h2>Вход</h2>
            <form method="POST" action="/enter.php">
                <input class="small-inp" maxlength="20" placeholder="Логин" name="Login" type="text">
			    </br>
				<input class="small-inp" maxlength="20" placeholder="Пароль" name="Password" type="password">
				<div class="form-bottom">
					<input class="common-button" type="submit" value="Войти">
				    </br>
					<input id="cancel-login" class="common-button" type="button" value="Отмена">
				</div>
            </form>
		</div>
	</dialog>

	<dialog id="register-dialog">
        <div class="dialog-area">
		    <h2>Регистрация</h2>
            <form method="POST" action="/reg.php">
			    <input class="medium-inp" placeholder="Фамилия" name="LName" type="text">
			    </br>
				<input class="medium-inp" placeholder="Имя" name="Name" type="text">
			    </br>
				<input class="medium-inp" placeholder="Отчество" name="MName" type="text">
			    </br>
                <input class="medium-inp" maxlength="20" placeholder="Придумайте логин" name="Login" type="text">
			    </br>
				<input class="medium-inp" maxlength="20" placeholder="Придумайте пароль" name="Password" type="password">
				</br>
				</br>
				<label for="start">Когда вы начали заниматься гонками?</label>
				</br>
				<input style="margin-top:7px;" type="date" id="start" name="racing_start">
				</br>
				<input class="medium-inp" maxlength="20" placeholder="Какое оборудование вы используете?" name="Equipment" type="texts">
				<div class="form-bottom">
					<input class="common-button" type="submit" value="Регистрация">
				    </br>
					<input id="cancel-reg" class="common-button" type="button" value="Отмена">
				</div>
            </form>
		</div>
	</dialog>
	
	<script> 
        var button_show_login = document.getElementById(\'show-login\');
		var button_close_login = document.getElementById(\'cancel-login\');
        var login_dialog = document.getElementById(\'login-dialog\');
        
		button_show_login.addEventListener(\'click\', function() {
            login_dialog.showModal();});
		button_close_login.addEventListener(\'click\', function() {
            login_dialog.close();});

		var button_show_reg = document.getElementById(\'show-register\');
		var button_close_reg = document.getElementById(\'cancel-reg\');
		var reg_dialog = document.getElementById(\'register-dialog\');

		button_show_reg.addEventListener(\'click\', function() {
            reg_dialog.showModal();});
		button_close_reg.addEventListener(\'click\', function() {
            reg_dialog.close();});
    </script>';}
	?>

    <?php
	if(isset($_COOKIE['Role']) && $_COOKIE['Role'] == 2){
	echo '
	<dialog id="add-race">
        <div class="dialog-area">
		    <h2>Новая гонка</h2>
            <form method="POST" action="/addrace.php">
                <input class="medium-inp" maxlength="50" placeholder="Введите название гонки" name="r_name" type="text">
			    </br>
				<textarea class="med-text" placeholder="Введите информацию о гонке" cols="40" rows="20" name="info"></textarea>
				<div class="form-bottom">
					<input class="common-button" type="submit" value="Добавить">
				    </br>
					<input id="close-r-button" class="common-button" type="button" value="Отмена">
				</div>
            </form>
		</div>
	</dialog>

	<script> 
        var button_add_r = document.getElementById(\'add-r-button\');
		var button_close_r = document.getElementById(\'close-r-button\');
        var race_dialog = document.getElementById(\'add-race\');
        
		button_add_r.addEventListener(\'click\', function() {
            race_dialog.showModal();});
		button_close_r.addEventListener(\'click\', function() {
            race_dialog.close();});
    </script>';}
	?>
	<!-- end sidebar -->
</div>
<!-- end page -->
<div id="footer">
	<p id="legal">&copy;2022 All Rights Reserved.</a></p>
</div>
</body>
</html>
