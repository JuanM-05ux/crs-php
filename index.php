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
    <title>Próxima película de Marvel</title>
    <meta name="description" content="La próxima película de Marvel">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- PicoCSS -->
    <link 
        rel="stylesheet" 
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css">
</head>

<body>
<main>
    <div class="card">
        <section>
            <img 
                src="<?= $data["poster_url"]; ?>" 
                alt="Poster de <?= $data["title"]; ?>">
        </section>

        <hgroup>
            <h3><?= $data["title"]; ?> se estrena en <?= $data["days_until"]; ?> días</h3>
            <p>Fecha de estreno: <?= $data["release_date"]; ?></p>
            <p>La siguiente es: <?= $data["following_production"]["title"]; ?></p>
        </hgroup>
    </div>
</main>
</body>
</html>

<style>
:root {
    color-scheme: light dark;
}

* {
    box-sizing: border-box;
}

/* BODY */
body {
    min-height: 100vh;
    margin: 0;
    display: grid;
    place-content: center;
    padding: 1rem;
    background: linear-gradient(45deg, #9e2906, #000000, #02176e);
    background-size: 400% 400%;
    animation: gradient 12s ease-in-out infinite;
}

/* Fondo animado */
@keyframes gradient {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* CARD */
.card {
    width: 100%;
    max-width: 420px;
    padding: 1.5rem;
    border-radius: 20px;
    backdrop-filter: blur(10px);
}

/* SECCIÓN IMAGEN */
section {
    display: flex;
    justify-content: center;
    margin-bottom: 1rem;
}

/* IMAGEN */
img {
    width: 100%;
    max-width: 260px;
    height: auto;
    border-radius: 16px;
    animation: flotar 3s ease-in-out infinite;
}

/* Animación imagen */
@keyframes flotar {
    0% { transform: translateY(10px); }
    50% { transform: translateY(-20px); }
    100% { transform: translateY(10px); }
}

/* TEXTO */
hgroup {
    text-align: center;
}

/* Texto responsivo */
h3 {
    font-size: clamp(1.2rem, 4vw, 2rem);
    margin-bottom: 0.5rem;
}

p {
    font-size: clamp(1rem, 3vw, 1.3rem);
    margin: 0.2rem 0;
}

/* Animación texto */
h3, p {
    opacity: 0;
    animation: aparecer 0.7s ease forwards;
}

@keyframes aparecer {
    to {
        opacity: 1;
        transform: translateY(8px);
    }
}

/* TABLET Y LAPTOP */
@media (min-width: 768px) {
    .card {
        max-width: 520px;
    }

    img {
        max-width: 320px;
    }
}
</style>