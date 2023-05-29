<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Pannello di controllo</title>
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/@popperjs/core/dist/cjs/popper.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<?php
session_start();
if (isset($_SESSION['session_id'])){
    ?>
    <body>
    <script>
        $(document).ready(function () {
            //console log cookie
            console.log(document.cookie);
            console.log("<?php echo $_COOKIE['email']; ?>");
        });
    </script>
    <button onclick="logout()">ciao</button>
    <div class="modal fade" id="exit" tabindex="-1" aria-labelledby="exitModalLabel" aria-hidden="true" role="dialog"
         onresize="">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exitModalLabel">Disconnessione</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="disconnect-message">
                    Sei sicuro di volerti disconnettere dall'account "UtenteTest1"?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <button type="button" class="btn btn-danger" onclick="logout()">Disconnetti</button>
                </div>
            </div>
        </div>
    </div>

    <div class="wrapper">
        <nav style="position: fixed; left: 0; top: 0; height: 100%;" class="sidebar" id="sidebar">
            <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark sidebar">
                <img class="mb-4" src="media/logo/logo.svg" alt="" width="auto" height="72">
                <span class="fs-4">Pannello di controllo</span>
                <hr>
                <div class="nav nav-pills flex-column mb-auto d-grid gap-2" id="v-pills-tab" role="tablist"
                     aria-orientation="vertical">
                    <button class="nav-link active text-white text-start hover-button" id="v-pills-dashboard-tab"
                            data-bs-toggle="pill"
                            data-bs-target="#v-pills-dashboard"
                            type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
                        <i class="bi bi-bank2" style="margin-right: 5px"></i>
                        Gestisci
                    </button>
                    <a class="nav-link text-white text-start hover-button" href="lista/eventi.html">
                        <i class="bi bi-calendar-range" style="margin-right: 5px"></i>
                        Eventi
                    </a>
                    <a class="nav-link text-white text-start hover-button" href="lista/itinerari.html">
                        <i class="bi bi-compass" style="margin-right: 5px"></i>
                        Itinerari
                    </a>
                    <a class="nav-link text-white text-start hover-button" href="lista/luoghi.html">
                        <i class="bi bi-geo" style="margin-right: 5px"></i>
                        Luoghi
                    </a>
                    <a class="nav-link text-white text-start hover-button" href="lista/ricettivita.html">
                        <i class="bi bi-shop" style="margin-right: 5px"></i>
                        Ricettività
                    </a>
                    <a class="nav-link text-white text-start hover-button" href="lista/servizi.html">
                        <i class="bi bi-info-circle" style="margin-right: 5px"></i>
                        Servizi
                    </a>
                    <button class="nav-link text-white text-start hover-button" id="v-pills-events-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-events"
                            type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
                        <i class="bi bi-people-fill" style="margin-right: 5px"></i>
                        Utenti
                    </button>
                </div>
                <hr>
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exit">
                    Disconnettiti
                </button>
                <p style="padding-top: 10px; text-align: center; color: gray; font-size: 11px;">Sessione attiva dal 12 Maggio 2022</p>
            </div>
        </nav>
        <div class="margin" id="content">
            <div class="tab-content" id="v-pills-tabContent">
                <a onclick="sidebarButton()">
                    <i style="font-size: 35px; color: gray; margin-left: 15px;" class="bi bi-x" id="sidebarIcon"></i>
                </a>
                <div class="tab-pane fade show active" id="v-pills-dashboard" role="tabpanel"
                     aria-labelledby="v-pills-home-tab"
                     tabindex="0">
                    <div class="container px-4 py-4" id="featured-3">
                        <h2 class="pb-2 border-bottom">Ultime modifiche</h2>
                        <div class="row g-6 py-3 row-cols-1 row-cols-lg-3">
                            <div class="feature col">
                                <div class="feature-icon d-inline-flex align-items-center justify-content-center bg-gradient text-primary fs-2 mb-3">
                                    <i class="bi bi-calendar-date"></i>
                                </div>
                                <h2>Evento aggiunto</h2>
                                <p class="blockquote-footer" style="padding-top: 10px;">
                                    17 Maggio 2022
                                </p>
                                <p>Il mercato di Fornovo di Taro è l'evento del mese da non perdere.</p>
                                <div class="btn-group">
                                    <a class="btn btn-primary" role="button" href="modifica/evento.html">Modifica</a>
                                    <button type="button"
                                            class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="visually-hidden">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Elimina</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="feature col">
                                <div class="feature-icon d-inline-flex align-items-center justify-content-center bg-gradient text-primary fs-2 mb-3">
                                    <i class="bi bi-bicycle" style="margin-right: 5px"></i>
                                </div>
                                <h2>Itinerario modificato</h2>
                                <p class="blockquote-footer" style="padding-top: 10px;">
                                    12 Maggio 2022
                                </p>
                                <p>La via Francigena è uno degli itinerari più ambiti della zona.</p>
                                <div class="btn-group">
                                    <a class="btn btn-primary" role="button" href="modifica/itinerario.html">Modifica</a>
                                    <button type="button"
                                            class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="visually-hidden">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Elimina</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="feature col">
                                <div class="feature-icon d-inline-flex align-items-center justify-content-center bg-gradient text-primary fs-2 mb-3">
                                    <i class="bi bi-bicycle" style="margin-right: 5px"></i>
                                </div>
                                <h2>Itinerario aggiunto</h2>
                                <p class="blockquote-footer" style="padding-top: 10px;">
                                    11 Maggio 2022
                                </p>
                                <p>La via Francigena è uno degli itinerari più ambiti del mondo.</p>
                                <div class="btn-group">
                                    <a class="btn btn-primary" role="button" href="modifica/itinerario.html">Modifica</a>
                                    <button type="button"
                                            class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="visually-hidden">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Elimina</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <h2 class="pb-2 border-bottom" style="margin-top: 50px;">Mappa</h2>
                        <div id="generalMap"></div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-events" role="tabpanel">
                    <div class="container px-4 py-5" id="events">
                        <h2 class="pb-2 border-bottom">
                            Ultimi eventi modificati
                            <a class="btn btn-secondary btn-sm" href="lista/eventi.html" role="button">Vedi
                                                                                                       tutti
                            </a>
                        </h2>
                        <div class="row g-5 py-4 row-cols-1 row-cols-lg-2">
                            <div class="bigButton">
                                <div style="padding-top: 110px;"
                                     class="feature-icon d-inline-flex align-items-center justify-content-center bg-gradient text-primary fs-1 mb-1">
                                    <i class="bi bi-plus-circle-fill"></i>
                                </div>
                                <p style="padding-top: 75px; color: gray; font-size: 13px;">Aggiungi un nuovo
                                                                                            evento</p>
                            </div>
                            <div class="feature col">
                                <div class="feature-icon d-inline-flex align-items-center justify-content-center bg-gradient text-primary fs-2 mb-3">
                                    <i class="bi bi-calendar-date"></i>
                                </div>
                                <h2>Evento aggiunto</h2>
                                <p class="blockquote-footer" style="padding-top: 10px;">
                                    17 Maggio 2022
                                </p>
                                <p>Il mercato di Fornovo di Taro è l'evento del mese da non perdere.</p>
                                <div class="btn-group">
                                    <a class="btn btn-primary" role="button" href="modifica/evento.html">Modifica</a>
                                    <button type="button"
                                            class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="visually-hidden">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Elimina</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <h2 class="pb-2 border-bottom" style="margin-top: 50px;">Mappa degli eventi</h2>
                        <div id="eventsMap"></div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-infrastructure" role="tabpanel">
                    <div class="container px-4 py-5" id="infrastructure">
                        <h2 class="pb-2 border-bottom">
                            Ultime ricettività modificate
                            <a class="btn btn-secondary btn-sm" href="lista/ricettivita.html" role="button">Vedi
                                                                                                            tutte
                            </a>
                        </h2>
                        <div class="row g-5 py-4 row-cols-1 row-cols-lg-3">
                            <div class="bigButton">
                                <div style="padding-top: 110px;"
                                     class="feature-icon d-inline-flex align-items-center justify-content-center bg-gradient text-primary fs-1 mb-1">
                                    <i class="bi bi-plus-circle-fill"></i>
                                </div>
                                <p style="padding-top: 75px; color: gray; font-size: 13px;">Aggiungi una nuova
                                                                                            ricettività</p>
                            </div>
                        </div>
                        <h2 class="pb-2 border-bottom" style="margin-top: 50px;">Mappa dei delle ricettività</h2>
                        <div id="infrastructureMap"></div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-services" role="tabpanel">
                    <div class="container px-4 py-5" id="services">
                        <h2 class="pb-2 border-bottom">
                            Ultimi servizi modificati
                            <a class="btn btn-secondary btn-sm" href="lista/servizi.html" role="button">Vedi
                                                                                                        tutti
                            </a>
                        </h2>
                        <div class="row g-5 py-4 row-cols-1 row-cols-lg-3">
                            <div class="bigButton">
                                <div style="padding-top: 110px;"
                                     class="feature-icon d-inline-flex align-items-center justify-content-center bg-gradient text-primary fs-1 mb-1">
                                    <i class="bi bi-plus-circle-fill"></i>
                                </div>
                                <p style="padding-top: 75px; color: gray; font-size: 13px;">Aggiungi un nuovo
                                                                                            servizio</p>
                            </div>
                        </div>
                        <h2 class="pb-2 border-bottom" style="margin-top: 50px;">Mappa dei servizi</h2>
                        <div id="servicesMap"></div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-itinerary" role="tabpanel">
                    <div class="container px-4 py-5" id="itinerary">
                        <h2 class="pb-2 border-bottom">
                            Ultimi itinerari modificati
                            <a class="btn btn-secondary btn-sm" href="lista/itinerari.html" role="button">Vedi
                                                                                                          tutti
                            </a>
                        </h2>
                        <div class="row g-5 py-4 row-cols-1 row-cols-lg-3">
                            <div class="bigButton">
                                <div style="padding-top: 110px;"
                                     class="feature-icon d-inline-flex align-items-center justify-content-center bg-gradient text-primary fs-1 mb-1">
                                    <i class="bi bi-plus-circle-fill"></i>
                                </div>
                                <p style="padding-top: 75px; color: gray; font-size: 13px;">Aggiungi un nuovo
                                                                                            itinerario</p>
                            </div>
                            <div class="feature col">
                                <div class="feature-icon d-inline-flex align-items-center justify-content-center bg-gradient text-primary fs-2 mb-3">
                                    <i class="bi bi-bicycle" style="margin-right: 5px"></i>
                                </div>
                                <h2>Itinerario modificato</h2>
                                <p class="blockquote-footer" style="padding-top: 10px;">
                                    12 Maggio 2022
                                </p>
                                <p>La via Francigena è uno degli itinerari più ambiti della zona.</p>
                                <div class="btn-group">
                                    <a class="btn btn-primary" role="button" href="modifica/itinerario.html">Modifica</a>
                                    <button type="button"
                                            class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="visually-hidden">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Elimina</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="feature col">
                                <div class="feature-icon d-inline-flex align-items-center justify-content-center bg-gradient text-primary fs-2 mb-3">
                                    <i class="bi bi-bicycle" style="margin-right: 5px"></i>
                                </div>
                                <h2>Itinerario aggiunto</h2>
                                <p class="blockquote-footer" style="padding-top: 10px;">
                                    11 Maggio 2022
                                </p>
                                <p>La via Francigena è uno degli itinerari più ambiti del mondo.</p>
                                <div class="btn-group">
                                    <a class="btn btn-primary" role="button" href="modifica/itinerario.html">Modifica</a>
                                    <button type="button"
                                            class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="visually-hidden">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Vedi itinerari nella stessa
                                                                              località</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#">Elimina</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <h2 class="pb-2 border-bottom" style="margin-top: 50px;">Mappa degli itinerari</h2>
                        <div id="itineraryMap"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const tokenID = "eyJhbGciOiJFUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6IjczNDlEUzQ4NkgifQ.eyJpc3MiOiI0WjlTVDZLRkdWIiwiaWF0IjoxNjUyMjkyMDA2LCJleHAiOjE2NTQ4ODM5ODF9.MRYZ5EyUSvRkM8zeWaE7lasmRXozBWsRk10WxtO8jpjnzkvJktWapV2LfhX0zkylfQGKA-Cv99TFNoEltUY3iQ";

        mapkit.init({
            authorizationCallback: function (done) {
                done(tokenID);
            }
        });

        let generalMap = new mapkit.Map("generalMap");
        let eventsMap = new mapkit.Map("eventsMap");
        let infrastructureMap = new mapkit.Map("infrastructureMap");
        let servicesMap = new mapkit.Map("servicesMap");
        let itineraryMap = new mapkit.Map("itineraryMap");

        $(document).ready(function () {
            $("#submit").click(function () {
                $.post("http://localhost:8080/pctomaggio/PCTO-Maggio-AS20212022/api/login.php", "json")
                    .fail(function () {
                        alert("È stato riscontrato un errore inaspettato.");
                    })
                    .done(function (data) {
                        if (data.id != null) {
                            document.getElementById("disconnect-message").innerHTML = "Sei sicuro di volerti disconnettere dall'account \"" + sessionStorage.getItem('name') + " " + sessionStorage.getItem('cognome') + "\"?";
                        } else {
                            logout();
                        }
                    });
            });
        });

        const event1 = new mapkit.Coordinate(44.692944427751556, 10.096279786048903);
        const event1Annotation = new mapkit.MarkerAnnotation(event1);
        event1Annotation.color = "#e7e7e7";
        event1Annotation.title = "Evento";
        event1Annotation.glyphText = "\u{1F4C5}";
        event1Annotation.selected = "true";
        event1Annotation.subtitle = "Mercato di Fornovo";

        const itinerary1 = new mapkit.Coordinate(44.687861147380445, 10.103751392788098);
        const itinerary1Annotation = new mapkit.MarkerAnnotation(itinerary1);
        itinerary1Annotation.color = "#e7e7e7";
        itinerary1Annotation.title = "Itinerario";
        itinerary1Annotation.selected = "true";
        itinerary1Annotation.glyphText = "\u{1F6B2}";
        itinerary1Annotation.subtitle = "Via Francigena";

        eventsMap.showItems([event1Annotation])
        itineraryMap.showItems([itinerary1Annotation])

        const generalEvent1 = new mapkit.Coordinate(44.692944427751556, 10.096279786048903);
        const generalEvent1Annotation = new mapkit.MarkerAnnotation(generalEvent1);
        generalEvent1Annotation.color = "#e7e7e7";
        generalEvent1Annotation.title = "Evento";
        generalEvent1Annotation.glyphText = "\u{1F4C5}";
        generalEvent1Annotation.subtitle = "Mercato di Fornovo";

        const generalItinerary1 = new mapkit.Coordinate(44.687861147380445, 10.103751392788098);
        const generalItinerary11Annotation = new mapkit.MarkerAnnotation(generalItinerary1);
        generalItinerary11Annotation.color = "#e7e7e7";
        generalItinerary11Annotation.title = "Itinerario";
        generalItinerary11Annotation.glyphText = "\u{1F6B2}";
        generalItinerary11Annotation.subtitle = "Via Francigena";

        generalMap.showItems([generalEvent1Annotation, generalItinerary11Annotation]);
        generalMap.cameraDistance = 2000;



        function sidebarButton() {
            if (!document.getElementById("sidebar").classList.contains("active")) {
                document.getElementById("sidebar").classList.add('active');
                document.getElementById("sidebarIcon").classList.remove('bi-x');
                document.getElementById("sidebarIcon").classList.add('bi-list');
                document.getElementById("content").classList.add('full');
            } else {
                document.getElementById("sidebar").classList.remove('active');
                document.getElementById("sidebarIcon").classList.remove('bi-list');
                document.getElementById("sidebarIcon").classList.add('bi-x');
                document.getElementById("content").classList.remove('full');
            }
        }
        function logout() {
            $.get("php/Login/logout.php", {deleteCookie: "1"} ,function (data) {
                window.location.href = "Login/login_Frontend.php";
            });
        }
    </script>
    </body>
    <?php
} else {
  header('Location: Login/login_Frontend.php');
?>
<?php
}
?>
</html>
