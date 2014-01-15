CSV Exporter
============

Eine Sammlung von Skripten die über einen cronjob Shop Produkte in eine csv Datei exportieren

Installieren und Konfigurieren
------------------------------
1.  Legen Sie das gesamte Modul in Ihrem Shop in

          modules/marm/csvexporter

2.  Konfigurieren, erweitern oder Schreiben Sie neue Exporter

3.  Rufen Sie Ihren Exportscript über ein cronjob auf

4.  Genießen Sie das Ergebnis


Hinweise
--------

Getestet auf Oxid CE 4.6.5

Version
-------
Aktuelle Version 1.0


Exporter Konfigurieren
======================

Grund Konfigurationen
---------------------

in der "protected $_config" 

'filename' - hier kann man eingeben wo die Datei erstellt wird und wie sie heißt

'shippingcost' - hier kann man ein array füllen mit Versandkosten
 
CSV Konfigurationen
-------------------

in der "protected $_entry"

erstellt man die Struktur der csv Datei

- 'header' - hier werden die Spalten Namen nach einander geschrieben.

Einzelne Spaltenname werden mit ; getrennt.

wenn man eine Leerzeile braucht zwischen der Kopfzeile und den Datensätzen, \n an den letzten Spaltennamen anhängen.

- 'fields' - hier werden die Inhalte der spalten geschrieben.

Einzelne Datensätze werden in #oxid# geschrieben und mit | getrennt.

#oxid#+#oxtitle# so werden mehrere Inhalte in einer spalte ausgegeben.

#oxshortdesc#/#oxlongdesc# so wird das zweite ausgegeben falls das erste nicht vorhanden ist.

- 'separator' - hier wird das Trennzeichen für die csv Datei eingetragen.

verschiedene Datenfeeds brauchen unterschiedliche Anforderungen an die csv Datei um die lesen zu können, mit dem Separator wird die Zeilen und Spalten Struktur definiert.

Eigene Konfigurationen
----------------------

man kann in den einzelnen Exportern alle Funktionen aus der marmCsvExporter.php überschreiben und erweitern.

Eine nicht vorhandene extra spalte hinzufügen, aber wie?

als Bsp.: wollen wir das Attribut Farbe der einzelnen Varianten Produkte auslesen

in der "protected $_entry"

- in 'header' schreiben wir den neuen Spaltennamen "Farbe".

- in 'fields' kommt ein neuer Marker #color#.

- jetzt muss die Funktion "getDataByMarker" aus der marmCsvExporter.php in unserem exporter um ein Marker erweitert werden.

- dem neuen Marker geben wir eine Funktion.

- und zum Schluss wir die eigentlich Funktion in unserem exporter geschrieben die die Farbe der Varianten Produkte ausließt und den an den Marker übergibt.
