<?php

include ("lib/openapi.php");
$vk = new Auth_Vkontakte();

$vk_auth = $vk->is_auth();

if ($vk_auth === false) {
	echo "Auth error";
}
else {
	// Здесь проверяем, зарегистирован ли у вас пользователь с таким VK_ID, в случае, если зарегистирован - перекидываем его на главную
	// Если не зарегистирован - надо показать ему упрощенную форму регистрации
	header ('Location: /');
}