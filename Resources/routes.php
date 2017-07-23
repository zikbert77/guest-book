<?php
/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 21.07.2017
 * Time: 14:12
 */

return [

    //Admin routes
    'manage-user/([0-9]+)' => 'AdminController/managing/$1',
    'manager/users' => 'AdminController/manageUsers',
    'manager' => 'AdminController/main',


    //Authentification routes
    'login' => 'AuthController/getLogin',
    'logout' => 'AuthController/logOut',
    'register' => 'AuthController/registerUser',


    //User routes
    'user/([0-9]+)' => 'UserController/userPage',


    //Site-message routes
    'add-message' => 'IndexController/addMessage',
    'changeLang' => 'IndexController/ChangeLang',
    'page-([0-9]+)/sort-([a-z+])' => 'IndexController/show/$1/2',
    'page-([0-9]+)' => 'IndexController/show/$1',
    '' => 'IndexController/main'


];