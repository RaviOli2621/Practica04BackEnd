# Practica04BackEnd

## Idea per a la pàgina

    La idea per aquesta pàgina és ser una espècie de wikipedia de terminologies dels jocs de lluita 

## Crear i logar usuaris

### Crear usuari
    A l'hora de crear els usuaris:
        -S'ha d'omplir el formulari en html
        -Al recarregar la vista amb la informació es carrega el controladorSign.php
        -Dins de controladorSign.php:
            -Comprovar per regex el usuari, correu i la contrasenya que sigui de la forma correcte
            -Encriptar la contrasenya
            -Fer una consulta per comprovar que l'usuari no existeixi
            -Afegir l'usuari
        -Enviar feedback al usuari
### Logar usuari
    A l'hora de logar amb un usuari
        -S'ha d'omplir el formulari en html
        -Al recarregar la vista amb la informació es carrega el controladorLog.php
        -Dins de controladorLog.php:
            -Fer una consulta per treure l'usuari amb el nom indicat
            -Si la contrasenya i el correu son correctes:
                -configurar sessió i generar cookie amb el nom de la sessió
                -Retornar a l'index
            -Si la contrasenya o el correu son incorrectes
                -Enviar feedback al usuari sobre el error
### Durada de la sessió
    La durada de la sessió es controla amb una cookie. Aquesta sera explicada en l'apartat "Cookies"
## Que es pot fer logat i sense logar

### Sense logar
    -Pots anar a l'apartat de paginaciò(on pots veure tots els articles)
    -Pots anar a l'apartat de cercar(per si vols buscar un article en concret)
### Logat
    -Pots accedir a tot el contingut anterior
    -Pots editar, afegir o eliminar el contingut de la teva propietat
## Canviar contrasenya
    Per poder canviar de contrasenya actualment:
    -L'usuari ha de trobarse sense logar 
    -Ha de anar a logarse i anar a canviar contrasenya
    -Ha de omplir el formulari amb les dades del usuari i la nova contrasenya
    -En controladorSign.php:
        -Cridem a la funció de "logarse" del controladorLog.php persaver si l'usuari es correcte
        -Si l'usuari és correcte
            -Comprovem que el format de la contrasenya és correcte
            -Si la contrasenya es correcte
                -Fem el update del usuari
                -Modifiquem la session activa (ja que en el moment que es comprova que l'usuari es correcte ens loguem) amb la nova contrasenya
                -Redirecciona a index
            -Contrasenya incorrecte: retornar feedback del format de la contrasenya i destruir la sessió i la cookie creada 
        -Usuari incorrecte: retornar feedback del format de la contrasenya i destruir la sessió i la cookie creada 

## LogOut
    Al clicar el boto de deslogarse, es recarrega el index i es destrueixen la session i la cookie 

## Cookies

### Durada de la sessió
    
    -La cookie anomenada "UsuariLogat" serveix per controlar el temps de la sessió.
    -Al inici de cada vista es crida a la funció de acabaSession.php, la qual controla que:
        -Si la cookie encara existeis renova el temps d'aquesta
        -Si la cookie no existeix però si la session, acaba amb la sessió i et retorna a index (per si volies anar a una pàgina que no pots sense sessió)
        -Si no hi ha sessió i ens trobem en una pàgina que no es pot anar sense sessió (ho savem ja que aquesta funció es crida després del include en les vistes corresponents), ens retorna a index
    -S'utilitzen cookies en comptes d'una variable de la session ja que hem sembla més sencill renovar el temps de la cookie que calcular la diferencia de la data de la actualització de la session amb la actual

### Paginació
    
    Existeixen dos cookies: "articles" i "pagina"
        -Articles guarda el número d'artícles per pàgina
        -Pagina guarda la última pàgina on s'ha anat
    Aquestes cookies es creen en cookiesPaginacio.php, codi que es crida quan ja s'ha carregat la part de la pàgina on encara poden variar les dades 

## Canvis respecte la pràctica 2 

    -Ara la pàgina del index s'encarrega de cridar un html o un altre depenent de si et trobes logat o no (indexVista/Bloquejat i indexVista/Desbloquejat)
    -Ara hi ha un controlador per vista (controladorSign serveix per el Sign i per el canviar la contrasenya)

## Altres

    -En controlador trovem la carpeta altres amb un codi per generar l'icone amb la lletra del usuari
    -En controlador trovem la carpeta cookies amb un codi encarregat de gestionar les cookies de paginacio
    -Ara hi ha un estil general (estils.css), un estil per paginacio (estils2.css) i els estils per la pagina de sign i login (estilsLog.css)
    -Per poder mantenir les dades al tenir un error amb el login i el sign existeix el document mantenerDatos.js en Vista/Js