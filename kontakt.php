<?php
include 'connect.php';

$msg     = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $ime    = trim($_POST['ime'] ?? '');
    $email  = trim($_POST['email'] ?? '');
    $poruka = trim($_POST['poruka'] ?? '');
    $datum  = date('d.m.Y. H:i');

    if (empty($ime) || empty($email) || empty($poruka)) {
        $msg = 'Molimo ispunite sva polja!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = 'Unesite ispravnu e-mail adresu!';
    } else {
        $sql  = "INSERT INTO kontakti (datum, ime, email, poruka) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 'ssss', $datum, $ime, $email, $poruka);
            if (mysqli_stmt_execute($stmt)) {
                $success = true;
            } else {
                $msg = 'Greška pri slanju poruke. Pokušajte ponovno.';
            }
        }
    }
    mysqli_close($dbc);
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt - ŠRD Jastrebarsko</title>
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
                <li><a href="index.php" class="nav-link">NOVOSTI</a></li>
                <li><a href="kategorija.php?kategorija=ribe" class="nav-link">RIBE</a></li>
                <li><a href="kategorija.php?kategorija=natjecanja" class="nav-link">NATJECANJA</a></li>
                <li><a href="kategorija.php?kategorija=opcenito" class="nav-link">OPĆENITO</a></li>
                <li><a href="onama.php" class="nav-link">O NAMA</a></li>
                <li><a href="kontakt.php" class="nav-link active">KONTAKT</a></li>
                <li><a href="unos.php" class="nav-link">UNOS</a></li>
                <li><a href="administrator.php" class="nav-link">ADMIN</a></li>
            </ul>
        </div>
    </nav>

    <main id="content">
        <section class="category-section">
            <h2 class="category-heading">
                <span class="category-square"></span>
                KONTAKTIRAJTE NAS
            </h2>
            <hr class="section-rule">

            <?php if ($success) : ?>
                <p class="success-msg">&#10003; Vaša poruka je uspješno poslana! Javit ćemo vam se u najkraćem mogućem roku.</p>
            <?php else : ?>

                <?php if (!empty($msg)) : ?>
                    <p class="error-msg">&#9888; <?php echo htmlspecialchars($msg); ?></p>
                <?php endif; ?>

                <div class="kontakt-wrap">

                    <div class="kontakt-info">
                        <h3 class="kontakt-info-title">Informacije</h3>
                        <ul class="kontakt-info-list">
                            <li>
                                <strong>Adresa:</strong><br>
                                Jastrebarsko, Hrvatska
                            </li>
                            <li>
                                <strong>E-mail:</strong><br>
                                srd@jastrebarsko.hr
                            </li>
                            <li>
                                <strong>Telefon:</strong><br>
                                +385 1 234 5678
                            </li>
                            <li>
                                <strong>Radno vrijeme:</strong><br>
                                Pon – Pet: 9:00 – 17:00
                            </li>
                        </ul>
                    </div>

                    <form action="kontakt.php" method="POST" class="kontakt-form" autocomplete="off">

                        <div class="form-item">
                            <label for="ime">Ime i prezime</label>
                            <div class="form-field">
                                <input type="text" id="ime" name="ime" class="form-field-textual"
                                    value="<?php echo isset($_POST['ime']) ? htmlspecialchars($_POST['ime']) : ''; ?>"
                                    required>
                            </div>
                        </div>

                        <div class="form-item">
                            <label for="email">E-mail adresa</label>
                            <div class="form-field">
                                <input type="email" id="email" name="email" class="form-field-textual"
                                    value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                                    required>
                            </div>
                        </div>

                        <div class="form-item">
                            <label for="poruka">Poruka</label>
                            <div class="form-field">
                                <textarea name="poruka" id="poruka" cols="30" rows="7"
                                    class="form-field-textual" required><?php echo isset($_POST['poruka']) ? htmlspecialchars($_POST['poruka']) : ''; ?></textarea>
                            </div>
                        </div>

                        <div class="form-item form-buttons">
                            <button type="reset" class="btn btn-reset">Poništi</button>
                            <button type="submit" class="btn btn-submit">Pošalji poruku</button>
                        </div>

                    </form>

                </div>

            <?php endif; ?>

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