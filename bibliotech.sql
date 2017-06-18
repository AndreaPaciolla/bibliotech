-- RESTORE CONSISTENT POINT

DROP SCHEMA public CASCADE;
CREATE SCHEMA public;

CREATE DATABASE bibliotech IF NOT EXISTS
  WITH OWNER = postgres
       ENCODING = 'UTF8'
       TABLESPACE = pg_default
       LC_COLLATE = 'Italian_Italy.1252'
       LC_CTYPE = 'Italian_Italy.1252'
       CONNECTION LIMIT = -1;


-- START DATABASE SCHEMA CREATION

CREATE TABLE "lingua" (
  "id" SERIAL PRIMARY KEY,
  "nome" VARCHAR(5) UNIQUE NOT NULL
);

INSERT INTO lingua(nome) VALUES('az');
INSERT INTO lingua(nome) VALUES('cz');
INSERT INTO lingua(nome) VALUES('de');
INSERT INTO lingua(nome) VALUES('ja');
INSERT INTO lingua(nome) VALUES('fa');
INSERT INTO lingua(nome) VALUES('en');
INSERT INTO lingua(nome) VALUES('uk');
INSERT INTO lingua(nome) VALUES('sv');
INSERT INTO lingua(nome) VALUES('ru');
INSERT INTO lingua(nome) VALUES('tr');
INSERT INTO lingua(nome) VALUES('nl');
INSERT INTO lingua(nome) VALUES('it');
INSERT INTO lingua(nome) VALUES('pl');
INSERT INTO lingua(nome) VALUES('ge');
INSERT INTO lingua(nome) VALUES('fr');

CREATE TABLE "ruolo" (
  "id" SERIAL PRIMARY KEY,
  "nome" VARCHAR(255) UNIQUE NOT NULL,
  "librimax" SMALLINT NOT NULL,
  "tempomax" INTEGER NOT NULL
);

INSERT INTO ruolo(nome, librimax, tempomax) VALUES('studente', 5, 60);
INSERT INTO ruolo(nome, librimax, tempomax) VALUES('docente', 10, 90);
INSERT INTO ruolo(nome, librimax, tempomax) VALUES('altro', 3, 14);
INSERT INTO ruolo(nome, librimax, tempomax) VALUES('dipendente', 0, 0);

CREATE TABLE "stato" (
  "id" SERIAL PRIMARY KEY,
  "nome" VARCHAR(255) UNIQUE NOT NULL
);

INSERT INTO stato(nome) VALUES
('fghanistan'),
('lbania'),
('Bermuda'),
('Bhutan'),
('Bolivia'),
('Bosnia and Herzegovina'),
('Botswana'),
('Bouvet Islan'),
('Brazil'),
('British Indian Ocean Territory'),
('Brunei'),
('Bulgaria'),
('Burkina Faso'),
('Burundi'),
('Cambodia'),
('Cameroon'),
('Canad'),
('Cape Verde'),
('Cayman Islands'),
('Central African Republic'),
('Chad'),
('Chile'),
('France'),
('French Guiana'),
('French Polynesia'),
('French Southern Territorie'),
('Gabon'),
('Gambia The'),
('Georgia'),
('Germany'),
('Ghana'),
('Gibraltar'),
('Greece'),
('Greenland'),
('Grenada'),
('Guadeloupe'),
('Guam'),
('Guatemala'),
('Guernsey and Alderney'),
('Guinea'),
('Guinea-Bissau'),
('Guyana'),
('Haiti'),
('Heard and McDonald Island'),
('Honduras'),
('Hong Kong S.A.R.'),
('Hungary'),
('Iceland'),
('India'),
('Indonesia'),
('Iran'),
('Iraq'),
('Ireland'),
('Israel'),
('Italy'),
('JJamaica'),
('JJapan'),
('Poland'),
('Portugal'),
('Puerto Rico'),
('Qatar'),
('Reunion'),
('Romania'),
('Russia');

CREATE TABLE "provincia" (
  "id" SERIAL PRIMARY KEY,
  "id_stato" INTEGER NOT NULL,
  "nome" VARCHAR(255) UNIQUE NOT NULL
);

INSERT INTO provincia(id, nome, id_stato) VALUES
(1754, 'Donegal', 55),
(1755, 'Dublin', 55),
(1756, 'Galway', 55),
(1757, 'Kerry', 55),
(1758, 'Kildare', 55),
(1759, 'Kilkenny', 55),
(1760, 'Laois', 55),
(1761, 'Leinster', 55),
(1762, 'Leitrim', 55),
(1763, 'Limerick', 55),
(1764, 'Loch Garman', 55),
(1765, 'Longford', 55),
(1766, 'Louth', 55),
(1767, 'Mayo', 55),
(1768, 'Meath', 55),
(1769, 'Monaghan', 55),
(1770, 'Offaly', 55),
(1771, 'Roscommon', 55),
(1772, 'Sligo', 55),
(1773, 'Tipperary North Riding', 55),
(1774, 'Tipperary South Riding', 55),
(1775, 'Ulster', 55),
(1776, 'Waterford', 55),
(1777, 'Westmeath', 55),
(1778, 'Wexford', 55),
(1779, 'Wicklow', 55),
(1780, 'Beit Hanania', 55),
(1781, 'Ben Gurion Airport', 55),
(1782, 'Bethlehem', 55),
(1783, 'Caesarea', 55),
(1784, 'Centre', 55),
(1785, 'Gaza', 55),
(1786, 'Hadaron', 55),
(1787, 'Haifa District', 55),
(1788, 'Hamerkaz', 55),
(1789, 'Hazafon', 55),
(1790, 'Hebron', 55),
(1791, 'Jaffa', 55),
(1792, 'Jerusalem', 55),
(1793, 'Khefa', 55),
(1794, 'Kiryat Yam', 55),
(1795, 'Lower Galilee', 55),
(1796, 'Qalqilya', 55),
(1797, 'Talme Elazar', 55),
(1798, 'Tel Aviv', 55),
(1799, 'Tsafon', 55),
(1800, 'Umm El Fahem', 55),
(1801, 'Yerushalayim', 55),
(1802, 'Abruzzi', 55),
(1803, 'Abruzzo', 55),
(1804, 'Agrigento', 55),
(1805, 'Alessandria', 55),
(1806, 'Ancona', 55),
(1807, 'Arezzo', 55),
(1808, 'Ascoli Piceno', 55),
(1809, 'Asti', 55),
(1810, 'Avellino', 55),
(1811, 'Bari', 55),
(1812, 'Basilicata', 55),
(1813, 'Belluno', 55),
(1814, 'Benevento', 55),
(1815, 'Bergamo', 55),
(1816, 'Biella', 55),
(1817, 'Bologna', 55),
(1818, 'Bolzano', 55),
(1819, 'Brescia', 55),
(1820, 'Brindisi', 55),
(1821, 'Calabria', 55),
(1822, 'Campania', 55),
(1823, 'Cartoceto', 55),
(1824, 'Caserta', 55),
(1825, 'Catania', 55),
(1826, 'Chieti', 55),
(1827, 'Como', 55),
(1828, 'Cosenza', 55),
(1829, 'Cremona', 55),
(1830, 'Cuneo', 55),
(1831, 'Emilia-Romagna', 55),
(1832, 'Ferrara', 55),
(1833, 'Firenze', 55),
(1834, 'Florence', 55),
(1835, 'Forli-Cesena ', 55),
(1836, 'Friuli-Venezia Giulia', 55),
(1837, 'Frosinone', 55),
(1838, 'Genoa', 55),
(1839, 'Gorizia', 55),
(1841, 'Lazio', 55),
(1842, 'Lecce', 55),
(1843, 'Lecco', 55),
(1844, 'Lecco Province', 55),
(1845, 'Liguria', 55),
(1846, 'Lodi', 55),
(1847, 'Lombardia', 55),
(1848, 'Lombardy', 55),
(1849, 'Macerata', 55),
(1850, 'Mantova', 55),
(1851, 'Marche', 55),
(1852, 'Messina', 55),
(1853, 'Milan', 55),
(1854, 'Modena', 55),
(1855, 'Molise', 55),
(1856, 'Molteno', 55),
(1857, 'Montenegro', 55),
(1858, 'Monza and Brianza', 55),
(1859, 'Naples', 55),
(1860, 'Novara', 55),
(1861, 'Padova', 55),
(1862, 'Parma', 55),
(1863, 'Pavia', 55),
(1864, 'Perugia', 55),
(1865, 'Pesaro-Urbino', 55),
(1866, 'Piacenza', 55),
(1867, 'Piedmont', 55),
(1868, 'Piemonte', 55),
(1869, 'Pisa', 55),
(1870, 'Pordenone', 55),
(1871, 'Potenza', 55),
(1872, 'Puglia', 55),
(1873, 'Reggio Emilia', 55),
(1874, 'Rimini', 55),
(1875, 'Roma', 55),
(1876, 'Salerno', 55),
(1877, 'Sardegna', 55),
(1878, 'Sassari', 55),
(1879, 'Savona', 55),
(1880, 'Sicilia', 55),
(1881, 'Siena', 55),
(1882, 'Sondrio', 55),
(1883, 'South Tyrol', 55),
(1884, 'Taranto', 55),
(1885, 'Teramo', 55),
(1886, 'Torino', 55),
(1887, 'Toscana', 55),
(1888, 'Trapani', 55),
(1889, 'Trentino-Alto Adige', 55),
(1890, 'Trento', 55),
(1891, 'Treviso', 55),
(1892, 'Udine', 55),
(1893, 'Umbria', 55),
(1894, 'Valle d''Aosta', 55),
(1895, 'Varese', 55),
(1896, 'Veneto', 55),
(1897, 'Venezia', 55),
(1898, 'Verbano-Cusio-Ossola', 55),
(1899, 'Vercelli', 55),
(1900, 'Verona', 55),
(1901, 'Vicenza', 55),
(1902, 'Viterbo', 55),
(1903, 'Buxoro Viloyati', 55),
(1904, 'Clarendon', 55),
(1905, 'Hanover', 55),
(1906, 'Kingston', 55),
(1907, 'Manchester', 55);

CREATE INDEX "idx_provincia__id_stato" ON "provincia" ("id_stato");

ALTER TABLE "provincia" ADD CONSTRAINT "fk_provincia__id_stato" FOREIGN KEY ("id_stato") REFERENCES "stato" ("id");

CREATE TABLE "citta" (
  "id" SERIAL PRIMARY KEY,
  "id_provincia" INTEGER NOT NULL,
  "nome" VARCHAR(255) UNIQUE NOT NULL
);

CREATE INDEX "idx_citta__id_provincia" ON "citta" ("id_provincia");

ALTER TABLE "citta" ADD CONSTRAINT "fk_citta__id_provincia" FOREIGN KEY ("id_provincia") REFERENCES "provincia" ("id");

INSERT INTO citta(id, nome, id_provincia) VALUES
(23992, 'Pescantina', 1896),
(23993, 'Peschiera del Garda', 1896),
(23994, 'Pianiga', 1896),
(23995, 'Piazzola sul Brenta', 1896),
(23996, 'Pieve di Soligo', 1896),
(23997, 'Pievebelvicino', 1896),
(23998, 'Piombino Dese', 1896),
(23999, 'Piove di Sacco', 1896),
(24000, 'Ponte San Nicolo', 1896),
(24001, 'Ponzano Veneto', 1896),
(24002, 'Porto Tolle', 1896),
(24003, 'Porto Viro', 1896),
(24004, 'Portogruaro', 1896),
(24005, 'Preganziol', 1896),
(24006, 'Quinto di Treviso', 1896),
(24007, 'Riese Pio X', 1896),
(24008, 'Romano dEzzelino', 1896);

CREATE TABLE "autore" (
  "id" SERIAL PRIMARY KEY,
  "id_citta_nascita" INTEGER NOT NULL,
  "nome" VARCHAR(255) NOT NULL,
  "cognome" VARCHAR(255) NOT NULL,
  "data_nascita" DATE NOT NULL,
  "biografia" TEXT NOT NULL
);

INSERT INTO autore(id_citta_nascita, nome, cognome, data_nascita, biografia) VALUES
(24005, 'JRR', 'Tolkien', '1980/02/16', 'Considero me stesso un poeta sin dalla minore età.'),
(24003, 'Jane', 'Austen', '1986/02/16', 'Considero tutti dei poeti non sbocciati.'),
(24001, 'Philip', 'Pullman', '1984/02/16', 'La poesia è ovunque.'),
(24002, 'Douglas', 'Adams', '1989/02/16', 'La perfezione è il niente.'),
(24005, 'JK', 'Rowling', '1975/02/16', 'La magia è insita in ogni giorno.'),
(24004, 'Harper', 'Lee', '1986/02/16', 'Considero me stesso un poeta sin dalla minore età.');

CREATE INDEX "idx_autore__id_citta_nascita" ON "autore" ("id_citta_nascita");

ALTER TABLE "autore" ADD CONSTRAINT "fk_autore__id_citta_nascita" FOREIGN KEY ("id_citta_nascita") REFERENCES "citta" ("id");

CREATE TABLE "casaeditrice" (
  "id" SERIAL PRIMARY KEY,
  "id_citta" INTEGER NOT NULL,
  "denominazione" VARCHAR(255) UNIQUE NOT NULL
);

INSERT INTO casaeditrice(denominazione, id_citta) VALUES
('Adelphi Edizioni – www.adelphi.it', 24000),
('Armando Curcio Editore – www.armandocurcioeditore.it', 24001),
('Bollati Boringhieri Editore – www.bollatiboringhieri.it', 24001),
('Bompiani Editore – www.bompiani.eu', 24001),
('Fanucci Editore – www.fanucci.it', 24001),
('Franco Angeli Editore – www.francoangeli.it', 24004),
('Garzanti Editore – www.garzanti.it', 24006),
('Hoepli – www.hoepli.it', 23994);

CREATE INDEX "idx_casaeditrice__id_citta" ON "casaeditrice" ("id_citta");

ALTER TABLE "casaeditrice" ADD CONSTRAINT "fk_casaeditrice__id_citta" FOREIGN KEY ("id_citta") REFERENCES "citta" ("id");

CREATE TABLE "libro" (
  "id" SERIAL PRIMARY KEY,
  "id_casaeditrice" INTEGER NOT NULL,
  "id_lingua" INTEGER NOT NULL,
  "isbn" TEXT NOT NULL,
  "titolo" VARCHAR(255) NOT NULL,
  "edizione" INTEGER NOT NULL,
  "anno_pubblicazione" DATE NOT NULL
);

CREATE INDEX "idx_libro__id_casaeditrice" ON "libro" ("id_casaeditrice");

CREATE INDEX "idx_libro__id_lingua" ON "libro" ("id_lingua");

INSERT INTO libro(id_casaeditrice, id_lingua, isbn, titolo, anno_pubblicazione, edizione) VALUES
(1, 12, '88-515-2159', 'Il Signore degli Anelli', '1993/02/01', 1),
(1, 12, '88-515-2189', 'Orgoglio e Pregiudizio', '1997/02/01', 1),
(7, 12, '88-515-1159', 'Queste Oscure Materie', '1993/03/01', 1),
(7, 12, '88-515-2199', 'Guida Galattica per gli Autostoppisti', '1998/02/01', 1),
(5, 12, '88-515-2211', 'Harry Potter e il Calice di Fuoco', '2001/02/01', 1),
(7, 12, '88-515-2150', 'Il Buio Oltre la Siepe', '1999/02/01', 1);

ALTER TABLE "libro" ADD CONSTRAINT "fk_libro__id_casaeditrice" FOREIGN KEY ("id_casaeditrice") REFERENCES "casaeditrice" ("id");

ALTER TABLE "libro" ADD CONSTRAINT "fk_libro__id_lingua" FOREIGN KEY ("id_lingua") REFERENCES "lingua" ("id");

CREATE TABLE "autore_libro" (
  "id_autore" INTEGER NOT NULL,
  "id_libro" INTEGER NOT NULL,
  PRIMARY KEY ("id_autore", "id_libro")
);
INSERT INTO autore_libro(id_libro, id_autore) VALUES
(1, 1),
(2, 2),
(3,3),
(4,4),
(5,5),
(6,6);


CREATE INDEX "idx_autore_libro" ON "autore_libro" ("id_libro");

ALTER TABLE "autore_libro" ADD CONSTRAINT "fk_autore_libro__autore" FOREIGN KEY ("id_autore") REFERENCES "autore" ("id");

ALTER TABLE "autore_libro" ADD CONSTRAINT "fk_autore_libro__libro" FOREIGN KEY ("id_libro") REFERENCES "libro" ("id");

CREATE TABLE "copia" (
  "id" SERIAL PRIMARY KEY,
  "id_libro" INTEGER NOT NULL,
  "disponibile" BOOLEAN NOT NULL DEFAULT TRUE,
  "sezione" VARCHAR(20) NOT NULL,
  "scaffale" VARCHAR(20) NOT NULL
);

CREATE INDEX "idx_copia__id_libro" ON "copia" ("id_libro");

INSERT INTO copia(id_libro, sezione, scaffale) VALUES
(3, 'LET', 2),
(5, 'LET', 3),
(5, 'LET', 3),
(6, 'LET', 3);


ALTER TABLE "copia" ADD CONSTRAINT "fk_copia__id_libro" FOREIGN KEY ("id_libro") REFERENCES "libro" ("id");

CREATE TABLE "utente" (
  "id" SERIAL PRIMARY KEY,
  "id_ruolo" INTEGER NOT NULL,
  "id_citta_nascita" INTEGER,
  "id_citta" INTEGER NOT NULL,
  "nome" TEXT NOT NULL,
  "cognome" VARCHAR(255) NOT NULL,
  "telefono" VARCHAR(15) UNIQUE NOT NULL,
  "email" VARCHAR(255) UNIQUE NOT NULL,
  "tessera" VARCHAR(50) UNIQUE NOT NULL,
  "data_registrazione" DATE NOT NULL,
  "data_nascita" DATE DEFAULT NULL,
  "sesso" VARCHAR(1),
  "password" VARCHAR(255) NOT NULL
);

INSERT INTO utente(id_ruolo, id_citta, id_citta_nascita, nome, cognome, telefono, email, tessera, data_registrazione, sesso, password) VALUES
(1, 24001, 24000, 'Andrea', 'Paciolla', '3406669321', 'andreapaciolla@gmail.com', '000001', '2017/02/16', 'M', '5f4dcc3b5aa765d61d8327deb882cf99');

CREATE INDEX "idx_utente__id_citta" ON "utente" ("id_citta");

CREATE INDEX "idx_utente__id_citta_nascita" ON "utente" ("id_citta_nascita");

CREATE INDEX "idx_utente__id_ruolo" ON "utente" ("id_ruolo");

ALTER TABLE "utente" ADD CONSTRAINT "fk_utente__id_citta" FOREIGN KEY ("id_citta") REFERENCES "citta" ("id");

ALTER TABLE "utente" ADD CONSTRAINT "fk_utente__id_citta_nascita" FOREIGN KEY ("id_citta_nascita") REFERENCES "citta" ("id");

ALTER TABLE "utente" ADD CONSTRAINT "fk_utente__id_ruolo" FOREIGN KEY ("id_ruolo") REFERENCES "ruolo" ("id");

CREATE TABLE "prestito" (
  "id" SERIAL PRIMARY KEY,
  "id_copia" INTEGER NOT NULL,
  "id_utente" INTEGER NOT NULL,
  "data_inizio" DATE NOT NULL,
  "data_fine" DATE,
  "voto" SMALLINT,
  "commento" TEXT,
  "stato_operativo" BOOLEAN
);

CREATE INDEX "idx_prestito__id_copia" ON "prestito" ("id_copia");

CREATE INDEX "idx_prestito__id_utente" ON "prestito" ("id_utente");

ALTER TABLE "prestito" ADD CONSTRAINT "fk_prestito__id_copia" FOREIGN KEY ("id_copia") REFERENCES "copia" ("id");

ALTER TABLE "prestito" ADD CONSTRAINT "fk_prestito__id_utente" FOREIGN KEY ("id_utente") REFERENCES "utente" ("id");