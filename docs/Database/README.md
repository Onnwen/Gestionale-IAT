# Documentazione database

## Quale è lo schema del db?

Lo trovate nel file `iat.sql` in questa cartella

## Dove metto le credenziali?

Nel file `connection.php` nella cartella `api/utils`; Se non c'è, incolla il file `example_connection.php` che trovi in questa cartella, cambia il nome del file in `connection.php` e inserisci le credenziali.

## Quali sono le credenziali per il database condiviso?

**db_user**: IAT

**db_name**: iat

**db_host**: thecouriernv.tplinkdns.com

Ovviamente non si può mettere la password in documentazione accessibile da tutti, quindi se ne avete bisogno contattate @TheCourierNV in privato

## Come faccio a creare un database in locale?

Prima di tutto, devi avere un DBMS impostato correttamente

Fai l'accesso al tuo DBMS e crea un nuovo database; se lo vuoi fare usando direttamente SQL, il comando è:
```sql

CREATE DATABASE nome_database

```

Opzionalmente, puoi creare un nuovo utente e dargli il permesso di accedere al nuovo database; oppure, puoi lasciare l'utente di default (`root`)

A questo punto, importa nel tuo DBMS il file `iat.sql` in questa cartella (se vuoi partire da un database vuoto) o l'ultimo backup (se vuoi un database con dati realistici)

Una volta creato il database, puoi inserire le seguenti credenziali nel file `connection.php` (se non sai dove trovarlo, riferisciti alla domanda ***Dove metto le credenziali?***):

**db_user**: il nome dell'utente che hai creato (oppure `root` se hai usato quello di default)

**db_host**: localhost

**db_password**: la password che hai impostato (oppure `""` se non lo hai fatto)

**db_name**: il nome del database che hai creato