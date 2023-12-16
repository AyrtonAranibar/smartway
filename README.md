# SmartWay

Este proyecto, desarrollado como parte de un trabajo universitario en la UCSM, consiste en un pequeño CRUD de clientes. Permite ingresar información sobre los clientes, incluyendo su ubicación, para luego habilitarlos. Posteriormente, se accede a la vista de "optimización de rutas" para planificar de manera óptima la entrega de productos. El sistema cuenta con un sistema de encriptado propio basado en tablas hash y RSA.

## Imágenes del proyecto

Rutas optimizadas:

![Rutas optimizadas](https://github.com/AyrtonAranibar/smartway/blob/master/app/public/images/project_file/mapa.png)

Lista de clientes:

![Lista de clientes](https://github.com/AyrtonAranibar/smartway/blob/master/app/public/images/project_file/lista_clientes.png)

Edicion de datos de clientes:
![Edicion de datos](https://github.com/AyrtonAranibar/smartway/blob/master/public/images/project_file/editar_cliente.png)

## Instalación

Configurar con los datos propios las carpetas

- app/Config/App.php
- app/Config/Database.php

```cmd
composer install
```

## Requisitos del servidor

Se necesita PHP version 7.3 o mayor, con las siguientes extenciones instaladas:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) 
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

Adiccionalmente, asegurate de que las siguientes extenciones estén habilitadas en tu PHP:

- json (habilitado por defecto - no lo desabilites)
- xml (habilitado por defecto - no lo desabilites)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)

