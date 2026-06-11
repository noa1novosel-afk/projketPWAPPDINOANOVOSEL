<?php
session_start();
include 'connect.php';

$msg = '';
$registriranKorisnik = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $ime      = $_POST['ime'];
    $prezime  = $_POST['prezime'];
    $username = $_POST['username'];
    $lozinka  = $_POST['pass'];
    $lozinka2 = $_POST['passRep'];
    $razina   = 0;

    if ($lozinka !== $lozinka2) {
        $msg = 'Lozinke se ne podudaraju!';
    } else {
        $sql  = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
        $stmt = mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
        }

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $msg = 'Korisničko ime već postoji!';
        } else {
            $hashed_password = password_hash($lozinka, PASSWORD_BCRYPT);
            $sql  = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($dbc);
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, 'ssssi', $ime, $prezime, $username, $hashed_password, $razina);
                mysqli_stmt_execute($stmt);
                $registriranKorisnik = true;
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
    <title>Registracija - ŠRD Jastrebarsko</title>
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
                <li><a href="unos.php" class="nav-link">UNOS</a></li>
                <li><a href="administrator.php" class="nav-link active">ADMIN</a></li>
            </ul>
        </div>
    </nav>

    <main id="content">
        <section class="category-section">
            <h2 class="category-heading">
                <span class="category-square"></span>
                REGISTRACIJA KORISNIKA
            </h2>
            <hr class="section-rule">

            <?php if ($registriranKorisnik === true) : ?>
                <p class="success-msg">&#10003; Korisnik je uspješno registriran! <a href="administrator.php">Prijavi se ovdje</a></p>
            <?php else : ?>

                <?php if (!empty($msg)) : ?>
                    <p class="error-msg">&#9888; <?php echo htmlspecialchars($msg); ?></p>
                <?php endif; ?>

                <form action="registracija.php" method="POST" autocomplete="off">

                    <div class="form-item">
                        <label for="ime">Ime</label>
                        <div class="form-field">
                            <span id="porukaIme" class="field-msg"></span>
                            <input type="text" name="ime" id="ime" class="form-field-textual">
                        </div>
                    </div>

                    <div class="form-item">
                        <label for="prezime">Prezime</label>
                        <div class="form-field">
                            <span id="porukaPrezime" class="field-msg"></span>
                            <input type="text" name="prezime" id="prezime" class="form-field-textual">
                        </div>
                    </div>

                    <div class="form-item">
                        <label for="username">Korisničko ime</label>
                        <div class="form-field">
                            <span id="porukaUsername" class="field-msg"></span>
                            <input type="text" name="username" id="username" class="form-field-textual">
                        </div>
                    </div>

                    <div class="form-item">
                        <label for="pass">Lozinka</label>
                        <div class="form-field">
                            <span id="porukaPass" class="field-msg"></span>
                            <input type="password" name="pass" id="pass" class="form-field-textual">
                        </div>
                    </div>

                    <div class="form-item">
                        <label for="passRep">Ponovite lozinku</label>
                        <div class="form-field">
                            <span id="porukaPassRep" class="field-msg"></span>
                            <input type="password" name="passRep" id="passRep" class="form-field-textual">
                        </div>
                    </div>

                    <div class="form-item form-buttons">
                        <button type="reset" class="btn btn-reset">Poništi</button>
                        <button type="submit" id="slanje" class="btn btn-submit">Registriraj se</button>
                    </div>

                </form>

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

    <script>
        document.getElementById('slanje').onclick = function(event) {
            var ok = true;

            var ime = document.getElementById('ime');
            if (ime.value.length === 0) {
                ok = false; ime.style.border = '1px dashed red';
                document.getElementById('porukaIme').innerHTML = 'Unesite ime!';
            } else { ime.style.border = '1px solid green'; document.getElementById('porukaIme').innerHTML = ''; }

            var prezime = document.getElementById('prezime');
            if (prezime.value.length === 0) {
                ok = false; prezime.style.border = '1px dashed red';
                document.getElementById('porukaPrezime').innerHTML = 'Unesite prezime!';
            } else { prezime.style.border = '1px solid green'; document.getElementById('porukaPrezime').innerHTML = ''; }

            var username = document.getElementById('username');
            if (username.value.length === 0) {
                ok = false; username.style.border = '1px dashed red';
                document.getElementById('porukaUsername').innerHTML = 'Unesite korisničko ime!';
            } else { username.style.border = '1px solid green'; document.getElementById('porukaUsername').innerHTML = ''; }

            var pass    = document.getElementById('pass');
            var passRep = document.getElementById('passRep');
            if (pass.value.length === 0 || passRep.value.length === 0 || pass.value !== passRep.value) {
                ok = false;
                pass.style.border = '1px dashed red'; passRep.style.border = '1px dashed red';
                document.getElementById('porukaPass').innerHTML = 'Lozinke nisu iste!';
                document.getElementById('porukaPassRep').innerHTML = 'Lozinke nisu iste!';
            } else {
                pass.style.border = '1px solid green'; passRep.style.border = '1px solid green';
                document.getElementById('porukaPass').innerHTML = ''; document.getElementById('porukaPassRep').innerHTML = '';
            }

            if (!ok) { event.preventDefault(); }
        };
    </script>

</body>
</html>