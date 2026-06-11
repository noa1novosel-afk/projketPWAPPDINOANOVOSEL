<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Popis vijesti - ŠRD Jastrebarsko</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <style type="text/css">
        .xml-count {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 0.85rem;
            color: #555555;
            margin-bottom: 16px;
        }
        table.xml-table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 0.84rem;
        }
        table.xml-table th {
            background-color: #217e20;
            color: #ffffff;
            padding: 10px 14px;
            text-align: left;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            font-size: 0.74rem;
        }
        table.xml-table td {
            padding: 10px 14px;
            border-bottom: 1px solid #dddddd;
            vertical-align: middle;
            color: #333333;
        }

        .kat {
            display: inline-block;
            padding: 2px 9px;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            background-color: #e4f0e3;
            color: #217e20;
            border: 1px solid #b8d4b0;
        }
        .kat-ribe       { background-color: #e0f0f8; color: #1a5a8a; border-color: #a8c8e0; }
        .kat-natjecanja { background-color: #fdf0e0; color: #8a4a00; border-color: #e0c080; }
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
                <li><a href="onama.php" class="nav-link">O NAMA</a></li>
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
                POPIS VIJESTI
            </h2>
            <hr class="section-rule"/>

            <p class="xml-count">
                Ukupan broj vijesti: <strong><xsl:value-of select="count(//Vijest)"/></strong>
            </p>

            <table class="xml-table">
                <tr>
                    <th>ID</th>
                    <th>Naslov</th>
                    <th>Autor</th>
                    <th>Kategorija</th>
                    <th>Datum</th>
                    <th>Slika</th>
                </tr>
                <xsl:for-each select="Vijesti/Vijest">
                <tr>
                    <td class="id-col"><xsl:value-of select="Id"/></td>
                    <td><strong><xsl:value-of select="Naslov"/></strong></td>
                    <td><xsl:value-of select="Autor"/></td>
                    <td>
                        <xsl:choose>
                            <xsl:when test="Kategorija = 'Ribe'">
                                <span class="kat kat-ribe"><xsl:value-of select="Kategorija"/></span>
                            </xsl:when>
                            <xsl:when test="Kategorija = 'Natjecanja'">
                                <span class="kat kat-natjecanja"><xsl:value-of select="Kategorija"/></span>
                            </xsl:when>
                            <xsl:otherwise>
                                <span class="kat"><xsl:value-of select="Kategorija"/></span>
                            </xsl:otherwise>
                        </xsl:choose>
                    </td>
                    <td><xsl:value-of select="Datum"/></td>
                    <td><xsl:value-of select="Slika"/></td>
                </tr>
                </xsl:for-each>
            </table>

        </section>
    </main>

    <footer id="footer">
        <div class="footer-inner">
            <p class="footer-copy">&#169; ŠRD Jastrebarsko 2026</p>
            <nav class="footer-links">
                <a href="#">Cookies</a>
                <a href="#">Policy and Privacy</a>
                <a href="#">Transparency</a>
            </nav>
            <p class="footer-author">Autor: Noa Novosel &#160;|&#160; nnovosel@tvz.hr &#160;|&#160; 2026.</p>
        </div>
    </footer>

</body>
</html>
</xsl:template>
</xsl:stylesheet>
