<?php
$racing_center = new PDO('mysql:host=localhost;dbname=racingcenter', 'root');

$sql = 'SELECT Password, id, Role FROM users WHERE Login = :login';
$query = $racing_center->prepare($sql);
$query->execute(['login' => $_POST['Login']]);
$query = $query->fetch(PDO::FETCH_ASSOC);

if(!is_countable($query) || count($query) == 0 || current($query) != $_POST['Password']) {
    header('Location: /');
    exit();
}

setcookie('id', next($query), time() + 3600*24);
setcookie('Role', next($query), time() + 3600*24);
header('Location: /');
?>