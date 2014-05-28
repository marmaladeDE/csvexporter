<?php

/**
 * This file is part of csvexporter Module for OXID eShop CE/PE/EE.
 *
 * csvexporter is free software: you can redistribute it and/or modify
 * it under the terms of the MIT License.
 *
 *
 * @link https://github.com/job963
 * @copyright (C) Joachim Barthel 2014
 * 
 */

//Set some helpful power ;-)
error_reporting(E_ALL);
set_time_limit(0);
ini_set("memory_limit", "1024M");

include '../../core/marmCsvExporter.php';

class marmPreisroboterExporter extends marmCsvExporter
{
    /**
     * Configuration
     */
    protected $_config = array(
        'export_parents'                => 0,               // Should parents be shown in file (not available !!!)
        'filename'                      => '../../../../../export/prex-05848170643ab0deb9914566391c0c63.txt',  // Export filename relative to this file
//        'filename'                      => '../preisroboter.txt', // Export filename relative to this file (for local test)
        'limit'                         => 500,             // limit for export (not available !!!)
        'debug'                         => false,           // enable / disable debug-output
        'silent'                        => false,            // enable / disable regular messages
        'header'                        => true,            // enable / disable headerline
        'langid'                        => 0,               // LanguageId for which you want to export
        'shippingcost'                  => array(           // shipping cost categories
                                            array('from' => 0 , 'cost' => 4.9),
                                            array('from' => 100 , 'cost' => 0)
                                            ),      
        'productLinkPrefix'             => '/index.php?cl=details&anid=',       //standard product url prefix
        //'preisroboterProductLinkParameters' => 'utm_source=preisroboter&utm_medium=csvex&utm_campaign=preisroboter', //preisroboter parameters for product        
        'preisroboterProductLinkParameters' => '&pk_campaign=preisroboter&pk_kwd=csvexp', // Piwik Campaign, Keyword = CSV Export
        'imageurl'                      => '/out/pictures/master/product/1/', 	//standard image url path
        'inStock'                       => 'auf Lager',                         //product in stock description
        'outOfStock'                    => 'in Kürze wieder lieferbar',        	//product out of stock description       
        'cutFirstPosArticlenumber'      => 0,                                   // cut the first n position from the article number
        'generalVat'                    => 19,                                  // general vat value for net prices
        'netPrices'                     => false,                                // net prices true/false
        'categoryPathSeparator'         => '>');                                // category path separator
	

    protected $_entry = array(
        'header'    => "Artikelnummer;Artikelname;Produktbeschreibung;Preis;Bildlink;Deeplink;Verfügbarkeit;Versandkosten;Hersteller;EAN;Grundpreis;Kategorie;Hersteller.Art.Nr.;PZN;Produktfarbe;Größe;UVP;VE",
        'fields'    => '#oxartnum#|#oxtitle#+#oxvarselect#|#oxlongdesc#|#oxprice#|#imagelink#|#seo_url#|#availability#|#shippingcost#|#brand#|#oxean#|#baseprice#|#categoryPath#|#mpn#| | | |#uvp#| ',
        'separator' => '|'
    );
    
    /**
     * Preisroboter specific
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
        
        if (isset($this->_config['preisroboterProductLinkParameters']))
        {
            $pos = strpos($sUrl, '?');
            
            if ($pos === false)
            {
                $sUrl .= '?'.$this->_config['preisroboterProductLinkParameters'];
            }
            else
            {
                $sUrl .= '&'.$this->_config['preisroboterProductLinkParameters'];
            }
        }
        
        return $sUrl;
    }    
    
}
$marmPreisroboterExporter = new marmPreisroboterExporter();
$marmPreisroboterExporter->start_export();