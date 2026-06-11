<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ŠRD Jastrebarsko</title>
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
        <?php
        include 'connect.php';
        define('UPLPATH', 'img/');

        $kategorije = [
            'opcenito'   => 'OPĆENITO',
            'natjecanja' => 'NATJECANJA',
            'ribe'       => 'RIBE',
        ];

        foreach ($kategorije as $kat => $naziv) :
            $query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='$kat' ORDER BY id DESC LIMIT 3";
            $result = mysqli_query($dbc, $query);

            if (mysqli_num_rows($result) > 0) :
        ?>

        <section class="category-section">
            <h2 class="category-heading">
                <span class="category-square"></span>
                <?php echo $naziv; ?>
            </h2>
            <hr class="section-rule">
            <div class="articles-grid">

                <?php while ($row = mysqli_fetch_array($result)) : ?>
                <article class="news-card">
                    <a href="clanak.php?id=<?php echo $row['id']; ?>" class="card-anchor">
                        <div class="card-image">
                            <?php if (!empty($row['slika'])) : ?>
                                <img src="<?php echo UPLPATH . htmlspecialchars($row['slika']); ?>" alt="<?php echo htmlspecialchars($row['naslov']); ?>">
                            <?php else : ?>
                                <img src="images/placeholder.jpg" alt="Bez slike">
                            <?php endif; ?>
                        </div>
                        <h3 class="card-title"><?php echo htmlspecialchars($row['naslov']); ?></h3>
                        <span class="card-time">&#9656; <?php echo htmlspecialchars($row['datum']); ?></span>
                    </a>
                </article>
                <?php endwhile; ?>

            </div>
        </section>

        <?php
            endif;
        endforeach;

        mysqli_close($dbc);
        ?>

    </main>

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