<?php
session_start();
include 'connect.php';
define('UPLPATH', 'img/');

$uspjesnaPrijava = false;
$admin = false;
$imeKorisnika = '';

if (isset($_POST['prijava'])) {
    $prijavaUsername = $_POST['username'];
    $prijavaLozinka  = $_POST['lozinka'];

    $sql  = "SELECT korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $prijavaUsername);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, $levelKorisnika);
        mysqli_stmt_fetch($stmt);
    }

    if (mysqli_stmt_num_rows($stmt) > 0 && password_verify($prijavaLozinka, $lozinkaKorisnika)) {
        $uspjesnaPrijava = true;
        $_SESSION['username'] = $imeKorisnika;
        $_SESSION['level']    = $levelKorisnika;
        $admin = ($levelKorisnika == 1);
    } else {
        $uspjesnaPrijava = false;
    }
}

if (isset($_SESSION['username'])) {
    $imeKorisnika    = $_SESSION['username'];
    $uspjesnaPrijava = true;
    $admin           = ($_SESSION['level'] == 1);
}

if (isset($_GET['odjava'])) {
    session_destroy();
    header('Location: administrator.php');
    exit();
}

if (isset($_POST['delete']) && $admin) {
    $id    = (int)$_POST['id'];
    $sql   = "DELETE FROM vijesti WHERE id = ?";
    $stmt  = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
    }
    header('Location: administrator.php?action=deleted');
    exit();
}

if (isset($_POST['update']) && $admin) {
    $id       = (int)$_POST['id'];
    $title    = $_POST['title'];
    $about    = $_POST['about'];
    $content  = $_POST['content'];
    $category = $_POST['category'];
    $archive  = isset($_POST['archive']) ? 1 : 0;

    if (isset($_FILES['pphoto']) && $_FILES['pphoto']['error'] === 0) {
        $picture = basename($_FILES['pphoto']['name']);
        $target  = UPLPATH . $picture;
        if (!is_dir(UPLPATH)) { mkdir(UPLPATH, 0755, true); }
        move_uploaded_file($_FILES['pphoto']['tmp_name'], $target);

        $sql  = "UPDATE vijesti SET naslov=?, sazetak=?, tekst=?, kategorija=?, arhiva=?, slika=? WHERE id=?";
        $stmt = mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 'ssssiis', $title, $about, $content, $category, $archive, $picture, $id);
            mysqli_stmt_execute($stmt);
        }
    } else {
        $sql  = "UPDATE vijesti SET naslov=?, sazetak=?, tekst=?, kategorija=?, arhiva=? WHERE id=?";
        $stmt = mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 'ssssii', $title, $about, $content, $category, $archive, $id);
            mysqli_stmt_execute($stmt);
        }
    }
    header('Location: administrator.php?action=updated');
    exit();
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator - ŠRD Jastrebarsko</title>
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
                <li><a href="administrator.php" class="nav-link active">ADMIN</a></li>
                <?php if ($uspjesnaPrijava) : ?>
                <li><a href="administrator.php?odjava=1" class="nav-link">ODJAVA</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <main id="content">
        <section class="category-section">
            <h2 class="category-heading">
                <span class="category-square"></span>
                ADMINISTRACIJA
            </h2>
            <hr class="section-rule">

            <?php if (isset($_GET['action'])) : ?>
                <?php if ($_GET['action'] === 'deleted') : ?>
                    <p class="success-msg">&#10003; Vijest je uspješno obrisana.</p>
                <?php elseif ($_GET['action'] === 'updated') : ?>
                    <p class="success-msg">&#10003; Vijest je uspješno izmijenjena.</p>
                <?php endif; ?>
            <?php endif; ?>

            <?php
            if ($uspjesnaPrijava && $admin) :
                $query  = "SELECT * FROM vijesti ORDER BY id DESC";
                $result = mysqli_query($dbc, $query);
            ?>
                <p class="success-msg">Prijavljeni ste kao: <strong><?php echo htmlspecialchars($imeKorisnika); ?></strong></p>

                <?php if (mysqli_num_rows($result) === 0) : ?>
                    <p class="no-results">Nema unesenih vijesti.</p>
                <?php endif; ?>

                <?php while ($row = mysqli_fetch_array($result)) : ?>
                <form enctype="multipart/form-data" action="administrator.php" method="POST" class="admin-form">

                    <div class="admin-form-header">
                        <strong>#<?php echo $row['id']; ?></strong> &nbsp;|&nbsp;
                        <?php echo htmlspecialchars($row['datum']); ?> &nbsp;|&nbsp;
                        <em><?php echo htmlspecialchars($row['kategorija']); ?></em>
                        <?php if ($row['arhiva'] == 1) : ?><span class="badge-archive">ARHIVIRANO</span><?php endif; ?>
                    </div>

                    <div class="form-item">
                        <label>Naslov vijesti</label>
                        <div class="form-field">
                            <input type="text" name="title" class="form-field-textual" value="<?php echo htmlspecialchars($row['naslov']); ?>">
                        </div>
                    </div>

                    <div class="form-item">
                        <label>Kratki sadržaj</label>
                        <div class="form-field">
                            <textarea name="about" cols="30" rows="3" class="form-field-textual"><?php echo htmlspecialchars($row['sazetak']); ?></textarea>
                        </div>
                    </div>

                    <div class="form-item">
                        <label>Sadržaj vijesti</label>
                        <div class="form-field">
                            <textarea name="content" cols="30" rows="6" class="form-field-textual"><?php echo htmlspecialchars($row['tekst']); ?></textarea>
                        </div>
                    </div>

                    <div class="form-item">
                        <label>Slika (ostavi prazno za zadržavanje postojeće)</label>
                        <div class="form-field admin-img-row">
                            <input type="file" name="pphoto" accept="image/*">
                            <?php if (!empty($row['slika'])) : ?>
                                <img src="<?php echo UPLPATH . htmlspecialchars($row['slika']); ?>" class="admin-thumb" alt="slika">
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-item">
                        <label>Kategorija</label>
                        <div class="form-field">
                            <select name="category" class="form-field-textual">
                                <option value="ribe"         <?php echo ($row['kategorija']==='ribe')         ? 'selected':''; ?>>Ribe</option>
                                <option value="natjecanja"      <?php echo ($row['kategorija']==='natjecanja')      ? 'selected':''; ?>>Natjecanja</option>
                                <option value="opcenito" <?php echo ($row['kategorija']==='opcenito') ? 'selected':''; ?>>Općenito</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-item form-item--checkbox">
                        <label>
                            <input type="checkbox" name="archive" <?php echo ($row['arhiva']==1) ? 'checked':''; ?>>
                            Arhiviraj (sakrij s naslovnice)
                        </label>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                    <div class="form-item form-buttons">
                        <button type="reset" class="btn btn-reset">Poništi</button>
                        <button type="submit" name="update" class="btn btn-submit">Izmjeni</button>
                        <button type="submit" name="delete" class="btn btn-delete"
                            onclick="return confirm('Jeste li sigurni da želite obrisati ovu vijest?')">Izbriši</button>
                    </div>
                </form>
                <hr class="admin-divider">
                <?php endwhile; ?>

            <?php

            elseif ($uspjesnaPrijava && !$admin) :
            ?>
                <p class="error-msg">Bok <strong><?php echo htmlspecialchars($imeKorisnika); ?></strong>! Uspješno ste prijavljeni, ali nemate pravo za pristup administratorskoj stranici.</p>
                <p><a href="administrator.php?odjava=1" class="btn btn-reset" style="display:inline-block;padding:9px 22px;">Odjavi se</a></p>

            <?php

            else :
            ?>
                <?php if (isset($_POST['prijava']) && !$uspjesnaPrijava) : ?>
                    <p class="error-msg">&#9888; Pogrešno korisničko ime ili lozinka. <a href="registracija.php">Registriraj se</a></p>
                <?php endif; ?>

                <form action="administrator.php" method="POST" class="admin-form" autocomplete="off">
                    <div class="form-item">
                        <label for="username">Korisničko ime</label>
                        <div class="form-field">
                            <input type="text" name="username" id="username" class="form-field-textual" autofocus>
                        </div>
                    </div>
                    <div class="form-item">
                        <label for="lozinka">Lozinka</label>
                        <div class="form-field">
                            <input type="password" name="lozinka" id="lozinka" class="form-field-textual">
                        </div>
                    </div>
                    <div class="form-item form-buttons">
                        <button type="submit" name="prijava" class="btn btn-submit">Prijavi se</button>
                    </div>
                    <p style="margin-top:12px; font-family:Arial,sans-serif; font-size:0.82rem;">
                        Nemate račun? <a href="registracija.php">Registrirajte se</a>
                    </p>
                </form>

            <?php endif; ?>

        </section>
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