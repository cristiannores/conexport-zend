### PASOS INTALACION DE SOFTWARE CONEXPORT.
==========================================

INSTALAR LOS SOFTWARE, PHP, GIT, COMPOSER, (WAMP O LAMP).

OPCION 1
-   COPIAR O CLONAR EL DIRECTORIO CON GIT


cd my/project/dir

    git clone git://github.com/cristiannores/conexport-zend.git
    cd conexport-zend
    php composer.phar self-update
    php composer.phar install


OPCION 2

-   DESCARGAR TODO EL REPOSITORIO Y COPIARLO EN LA CARPETA

	
		cd conexport-zend
		php composer.phar self-update
		php composer.phar install



COPIAR LOS ARCHIVOS DE LA BD CONEXPORT.SQL Y CREAR UNA BD CON USUARIO Y PASSWORD

CONFIGURAR LOS ARCHIVOS DE LA CARPETA CONFIG PARA LA BD Y LOS USUARIOS, ADEMAS DEL FILE-MANAGER PARA LA CARPETA DE UPLOADS DE ARCHIVOS A \DATA\UPLOADS 

	
	-	USUARIO 
		usuario : juanperez@gmail.com
		clave   : abcd1234







INSTALACION DE ZEND.
ZendSkeletonApplication
=======================

Introduction
------------
This is a simple, skeleton application using the ZF2 MVC layer and module
systems. This application is meant to be used as a starting place for those
looking to get their feet wet with ZF2.

Installation
------------

Using Composer (recommended)
----------------------------
The recommended way to get a working copy of this project is to clone the repository
and use `composer` to install dependencies using the `create-project` command:

    curl -s https://getcomposer.org/installer | php --
    php composer.phar create-project -sdev --repository-url="https://packages.zendframework.com" zendframework/skeleton-application path/to/install

Alternately, clone the repository and manually invoke `composer` using the shipped
`composer.phar`:

    cd my/project/dir
    git clone git://github.com/zendframework/ZendSkeletonApplication.git
    cd ZendSkeletonApplication
    php composer.phar self-update
    php composer.phar install

(The `self-update` directive is to ensure you have an up-to-date `composer.phar`
available.)

Another alternative for downloading the project is to grab it via `curl`, and
then pass it to `tar`:

    cd my/project/dir
    curl -#L https://github.com/zendframework/ZendSkeletonApplication/tarball/master | tar xz --strip-components=1

You would then invoke `composer` to install dependencies per the previous
example.

Using Git submodules
--------------------
Alternatively, you can install using native git submodules:

    git clone git://github.com/zendframework/ZendSkeletonApplication.git --recursive

Web Server Setup
----------------

### PHP CLI Server

The simplest way to get started if you are using PHP 5.4 or above is to start the internal PHP cli-server in the root directory:

    php -S 0.0.0.0:8080 -t public/ public/index.php

This will start the cli-server on port 8080, and bind it to all network
interfaces.

**Note: ** The built-in CLI server is *for development only*.

### Apache Setup

To setup apache, setup a virtual host to point to the public/ directory of the
project and you should be ready to go! It should look something like below:

    <VirtualHost *:80>
        ServerName zf2-tutorial.localhost
        DocumentRoot /path/to/zf2-tutorial/public
        SetEnv APPLICATION_ENV "development"
        <Directory /path/to/zf2-tutorial/public>
            DirectoryIndex index.php
            AllowOverride All
            Order allow,deny
            Allow from all
        </Directory>
    </VirtualHost>
