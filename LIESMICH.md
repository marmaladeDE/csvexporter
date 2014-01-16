CSV Exporter
============

Eine Sammlung von Skripten, die über einen cronjob Shop Produkte in eine csv Datei exportieren

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

in der protected Variable `$_config` 

        'export_parents'                => Anzeigen von Eltern Produkten in der csv Datei
        'filename'                      => Pfad und Dateiname
        'limit'                         => Limit für Export
        'debug'                         => debug Option An/Aus, für Entwickler
        'silent'                        => debug Ausgaben An/Aus, für Entwickler
        'header'                        => Kopfzeile An/Aus
        'langid'                        => Sprach id, für welche Sprache Exportiert werden soll
        'shippingcost'                  => Versand Optionen      
        'productLinkPrefix'             => Standard Produkt URL Präfix
        'geizhalsProductLinkParameters' => Exporter spezifischer Produkt Parameter    
        'imageurl'                      => Pfad der zu Exportierenden Produkt Bilder
        'inStock'                       => Ausgabe, wenn Produkt Lageberstand hat
        'outOfStock'                    => Ausgabe, wenn Produkt kein Lagerbestand hat      
        'cutFirstPosArticlenumber'      => Die ersten x Zeichen der Artikelnummer abschneiden
        'generalVat'                    => MwSt für die Nettopreise
        'netPrices'                     => Nettopreise An/Aus
        'categoryPathSeparator'         => Trennzeichen für die Kategoriepfade

CSV Konfigurationen
-------------------

In der protected Variable `$_entry` wird die Struktur der csv Datei erstellt.

- in dem `header` schreiben wir nach einander die Spalten Namen, die mit `;` getrennt werden.

wenn man eine Leerzeile zwischen der Kopfzeile und den Datensätzen braucht, schreiben wir ein `\n` an den letzten Spaltennamen.

- in den `fields` werden die Inhalte der spalten geschrieben.

Einzelne Datensätze werden in `#oxid#` geschrieben und mit `|` getrennt.

`#oxid#+#oxtitle#` so werden mehrere Inhalte in einer spalte ausgegeben.

`#oxshortdesc#/#oxlongdesc#` so wird das zweite ausgegeben falls das erste nicht vorhanden ist.

- in dem `separator` wird das Trennzeichen für die csv Datei eingetragen.

Mit dem Separator wird die Zeilen und Spalten Struktur definiert.

Eigene Konfigurationen
----------------------

Man kann in den einzelnen Exportern alle Funktionen aus der **marmCsvExporter.php** überschreiben und erweitern.

Eine nicht vorhandene Spalte hinzufügen, aber wie?

als Bsp.: wollen wir das Attribut Farbe der einzelnen Varianten Produkte auslesen

in der protected Variable `$_entry`:

- in `header` schreiben wir den neuen Spaltennamen `Farbe`.

- in `fields` kommt ein neuer Marker `#color#`.

im Export Script:

- jetzt muss die Funktion `getDataByMarker($marker)` aus der **marmCsvExporter.php** in unserem exporter um ein Marker erweitert werden.

- dem neuen Marker geben wir eine Funktion.

- und zum Schluss wird die eigentliche Funktion in unserem exporter geschrieben, die die Farbe der Varianten Produkte ausließt und den an den Marker übergibt.
