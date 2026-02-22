<?php
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 1);

const API_URL = "https://whenisthenextmcufilm.com/api";

$ch = curl_init(API_URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$result = curl_exec($ch);

if ($result === false) {
    die("Error en cURL: " . curl_error($ch));
}

$data = json_decode($result, true);

curl_close($ch);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>La próxima película de Marvel</title>
    <meta name="description" content="La próxima película de Marvel">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link 
        rel="stylesheet" 
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css">
</head>

<body>
<main>
    <div class="card animar">
    <section>
        <img src="<?=  $data["poster_url"]; ?> width="300" alt="poster de <?=  $data["title"] ?>"
        style="border-radius: 16px;" />
    </section>
    <hgroup>
        <h3><?= $data["title"]; ?> se estrena en <?= $data["days_until"]; ?> días</h3>
        <p>Fecha de estreno <?= $data["release_date"]; ?></p>
        <p>La siguiente es <?= $data["following_production"]["title"]; ?></p>
    </hgroup>
    </div>
</main>
</body>
</html>
<style>
    :root{
        color: light dark;
    }

    body{
        display: grid;
        place-content: center;
        height: 100vh;
        background: linear-gradient(45deg, #9e2906, #000000, #02176e);
        background-size: 400% 400%;
        animation: gradient 12s ease-in infinite;
    }
    @keyframes gradient{
            0%{
            background-position: 0% 50%;
        }
            50%{
            background-position: 100% 50%;
        }
            100%{
            background-position: 0% 50%;
        }
    }
    
    section{
        display: flex;
        justify-content: center;
        text-align: center;
    }

    hgroup{
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }
   

    img{
        margin: 0 auto;
        animation: flotar 3s ease-in-out infinite;
    }

    @keyframes flotar{
        0%{transform: translateY(10px);}
        50%{transform: translateY(-25px);}
        100%{ transform: translateY(10px);}
    }
    h3, p {
    font-size: 49px;   
    opacity: 0;
    animation: aparecer 0.6s ease forwards;
}

    .delay-1 { animation-delay: 0.75s; }
    .delay-2 { animation-delay: 0.70s; }
    .delay-3 { animation-delay: 0.65s; }

    @keyframes aparecer {
        to {
            opacity: 1;
            transform: translateY(10px);
        }
    }
    main{
        margin-top: 75px;
    }
</style>