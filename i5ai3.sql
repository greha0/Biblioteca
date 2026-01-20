-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 20, 2026 alle 23:41
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `i5ai3`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `film`
--

CREATE TABLE `film` (
  `isan` varchar(96) NOT NULL,
  `titolo` varchar(254) NOT NULL,
  `autore` varchar(32) NOT NULL,
  `genere` varchar(32) NOT NULL,
  `quantita` int(11) NOT NULL DEFAULT 1,
  `prezzo` decimal(10,0) NOT NULL COMMENT 'Prezzo al mese',
  `data_aggiunta` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `film`
--

INSERT INTO `film` (`isan`, `titolo`, `autore`, `genere`, `quantita`, `prezzo`, `data_aggiunta`) VALUES
('0000-0001-2023-0000-A', 'Blade Runner 2049', 'Denis Villeneuve', 'Fantascienza', 0, 1, '2026-01-20'),
('0000-0002-2019-0000-B', 'Knives Out', 'Rian Johnson', 'Giallo', 0, 0, '2026-01-20'),
('0000-0004-2010-0000-D', 'Inception', 'Christopher Nolan', 'Thriller', 0, 0, '2026-01-20'),
('0000-0005-2004-0000-E', 'The Notebook', 'Nick Cassavetes', 'Romantico', 0, 0, '2026-01-20'),
('0000-0006-2018-0000-F', 'A Quiet Place', 'John Krasinski', 'Horror', 0, 0, '2026-01-20'),
('0000-0008-2018-0000-H', 'Bohemian Rhapsody', 'Bryan Singer', 'Biografico', 0, 0, '2026-01-20'),
('0000-0009-1981-0000-I', 'Indiana Jones e i Predatori dell\'Arca Perduta', 'Steven Spielberg', 'Avventura', 0, 0, '2026-01-20'),
('0000-0010-2019-0000-J', 'Joker', 'Todd Phillips', 'Distopico', 0, 0, '2026-01-20'),
('0000-0011-1972-0000-K', 'Il Padrino', 'Francis Ford Coppola', 'Classico', 0, 0, '2026-01-20'),
('0000-0012-2020-0000-L', 'My Octopus Teacher', 'Pippa Ehrlich', 'Documentario', 0, 0, '2026-01-20'),
('0000-0013-2011-0000-M', 'Una Notte da Leoni 2', 'Todd Phillips', 'Commedia', 0, 0, '2026-01-20'),
('0000-0014-1994-0000-N', 'Forrest Gump', 'Robert Zemeckis', 'Drammatico', 0, 0, '2026-01-20'),
('0000-0015-1999-0000-O', 'Matrix', 'Lana e Lilly Wachowski', 'Azione', 0, 0, '2026-01-20'),
('0000-0016-2001-0000-P', 'Shrek', 'Andrew Adamson', 'Animazione', 0, 0, '2026-01-20'),
('0000-0017-1966-0000-Q', 'Il Buono, il Brutto, il Cattivo', 'Sergio Leone', 'Western', 0, 0, '2026-01-20'),
('0000-0018-2016-0000-R', 'La La Land', 'Damien Chazelle', 'Musical', 0, 0, '2026-01-20'),
('0000-0019-1974-0000-S', 'Chinatown', 'Roman Polanski', 'Noir', 0, 0, '2026-01-20'),
('0000-0020-1998-0000-T', 'Saving Private Ryan', 'Steven Spielberg', 'Guerra', 0, 0, '2026-01-20'),
('0000-0021-2015-0000-U', 'Creed', 'Ryan Coogler', 'Sportivo', 0, 0, '2026-01-20'),
('0000-0022-2010-0000-V', 'Shutter Island', 'Martin Scorsese', 'Psicologico', 0, 0, '2026-01-20');

-- --------------------------------------------------------

--
-- Struttura della tabella `generi`
--

CREATE TABLE `generi` (
  `nome` varchar(32) NOT NULL,
  `descrizione` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `generi`
--

INSERT INTO `generi` (`nome`, `descrizione`) VALUES
('Animazione', 'Opere realizzate con tecniche di animazione'),
('Avventura', 'Viaggi emozionanti, esplorazioni e imprese pericolose'),
('Azione', 'Sequenze dinamiche con combattimenti, inseguimenti e scene spettacolari'),
('Biografico', 'Racconto della vita di persone reali'),
('Classico', 'Opere di riconosciuto valore storico e culturale'),
('Commedia', 'Storie con intento comico e divertente'),
('Distopico', 'Società future oppressive, degradate o post-apocalittiche'),
('Documentario', 'Contenuti informativi basati su fatti e realtà'),
('Drammatico', 'Narrazioni intense focalizzate su conflitti emotivi e umani'),
('Fantascienza', 'Storie ambientate in futuri ipotetici con tecnologie avanzate e scenari speculativi'),
('Fantasy', 'Mondi immaginari con elementi magici e creature fantastiche'),
('Giallo', 'Misteri, crimini e investigazioni con enigmi da risolvere'),
('Guerra', 'Conflitti bellici e le loro conseguenze'),
('Horror', 'Contenuti volti a suscitare paura, terrore e inquietudine'),
('Musical', 'Storie narrate attraverso canzoni e performance musicali'),
('Noir', 'Atmosfere cupe con personaggi moralmente ambigui'),
('Psicologico', 'Esplorazione profonda della psiche umana e dei conflitti interiori'),
('Romantico', 'Storie incentrate su relazioni amorose e sentimenti'),
('Sportivo', 'Storie incentrate su sport e atleti'),
('Storico', 'Ambientazioni in epoche passate con ricostruzioni storiche'),
('Thriller', 'Suspense, tensione e colpi di scena che tengono con il fiato sospeso'),
('Western', 'Ambientazioni nel selvaggio West americano');

-- --------------------------------------------------------

--
-- Struttura della tabella `libri`
--

CREATE TABLE `libri` (
  `isbn` varchar(13) NOT NULL,
  `titolo` varchar(254) NOT NULL,
  `autore` varchar(254) NOT NULL,
  `genere` varchar(32) NOT NULL,
  `quantita` int(11) NOT NULL DEFAULT 1,
  `prezzo` int(11) NOT NULL COMMENT 'prezzo al mese',
  `data_aggiunta` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `libri`
--

INSERT INTO `libri` (`isbn`, `titolo`, `autore`, `genere`, `quantita`, `prezzo`, `data_aggiunta`) VALUES
('9780060935467', 'Il piccolo principe', 'Antoine de Saint-Exupéry', 'Animazione', 0, 2, '2026-01-20'),
('9780061120084', 'Sapiens: Da animali a dèi', 'Yuval Noah Harari', 'Documentario', 0, 0, '2026-01-20'),
('9780140177398', 'Carri di fuoco', 'W. J. Weatherby', 'Sportivo', 0, 0, '2026-01-20'),
('9780141187761', 'Addio alle armi', 'Ernest Hemingway', 'Guerra', 0, 0, '2026-01-20'),
('9780143039433', 'Ombre rosse', 'Zane Grey', 'Western', 0, 0, '2026-01-20'),
('9780316769480', 'Orgoglio e Pregiudizio', 'Jane Austen', 'Romantico', 0, 0, '2026-01-20'),
('9780345503858', 'Hunger Games', 'Suzanne Collins', 'Azione', 0, 0, '2026-01-20'),
('9780385121675', 'Shining', 'Stephen King', 'Horror', 0, 0, '2026-01-20'),
('9780385504209', 'Il Codice da Vinci', 'Dan Brown', 'Thriller', 0, 0, '2026-01-20'),
('9780441172719', 'Neuromante', 'William Gibson', 'Fantascienza', 0, 0, '2026-01-20'),
('9780547778574', '1984', 'George Orwell', 'Distopico', 0, 0, '2026-01-20'),
('9780618002221', 'Il Signore degli Anelli', 'J.R.R. Tolkien', 'Fantasy', 0, 0, '2026-01-20'),
('9780670034696', 'Steve Jobs', 'Walter Isaacson', 'Biografico', 0, 0, '2026-01-20'),
('9780679723134', 'Il grande sonno', 'Raymond Chandler', 'Noir', 0, 0, '2026-01-20'),
('9780679732266', 'Delitto e castigo', 'Fëdor Dostoevskij', 'Psicologico', 0, 0, '2026-01-20'),
('9780740725574', 'Guida galattica per gli autostoppisti', 'Douglas Adams', 'Commedia', 0, 0, '2026-01-20'),
('9780743273564', 'Anna Karenina', 'Lev Tolstoj', 'Drammatico', 0, 0, '2026-01-20'),
('9780743273571', 'L\'isola del tesoro', 'Robert Louis Stevenson', 'Avventura', 0, 0, '2026-01-20'),
('9788804506081', 'La Divina Commedia', 'Dante Alighieri', 'Classico', 0, 0, '2026-01-20'),
('9788804520704', 'I Promessi Sposi', 'Alessandro Manzoni', 'Storico', 0, 0, '2026-01-20'),
('9788804668217', 'Il nome della rosa', 'Umberto Eco', 'Giallo', 0, 0, '2026-01-20'),
('9788804669603', 'Cime tempestose', 'Emily Brontë', 'Musical', 0, 0, '2026-01-20');

-- --------------------------------------------------------

--
-- Struttura della tabella `noleggi`
--

CREATE TABLE `noleggi` (
  `codice_noleggio` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `data_noleggio` date NOT NULL,
  `data_scadenza` date NOT NULL,
  `prezzo` decimal(10,2) NOT NULL,
  `libro` varchar(13) DEFAULT NULL,
  `film` varchar(96) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `persone`
--

CREATE TABLE `persone` (
  `cf` varchar(16) NOT NULL,
  `nome` varchar(32) NOT NULL,
  `cognome` varchar(32) NOT NULL,
  `tel` varchar(11) DEFAULT NULL,
  `data_nascita` date NOT NULL,
  `luogo_nascita` varchar(32) NOT NULL,
  `email` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `persone`
--

INSERT INTO `persone` (`cf`, `nome`, `cognome`, `tel`, `data_nascita`, `luogo_nascita`, `email`) VALUES
('BRGGTM07B60D969A', 'Greta', 'Brugnatti', '3701392265', '2007-02-20', 'Genova', 'goghi2007@gmail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `ruoli`
--

CREATE TABLE `ruoli` (
  `nome` varchar(16) NOT NULL,
  `descrizione` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ruoli`
--

INSERT INTO `ruoli` (`nome`, `descrizione`) VALUES
('admin', 'l\'admin ha i poteri su tutto e tutti'),
('bibliotecario', 'il bibliotecario ha la possibilità di aggiungere, rimuovere, modificare libri.'),
('utente', 'l\'utente ha la possibilità di visualizzare i libri noleggiabili e i libri noleggiati e quindi la possibilità di noleggiarli.');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `id_utente` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(256) NOT NULL,
  `ruolo` varchar(16) NOT NULL,
  `cf` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id_utente`, `username`, `password`, `ruolo`, `cf`) VALUES
(3, 'lookatgreta', '$2y$10$gs1fOuurta87BGnfNuRfQ.NsGtlnt3Fcob4dJtFnPuZWINr6wzxcO', 'admin', 'BRGGTM07B60D969A');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`isan`) USING BTREE,
  ADD KEY `genere` (`genere`);

--
-- Indici per le tabelle `generi`
--
ALTER TABLE `generi`
  ADD PRIMARY KEY (`nome`);

--
-- Indici per le tabelle `libri`
--
ALTER TABLE `libri`
  ADD PRIMARY KEY (`isbn`),
  ADD KEY `genere` (`genere`);

--
-- Indici per le tabelle `noleggi`
--
ALTER TABLE `noleggi`
  ADD PRIMARY KEY (`codice_noleggio`),
  ADD KEY `id_utente` (`id_utente`),
  ADD KEY `libro` (`libro`),
  ADD KEY `film` (`film`);

--
-- Indici per le tabelle `persone`
--
ALTER TABLE `persone`
  ADD PRIMARY KEY (`cf`);

--
-- Indici per le tabelle `ruoli`
--
ALTER TABLE `ruoli`
  ADD PRIMARY KEY (`nome`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id_utente`),
  ADD KEY `ruolo` (`ruolo`) USING BTREE,
  ADD KEY `cf` (`cf`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `noleggi`
--
ALTER TABLE `noleggi`
  MODIFY `codice_noleggio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id_utente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `film_ibfk_1` FOREIGN KEY (`genere`) REFERENCES `generi` (`nome`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `libri`
--
ALTER TABLE `libri`
  ADD CONSTRAINT `libri_ibfk_1` FOREIGN KEY (`genere`) REFERENCES `generi` (`nome`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `noleggi`
--
ALTER TABLE `noleggi`
  ADD CONSTRAINT `noleggi_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utenti` (`id_utente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `noleggi_ibfk_2` FOREIGN KEY (`libro`) REFERENCES `libri` (`isbn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `noleggi_ibfk_3` FOREIGN KEY (`film`) REFERENCES `film` (`isan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `utenti`
--
ALTER TABLE `utenti`
  ADD CONSTRAINT `utenti_ibfk_1` FOREIGN KEY (`cf`) REFERENCES `persone` (`cf`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `utenti_ibfk_2` FOREIGN KEY (`ruolo`) REFERENCES `ruoli` (`nome`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
