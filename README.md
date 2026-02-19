# vmh.great-site.net
----------------------------------------------------------------------------------------------------
Crear Proyecto 

1.Para este "proyecto" vmh.great-site.net primero se tiene que crear un repository,en este caso:
https://github.com/moralesv-git/vmh.great-site.net
Para combinar con Visual Studio integrado en GitHub se cambia .com por .dev en este caso:
https://github.dev/moralesv-git/vmh.great-site.net

----------------------------------------------------------------------------------------------------
Linkear con con infinityfree.com para editar desde VS en GitHub

2.Otorgar persmisos a Github para interactuar con la cuenta en InifinityFree. Para esa conexión se requiere otorgarle a GitHub permiso para acceder a las credenciales de InifinityFree.

Objetivo: Cargar el código en GitHub que desde ahora será el responsable del deployment de todo ese código en InfinityFree.

Para obtener las informaciones para las credenciales en dashboard de la cuenta de InfinityFree (https://dash.infinityfree.com/accounts/if0_40996511/domains/vmh.great-site.net) ir a:
FTP Details\
Ahi se copia el texto de
FTP Username: if0_***           
FTP Password: ******
FTP Hostname: ftpupload.net

Se necesita utilizar GitHub Secrets para usar FTP
Settings\Secrets and variables\Actions --> New repository secret, donde se deberán encontrar las siguientes credenciales:

En GitHub:              De InfnitiyFree:
FTP_USERNAME        --> Aquí se pega la información de FTP Username, i.e. if0_***
FTP_PASSWORD        --> Aquí se pega la información de FTP Password, i.e. ******







 Tutorial en: https://www.youtube.com/watch?v=8APySoBHj5I

----------------------------------------------------------------------------------------------------
Crear una database, por ejemplo en este caso:
db_vmh

que en InfinityFree se refleja como:
if0_40996511_db_vmh

----------------------------------------------------------------------------------------------------
Crear config\database.php

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
// Setting up the time zone
date_default_timezone_set('America/Mexico_City');
// Host Name se cambia por: MySQL Hostname de InfinityFree: sql308.infinityfree.com
$db_hostname = 'maria_db';  
// Database Name En InfinitiyFree: List of MySQL Databases\Database Name -> if0_40996511_db_vmh
$db_name = 'if0_40996511_db_vmh';
// Database En InfinitiyFree: MySQL Connection Details\MySQL Username -> if0_40996511
$db_username = 'admin';
// Database Password En InfinitiyFree: MySQL Connection Details\MySQL Password -> ******
$db_password = 'admin';

try {
    $conn = new PDO("mysql:host=$db_hostname; dbname=$db_name", $db_username, $db_password);
    $conn->setAttribute (PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo $e->getMessage();
}
?>

----------------------------------------------------------------------------------------------------
Crear .github\workflows\infinity-free.yml

Nota:   el arbol .github ni el folder workflows existen de inicio
        Github solicitará instalar:
        GitHub Actions workflows and runs for github.com hosted repositories in VS Code
        Despues de la instalación las carpetas y archivos en este arbol se verán de color rojo

infinity.yml code:

name: Deploy to vmh.great-site.net # 1.Cambiar

on:
    workflow_dispatch: # Uncomment below to deploy on push instead
    push:
        branches:
            main
jobs:
    deploy:
        name: Deploy to vmh.great-site.net # 2.Cambiar
        runs-on: ubuntu-latest
    steps:
        name: Get latest code
        uses: actions/checkout@v4
        
        name: Sync files via FTP
        uses: SamKirkland/FTP-Deploy-Action@v4.3.5
        with:
            server: ftpupload.net # 3.Change if using another host (ver de InfinityFree)
            username: ${{ secrets.FTP_USERNAME }}
            password: ${{ secrets.FTP_PASSWORD }}
            server-dir: /vmh.great-site.org/htdocs/ #4.Si SOLO UN dominio escribe /htdocs/ (con las dos diagonales) solamente
            retries: 3
            retryDelay: 10

----------------------------------------------------------------------------------------------------
Commit lo anterior
----------------------------------------------------------------------------------------------------

----------------------------------------------------------------------------------------------------

----------------------------------------------------------------------------------------------------

----------------------------------------------------------------------------------------------------

----------------------------------------------------------------------------------------------------