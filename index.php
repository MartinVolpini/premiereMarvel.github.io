<?php 
#--------------LLamada a una API----------------------------------------------------
/*Una forma clasica en php es manejar las llamadas a una api con curl, 
    esta es una extencion hay que instalarla     */
//En https://curl.se/ lo podes descargar, pero seguro lo tenes instalado por defecto en window
//Para ver si ya lo tenes habri consola y pone: curl --version   .
//curl permite hacer peticiones get escribis en consola : curl urlweb y devuelve los datos.
//Con curl urlweb -v  devuelve la info del servidor.
//Con curl urlweb -i  devuelve la info del la api y la cabecera mas resumido.

// if (function_exists('curl_init')) {
//     echo 'cURL está instalado y habilitado.';
// } else {
//     echo 'cURL no está instalado o no está habilitado.';
// };

// $ch = curl_init();

// curl_setopt($ch, CURLOPT_URL, "https://api.example.com/data");
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// $response = curl_exec($ch);
// curl_close($ch);

// echo $response;

#API
const API_URL = "https://whenisthenextmcufilm.com/api";
// #Inicializar una nueva sesíon de cURL; ch = cURL handle
$ch = curl_init(API_URL);

#Indicar que queremos recibir el resultado de la peticíon y no mostrarla en pantalla
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//Es para desactivar el ssl para pruevas para no te molesten con el certificado SSL.
//En un proyecto real no iria esto.
#curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

//Ejecutar la petición y guardamos el resultado 
$result = curl_exec($ch);

//MANEJO DE LA PETICIÓN
if (curl_errno($ch)) {
    echo 'Error de cURL: ' . curl_error($ch);
} else {
    //Convertimos el resultado a un array asosiativo
    $data = json_decode($result, true);
    //Mostramos el dato
    // var_dump($data);
}
//Convertimos el resultado a un array asosiativo
// $data = json_decode( $result , true );
//Cerramos el curl
curl_close($ch);

//Mostramos el tipo de dato
// var_dump($ch);
// var_dump($data);

// ------------ -----------------------------------------------------

# OTRA FORMA DE HACER PETICIONES ES CON:
# $result = file_get_contents(API_URL);    //Es la forma mas facil de hacer un get

// ------------------- ---------------------------------------------

// phpinfo();

?>
<head>
    <!-- Centered viewport -->
    <meta charset="UTF-8" />
    <meta name="decription" content="La proxima pelicula de Marvel" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css"
    >
    <title>La proxima pelicula de Marvel</title>
</head>

<main>

<!-- ------------------------------------------------------------------->
    <br><br>

    <section style="text-align: center;">
        <h1>El próxima extreno de MARVEL</h1>
        <p>Se extrena en <?=$data['days_until']?> dias</p>
    </section>

    <section style="display: flex; flex-flow:column; justify-content: center; align-items: center;">
        <img 
            src="<?= $data['poster_url']?>" 
            style="width: 15rem; border-radius:16px; margin: 0.5rem 0rem 2rem 0rem;" 
            alt="Poster de <?= $data['title']?>"
        />
        <hgroup style="text-align: center; width: min( 80%,1200px);">
            <h3 style="margin: 0.5rem 0rem 2.5rem 0rem">
                <?= $data['title']?>
            </h3>
            <!-- <h3 style="margin: 1rem 0rem; letter-spacing: 1.8px;">Trama</h3> -->
            <p>
                <?= $data['overview']?>
            </p>
            <p style="margin: 1rem 0rem">
                Fecha de extreno: <?= $data['release_date']?>
            </p>
        </hgroup>
    </section>
</main>

<!-- ------------------------------------------------------------------->

<hr><br><br>

<section style="text-align: center;  ">
    <h2>Siguiente extreno de MARVEL</h2>
    <p>Se extrena en <?=$data['following_production']['days_until']?> dias</p>
</section>

<section style="display: flex; flex-flow:column; justify-content: center; align-items: center;">
    <img 
        src="<?= $data['following_production']['poster_url']?>" 
        style="width: 15rem; border-radius:16px; margin: 0.5rem 0rem 2rem 0rem;" 
        alt="Poster de <?= $data['following_production']['title']?>"
    />
    <hgroup style="text-align: center; width: min( 80%,1200px);">
        <h3 style="margin: 0.5rem 0rem 2.5rem 0rem">
            <?= $data['following_production']['title']?>
        </h3>
        <!-- <h3 style="margin: 1rem 0rem; letter-spacing: 1.8px;">Trama</h3> -->
        <p>
            <?= $data['following_production']['overview']?>
        </p>
        <p style="margin: 1rem 0rem">
            Fecha de extreno: <?= $data['following_production']['release_date']?>
        </p>
    </hgroup>
</section>

<!-- ------------------------------------------------------------------->
<hr>
<section style="text-align: center; margin: 4rem 0rem 0rem 0rem;">
        <h2>Mi petición curl</h2>
        <p>El obj:</p>
    </section>
    <pre style="height: 25rem; width: min( 80%,1200px); margin: 0rem auto;
        font-size: 14px; overflow: scroll;"
    >
        <?= var_dump($data); ?>
    </pre>
    <hr><br><br>

