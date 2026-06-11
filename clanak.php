<?php
include 'connect.php';
define('UPLPATH', 'img/');

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header('Location: index.php');
    exit();
}

$query  = "SELECT * FROM vijesti WHERE id=$id LIMIT 1";
$result = mysqli_query($dbc, $query) or die('Greška pri dohvatu: ' . mysqli_error($dbc));
$row    = mysqli_fetch_array($result);

if (!$row) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($row['naslov']); ?> - ŠRD Jastrebarsko</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <header id="header">
        <div class="header-logo">
            <p class="site-name">ŠRD Jastrebarsko</p>
            <p class="site-tagline">STRANICA ŠPORTSKOG RIBOLOVNOG DRUŠTVA JASTREBARSKO</p>
        </div>
    </header>

    <nav id="nav">
        <div class="nav-inner">
            <ul class="nav-list">
                <li><a href="index.php" class="nav-link active">NOVOSTI</a></li>
                <li><a href="kategorija.php?kategorija=ribe" class="nav-link">RIBE</a></li>
                <li><a href="kategorija.php?kategorija=natjecanja" class="nav-link">NATJECANJA</a></li>
                <li><a href="kategorija.php?kategorija=opcenito" class="nav-link">OPĆENITO</a></li>
                <li><a href="onama.php" class="nav-link">O NAMA</a></li>
                <li><a href="kontakt.php" class="nav-link">KONTAKT</a></li>
                <li><a href="unos.php" class="nav-link">UNOS</a></li>
                <li><a href="administrator.php" class="nav-link">ADMIN</a></li>
            </ul>
        </div>
    </nav>

    <main id="content">
        <div class="article-wrap">

            <aside class="article-category-label">
                <span class="category-square"></span>
                <span><?php echo strtoupper(htmlspecialchars($row['kategorija'])); ?></span>
            </aside>

            <article id="article-main">

                <h2 class="article-title">
                    <?php echo htmlspecialchars($row['naslov']); ?>
                </h2>

                <div class="article-meta">
                    <p>AUTOR: <strong>Noa Novosel</strong></p>
                    <p>OBJAVLJENO: <time><?php echo htmlspecialchars($row['datum']); ?></time></p>
                </div>

                <?php if (!empty($row['slika'])) : ?>
                <figure class="article-figure">
                    <img src="<?php echo UPLPATH . htmlspecialchars($row['slika']); ?>" alt="<?php echo htmlspecialchars($row['naslov']); ?>">
                </figure>
                <?php endif; ?>

                <?php if (!empty($row['sazetak'])) : ?>
                <section class="article-about">
                    <p><em><?php echo nl2br(htmlspecialchars($row['sazetak'])); ?></em></p>
                </section>
                <?php endif; ?>

                <section class="article-body">
                    <p><?php echo nl2br(htmlspecialchars($row['tekst'])); ?></p>
                </section>

            </article>

        </div>
    </main>

    <?php mysqli_close($dbc); ?>

    <footer id="footer">
        <div class="footer-inner">
            <p class="footer-copy">
                &copy; ŠRD Jastrebarsko 2026
            </p>
            <nav class="footer-links">
                <a href="#">Cookies</a>
                <a href="#">Policy and Privacy</a>
                <a href="#">Transparency</a>
            </nav>
            <p class="footer-author">Autor: Noa Novosel &nbsp;|&nbsp; nnovosel@tvz.hr &nbsp;|&nbsp; 2026.</p>
        </div>
    </footer>

</body>
</html>