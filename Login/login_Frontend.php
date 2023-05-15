<!doctype html>
<html lang="it">
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
                    <div class="form-group">
                        <label for="inputPassword" class="sr-only" hidden>Password</label>
                        <input type="password" id="inputPassword" class="form-control" placeholder="Password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>"required>
                    </div>

                    <div class="form-group">
                        <div class="mb-3 float-start">
                            <label>
                                <a href="">Password dimenticata?</a>
                            </label>
                        </div>
                        <div class="checkbox mb-3 float-end">
                            <label>
                                <input id="remeber-me" type="checkbox" value="remember-me"> Ricordami
                            </label>
                        </div>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block w-100" type="submit">Accedi</button>
                </form>
                <label>
                    <a id="registration" href="www.google.com">Non sei registrato?</a>
                </label>
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
    let registrationLink = $("#registration");
    let form = document.querySelector("form");
    let errorMessage = $("#loginErrorMessage");

    form.addEventListener("submit", function (event) {
        event.preventDefault();

        if (email.value === "" || password.value === "") {
            alert("Inserisci i dati negli appositi campi");
        } else {
            if(rememberMe.is(':checked'))
                remeberMeStatus = 1;
            else
                remeberMeStatus = 0;

            $.post("../php/login/login.php", {
                email: email.value,
                pw: password.value,
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
                        errorMessage.html("Utente non trovato");
                    } else if(data.status === 405){
                        errorMessage.html("Password incorretta");
                    } else {
                        errorMessage.html("Errore inaspettato");
                    }
                });
        }
    });
    $(document).ready(function () {
        let data = new Date().getFullYear();
        $("#dateCopyright").html("&copy; "+data.toString());
    });
</script>
</html>
