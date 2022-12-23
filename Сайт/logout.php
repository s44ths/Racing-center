<?php
setcookie ('id', '', time() - 3600*24);
setcookie ('Role', '', time() - 3600*24);

header('Location: /');
?>