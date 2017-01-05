<?php
namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
	//验证验证码
    public static function check($code)
    {
        if($_SESSION['milkcaptcha'] == $code) {
            return true;
        } else {
        	return false;
        }
    }

}