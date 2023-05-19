<?php
session_start();
if(isset($_SESSION['session_id'])){
    header('Location: ../index.php');
} else {
?>
<!doctype html>
<html lang="it" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Christian Canossa, Onnwen Cassitto and Andrea Scartazza">
    <title>AccediIAT</title>

    <!-- import from node_modules al bootstrap lib -->

    <script src="../node_modules/jquery/dist/jquery.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <script src="../node_modules/@popperjs/core/dist/umd/popper.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <link href="../node_modules/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../css/login.css" rel="stylesheet">
</head>
<body class="text-center">

<main class="form-signin w-100 m-auto">
    <div class="conteiner">
        <div class="row justify-content-center">
            <div class="form-wrap">
                <form role="form" class="form-signin text-center">
                    <img class="mb-4" src="../Media/logo/logo.svg" alt="" width="auto" height="72">
                    <h1 class="h2 mb-2 font-weight-normal">Accedere</h1>
                    <label id="loginErrorMessage" class="h5 mb-1 font-weight-normal" hidden></label>
                    <div class="form-group">
                        <label for="inputEmail" class="sr-only" hidden>Indirizzo E-Mail</label>
                        <input type="email" id="inputEmail" class="form-control" placeholder="Indirizzo E-Mail" value="<?php if(isset($_COOKIE["email"])) { echo $_COOKIE["email"]; } ?>" required autofocus>
                    </div>
                    <div class="form-group ">
                        <div class="input-group " id="passwordInputGroup">
                            <input id="inputPassword" type="password" class="form-control mb-0 rounded-0" placeholder="Password" aria-describedby="basic-addon2">
                            <span id="basic-addon2" class="input-group-text rounded-0"><a style="color: black" href=""><i class="bi bi-eye" aria-hidden="true"></i></a></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mt-2 mb-3 float-start">
                            <label>
                                <a href="">Password dimenticata?</a>
                            </label>
                        </div>
                        <div class="checkbox mt-2 mb-3 float-end">
                            <label>
                                <input id="remeber-me" type="checkbox" value="remember-me"> Ricordami
                            </label>
                        </div>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block w-100" type="submit">Accedi</button>
                </form>
                <label>
                    <a id="registration" data-bs-toggle="modal" data-bs-target="#registrationModal" href="" onclick="event.preventDefault()">Non sei registrato?</a>
                </label>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="registrationForm" role="form" class="form-signin">
                        <h1 class="h2 mb-2 font-weight-normal">Registrati</h1>
                        <label id="registrationErrorMessage" class="h5 mb-1 font-weight-normal" hidden></label>
                        <div class="form-group mb-2">
                            <label for="nameRegistration" class="sr-only float-start" >Inserisci il nome:</label>
                            <input type="text" id="nameRegistration" class="form-control rounded" placeholder="Nome" required autofocus>
                        </div>
                        <div class="form-group mb-2">
                            <label for="surnameRegistration" class="sr-only float-start" >Inserisci il cognome:</label>
                            <input type="text" id="surnameRegistration" class="form-control rounded" placeholder="Cognome" required autofocus>
                        </div>
                        <div class="form-group mb-2">
                            <label for="mailRegistration" class="sr-only float-start" >Inserisci la email:</label>
                            <input type="email" id="mailRegistration" class="form-control rounded" placeholder="Email" required autofocus>
                        </div>
                        <div class="form-group mb-2">
                            <label for="pwRegistration" class="sr-only float-start" >Inserisci password:</label>
                            <div class="input-group " id="passwordRegistrationInputGroup">
                                <input id="passwordRegistration" type="password" class="form-control mb-0 rounded-start" placeholder="Password" aria-describedby="basic-addon2">
                                <span id="basic-addon2" class="input-group-text rounded-right"><a style="color: black" href=""><i class="bi bi-eye" aria-hidden="true"></i></a></span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                    <button id="registrationButton" type="button" class="btn btn-primary" onclick="registration()">Registrati</button>
                </div>
            </div>
        </div>
    </div>
    <p id="dateCopyright" class="mt-5 mb-3 text-muted">&copy; </p>
</main>

</body>
<script>
    let email = $("#inputEmail");
    let password = $("#inputPassword");
    let rememberMe = $("#remeber-me");
    let remeberMeStatus = 0;
    let form = document.querySelector("form");
    let errorMessage = $("#loginErrorMessage");


    $(document).ready(function () {
        //copyright logo
        let data = new Date().getFullYear();
        $("#dateCopyright").html("&copy; " + data.toString());

        //remember me controll
        if(<?php if(isset($_COOKIE["email"])) { echo 1; } else { echo 0; } ?>){
            email.val("<?php if(isset($_COOKIE["email"])) { echo $_COOKIE["email"]; } ?>");
            password.val("<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>");
        }

        //view password link
        $("#passwordInputGroup a").on('click', function(event) {
            event.preventDefault();
            viewPassword("passwordInputGroup");
        });
        $("#passwordRegistrationInputGroup a").on('click', function(event) {
            event.preventDefault();
            viewPassword("passwordRegistrationInputGroup");
        });
    });

    function viewPassword(object) {
        debugger;
        if($('#' + object + ' input').attr("type") === "text"){
            $('#' + object + ' input').attr('type', 'password');
            $('#' + object + ' i').addClass( "bi-eye-slash" );
            $('#' + object + ' i').removeClass( "bi-eye" );
            $('#' + object + ' i').addClass( "rounded-bottom" );
        }else if($('#' + object + ' input').attr("type") === "password"){
            $('#' + object + ' input').attr('type', 'text');
            $('#' + object + ' i').removeClass( "bi-eye-slash" );
            $('#' + object + ' i').addClass( "bi-eye" );
        }
    }

    //form login
    form.addEventListener("submit", function (event) {
        event.preventDefault();
        if (email.value === "" || password.value === "") {
            alert("Inserisci i dati negli appositi campi");
        } else {
            if(rememberMe.is(':checked'))
                remeberMeStatus = 1;
            else
                remeberMeStatus = 0;

            $.post("../php/Login/login.php", {
                email: email.val(),
                password: password.val(),
                rememberMe: remeberMeStatus
            })
                .done (function (data){
                    window.location.replace("../index.php");
                })
                .fail (function (data){
                    errorMessage.removeAttr("hidden");
                    errorMessage.css("color", "red");
                    if(data.status === 403){
                        errorMessage.html("Password errata");
                    } else if(data.status === 404){
                        errorMessage.html("Utente inesistente");
                    } else if(data.status === 405){
                        errorMessage.html("Utente non attivo");
                    } else {
                        errorMessage.html("Errore inaspettato");
                    }
                });
        }
    });

    let registrationErrorMessage = $("#registrationErrorMessage");
    let nameRegistration = $("#nameRegistration");
    let surnameRegistration = $("#surnameRegistration");
    let mailRegistration = $("#mailRegistration");
    let passwordRegistration = $("#passwordRegistration");
    const registrationModal = document.getElementById('registrationModal')

    registrationModal.addEventListener('show.bs.modal', function(event) {
        registrationModal.querySelector('form').reset();
    })
    registrationModal.addEventListener('hide.bs.modal', function(event) {
        registrationErrorMessage.attr("hidden", "true");
    })

    //check sintax mail
    function checkMail(mail) {
        debugger;
        let mailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
        return mailRegex.test(mail);
    }

    //check sintax password
    function checkPassword(password) {
        debugger;
        let passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
        return passwordRegex.test(password);
    }

    function registration() {
        debugger;
        let name = $("#nameRegistration").val();
        let surname = $("#surnameRegistration").val();
        let email = $("#mailRegistration").val();
        let password = $("#passwordRegistration").val();
        let registrationForm = $("#registrationForm");
        let registrationErrorMessage = $("#registrationErrorMessage");
        let registrationButton = $("#registrationButton");

        if(name === "" || surname === "" || email === "" || password === ""){
            registrationErrorMessage.removeAttr("hidden");
            registrationErrorMessage.css("color", "red");
            registrationErrorMessage.html("Inserisci tutti i dati");
        } else if(checkMail(email) === false){
            registrationErrorMessage.removeAttr("hidden");
            registrationErrorMessage.css("color", "red");
            registrationErrorMessage.html("Inserisci un email valido");
        } else if(checkPassword(password) === false){
            registrationErrorMessage.removeAttr("hidden");
            registrationErrorMessage.css("color", "red");
            registrationErrorMessage.html("Inserisci una password valida");
        }
        else {
            registrationButton.attr("disabled", "true");
            $.post("../php/Registration/registration.php", {
                name: name,
                surname: surname,
                email: email,
                pw: password,
            })
                .done (function (data){
                    registrationErrorMessage.removeAttr("hidden");
                    registrationErrorMessage.css("color", "green");
                    registrationErrorMessage.html("Registrazione avvenuta con successo");
                    registrationForm.trigger("reset");
                    registrationButton.removeAttr("disabled");
                })
                .fail (function (data){
                    registrationErrorMessage.removeAttr("hidden");
                    registrationErrorMessage.css("color", "red");
                    if(data.status === 403){
                        registrationErrorMessage.html("Utente già esistente");
                    } else if(data.status === 500){
                        registrationErrorMessage.html("Registrazione Fallita");
                    } else {
                        registrationErrorMessage.html("Errore inaspettato");
                    }
                    registrationButton.removeAttr("disabled");
                });
        }
    }
</script>
<?php
    }
?>
</html>
