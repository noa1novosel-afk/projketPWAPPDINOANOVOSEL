-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2026 at 02:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `srdjastrebarsko`
--

-- --------------------------------------------------------

--
-- Table structure for table `kontakti`
--

CREATE TABLE `kontakti` (
  `id` int(11) NOT NULL,
  `datum` varchar(32) DEFAULT NULL,
  `ime` varchar(64) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `poruka` text DEFAULT NULL,
  `procitano` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kontakti`
--

INSERT INTO `kontakti` (`id`, `datum`, `ime`, `email`, `poruka`, `procitano`) VALUES
(1, '07.06.2026. 20:04', 'nn', 'nnovosel@tvz.hr', 'rtesta', 0),
(2, '07.06.2026. 20:19', 'nn', 'nnovosel@tvz.hr', 'pitanje', 0),
(3, '11.06.2026. 14:01', 'nn', 'nn@gmail.com', 'Test', 0);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(32) DEFAULT NULL,
  `prezime` varchar(32) DEFAULT NULL,
  `korisnicko_ime` varchar(32) DEFAULT NULL,
  `lozinka` varchar(255) DEFAULT NULL,
  `razina` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `razina`) VALUES
(1, 'M', 'N', 'nm', '$2y$10$3d/OfAQHYQVGt1OmQuHaou1VRHPH/1ysFAyI.7ZjEyTf7ZoC7k626', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vijesti`
--

CREATE TABLE `vijesti` (
  `id` int(11) NOT NULL,
  `datum` varchar(32) DEFAULT NULL,
  `naslov` varchar(64) DEFAULT NULL,
  `sazetak` text DEFAULT NULL,
  `tekst` text DEFAULT NULL,
  `slika` varchar(64) DEFAULT NULL,
  `kategorija` varchar(64) DEFAULT NULL,
  `arhiva` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `vijesti`
--

INSERT INTO `vijesti` (`id`, `datum`, `naslov`, `sazetak`, `tekst`, `slika`, `kategorija`, `arhiva`) VALUES
(13, '07.06.2026.', 'Pripreme za ribolovno natjecanje', '', 'Svako uspješno ribolovno natjecanje započinje kvalitetnom pripremom. Članovi ŠRD Jastrebarsko dobro znaju koliko je važno unaprijed proučiti vodu, vremenske uvjete i ponašanje ribe. Dobra priprema često čini razliku između prosječnog i vrhunskog rezultata.\r\n\r\nPrije samog natjecanja potrebno je provjeriti opremu, pripremiti mamce i uskladiti taktiku s uvjetima na stazi. Iskusni natjecatelji posebnu pažnju posvećuju hranjenju lovnog mjesta jer upravo ono može privući veći broj riba tijekom ograničenog vremena natjecanja.\r\n\r\nJednako važna je i psihološka priprema. Natjecatelji moraju ostati koncentrirani i smireni bez obzira na razvoj situacije. Ponekad nekoliko minuta može odlučiti pobjednika. Upravo zato uspješni ribolovci ne oslanjaju se samo na sreću nego na znanje, iskustvo i upornost. Takav pristup godinama karakterizira članove ŠRD Jastrebarsko.', 'DSC_0215-780x405.jpg', 'natjecanja', 0),
(14, '07.06.2026.', 'Mladi natjecatelji – budućnost društva', '', 'Budućnost svakog sportskog društva nalazi se u radu s mladima. ŠRD Jastrebarsko pridaje veliku važnost uključivanju djece i mladih u ribolovne aktivnosti te njihovom postupnom razvoju kroz natjecanja i edukacije.\r\n\r\nMladi ribolovci kroz treninge uče osnove sportskog ribolova, pravilno rukovanje opremom i odgovorno ponašanje prema prirodi. Sudjelovanjem na natjecanjima stječu samopouzdanje, razvijaju natjecateljski duh i upoznaju vršnjake sličnih interesa.\r\n\r\nPosebna vrijednost ovakvih aktivnosti jest razvoj odgovornosti i strpljenja. Ribolov nije sport brzih rezultata, već disciplina koja nagrađuje upornost i predan rad. Mnogi današnji uspješni natjecatelji svoje prve korake napravili su upravo kao mladi članovi lokalnih društava. Zbog toga ulaganje u mlade predstavlja jedno od najvažnijih područja djelovanja ŠRD Jastrebarsko.', 'OIP (4).jpg', 'natjecanja', 0),
(15, '07.06.2026.', 'Tradicija ribolova u Jastrebarskom', '', 'ŠRD Jastrebarsko ima dugu i bogatu tradiciju koja seže još u prvu polovicu 20. stoljeća. Tijekom desetljeća društvo je okupljalo brojne zaljubljenike u ribolov i prirodu te postalo važan dio sportskog i društvenog života grada.\r\n\r\nKroz godine su se mijenjale tehnike ribolova, oprema i pristupi gospodarenju vodama, ali je ostala ista ljubav prema prirodi i sportskom ribolovu. Upravo zahvaljujući predanom radu članova društvo je uspješno očuvalo svoju tradiciju i prilagodilo se modernim izazovima.\r\n\r\nDanas ŠRD Jastrebarsko predstavlja mjesto okupljanja ljudi različitih generacija koji dijele zajedničku strast prema ribolovu. Iskustva starijih članova prenose se na mlađe, stvarajući snažnu povezanost i osjećaj pripadnosti. Ta kombinacija tradicije, znanja i zajedništva čini društvo važnim nositeljem ribolovne kulture jaskanskog kraja.', 'OIP (2).jpg', 'opcenito', 0),
(16, '07.06.2026.', 'Očuvanje voda i ribljeg fonda', '', 'Jedna od najvažnijih zadaća ŠRD Jastrebarsko jest očuvanje voda i ribljeg fonda. Društvo redovito provodi aktivnosti usmjerene na zaštitu okoliša, poribljavanje i održavanje prirodnih staništa.\r\n\r\nZdrava voda temelj je kvalitetnog ribolova. Zbog toga članovi sudjeluju u akcijama čišćenja obala, uklanjanja otpada i uređenja okoliša. Takve aktivnosti ne koriste samo ribolovcima nego i svim posjetiteljima koji dolaze uživati u prirodi.\r\n\r\nPosebnu važnost imaju poribljavanja kojima se održava stabilnost ribljih populacija. Time se osigurava dugoročna održivost ribolova i očuvanje prirodne ravnoteže. Odgovoran odnos prema vodi i okolišu jedna je od temeljnih vrijednosti društva, a upravo zahvaljujući takvom pristupu buduće generacije moći će uživati u ljepotama jaskanskih voda.', '51335604_1460491977416623_327675991453335552_n-1.jpg', 'opcenito', 0),
(18, '07.06.2026.', 'Ribolov kao spoj sporta i prirode', '', 'Ribolov je mnogo više od pokušaja ulova ribe. Za članove ŠRD Jastrebarsko on predstavlja spoj sporta, rekreacije i boravka u prirodi. Upravo taj sklad privlači velik broj ljudi svih generacija.\r\n\r\nBoravak uz vodu pruža priliku za odmor od svakodnevnih obveza i stresa. Tišina, svjež zrak i prirodno okruženje pozitivno djeluju na fizičko i mentalno zdravlje. Istovremeno, ribolov zahtijeva koncentraciju, strpljenje i poznavanje prirodnih procesa.\r\n\r\nMnogi članovi društva ističu kako im vrijeme provedeno na vodi pomaže u održavanju ravnoteže između poslovnih obveza i slobodnog vremena. Osim toga, ribolov često okuplja obitelji i prijatelje, stvarajući uspomene koje ostaju za cijeli život. Upravo zbog toga ovaj sport zauzima posebno mjesto u životima brojnih stanovnika jaskanskog kraja.', 'maxresdefault.jpg', 'opcenito', 0),
(19, '07.06.2026.', 'Pripreme za ribolovno natjecanje', '', 'Svako uspješno ribolovno natjecanje započinje kvalitetnom pripremom. Članovi ŠRD Jastrebarsko dobro znaju koliko je važno unaprijed proučiti vodu, vremenske uvjete i ponašanje ribe. Dobra priprema često čini razliku između prosječnog i vrhunskog rezultata.\r\n\r\nPrije samog natjecanja potrebno je provjeriti opremu, pripremiti mamce i uskladiti taktiku s uvjetima na stazi. Iskusni natjecatelji posebnu pažnju posvećuju hranjenju lovnog mjesta jer upravo ono može privući veći broj riba tijekom ograničenog vremena natjecanja.\r\n\r\nJednako važna je i psihološka priprema. Natjecatelji moraju ostati koncentrirani i smireni bez obzira na razvoj situacije. Ponekad nekoliko minuta može odlučiti pobjednika. Upravo zato uspješni ribolovci ne oslanjaju se samo na sreću nego na znanje, iskustvo i upornost. Takav pristup godinama karakterizira članove ŠRD Jastrebarsko.', 'srd-1.jpg', 'natjecanja', 0),
(22, '07.06.2026.', 'Deverika – čest stanovnik mirnih voda', '', 'Deverika je jedna od najrasprostranjenijih slatkovodnih riba u nizinskim rijekama, kanalima i jezerima. Karakterizira je visoko i bočno spljošteno tijelo srebrnkaste do brončane boje. Najčešće se kreće u jatima te se hrani sitnim organizmima i hranom koju pronalazi na dnu. Zbog svoje brojnosti često je cilj ribolovaca koji prakticiraju lov na plovak ili feeder tehniku. Iako ne doseže veličine šarana ili soma, deverika je važan dio ribljeg fonda i vrlo zanimljiva vrsta za sportski ribolov.', 'deverika riba.jpg', 'ribe', 0),
(23, '07.06.2026.', 'Som – najveći grabežljivac naših voda', '', 'Som je najveća slatkovodna riba u Hrvatskoj i pravi vladar riječnih dubina. Prepoznatljiv je po dugim brkovima, širokoj glavi i snažnom tijelu koje mu omogućuje uspješan lov. Najčešće obitava u dubokim dijelovima rijeka i jezera, gdje vreba svoj plijen. Hrani se ribama, rakovima i drugim vodenim organizmima. Ulov velikog soma predstavlja poseban doživljaj za svakog ribolovca jer ova riba pruža snažan otpor i nezaboravnu borbu.', 'Som-1024x450.jpg', 'ribe', 0),
(24, '07.06.2026.', 'Šaran – kralj sportskog ribolova', '', 'Šaran je jedna od najpoznatijih i najcjenjenijih slatkovodnih riba u Hrvatskoj. Poznat je po svojoj snazi, opreznosti i borbenosti, zbog čega predstavlja poseban izazov za ribolovce. Nastanjuje jezera, ribnjake i sporije rijeke bogate vegetacijom. Hrani se različitim organizmima s dna, ali i biljnim materijalom. Veći primjerci mogu doseći impresivne dimenzije i težinu veću od 20 kilograma. Upravo zbog svoje veličine i snage šaran je omiljena meta sportskih ribolovaca tijekom cijele godine.', 'Common_carp_saran.jpg', 'ribe', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kontakti`
--
ALTER TABLE `kontakti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`);

--
-- Indexes for table `vijesti`
--
ALTER TABLE `vijesti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kontakti`
--
ALTER TABLE `kontakti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vijesti`
--
ALTER TABLE `vijesti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
