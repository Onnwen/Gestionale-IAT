# Documentazione progetto IAT

## Come funziona la documentazione?

C'è una cartella per ogni categoria, dove troverete i file pertinenti

Iniziate a leggere dal file `README.md`

## Cosa devo fare per iniziare a sviluppare?

Per fare il setup iniziale del progetto, basta seguire questa guida:

### Prerequisiti

Devi avere già installato:
- NPM
- Un ambiente di sviluppo (Ad esempio: VSCODE)
- Un browser (Ad esempio: Chrome, FIREFOX, Opera, Brave, Vivaldi, Safari)
- Un server web (Ad esempio: Xampp, NGINX, Apache)
- Un interprete PHP (Ad esempio: Xampp, PHP-FPM)

Sono altamente consigliati (ma non strettamente necessari):

- Un client per git (Ad esempio: Github desktop, GIT-SCM)
- Un DBMS (Ad esempio: Xampp, MARIADB)
- Un debugger per il PHP (Ad esempio: XDEBUG)
- Un programma per fare il debug delle richieste HTTP (Ad esempio: Postman, CURL)
- Un debugger per il JavaScript (Ad esempio: quello incluso nel browser, estensioni per il tuo ambiente di sviluppo)

### Prima fase: Il download del progetto

Vai sulla pagina del progetto (su github.com) e scegli come scaricare il progetto.

Consiglio di clonare la repository usando il tuo client di git, ma in alternativa si può scaricare uno zip.

#### Il server web

Consiglio caldamente di scaricare i file direttamente nella cartella del tuo server web

A questo punto, controlla se andando su `http://localhost/NOME_CARTELLA_PROGETTO` nel tuo browser si apre il progetto; è normale che la pagina non funzioni correttamente, visto che mancano le librerie necessarie.

### Seconda fase: Le librerie

Per scaricare le librerie è sufficiente:

1) Aprire una riga di comando
2) Navigare alla cartella del progetto (usando il comando `cd`)
3) Inserire il comando `npm install`

Se il terminale si lamenta che `npm` non è un comando esistente, vuol dire che non hai installato NPM correttamente

### Terza fase: Il database

Per poter connetterti al database, è necessario modificare il file `connection.php` ed inserire le credenziali di un database.

Hai due opzioni riguardo il database:

1) Puoi usare il database condiviso
2) Puoi creare un nuovo database da usare in locale

In entrambi i casi, puoi trovare le relative istruzioni nella cartella `Database` in questa documentazione

### Fasi opzionali

#### Quarta fase: Imposta il debugger PHP
#### Quinta fase: Imposta il debugger JavaScript
#### Sesta fase: Imposta il tuo ambiente di sviluppo