-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 22, 2026 alle 09:26
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.0.30

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
  `prezzo` decimal(10,0) NOT NULL COMMENT 'Prezzo al mese',
  `data_aggiunta` date NOT NULL DEFAULT current_timestamp(),
  `filmID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `film`
--

INSERT INTO `film` (`isan`, `titolo`, `autore`, `genere`, `prezzo`, `data_aggiunta`, `filmID`) VALUES
('000000019A2B0000Q0000001X', 'Il silenzio del tempo', 'Marco Bellini', 'Drammatico', 5, '2026-01-22', 1),
('000000023F7C0000R0000002Y', 'Ombre nella notte', 'Laura Conti', 'Thriller', 6, '2026-01-22', 2),
('000000038D4E0000S0000003Z', 'Ritorno a casa', 'Giovanni Rinaldi', 'Romantico', 4, '2026-01-22', 3),
('000000041B9A0000T0000004W', 'L\'ultima missione', 'Andrea Moretti', 'Azione', 7, '2026-01-22', 4),
('000000056C2F0000U0000005V', 'Oltre le stelle', 'Francesca De Luca', 'Fantascienza', 8, '2026-01-22', 5),
('000000064E8D0000P0000006U', 'Il mistero del lago', 'Paolo Ferri', 'Giallo', 4, '2026-01-22', 6),
('000000079F1C0000N0000007T', 'Sotto lo stesso cielo', 'Elena Vitale', 'Drammatico', 5, '2026-01-22', 7),
('000000082A7B0000M0000008S', 'Codice Omega', 'Riccardo Sala', 'Fantascienza', 9, '2026-01-22', 8),
('000000093C6D0000L0000009R', 'Fuga dal passato', 'Alessandro Greco', 'Thriller', 5, '2026-01-22', 9),
('000000104D8F0000K0000010Q', 'Vite intrecciate', 'Sara Lombardi', 'Drammatico', 5, '2026-01-22', 10),
('000000115B2A0000J0000011P', 'La città perduta', 'Matteo Galli', 'Avventura', 6, '2026-01-22', 11),
('000000126F9C0000I0000012O', 'Incubo digitale', 'Davide Romano', 'Horror', 6, '2026-01-22', 12),
('000000137A4E0000H0000013N', 'Amore senza tempo', 'Chiara Fontana', 'Romantico', 4, '2026-01-22', 13),
('000000148D7B0000G0000014M', 'Oltre il confine', 'Luca Bianchi', 'Azione', 7, '2026-01-22', 14),
('000000159C1F0000F0000015L', 'La verità nascosta', 'Marta Pellegrini', 'Giallo', 5, '2026-01-22', 15),
('000000160E8A0000E0000016K', 'Universo parallelo', 'Stefano Ricci', 'Fantascienza', 8, '2026-01-22', 16),
('000000171B9D0000D0000017J', 'Il prezzo del potere', 'Nicola Testa', 'Drammatico', 5, '2026-01-22', 17),
('000000182F3C0000C0000018I', 'Notte di paura', 'Valentina Neri', 'Horror', 6, '2026-01-22', 18),
('000000193A6E0000B0000019H', 'Strade incrociate', 'Federico Marin', 'Drammatico', 5, '2026-01-22', 19),
('000000204C8F0000A0000020G', 'L\'erede segreto', 'Simone Costa', 'Avventura', 6, '2026-01-22', 20);

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
('Narrativa', 'produzione letteraria scritta con l\'intento di rientrare in uno specifico genere letterario, caratterizzata da temi, personaggi e situazioni ripetitive che attraggono particolari gruppi di lettori.'),
('Noir', 'Atmosfere cupe con personaggi moralmente ambigui'),
('Psicologico', 'Esplorazione profonda della psiche umana e dei conflitti interiori'),
('Romantico', 'Storie incentrate su relazioni amorose e sentimenti'),
('Romanzo', '  '),
('Saggio', 'non ha una trama lineare, ma si concentra su un\'idea, un tema o una riflessione personale, spesso guidata da una voce fuori campo che accompagna lo spettatore in un processo di pensiero critico e interrogativo.'),
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
  `prezzo` int(11) NOT NULL COMMENT 'prezzo al mese',
  `data_aggiunta` date NOT NULL DEFAULT current_timestamp(),
  `libroID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `libri`
--

INSERT INTO `libri` (`isbn`, `titolo`, `autore`, `genere`, `prezzo`, `data_aggiunta`, `libroID`) VALUES
('9788806229041', 'Il nome della rosa', 'Umberto Eco', 'Storico', 5, '2026-01-22', 121),
('9788807881705', 'La solitudine dei numeri primi', 'Paolo Giordano', 'Narrativa', 4, '2026-01-22', 122),
('9788806219288', 'Gomorra', 'Roberto Saviano', 'Saggio', 4, '2026-01-22', 123),
('9788806221199', 'Io non ho paura', 'Niccolò Ammaniti', 'Narrativa', 3, '2026-01-22', 124),
('9788807812662', 'Seta', 'Alessandro Baricco', 'Romanzo', 3, '2026-01-22', 125),
('9788806227566', 'Il codice Da Vinci', 'Dan Brown', 'Thriller', 5, '2026-01-22', 126),
('9788807883129', 'Harry Potter e la pietra filosofale', 'J.K. Rowling', 'Fantasy', 4, '2026-01-22', 127),
('9788804668233', 'Il signore degli anelli', 'J.R.R. Tolkien', 'Fantasy', 5, '2026-01-22', 128),
('9788807900161', '1984', 'George Orwell', 'Distopico', 3, '2026-01-22', 129),
('9788806220673', 'Il vecchio e il mare', 'Ernest Hemingway', 'Classico', 3, '2026-01-22', 130),
('9788806224732', 'Shining', 'Stephen King', 'Horror', 4, '2026-01-22', 131),
('9788806228815', 'Il trono di spade', 'George R.R. Martin', 'Fantasy', 6, '2026-01-22', 132),
('9788806218892', 'Il piccolo principe', 'Antoine de Saint-Exupéry', 'Classico', 2, '2026-01-22', 133),
('9788806222554', 'La ragazza del treno', 'Paula Hawkins', 'Thriller', 4, '2026-01-22', 134),
('9788806226064', 'Il cacciatore di aquiloni', 'Khaled Hosseini', 'Narrativa', 4, '2026-01-22', 135),
('9788806229980', 'Fahrenheit 451', 'Ray Bradbury', 'Fantascienza', 3, '2026-01-22', 136),
('9788806221441', 'Dracula', 'Bram Stoker', 'Horror', 3, '2026-01-22', 137),
('9788806224015', 'Il grande Gatsby', 'F. Scott Fitzgerald', 'Classico', 3, '2026-01-22', 138),
('9788806227122', 'Norwegian Wood', 'Haruki Murakami', 'Classico', 4, '2026-01-22', 139),
('9788806225333', 'La strada', 'Cormac McCarthy', 'Guerra', 4, '2026-01-22', 140);

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
  `libro` int(11) DEFAULT NULL,
  `film` int(11) DEFAULT NULL
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
('BRGASD67B60D969A', 'Alessandro', 'Brugnatti', '3556214555', '1967-02-02', 'Genova', '3netta@gmail.com'),
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
(3, 'lookatgreta', '$2y$10$gs1fOuurta87BGnfNuRfQ.NsGtlnt3Fcob4dJtFnPuZWINr6wzxcO', 'admin', 'BRGGTM07B60D969A'),
(4, '3netta', '$2y$10$8XiC3rJdohmJBnQ0SL5JcuF8ojH5A7roTHjm9nx2uyo/65Y3bdwL6', 'utente', 'BRGASD67B60D969A');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`filmID`),
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
  ADD PRIMARY KEY (`libroID`),
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
-- AUTO_INCREMENT per la tabella `film`
--
ALTER TABLE `film`
  MODIFY `filmID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT per la tabella `libri`
--
ALTER TABLE `libri`
  MODIFY `libroID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT per la tabella `noleggi`
--
ALTER TABLE `noleggi`
  MODIFY `codice_noleggio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id_utente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  ADD CONSTRAINT `noleggi_ibfk_2` FOREIGN KEY (`film`) REFERENCES `film` (`filmID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `noleggi_ibfk_3` FOREIGN KEY (`libro`) REFERENCES `libri` (`libroID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
