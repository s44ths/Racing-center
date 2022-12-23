<?php
if(!isset($_COOKIE['id']))
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
        <?php
		    $racing_center = new PDO('mysql:host=localhost;dbname=racingcenter', 'root');

            $get_u_info = 'SELECT LastName, FirstName, MiddleName, Login, Password, Equipment FROM Users WHERE id = :cur_user';
			$user_info = $racing_center->prepare($get_u_info);
			$user_info->execute(['cur_user' => $_COOKIE['id']]);
            $user_info = $user_info->fetch(PDO::FETCH_OBJ);

            echo 
            '   
            <form method="POST" action="/updateuinfo.php">
                <input class="medium-inp" placeholder="Фамилия" name="LName" type="text" value="'.$user_info->LastName.'">
			    </br>
				<input class="medium-inp" placeholder="Имя" name="Name" type="text" value="'.$user_info->FirstName.'">
			    </br>
				<input class="medium-inp" placeholder="Отчество" name="MName" type="text" value="'.$user_info->MiddleName.'">
			    </br>
                <input class="medium-inp" maxlength="20" placeholder="Логин" name="Login" type="text" value="'.$user_info->Login.'">
			    </br>
				<input class="medium-inp" maxlength="20" placeholder="Пароль" name="Password" type="password" value="'.$user_info->Password.'">
				</br>
				Оборудование: <input class="medium-inp" maxlength="20" placeholder="Какое оборудование вы используете?" name="Equipment" type="texts" value="'.$user_info->Equipment.'">
				<input type="hidden" name="uid" value="'.$_COOKIE['id'].'">
                <div class="form-bottom">
					<input class="common-button" type="submit" value="Обновить данные">
				</div>
            </form>';
        ?>

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