<?php

include ("lib/openapi.php");
$vk = new Auth_Vkontakte();
$vk_auth = $vk->is_auth();

include ("templates/index.html");