<?php
/**
 * This file is NOT freeware and could not be redistributed.
 * You could buy additional licences at http://marmalade.de/shop/
 * 
 * @link      http://www.marmalade.de
 * @copyright (C) marmalade GmbH | Joscha Krug
 * @author Michael Wille <wille@marmalade.de>
 */

//Set some helpful power ;-)
error_reporting(E_ALL);
set_time_limit(0);
ini_set("memory_limit", "1024M");

include '../../core/marmCsvExporter.php';

class marmGeizhalsExporter extends marmCsvExporter
{
    /**
     * Configuration
     */
    protected $_config = array(
        'export_parents'                => 0,               // Should parents be shown in file (not available !!!)
        'filename'                      => '../../../../../export/geizhals.txt', // Export filename relative to this file
//        'filename'                      => '../geizhals.txt', // Export filename relative to this file (for local test)
        'limit'                         => 500,             // limit for export (not available !!!)
        'debug'                         => false,           // enable / disable debug-output
        'silent'                        => true,            // enable / disable regular messages
        'header'                        => true,            // enable / disable headerline
        'langid'                        => 0,               // LanguageId for which you want to export
        'shippingcost'                  => array(           // shipping cost categories
                                            array('from' => 0 , 'cost' => 6),
                                            array('from' => 20 , 'cost' => 2),
                                            array('from' => 50 , 'cost' => 0)
                                            ),      
        'productLinkPrefix'             => '/index.php?cl=details&anid=',       //standard product url prefix
        'geizhalsProductLinkParameters' => 'utm_source=geizhals&utm_medium=csvex&utm_campaign=geizhals', //geizhals parameters for product        
        'imageurl'                      => '/out/pictures/generated/product/1/290_290_95/', //standard image url path
        'inStock'                       => 'auf Lager',                         //product in stock description
        'outOfStock'                    => 'in Kürze wieder lieferbar',        //product out of stock description       
        'cutFirstPosArticlenumber'      => 3,                                   // cut the first n position from the article number
        'generalVat'                    => 19,                                  // general vat value for net prices
        'netPrices'                     => true,                                // net prices true/false
        'categoryPathSeparator'         => '>');                                // category path separator
	

    protected $_entry = array(
        'header'    => "Bezeichnung;Hersteller;Herst.Nr.;Preis;Verfügbarkeit;VersandDE;EAN;Deeplink;Artikelnummer;Beschreibung;Kategorie;Bildlink",
        'fields'    => '#brand#+#oxtitle#+#oxvarselect#|#brand#|#mpn#|#oxprice#|#availability#|#shippingcost#|#oxdistean#|#seo_url_parent#|#oxid#/#mpn#/#ERROR#|#oxshortdesc#/#oxlongdesc#|#categoryPath#|#imagelink#',
        'separator' => '~'
    );
    
    /**
     * geizhals specific
     * Calls the method from marmCsvExporter and replaces the value
     * 
     * get seo url
     * 
     * @param boolean only parent
     * @return string
     */ 
    public function getSeoUrl($onlyParent = false)
    {
        $sUrl = parent::getSeoUrl($onlyParent);
        
        if (isset($this->_config['geizhalsProductLinkParameters']))
        {
            $pos = strpos($sUrl, '?');
            
            if ($pos === false)
            {
                $sUrl .= '?'.$this->_config['geizhalsProductLinkParameters'];
            }
            else
            {
                $sUrl .= '&'.$this->_config['geizhalsProductLinkParameters'];
            }
        }
        
        return $sUrl;
    }    
    
}
$marmGeizhalsExporter = new marmGeizhalsExporter();
$marmGeizhalsExporter->start_export();