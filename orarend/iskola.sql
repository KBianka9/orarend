-- phpMyAdmin SQL Dump
-- version 5.2.2-dev+20231116.f370c1a8d6
-- https://www.phpmyadmin.net/
--
-- Gép: localhost
-- Létrehozás ideje: 2023. Nov 17. 12:41
-- Kiszolgáló verziója: 10.4.24-MariaDB
-- PHP verzió: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `iskola`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo`
--

CREATE TABLE `felhasznalo` (
  `azonosito` int(6) NOT NULL,
  `jogosultsag` varchar(50) COLLATE utf8_hungarian_ci NOT NULL DEFAULT 'diák',
  `nev` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  `jelszo` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `telefon` int(12) DEFAULT NULL,
  `kezdes_eve` year(4) DEFAULT NULL,
  `evfolyam` int(2) DEFAULT NULL,
  `betujel` varchar(1) COLLATE utf8_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalo`
--

INSERT INTO `felhasznalo` (`azonosito`, `jogosultsag`, `nev`, `jelszo`, `email`, `telefon`, `kezdes_eve`, `evfolyam`, `betujel`) VALUES
(345740, 'diák', 'Nagy Amália', '42c1f229e14c3e479a1b0deb37b34882', 'nagyami@gmail.com', 0, '2020', 12, 'a'),
(345742, 'admin', 'Árva Károly', '6e7a39b8bd3d274a4b5059b4e49ae4fa', 'arvakaroly@gmail.com', 701548695, NULL, NULL, NULL),
(345743, 'diák', 'Horváth Fanni', 'f4218783c5a63652a743ae330effe37e', 'horvathfanni@gmail.com', 0, '2020', 12, 'a'),
(345744, 'diák', 'Kocsis Miklós', '630f9081965b34276f9ade0ae8174f0e', 'kocsismiki@gmail.com', 0, '2020', 12, 'b'),
(345745, 'diák', 'Farkas Marianna', '498bb05a4265088015c9cf6731af3589', 'farkasmariann@gmail.com', 0, '2020', 12, 'b'),
(345746, 'diák', 'Imre Márton', '6331310f0f3c65f7ebbb5999dc3628aa', 'imremarci@gmail.com', 20156487, '2020', 12, 'b'),
(345747, 'diák', 'Nagy Réka', '7f4da34f691d1bffe8068c6563a47ea1', 'nagyreka@gmail.com', 301547896, '2021', 10, 'a'),
(345748, 'tanár', 'Mihalik András', '9d28795dc48ce9a3b8a12c74273aaa8a', 'mihalikandras@gmail.com', 301548620, '2020', 12, 'a'),
(345749, 'tanár', 'Mészáros Emese', 'd0912e75066d67b6292b7e6fe49f48ef', 'meszarosemese@gmail.com', 302846758, '2020', 12, 'b'),
(345750, 'tanár', 'Gaál Borbála', 'c25fa5c0765283939a9e85498030f594', 'gaalborbala@gmail.com', 20156487, NULL, NULL, NULL),
(345751, 'tanár', 'Molnár Júlia', 'd0bd178b399f3289ff095166644c9bc9', 'molnarjulia@gmail.com', 0, '2021', 10, 'a'),
(345752, 'tanár', 'Huszár Mária', '3680f4907af1ea561bbcb8ddb107def1', 'huszarmaria@gmail.com', 0, '2021', 10, 'b'),
(345753, 'tanár', 'Baranyai István', '715b38b20e6b5da1fb99dc3eb1abcd41', 'baranyaistvan@gmail.com', 304598456, '2022', 9, 'a'),
(345755, 'tanár', 'Simon Bernadett', '9e6bbecfa0d23869bbf11e5272f705e9', 'simonbernadett@gmail.com', 0, '2022', 9, 'b'),
(345756, 'admin', 'Kiss Alfréd', '63f8f4cfbb18d0e44d8337a6ad15a8c8', 'kissalfred@gmail.com', 0, NULL, NULL, NULL),
(345757, 'tanár', 'Földesi Szilvia', 'd4f0fc9604e9fede2913874836aded3b', 'foldesiszilvia@gmail.com', 301548695, NULL, NULL, NULL),
(345758, 'tanár', 'Tóth Attila', '0b82947b22f2525a7608df0e20172da2', 'tothattila@gmail.com', 301547856, NULL, NULL, NULL),
(345759, 'diák', 'Nagy Mihály', 'bec798ccac2e21aa9f570d121ba9ceec', 'nagymihaly@gmail.com', 0, '2021', 10, 'a'),
(345760, 'diák', 'Kiss Bianka', '4f10435221dc5fc5dc002ab7c44b6065', 'kissbianka@gmail.com', 0, '2020', 12, 'a'),
(345761, 'diák', 'Újfalvy Kamilla', '3832fe1d733e51a54d8c605d709775ba', 'ujfalvykamilla@gmail.com', 0, '2022', 9, 'a'),
(345762, 'tanár', 'Arany Vivien', 'f46246624aa301f3750ac89f0078f8d1', 'aranyvivien@gmail.com', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `oktatotttargy`
--

CREATE TABLE `oktatotttargy` (
  `tanar_azonosito` int(6) NOT NULL,
  `oktatott_targy` varchar(30) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `oktatotttargy`
--

INSERT INTO `oktatotttargy` (`tanar_azonosito`, `oktatott_targy`) VALUES
(345748, 'angol'),
(345749, 'matek, fizika'),
(345750, 'magyar, angol'),
(345751, 'német'),
(345752, 'biológia, kémia'),
(345753, 'angol, német'),
(345755, 'fizika'),
(345757, 'földrajz, biológia'),
(345758, 'tesi'),
(345762, 'matek, fizika');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `osztaly`
--

CREATE TABLE `osztaly` (
  `kezdes_eve` year(4) NOT NULL,
  `evfolyam` int(2) NOT NULL,
  `betujel` varchar(2) COLLATE utf8_hungarian_ci NOT NULL,
  `letszam` int(2) NOT NULL,
  `tagozat` varchar(30) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `osztaly`
--

INSERT INTO `osztaly` (`kezdes_eve`, `evfolyam`, `betujel`, `letszam`, `tagozat`) VALUES
('2020', 12, 'a', 22, 'nyelvi'),
('2020', 12, 'b', 32, 'természettudományi'),
('2021', 10, 'a', 30, 'nyelvi'),
('2021', 10, 'b', 20, 'természettudományi'),
('2022', 9, 'a', 26, 'nyelvi'),
('2022', 9, 'b', 25, 'természettudományi');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tanora`
--

CREATE TABLE `tanora` (
  `tanar_azonosito` int(6) NOT NULL,
  `nap` varchar(10) COLLATE utf8_hungarian_ci NOT NULL,
  `ora` time NOT NULL,
  `tanora_neve` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  `teremszam` int(3) NOT NULL,
  `kezdes_eve` year(4) NOT NULL,
  `evfolyam` int(2) NOT NULL,
  `betujel` varchar(1) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `tanora`
--

INSERT INTO `tanora` (`tanar_azonosito`, `nap`, `ora`, `tanora_neve`, `teremszam`, `kezdes_eve`, `evfolyam`, `betujel`) VALUES
(345748, 'Hétfő', '08:00:00', 'angol', 111, '2020', 12, 'a'),
(345748, 'Hétfő', '09:00:00', 'angol', 111, '2020', 12, 'a'),
(345749, 'Hétfő', '10:00:00', 'matek', 217, '2020', 12, 'a'),
(345750, 'Hétfő', '11:00:00', 'magyar', 219, '2020', 12, 'a'),
(345751, 'Hétfő', '12:00:00', 'német', 111, '2020', 12, 'a'),
(345752, 'Hétfő', '12:00:00', 'kémia', 219, '2020', 12, 'b'),
(345753, 'Hétfő', '10:00:00', 'német', 215, '2020', 12, 'b'),
(345755, 'Hétfő', '09:00:00', 'fizika', 219, '2020', 12, 'b'),
(345757, 'Hétfő', '08:00:00', 'biológia', 217, '2020', 12, 'b'),
(345757, 'Hétfő', '13:00:00', 'földrajz', 222, '2020', 12, 'b'),
(345758, 'Hétfő', '11:00:00', 'tesi', 300, '2020', 12, 'b');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `terem`
--

CREATE TABLE `terem` (
  `teremszam` int(3) NOT NULL,
  `ferohely` int(2) NOT NULL,
  `felszereltseg` varchar(20) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `terem`
--

INSERT INTO `terem` (`teremszam`, `ferohely`, `felszereltseg`) VALUES
(111, 40, 'kiváló'),
(215, 20, 'közepes'),
(217, 60, 'kiváló'),
(218, 40, 'jó'),
(219, 20, 'közepes'),
(222, 30, 'jó'),
(300, 100, 'kiváló');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `felhasznalo`
--
ALTER TABLE `felhasznalo`
  ADD PRIMARY KEY (`azonosito`),
  ADD KEY `felhasznalo_ibfk_1` (`kezdes_eve`,`evfolyam`,`betujel`);

--
-- A tábla indexei `oktatotttargy`
--
ALTER TABLE `oktatotttargy`
  ADD PRIMARY KEY (`tanar_azonosito`,`oktatott_targy`),
  ADD KEY `oktatott_targy_index` (`tanar_azonosito`);

--
-- A tábla indexei `osztaly`
--
ALTER TABLE `osztaly`
  ADD PRIMARY KEY (`kezdes_eve`,`evfolyam`,`betujel`);

--
-- A tábla indexei `tanora`
--
ALTER TABLE `tanora`
  ADD PRIMARY KEY (`tanar_azonosito`,`nap`,`ora`),
  ADD KEY `teremszam_index` (`teremszam`),
  ADD KEY `kezdes_eve` (`kezdes_eve`,`evfolyam`,`betujel`);

--
-- A tábla indexei `terem`
--
ALTER TABLE `terem`
  ADD PRIMARY KEY (`teremszam`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `felhasznalo`
--
ALTER TABLE `felhasznalo`
  MODIFY `azonosito` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=345763;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `felhasznalo`
--
ALTER TABLE `felhasznalo`
  ADD CONSTRAINT `felhasznalo_ibfk_1` FOREIGN KEY (`kezdes_eve`,`evfolyam`,`betujel`) REFERENCES `osztaly` (`kezdes_eve`, `evfolyam`, `betujel`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Megkötések a táblához `oktatotttargy`
--
ALTER TABLE `oktatotttargy`
  ADD CONSTRAINT `oktatotttargy_ibfk_1` FOREIGN KEY (`tanar_azonosito`) REFERENCES `felhasznalo` (`azonosito`);

--
-- Megkötések a táblához `tanora`
--
ALTER TABLE `tanora`
  ADD CONSTRAINT `tanora_ibfk_1` FOREIGN KEY (`teremszam`) REFERENCES `terem` (`teremszam`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tanora_ibfk_2` FOREIGN KEY (`tanar_azonosito`) REFERENCES `felhasznalo` (`azonosito`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tanora_ibfk_3` FOREIGN KEY (`kezdes_eve`,`evfolyam`,`betujel`) REFERENCES `osztaly` (`kezdes_eve`, `evfolyam`, `betujel`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
