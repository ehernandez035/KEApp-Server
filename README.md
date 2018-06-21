# KEApp-Server

KEApp Android sitemako aplikazioaren zerbitzari aldeko kodea.
PHPz idatzitako kode honekin, datu-baseko informazioa kudeatzen da.

Zerbitzariak datu-baseko informazioarekin lan egiten du.
Informazio hori eguneratu, eskatu eta ezabatzeko eskaerak PHP
lengoaian exekutatzen dira, honek MySQL datu baseen kudeaketa
sistemaren bitartez datu baseko informazioa moldatuz.

Aplikazioaren funtzionamendurako honako fitxategiak sortu dira:

- `register.php`: erabiltzaile berriek kontua sortzeko eskaera. Erabiltzaile izena,
pasahitza eta email-a gordeko dira datu basean, baldin eta erabiltzaile izena eta email-a errepikaturik ez badaude.

- `login.php`: erabiltzaile izena eta pasahitza emanda, saioa hasteko eskaera.
Saioa hasita, hainbat eskaeren artean mantentzeko, Cookiak (informazio atal txikiak)
erabiliko dira erabiltzailea identifikatu ahal izateko.
Honekin zerbitzariaren eskaera kopurua minimizatzen da, eta erabiltzailearen identifikazioa eskaera guztietan bermatzen da.

- `logout.php`: erregistratutako erabiltzaileek saioa ixteko erabiltzen den fitxategia.

- `deleteAccount.php`: erregistratutako erabiltzaileek aplikazioko kontua ezabatzeko fitxategia.

- `crash.php`: aplikazioaren proba fasean, \textit{alpha-tester}-ren batek aplikazioan erroreak aurkituz gero,
errorea detektatzeko mezua bidaltzen duen fitxategia.

- `userInfo.php`: Cookien bitartez erabiltzailearen puntuak , maila, eta erabiltzaile izena lortzen ditu.

- `myranking.php`: erabiltzailearen posizioa ranking-ean bueltatzen du.

- `ranking.php`: puntuazio altueneko 10 erabiltzaileen erabiltzaile izenak eta puntuazioa erakusteko balio du.

- `quizzes.php`: galdetegien zerrenda erakusteko balio du, eta hauetan asmatutako
galderen portzentaia kalkulatzeko informazioa.

- `question.php`: galdetegi bakoitzari dagokion galderak erakusteko balio du.

- `check\_answers.php`: erabiltzaileak erantzundako galderak okerrak diren ala ez egiaztatzeko kodea.
Galdetegiak erantzuterakoan, lehendik lortutako puntuazioa hobetzekotan, puntuazio berria datu basean gordeko da.

- `changeEmail, changePassword, changeUsername`: profileko datuak modifikatzeko fitxategiak.
Emaila, pasahitza eta erabiltzaile-izena aldatzeko aukera eskaintzen dute, hurrenez hurren.

- `check\_password`: pasahitza aldatzerakoan, lehendik zegoen pasahitza eskatzen da, segurtasuna bermatzeko. 
Lehendik zegoen pasahitza erabiltzaileari eskatutakoaren berdina dela egiaztatzeko fitzategia da.

- `PrivacyPolicy.html`: Pribatutasun Politika erakusteko fitxategia.
