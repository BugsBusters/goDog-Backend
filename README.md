# HackUnivpm 2017 - Backend ![TravisCI Status](https://travis-ci.com/andreacivita/backend.svg?token=7Kxp6k8HEGz25QNrCnW3&branch=master)

Back-end per HackUnivpm 2017. L'app è integrata con TravisCI per il testing automatico.

## INSTALLAZIONE

```
composer install

cp .env.example .env

php artisan key:generate

```
Settare i parametri di connessione al DB nel file .env **come segue**

```YAML
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_db
DB_USERNAME=username
DB_PASSWORD=password // scrivi '' se non hai password
```

Ora, per importare il Database procedi con il comando

```
php artisan migrate
```

## CONTRIBUZIONE

Per contribuire al progetto è necessario seguire alcune regole:

1. Tutte le rotte vanno definite nel file api.php (contenuto nella cartella routes). A tutte le rotte verrà aggiunto il prefisso /api.     <br>Es. se definisco la rotta '/prodotti' allora potrò accedervi utilizzando l'url 'localhost/api/prodotti'
2. Scrivere nuovi test per ogni funzionalità implementata. I test sono basati su PHPUnit, è possibile guardare nella cartella test per capire come scriverli. Vanno lanciati prima di eseguire il commit, per essere sicuri che tutto funzioni. Inoltre, il sistema TravisCI li esegue in automatico e verifica che tutte i test abbiano successo.
3. Ogni modifica al database va scritta nel file di migrazione (nella cartella 'database/migrations'). In questo modo, è possibile manterere via GIT tutti i cambiamenti alle tabelle. Per ogni nuova modifica, generare una nuova classe migrazione, aggiungere le modifiche e salvare. <br> NB: la nuova migrazione verrà salvata come un nuovo file. Non cancellare i files vecchi, perchè possono servire come backup.
4. Ogni funzionalità va sviluppata in un apposito branch. Si crea il branch, si sviluppa tutto il necessario e poi si esegue una pull-request. TravisCI bloccherà automaticamente tutte le pull request che non hanno passato i test.
5. Non esistono views. Ogni api eseguirà determinate operazioni e ritornerà sempre un file JSON (in qualunque caso) con il corretto HTTP Code.
6. Commentare tutti i metodi scritti, compresi i test, seguendo lo stile della JavaDoc (basta digitare /** una riga sopra al metodo per generare la documentazione)
7. I test sono differenziati tra Unit Test e Feature Test. I test unit si riferiscono ad un metodo specifico (es. test per inserimento su db). I feature test testano tutta la funzionalità.

## NOTE ULTERIORI

Verrà incluso in questo file (README.MD) un pop-up di travisCI che segnala lo stato dell'ultima build (ossia l'ultima versione). In questo modo, sarà possibile tenere sott'occhio eventuali errori e correggerli appena si manifestano. <br>
