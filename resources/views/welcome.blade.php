<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <title>HTML Chat</title>
    <style rel="stylesheet">
        .thumb {
            height: 200px;
            border: 1px solid #000;
            margin: 10px 5px 0 0;
        }
        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }
        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 50%; /* Could be more or less, depending on screen size */
        }
        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #contents {
            width: 500px;
            margin: auto;
        }
        #wrapper {
            height: 520px;
            overflow: auto;
        }
        body {
            background-color: #edecec;
            /* font-family: 'OverlockRegular', Arial, sans-serif; */
        }
        .logo {
            margin: auto;
            /* background: url("../gfx/logo.png") no-repeat; */
            width: 260px;
            height: 100px;
        }
        .bubble-avatar {
            height: 50px;
            width: 50px;
            float: left;
            margin-right: 20px;
        }
        .bubble-text {
            height: 50px;
            display: table;
        }
        .bubble-text p {
            display: table-cell;
            vertical-align: middle;
            font-size: 16px;
        }
        .bubble-quote {
            /* background: url("../gfx/quote.png") no-repeat; */
            background-position: top right;
            float: right;
            position: absolute;
            left: 45px;
            top: -10px;
            height: 30px;
            width: 30px;
        }
        .bubble {
            display: inline-block;
            position: relative;
            clear: both;
            background-color: #ffffff;
            width: 98%;
            border: 1px solid #bfc2c4;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15);
        }
        .bubble-container {
            padding-top: 8px;
            width: 98%;
        }
        .form input, .form textarea {
            border: 1px solid #bfc2c4;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15);
        }
        .form input[type="text"], .form input[type="password"] {
            border: 1px solid #c9c9c9;
            color: #404040;
            font-size: 11px;
            height: 28px;
            margin-bottom: 3px;
            padding: 0 6px;
        }
        /* Button */
        .button {
            font-size: 12px;
            display: inline-block;
            padding: 5px 16px;
            box-shadow: rgba(0, 0, 0, 0.14902) 0px 1px 3px;
        }
        .button:hover .arrow {
            background-color: #03a5d1;
        }
        .button:visited {
            color: #ffffff;
        }
        .button, input[type="submit"], input[type="reset"], button {
            background: #03a5d1;
            border: 1px;
            color: #fff;
            cursor: pointer;
            font-weight: 400;
            height: auto;
            overflow: visible;
            padding: 7px 20px;
            -webkit-transition: background-color .2s ease;
            -moz-transition: background-color .2s ease;
            -ms-transition: background-color .2s ease;
            -o-transition: background-color .2s ease;
            transition: background-color .2s ease;
            width: auto;
        }
        .button:hover, input[type="submit"]:hover, input[type="reset"]:hover, button:hover {
            background: #3a3a3a;
            color: #fff;
        }
    </style>
</head>
<body onload="modalScript()">


<div class="logo"></div>

<div id="contents">
    <div id="wrapper">
        <div class="bubble-container">

            <div class="bubble-container"><span class="bubble"><img class="bubble-avatar" src="https://infosertecblog.files.wordpress.com/2016/08/bot-de-telegram.jpg" alt="imagen no disponible"/><div class="bubble-text"><p>Bienvenido al Chat.</p></div><span class="bubble-quote" /></span></div>


                @foreach($mensajes as $mensaje)
                    @php
                        $texto = $mensaje->texto;
                        $user = $mensaje->usuario;
                        $fecha = $mensaje->fecha;
                        $fechaEx = explode(" ", $fecha);
                        $hora = $fechaEx[1];
                    @endphp
                <div class="bubble-container"><span class="bubble"><img class="bubble-avatar" src="" /><div class="bubble-text"><p><font color="gray">( {{ $hora }} ) </font> -  <font color="blue">{{ $user  }}</font>: {{ $texto  }}</p></div><span class="bubble-quote" /></span></div>
                @endforeach

        </div>
    </div>
</div>

<div  align="center">

</div>


<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content" align="center">
        <input type="file" id="files" name="files[]" />
        <br />
        <output id="list">
        </output>

        <p>Ingresa nombre de usuario</p> <input type="text" id ="idNick" name="idNick"/>  <input type="submit" class="button" id="idButtonModal" value="Send"/>

    </div>

</div>

<center>
    <div id="form">
        <form class="form" method="post" action ="/mensaje">
            {!! csrf_field() !!}
            <input id="msgText" style="width:393px" type="text" name="msgText"/>
            <button type="submit">Submit</button>

            <br>

            <input id="user" style="visibility:hidden" type="text" name="user"/>
        </form>
    </div>
</center>
</body>
</html>

<script>
    var buttonModal = document.getElementById("idButtonModal");
    var sourceAvatar = " http://freevector.co/wp-content/uploads/2010/02/68796-chat-avatar.png"
    document.getElementById('files').addEventListener('change', archivo, false);
    function modalScript() {
        document.getElementById("list").innerHTML = ['<img class="thumb" id="idAvatar" src=" http://freevector.co/wp-content/uploads/2010/02/68796-chat-avatar.png" />'].join('');
        // Get the modal
        var modal = document.getElementById('myModal');
        var user = getCookie("username");
        if (user != "") {
            document.getElementById("user").value = user;
        } else {
            modal.style.display = "block";
        }
    }
    //Funcion para el button del modal
    buttonModal.onclick = function() {
        var modal = document.getElementById('myModal');
        //document.getElementById("idAvatarChat").src = sourceAvatar;
        var user = document.getElementById("idNick").value;
        if (user != "" && user != null) {
            console.log(sourceAvatar)
            /*if(!sourceAvatar.includes(".png") || !sourceAvatar.includes(".jpg")){
             alert("Debe ingresar una imagen valida")
             }else{*/
            setCookie("username", user, 7);
            modal.style.display = "none";
            document.getElementById("user").value = user;
            //}
        }else{
            alert("Debe ingresar un usuario")
        }
    }
    //Cambiamos el valos de cookie
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
    //Obtenemos la cokkie
    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    //Al examinar la imagen
    function archivo(evt) {
        var files = evt.target.files; // FileList object
        //Obtenemos la imagen del campo "file".
        for (var i = 0, f; f = files[i]; i++) {
            //Solo admitimos imágenes.
            if (!f.type.match('image.*')) {
                continue;
            }
            var reader = new FileReader();
            reader.onload = (function(theFile) {
                return function(e) {
                    // Creamos la imagen.
                    document.getElementById("list").innerHTML = ['<img class="thumb" id="idAvatar" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                    sourceAvatar = e.target.result
                };
            })(f);
            reader.readAsDataURL(f);
        }
    }
</script>