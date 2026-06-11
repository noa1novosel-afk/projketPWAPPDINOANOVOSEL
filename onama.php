<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O nama - ŠRD Jastrebarsko</title>
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
                <li><a href="onama.php" class="nav-link active">O NAMA</a></li>     
                <li><a href="kontakt.php" class="nav-link">KONTAKT</a></li>
                <li><a href="unos.php" class="nav-link">UNOS</a></li>
                <li><a href="administrator.php" class="nav-link">ADMIN</a></li>
            </ul>
        </div>
    </nav>

    <main id="content">
        <section class="category-section">
            <h2 class="category-heading">
                <span class="category-square"></span>
                O NAMA
            </h2>
            <hr class="section-rule">

            <div class="onama-wrap">

                <div class="onama-intro">
                    <p>
                        Športsko ribolovno društvo Jastrebarsko osnovano je s ciljem okupljanja ljubitelja
                        ribolova i prirode jaskanskog kraja. Kroz desetljeća djelovanja postali smo jedan od
                        stupova sportskog i društvenog života grada, spajajući generacije zajedničkom ljubavlju
                        prema vodama i ribolovu.
                    </p>
                    <p>
                        Naša misija je promicanje sportskog ribolova, odgovornog odnosa prema prirodi i
                        očuvanje ribljeg fonda za buduće generacije. Redovito provodimo akcije poribljavanja,
                        čišćenja obala i edukacije mladih ribolovaca.
                    </p>
                </div>

                <figure class="onama-figure">
                    <img src="img/ribolov.jpg" alt="">
                    <figcaption>Članovi društva na jednom od naših ribolovnih mjesta</figcaption>
                </figure>

                <div class="onama-text">
                    <h3 class="onama-subtitle">Naša povijest</h3>
                    <p>
                        Društvo ima dugu i bogatu tradiciju koja seže još u prvu polovicu 20. stoljeća.
                        Tijekom godina mijenjale su se tehnike i oprema, ali je ostala ista predanost
                        zajednici i prirodi. Svaki član našeg društva nosi s ponosom tu tradiciju.
                    </p>
                    <p>
                        Danas broji više stotina aktivnih članova koji zajedno brinu o ribnjacima i
                        riječnim vodama na području Jastrebarskog. Organiziramo redovita natjecanja,
                        edukacije za mlađe uzraste i zajednička izlaženja na vodu.
                    </p>
                </div>

                <figure class="onama-figure">
                    <img src="img/R.jpg" alt="">
                    <figcaption>Škola ribolova za naše najmlađe članove</figcaption>
                </figure>

                <div class="onama-text">
                    <h3 class="onama-subtitle">Naše vrijednosti</h3>
                    <p>
                        Temeljne vrijednosti ŠRD Jastrebarsko su ljubav prema prirodi, sportski duh,
                        drugarstvo i odgovornost. Vjerujemo da ribolov nije samo sport, već i način
                        života koji uči strpljenju, poštovanju prirode i zajedništvu.
                    </p>
                    <p>
                        Posebnu pažnju posvećujemo radu s mladima jer smatramo da je budućnost
                        ribolova i očuvanja prirode upravo u mlađim naraštajima.
                    </p>
                </div>

                <div class="onama-video-section">
                    <h3 class="onama-subtitle" style="text-align:center; margin-bottom:16px;">Pogledajte naše društvo u akciji</h3>
                    <div class="onama-video-wrap">

                        <iframe width="560" height="315" src="https://www.youtube.com/embed/_PoWvY8A6Ew?si=HPgMcIL7gDjViSGm" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>

                <div class="onama-cta">
                    <p>Zainteresirani ste za članstvo ili imate pitanja?</p>
                    <a href="kontakt.php" class="btn btn-submit" style="display:inline-block; text-decoration:none;">Kontaktirajte nas</a>
                </div>

            </div>

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