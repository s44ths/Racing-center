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

            $get_req_list = 'SELECT * FROM Request WHERE sender_id = :cur_id ORDER BY req_id DESC';
			$requests = $racing_center->prepare($get_req_list);
			$requests->execute(['cur_id' => $_COOKIE['id']]);

			$check = false;
			while($row = $requests->fetch(PDO::FETCH_OBJ))
			{
				$check = true;
                $get_req_status = 'SELECT Verdict FROM Fin_Verdict WHERE req_id = :cur_req';
                $status = $racing_center->prepare($get_req_status);
                $status->execute(['cur_req' => $row->req_id]);
                $status = $status->fetch(PDO::FETCH_ASSOC);

                $get_req_user = 'SELECT * FROM Users WHERE id = :requester_id';
                $user_info = $racing_center->prepare($get_req_user);
                $user_info->execute(['requester_id' => $row->sender_id]);
                $user_info = $user_info->fetch(PDO::FETCH_OBJ);

                $start_date = date('d.m.Y', strtotime($user_info->StartDate));

			  echo '<div class="post" style="background: url(images/img04.jpg) no-repeat;">
				        <h2 class="title">Заявка #'.$row->req_id.'</h2>
                        <div class="longmeta">
                            Статус: ';
                            if (!is_countable($status) || count($status) == 0)
                                echo 'В обработке';
                            else if(current($status) == 1)
                                echo '<span style="color: green">Одобрена</span>';
                            else
                                echo '<span style="color: red">Отклонена</span>';
                
                  echo '</div>
			            <div class="entry">
				            Информация о водителе: 
                                <div class="req-info">
                                    ФИО: '.$user_info->LastName.' '.$user_info->FirstName.' '.$user_info->MiddleName.'</br>
                                    Экиперовка: '.$user_info->Equipment.'</br>
                                    Занимается гонками с: '.$start_date.'</br>
                                    Был дисквалифицирован '.$user_info->Disquals.' раз </br>
                                    Число очков за сезон: '.$user_info->Points.'
                                </div>
                            Информация об автомобиле:
                                <div class="req-info">
                                    Марка/модель автомобиля: '.$row->Model.' </br>
                                    Наличие карткаса: ';
                                    if($row->Rollcage)
                                        echo 'Есть </br>';
                                    else
                                        echo 'Нет </br>';
                            echo    'Мощность двигателя: '.$row->Power.' </br>
                                    Тип ремней безопасности: '.$row->BeltType.' </br>
                                    Ширина шины: '.$row->Tire.' </br>
                                    Наличие тюнинга: ';
                                    if($row->Tuning)
                                        echo 'Есть </br>';
                                    else
                                        echo 'Нет </br>';
                        echo    '</div>
			            </div>
						<div class="page-controls">';
                        if (!is_countable($status) || count($status) == 0){
			            echo '<div class="inner-controls">
                                <form style="margin: 0; padding-left: 195px;"method="POST" action="/deleterequest.php" onsubmit="return ConfirmDelete();">
                                    <input type="hidden" name="request_id" value="'.$row->req_id.'">
                                    <input class="common-button" type="submit" value="Удалить заявку">
                                </form>
                            </div>';}
                   echo '</div>
                    </div>';
            }
			if(!$check) 
			   echo 'Пока что вы не подали ни одной заявки';
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
    <script> 
        function ConfirmDelete() {
            var conf = confirm('Вы уверены, что хотите удалить заявку? Вы не сможете её восстановить.'); 
            return conf;
        }
    </script>
</div>
<!-- end page -->
<div id="footer">
	<p id="legal">&copy;2022 All Rights Reserved.</a></p>
</div>
</body>
</html>
