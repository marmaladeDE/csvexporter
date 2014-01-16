CSV Exporter
============

collection of a scripts, Export via cronjob your Shop products in a csv file

Installing and Configuration
----------------------------
1.  Place the entire module in your shop in

          modules / marm / csvexporter

2.  Configure, upgrade , or writing new Exporter

3.  Call your export script via cronjob

4.  Enjoy the result


Notes
-----

Tested on Oxid CE 4.6.5

version
-------
Current Version 1.0


Exporter Configuration
======================

basic configurations
--------------------

in the protected variable `$ _config`

        'export_parents'                => Should parents be shown in file
        'filename'                      => Export filename relative to this file
        'limit'                         => limit for export
        'debug'                         => enable / disable debug-output
        'silent'                        => enable / disable regular messages
        'header'                        => enable / disable headerline
        'langid'                        => LanguageId for which you want to export
        'shippingcost'                  => shipping cost categories
        'productLinkPrefix'             => standard product url prefix
        'geizhalsProductLinkParameters' => geizhals parameters for product
        'imageurl'                      => standard image url path
        'inStock'                       => product in stock description
        'outOfStock'                    => product out of stock description
        'cutFirstPosArticlenumber'      => cut the first n position from the article number
        'generalVat'                    => general vat value for net prices
        'netPrices'                     => net prices true/false
        'categoryPathSeparator'         => category path separator

CSV configurations
------------------

in the protected variable `$ _Entry` you creat the structure of the csv file

`header` here the column names are written after the other.

Individual column name with `;` separately.

if you need a blank line between the header and the data records, write `\n` in the last column name.

`fields` here are written contents of the column.

Individual records are written to `#oxid#`  and separated by `|`.

`#oxid#+#oxtitle#` so will be displayed more conten  in a column.

`#oxshortdesc#/#oxlongdesc#` then the second output if the first is not available.

`separator` here the delimiter for the csv file is entered.

various data feeds need different requirements to be able to read the csv file to which with the separator structure, the rows and columns will be defined.

own configurations
------------------

can be seen in the individual Exportern all functions from the marmCsvExporter.php override and extend.

A non existent Extra column to add, but how?

as example: we want the attribute color of the individual variants product

in the protected variable `$ _Entry`

- In `header`, we write the new column name `color`.

- In `fields` comes a new marker `#color#`.

- Now has the `getDataByMarker($marker)` from the marmCsvExporter.php be extended in our exporter to a marker.

- The new marker we give a new function.

- And finally we actually function in our exporter written reads out the color of the variants products and passes the marker.


