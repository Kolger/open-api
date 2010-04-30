<?php
	include ("lib/openapi.php");
	$vk = new Auth_Vkontakte();
	$vk->logout();
	
	header ("Location: /");