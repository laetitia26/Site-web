<?php

class Auth{
	static function isLoogged(){
		if (isset($_SESSION['Auth']) && isset($_SESSION['Auth']['login']) && isset($_SESSION['Auth']['login'])) {
			return true;
		}else{
			return false;
		}
	}
}






?>