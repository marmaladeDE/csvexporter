CSV Exporter
============

Eine Sammlung von Skripten, die über einen Cronjob Shop-Produkte in eine CSV-Datei exportiert.

Installieren und Konfigurieren
------------------------------
1.  Legen Sie alle Dateien des Moduls in Ihrem Shop in das folgende Verzeichnis:

          modules/marm/csvexporter

2.  Konfigurieren, erweitern oder schreiben Sie neue Exporter. 
Einige Exporter sind bereits enthalten. An diesen können Sie sich orentieren.
Die Exporter liegen im Verzeichnis `exporter`.

3.  Nun können Sie Ihre Exportscripte aufrufen und die CSV-Datei erstellen. 
Dies können Sie entweder manuell durchführen oder über einen Cronjob automatisieren.
Der Aufruf lautet: 

        shopurl.de/modules/marm/csvexporter/exporter/IHR-EXPORTER/IHR-EXPORTER.php

4.  Schon fertig. Sie können nun Ihre CSV-Datei an die Preisportale melden.


Hinweise
--------

Getestet auf Oxid CE 4.6.5, 4.7.5, 4.8.1

Version
-------
Aktuelle Version 1.0


Exporter konfigurieren
======================

Grundkonfiguration
------------------

Im oberen Bereich Ihres Exporterscripts finden Sie die Konfiguration. 
Diese ist in der Variablen `$_config` als Array hinterlegt.
Folgende Optionen stehen Ihnen zur Verfügung.

        'export_parents'                => Anzeigen von Eltern Produkten in der CSV-Datei
        'filename'                      => Pfad und Dateiname
        'limit'                         => Limit für Export
        'debug'                         => debug Option An/Aus, für Entwickler
        'silent'                        => debug Ausgaben An/Aus, für Entwickler
        'header'                        => Kopfzeile An/Aus
        'langid'                        => Sprachid, für welche Sprache Exportiert werden soll
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

CSV-Konfiguration
-----------------

Nun geht es darum, die Ausgabe der Daten zu steuern.
In der Variablen `$_entry` werden die Felder, die Sie exportieren möchten, angegeben.

Das Array enthält folgende Optionen.

        'header'    => Spalten Namen für die CSV-Datei.
        'fields'    => Spalten Inhalte für die CSV-Datei.
        'separator' => Trennzeichen der CSV-Datei.

Hier noch einige Tipps:

- Die Spalten Namen werden im `header` nacheinander geschrieben und mit `;` getrennt.

- Um eine Leerzeile zwischen der Kopfzeile und den Inhalten in der CSV-Datei zu erzeugen, schreiben Sie ein `\n` an den letzen Spaltennamen.

- Die Spalteninhalte werden in Markern `#IHRER MARKER#` geschrieben und mit `|` getrennt.

- Man kann Marker miteinander verknüpft in einem Datensatz ausgeben, die werden mit `+` geschrieben.
Das sieht dann so aus: `#Marker 1#+#Marker 2#`.

- Oder man möchte einen Fallback haben, dann werden die Marker mit ein `/` geschrieben.
Das bedeutet wenn `#Marker 1#` leer ist wird `#Marker 2#` ausgegeben.
Das sieht dann so aus: `#Marker 1#/#Marker 2#`.

- Die Operatoren können gemischt werden und einen Spalteninhalt erstellen der aus Fallback und Verknüpfung besteht.
zB. `#Marker 1#/#Marker 2#+#Marker 3#`, hier wird entweder Marker 1 oder Marker 2 mit Marker 3 ausgegeben.

Eigene Konfigurationen
----------------------

Im unteren Bereich Ihres Exporterscripts können Sie nun eigene Funktionen schreiben.
Alle Funktionen aus der **marmCsvExporter.php** können überschrieben und erweitert werden.

Eine nicht vorhandene Spalte hinzufügen, aber wie?

Bsp.: Wir wollen das Attribut **Farbe** der einzelnen Variantenprodukte in die CSV-Datei exportiert haben.

Dazu schreiben wir im `header` den neuen Spaltennamen `Farbe`. In das Feld `fields` kommt ein neuer Marker namens `#color#`.
Diesen Marker müssen wir nun dynamisch befüllen. Marker werden in der Funktion `getDataByMarker($marker)` definiert, diese müssen wir erweitern.
Hier bekommt der Marker einen eigenen Funktionsaufruf. Danach können wir die eigentliche Funktion in unserem Exporterscript schreiben,
die die Farbe der Produkte ausliest. Als Beispiel sehen Sie sich Die Funktion `getSeoUrl()` in den mitgelieferten Exportern,
von geizhals oder google.