<?php
include 'connect.php';
define('UPLPATH', 'img/');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title    = $_POST['title'];
    $about    = $_POST['about'];
    $content  = $_POST['content'];
    $category = $_POST['category'];
    $date     = date('d.m.Y.');

    $archive = isset($_POST['archive']) ? 1 : 0;

    $picture = '';
    if (isset($_FILES['pphoto']) && $_FILES['pphoto']['error'] === 0) {
        $picture    = basename($_FILES['pphoto']['name']);
        $target_dir = UPLPATH . $picture;
        if (!is_dir(UPLPATH)) {
            mkdir(UPLPATH, 0755, true);
        }
        move_uploaded_file($_FILES['pphoto']['tmp_name'], $target_dir);
    }

    $title    = mysqli_real_escape_string($dbc, $title);
    $about    = mysqli_real_escape_string($dbc, $about);
    $content  = mysqli_real_escape_string($dbc, $content);
    $category = mysqli_real_escape_string($dbc, $category);
    $picture  = mysqli_real_escape_string($dbc, $picture);

    $query = "INSERT INTO vijesti (datum, naslov, sazetak, tekst, slika, kategorija, arhiva)
              VALUES ('$date', '$title', '$about', '$content', '$picture', '$category', '$archive')";

    $result = mysqli_query($dbc, $query) or die('Greška pri unosu: ' . mysqli_error($dbc));

    mysqli_close($dbc);

    header('Location: index.php?unos=ok');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unos vijesti - ŠRD Jastrebarsko</title>
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
                <li><a href="unos.php" class="nav-link active">UNOS</a></li>
                <li><a href="administrator.php" class="nav-link">ADMIN</a></li>
            </ul>
        </div>
    </nav>

    <main id="content">

        <?php if (isset($_GET['unos']) && $_GET['unos'] === 'ok') : ?>
        <p class="success-msg">&#10003; Vijest je uspješno unesena!</p>
        <?php endif; ?>

        <section class="category-section">
            <h2 class="category-heading">
                <span class="category-square"></span>
                UNOS NOVE VIJESTI
            </h2>
            <hr class="section-rule">

            <form name="unos_vijesti" action="unos.php" method="POST" enctype="multipart/form-data" autocomplete="on">

                <div class="form-item">
                    <label for="title">Naslov vijesti</label>
                    <div class="form-field">
                        <input type="text" id="title" name="title" class="form-field-textual" autofocus required>
                    </div>
                </div>

                <div class="form-item">
                    <label for="about">Kratki sadržaj vijesti (do 50 znakova)</label>
                    <div class="form-field">
                        <textarea name="about" id="about" cols="30" rows="4" class="form-field-textual" maxlength="50"></textarea>
                    </div>
                </div>

                <div class="form-item">
                    <label for="content">Sadržaj vijesti</label>
                    <div class="form-field">
                        <textarea name="content" id="content" cols="30" rows="10" class="form-field-textual"></textarea>
                    </div>
                </div>

                <div class="form-item">
                    <label for="pphoto">Slika</label>
                    <div class="form-field">
                        <input type="file" id="pphoto" name="pphoto" accept="image/jpg,image/jpeg,image/gif,image/png">
                    </div>
                </div>

                <div class="form-item">
                    <label for="category">Kategorija vijesti</label>
                    <div class="form-field">
                        <select name="category" id="category" class="form-field-textual">
                            <option value="ribe">Ribe</option>
                            <option value="natjecanja">Natjecanja</option>
                            <option value="opcenito">Općenito</option>
                        </select>
                    </div>
                </div>

                <div class="form-item form-item--checkbox">
                    <label for="archive">
                        <input type="checkbox" id="archive" name="archive" value="da">
                        Spremiti u arhivu (vijest se neće prikazivati)
                    </label>
                </div>

                <div class="form-item form-buttons">
                    <button type="reset" class="btn btn-reset">Poništi</button>
                    <button type="submit" class="btn btn-submit">Prihvati</button>
                </div>

            </form>
        </section>

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