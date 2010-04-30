<?php

define ('VK_APP_ID', 'vk_app_1868779');
define ('VK_APP_PASSWORD', 'q2L3DWlLse0Wtah6nMTR');

class Auth_Vkontakte {
	
	/**
	* Проверяет, залогинен пользователь. Если да - возвращает его ID ВКонтакте, в противном случае - false.
	*/
	public function is_auth() {
		if (!isset($_COOKIE[VK_APP_ID]))
			return false;
			
		$vk_cookie = $_COOKIE[VK_APP_ID];
		
		if (!empty($vk_cookie)) {
			$cookie_data = array();
			
			foreach (explode('&', $vk_cookie) as $item) {
				$item_data = explode('=', $item);
				$cookie_data[$item_data[0]] = $item_data[1];
			}
			
			// Проверяем sig
			$string = sprintf("expire=%smid=%ssecret=%ssid=%s%s", $cookie_data['expire'], $cookie_data['mid'], $cookie_data['secret'], $cookie_data['sid'], VK_APP_PASSWORD);
			
			if (md5($string) == $cookie_data['sig']) {
				// sig не подделан - возвращаем ID пользователя ВКонтакте.
				return $cookie_data['mid'];
			}
		}
		
		return false;
	}
	
	/**
	* Производит разлогинивание 
	*/
	public function logout() {
		
		// Заменяем куку от ВКонтакте на пустую
		if (setcookie(VK_APP_ID, '', 0, "/", '.'.$_SERVER['HTTP_HOST'])) {
			return true;
		}
		
		return false;
	}
	
	/**
	* Возвращает HTML со всеми необходимыми скриптами
	*/
	public function render_login_form() {
		return file_get_contents("lib/login_form.html");
	}
}