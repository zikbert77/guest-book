<?php
/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 21.07.2017
 * Time: 14:12
 */

return [

    'login' => 'AuthController/getLogin',
    'logout' => 'AuthController/logOut',

    'register' => 'AuthController/registerUser',

    'user/([0-9]+)' => 'UserController/userPage',

    'add-message' => 'IndexController/addMessage',
    '' => 'IndexController/show'


];