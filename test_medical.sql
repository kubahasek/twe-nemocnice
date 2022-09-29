-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pon 21. úno 2022, 00:16
-- Verze serveru: 10.1.30-MariaDB
-- Verze PHP: 7.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `test_medical`
--
CREATE DATABASE IF NOT EXISTS `test_medical` DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci;
USE `test_medical`;

-- --------------------------------------------------------

--
-- Struktura tabulky `patient`
--

CREATE TABLE `patient` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `patient`
--

INSERT INTO `patient` (`id`, `name`, `surname`) VALUES
(1, 'Hynek', 'Bejček'),
(2, 'Blanka', 'Maturová'),
(3, 'Věnceslav', 'Koza'),
(4, 'Miriam', 'Mikulenková'),
(5, 'René', 'Záruba'),
(6, 'Svatava', 'Zoubková'),
(7, 'Šimon', 'Mikeš');

-- --------------------------------------------------------

--
-- Struktura tabulky `procedure`
--

CREATE TABLE `procedure` (
  `id` int(10) UNSIGNED NOT NULL,
  `number` varchar(10) COLLATE utf8_czech_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `procedure`
--

INSERT INTO `procedure` (`id`, `number`, `title`, `price`) VALUES
(1, '01021', 'KOMPLEXNÍ VYŠETŘENÍ PRAKTICKÝM LÉKAŘEM', 830),
(2, '01022', 'OPAKOVANÉ KOMPLEXNÍ VYŠETŘENÍ PRAKTICKÝM LÉKAŘEM', 556),
(3, '01023', 'CÍLENÉ VYŠETŘENÍ PRAKTICKÝM LÉKAŘEM', 214),
(4, '01024', 'KONTROLNÍ VYŠETŘENÍ PRAKTICKÝM LÉKAŘEM', 141),
(5, '01025', 'KONZULTACE PRAKTICKÉHO LÉKAŘE RODINNÝMI PŘÍSLUŠNÍKY PACIENTA', 87),
(6, '01026', 'ČASNÝ ZÁCHYT DEMENCE V  ORDINACI PRAKTICKÉHO LÉKAŘE', 206),
(7, '01030', 'ADMINISTRATIVNÍ ÚKONY PRAKTICKÉHO LÉKAŘE', 87),
(8, '01040', 'PODROBNÝ VÝPIS Z DOKUMENTACE', 261),
(9, '01146', 'STANOVENÍ D-DIMERU V ORDINACI', 356),
(10, '01147', 'STANOVENÍ SRDEČNÍHO TROPONINU T V ORDINACI', 456),
(11, '01148', 'STANOVENÍ PRO BNP V ORDINACI', 773),
(12, '01150', 'NÁVŠTĚVA PRAKTICKÉHO LÉKAŘE U PACIENTA', 60),
(13, '01160', 'NÁVŠTĚVA LÉKAŘE U PACIENTA V DOBĚ MEZI 19 - 22 HOD.', 100),
(14, '01170', 'NÁVŠTĚVA LÉKAŘE U PACIENTA V DOBĚ MEZI 22 - 06 HOD.', 200),
(15, '01180', 'NÁVŠTĚVA LÉKAŘE U PACIENTA V DEN PRACOVNÍHO VOLNA NEBO PRACOVNÍHO KLIDU', 200),
(16, '01185', 'PŘEDOPERAČNÍ VYŠETŘENÍ PRAKTICKÝM LÉKAŘEM', 214),
(17, '01186', 'PŘEVZETÍ PACIENTA PO ONKOLOGICKÉ LÉČBĚ DO PÉČE LÉKAŘE PRIMÁRNÍ PÉČE', 556),
(18, '01188', 'NÁSLEDNÁ PROHLÍDKA PACIENTA S ONKOLOGICKÝM ONEMOCNĚNÍM', 351),
(19, '01196', 'MANAGEMENT ČASNÉHO ZÁCHYTU KARCINOMU PLIC – ZAHÁJENÍ SLEDOVÁNÍ POJIŠTĚNCE V RÁMCI ČASNÉHO ZÁCHYTU KARCINOMU PLIC', 206),
(20, '01197', 'MANAGEMENT ČASNÉHO ZÁCHYTU KARCINOMU PLIC – BEZ NÁSLEDNÉHO SLEDOVÁNÍ POJIŠTĚNCE V RÁMCI ČASNÉHO ZÁCHYTU KARCINOMU PLIC', 206),
(21, '01201', '.PÉČE O STABILIZOVANÉHO KOMPENZOVANÉHO DIABETIKA 2. TYPU PRAKTICKÝM LÉKAŘEM', 411),
(22, '01204', 'PÉČE O PREDIABETIKA PRAKTICKÝM LÉKAŘEM', 411),
(23, '01210', 'TEST MENTÁLNÍCH FUNKCÍ V ORDINACI PRAKTICKÉHO LÉKAŘE', 261),
(24, '01211', 'PÉČE O PACIENTA S DEMENCÍ PRAKTICKÝM LÉKAŘEM', 274),
(25, '01441', 'STANOVENÍ GLUKÓZY GLUKOMETREM', 20),
(26, '01443', 'KVANTITATIVNÍ STANOVENÍ KREVNÍ SRÁŽLIVOSTI (INR) Z KAPILÁRNÍ KRVE (POCT)', 187),
(27, '01445', 'STANOVENÍ GLYKOVANÉHO HEMOGLOBINU HBA1C V AMBULANCI', 159),
(28, '15118', 'MANAGEMENT KOLOREKTÁLNÍHO SCREENINGU', 206),
(29, '15119', 'KOLOREKTÁLNÍ SCREENING-ANALYTICKÁ ČÁST, STANOVENÍ OKULTNÍHO KRVÁCENÍ VE STOLICI', 194),
(30, '15120', 'SIGNÁLNÍ VÝKON - STANOVENÍ OKULTNÍHO KRVÁCENÍ VE STOLICI SPECIÁLNÍM TESTEM V RÁMCI SCREENINGU KOLOREKTÁLNÍHO KARCINOMU - NÁLEZ NEGATIVNÍ', 0),
(31, '15121', 'SIGNÁLNÍ VÝKON - STANOVENÍ OKULTNÍHO KRVÁCENÍ VE STOLICI SPECIÁLNÍM TESTEM V RÁMCI SCREENINGU KOLOREKTÁLNÍHO KARCINOMU - NÁLEZ POZITIVNÍ', 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `report`
--

CREATE TABLE `report` (
  `id` int(10) UNSIGNED NOT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `procedure_id` int(10) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `note` text COLLATE utf8_czech_ci NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `report`
--

INSERT INTO `report` (`id`, `patient_id`, `procedure_id`, `date`, `note`, `deleted_at`) VALUES
(1, 1, 4, '2022-02-16 14:20:02', 'Pacientovi bylo hrozně špatně. Předepsán paralen.', NULL),
(2, 6, 12, '2022-02-17 10:36:44', 'Pacientka s podezřením na zánět slepého střeva. Nejspíš si to vymýšlí, protože ji bolí na druhé straně dutiny břišní.', NULL);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `procedure`
--
ALTER TABLE `procedure`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `procedure_id` (`procedure_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pro tabulku `procedure`
--
ALTER TABLE `procedure`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pro tabulku `report`
--
ALTER TABLE `report`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`procedure_id`) REFERENCES `procedure` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
