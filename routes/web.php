<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(isset($_GET['msg'])){
        $msg = new \App\Mensaje();
        $msg->usuario = $_GET['user'];
        $msg->texto = $_GET['msg'];
        $msg->fecha = \Carbon\Carbon::now();
        $msg->save();
    }


    // retorno

    $mensajes = App\Mensaje::all();


    // se lo doy a la vista

    return view('welcome', ['mensajes' => $mensajes]);
});

//Obtengo los mensajes de la base de datos
Route::get('/mensaje',function (){

        if(isset($_GET['msg'])){
                $msg = new \App\Mensaje();
                $msg->usuario = $_GET['user'];
                $msg->texto = $_GET['msg'];
                $msg->fecha = \Carbon\Carbon::now();
                $msg->save();
        }


    // retorno

    $mensajes = App\Mensaje::all();


    // se lo doy a la vista

    return view('welcome', ['mensajes' => $mensajes]);
});


