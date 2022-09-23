<?php

namespace App\Http\Controllers\webapp;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    function __construct() {

    }

    function validate_session(){
        if(!isset($_SESSION)) 
            { 
                session_start(); 
        } 
        if(!isset($_SESSION['userid'])){
            header('Location: /');
            exit;
        }
    }
}
