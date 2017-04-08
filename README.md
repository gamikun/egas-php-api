Deploy
======
El repositorio también se encuentra replicado en
https://bitbucket.org/edesarrollos/api-php
Debido a que este es la URL open source.

La URL de la clase Client necesita ser configurada.
    
    $client = new Client;
    $client->baseURL = 'http://algo.empresa.com';

Para el caso de las pruebas de unidad, se debe
crear un archivo config.php en este formato:

	<?php
	return [
		'baseURL' => 'http://...'
	];

