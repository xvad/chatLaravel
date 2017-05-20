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

    // retorno

    $mensajes = App\Mensaje::all();


    // se lo doy a la vista

    return view('welcome', ['mensajes' => $mensajes]);
});

//Agrego los mensajes a la base de datos
Route::post('mensaje',function (){

    if($_POST['msgText'] != null and $_POST['user'] != null) {
        $msg = new \App\Mensaje();
        $msg->texto = $_POST['msgText'];
        $msg->usuario = $_POST['user'];
        $msg->fecha = \Carbon\Carbon::now();
        $msg->save();

    }
    // retorno

    $mensajes = App\Mensaje::all();


    // se lo doy a la vista

    return view('welcome', ['mensajes' => $mensajes]);
});