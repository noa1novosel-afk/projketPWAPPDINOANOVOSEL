<?php
session_start();
include 'connect.php';

$admin = isset($_SESSION['level']) && $_SESSION['level'] == 1;
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podaci (JSON / XML) - ŠRD Jastrebarsko</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .podaci-tabs {
            display: flex;
            gap: 0;
            margin-bottom: 0;
            border-bottom: 2px solid #217e20;
            max-width: 820px;
        }
        .podaci-tab {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            padding: 10px 28px;
            cursor: pointer;
            background: #f4f4f4;
            border: 1px solid #ddd;
            border-bottom: none;
            color: #555;
            text-transform: uppercase;
            transition: background 0.15s, color 0.15s;
        }
        .podaci-tab.active {
            background: #217e20;
            color: #fff;
            border-color: #217e20;
        }
        .podaci-panel {
            display: none;
            max-width: 820px;
            margin-top: 0;
            padding: 20px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-top: none;
        }
        .podaci-panel.active { display: block; }

        .link-badge {
            display: inline-block;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 5px 14px;
            border: 1px solid #217e20;
            color: #217e20;
            margin-bottom: 16px;
            letter-spacing: 0.04em;
            text-decoration: none;
            transition: background 0.15s, color 0.15s;
        }
        .link-badge:hover { background: #217e20; color: #fff; }

        pre.kod {
            background: #1e1e1e;
            color: #d4d4d4;
            font-family: 'Courier New', monospace;
            font-size: 0.8rem;
            line-height: 1.6;
            padding: 16px;
            overflow-x: auto;
            white-space: pre-wrap;
            word-break: break-word;
            max-height: 500px;
            overflow-y: auto;
            margin-top: 12px;
        }
        .spinner {
            font-family: Arial, sans-serif;
            font-size: 0.82rem;
            color: #888;
            padding: 12px 0;
        }
        table.podaci-table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 0.82rem;
            margin-top: 14px;
        }
        table.podaci-table th {
            background: #217e20;
            color: #fff;
            padding: 8px 12px;
            text-align: left;
            font-weight: 600;
            letter-spacing: 0.03em;
        }
        table.podaci-table td {
            padding: 8px 12px;
            border-bottom: 1px solid #e0e0e0;
            color: #333;
            vertical-align: top;
        }
        table.podaci-table tr:nth-child(even) td { background: #f0f5f0; }
        .badge-admin {
            background: #217e20; color: #fff;
            font-size: 0.68rem; font-weight: 700;
            padding: 2px 7px; letter-spacing: 0.04em;
        }
        .badge-user {
            background: #888; color: #fff;
            font-size: 0.68rem; font-weight: 700;
            padding: 2px 7px; letter-spacing: 0.04em;
        }
    </style>
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
            <li><a href="unos.php" class="nav-link">UNOS</a></li>
            <li><a href="onama.php" class="nav-link">O NAMA</a></li>
            <li><a href="kontakt.php" class="nav-link">KONTAKT</a></li>
            <li><a href="administrator.php" class="nav-link">ADMIN</a></li>
            <li><a href="podaci.php" class="nav-link active">PODACI</a></li>
        </ul>
    </div>
</nav>

<main id="content">
    <section class="category-section">
        <h2 class="category-heading">
            <span class="category-square"></span>
            PODACI – JSON &amp; XML
        </h2>
        <hr class="section-rule">

        <?php if (!$admin): ?>
            <p class="error-msg">&#9888; Pristup odbijen. Morate biti prijavljeni kao administrator. <a href="administrator.php">Prijava</a></p>
        <?php else: ?>

        <div class="podaci-tabs">
            <button class="podaci-tab active" onclick="showTab('json')">JSON – Kontakt poruke</button>
            <button class="podaci-tab"        onclick="showTab('xml')">XML – Korisnici</button>
        </div>

        <div class="podaci-panel active" id="panel-json">
            <p style="font-family:Arial,sans-serif;font-size:0.83rem;color:#444;margin-bottom:12px;">
                Kontakt poruke iz baze podataka u <strong>JSON</strong> formatu.
                Direktan link na izvorni JSON:
            </p>
            <a href="kontakti_json.php" target="_blank" class="link-badge">&#8599; Otvori kontakti_json.php</a>

            <p style="font-family:Arial,sans-serif;font-size:0.83rem;color:#444;margin:14px 0 6px;">Vizualni prikaz:</p>
            <div id="json-tablica"><p class="spinner">Učitavanje...</p></div>

            <p style="font-family:Arial,sans-serif;font-size:0.83rem;color:#444;margin:14px 0 6px;">Sirovi JSON:</p>
            <pre class="kod" id="json-raw">Učitavanje...</pre>
        </div>

        <div class="podaci-panel" id="panel-xml">
            <p style="font-family:Arial,sans-serif;font-size:0.83rem;color:#444;margin-bottom:12px;">
                Popis korisnika iz baze podataka u <strong>XML</strong> formatu (lozinke nisu izložene).
                Direktan link na izvorni XML:
            </p>
            <a href="korisnici_xml.php" target="_blank" class="link-badge">&#8599; Otvori korisnici_xml.php</a>

            <p style="font-family:Arial,sans-serif;font-size:0.83rem;color:#444;margin:14px 0 6px;">Vizualni prikaz:</p>
            <div id="xml-tablica"><p class="spinner">Učitavanje...</p></div>

            <p style="font-family:Arial,sans-serif;font-size:0.83rem;color:#444;margin:14px 0 6px;">Sirovi XML:</p>
            <pre class="kod" id="xml-raw">Učitavanje...</pre>
        </div>

        <?php endif; ?>

    </section>
</main>

<?php mysqli_close($dbc); ?>

<footer id="footer">
    <div class="footer-inner">
        <p class="footer-copy">&copy; ŠRD Jastrebarsko 2026</p>
        <nav class="footer-links">
            <a href="#">Cookies</a>
            <a href="#">Policy and Privacy</a>
            <a href="#">Transparency</a>
        </nav>
        <p class="footer-author">Autor: Noa Novosel &nbsp;|&nbsp; nnovosel@tvz.hr &nbsp;|&nbsp; 2026.</p>
    </div>
</footer>

<?php if ($admin): ?>
<script>

function showTab(tab) {
    document.querySelectorAll('.podaci-tab').forEach((t, i) => {
        t.classList.toggle('active', (tab === 'json' && i === 0) || (tab === 'xml' && i === 1));
    });
    document.getElementById('panel-json').classList.toggle('active', tab === 'json');
    document.getElementById('panel-xml').classList.toggle('active',  tab === 'xml');
}


fetch('kontakti_json.php')
    .then(r => r.json())
    .then(data => {

        document.getElementById('json-raw').textContent = JSON.stringify(data, null, 2);


        const poruke = data.poruke || [];
        if (poruke.length === 0) {
            document.getElementById('json-tablica').innerHTML = '<p class="no-results">Nema kontakt poruka.</p>';
            return;
        }
        let html = '<table class="podaci-table"><thead><tr>'
            + '<th>#</th><th>Datum</th><th>Ime</th><th>E-mail</th><th>Poruka</th>'
            + '</tr></thead><tbody>';
        poruke.forEach(p => {
            html += `<tr>
                <td>${p.id}</td>
                <td>${escHtml(p.datum)}</td>
                <td>${escHtml(p.ime)}</td>
                <td><a href="mailto:${escHtml(p.email)}">${escHtml(p.email)}</a></td>
                <td>${escHtml(p.poruka)}</td>
            </tr>`;
        });
        html += '</tbody></table>';
        document.getElementById('json-tablica').innerHTML = html;
    })
    .catch(() => {
        document.getElementById('json-raw').textContent     = 'Greška pri dohvatu JSON-a.';
        document.getElementById('json-tablica').innerHTML   = '<p class="error-msg">Greška pri dohvatu podataka.</p>';
    });


fetch('korisnici_xml.php')
    .then(r => r.text())
    .then(text => {
        // Sirovi ispis
        document.getElementById('xml-raw').textContent = text;

        // Parsiranje u tablicu
        const parser  = new DOMParser();
        const xmlDoc  = parser.parseFromString(text, 'application/xml');
        const korisnici = xmlDoc.querySelectorAll('korisnik');

        if (korisnici.length === 0) {
            document.getElementById('xml-tablica').innerHTML = '<p class="no-results">Nema korisnika.</p>';
            return;
        }

        let html = '<table class="podaci-table"><thead><tr>'
            + '<th>#</th><th>Ime</th><th>Prezime</th><th>Korisničko ime</th><th>Razina</th>'
            + '</tr></thead><tbody>';
        korisnici.forEach(k => {
            const razina = k.querySelector('razina').textContent;
            const badge  = razina === 'administrator'
                ? '<span class="badge-admin">ADMIN</span>'
                : '<span class="badge-user">KORISNIK</span>';
            html += `<tr>
                <td>${k.querySelector('id').textContent}</td>
                <td>${escHtml(k.querySelector('ime').textContent)}</td>
                <td>${escHtml(k.querySelector('prezime').textContent)}</td>
                <td>${escHtml(k.querySelector('korisnicko_ime').textContent)}</td>
                <td>${badge}</td>
            </tr>`;
        });
        html += '</tbody></table>';
        document.getElementById('xml-tablica').innerHTML = html;
    })
    .catch(() => {
        document.getElementById('xml-raw').textContent   = 'Greška pri dohvatu XML-a.';
        document.getElementById('xml-tablica').innerHTML = '<p class="error-msg">Greška pri dohvatu podataka.</p>';
    });

function escHtml(str) {
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;');
}
</script>
<?php endif; ?>

</body>
</html>