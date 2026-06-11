<?php
    if (isset($_POST['title'])) {
        $title = $_POST['title'];
    } else {
        $title = '';
    }

    if (isset($_POST['about'])) {
        $about = $_POST['about'];
    } else {
        $about = '';
    }

    if (isset($_POST['content'])) {
        $content = $_POST['content'];
    } else {
        $content = '';
    }

    if (isset($_POST['category'])) {
        $category = $_POST['category'];
    } else {
        $category = '';
    }

    if (isset($_POST['archive'])) {
        $archive = 'Da';
    } else {
        $archive = 'Ne';
    }

    $image = '';
    if (isset($_FILES['pphoto']) && $_FILES['pphoto']['error'] === 0) {
        $ime_datoteke = basename($_FILES['pphoto']['name']);
        $odrediste = 'img/' . $ime_datoteke;
        if (!is_dir('img')) {
            mkdir('img', 0755, true);
        }
        if (move_uploaded_file($_FILES['pphoto']['tmp_name'], $odrediste)) {
            $image = $ime_datoteke;
        }
    }

    $datum = date('d.m.Y. H:i');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?> - ŠRD Jastrebarsko</title>
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
                <li><a href="kategorija.php?kategorija=općenito" class="nav-link">OPĆENITO</a></li>
                <li><a href="onama.php" class="nav-link">O NAMA</a></li>
                <li><a href="kontakt.php" class="nav-link">KONTAKT</a></li>
                <li><a href="unos.html" class="nav-link">UNOS</a></li>
            </ul>
        </div>
    </nav>

    <main id="content">
        <div class="article-wrap">

            <aside class="article-category-label">
                <span class="category-square"></span>
                <span><?php echo htmlspecialchars(strtoupper($category)); ?></span>
            </aside>

            <article id="article-main">

                <h2 class="article-title">
                    <?php echo htmlspecialchars($title); ?>
                </h2>

                <div class="article-meta">
                    <p>AUTOR: <strong>Noa Novosel</strong></p>
                    <p>OBJAVLJENO: <time><?php echo $datum; ?></time></p>
                    <p>ARHIV: <?php echo $archive; ?></p>
                </div>

                <?php if ($image !== ''): ?>
                <figure class="article-figure">
                    <img src="img/<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($title); ?>">
                </figure>
                <?php endif; ?>

                <?php if ($about !== ''): ?>
                <section class="article-about">
                    <p><?php echo nl2br(htmlspecialchars($about)); ?></p>
                </section>
                <?php endif; ?>

                <section class="article-body">
                    <p><?php echo nl2br(htmlspecialchars($content)); ?></p>
                </section>

            </article>

        </div>
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