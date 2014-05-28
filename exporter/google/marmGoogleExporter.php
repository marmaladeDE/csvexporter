<?php

/**
 * This file is part of csvexporter Module for OXID eShop CE/PE/EE.
 *
 * csvexporter is free software: you can redistribute it and/or modify
 * it under the terms of the MIT License.
 *
 *
 * @link http://marmalade.de
 * @copyright (C) marmalade.de 2014
 */

//Set some helpful power ;-)
error_reporting(E_ALL);
set_time_limit(0);
ini_set("memory_limit", "1024M");

include '../../core/marmCsvExporter.php';

class marmGoogleExporter extends marmCsvExporter
{
    /**
     * Configuration
     */
    protected $_config = array(
        'export_parents'                => 0,               // Should parents be shown in file !!!not available
        'filename'                      => '../../../../../export/ggex-6b66d82af984e5ad46b9cb27b1ef8aae.txt', // Export filename relative to this file
//        'filename'                      => '../../../../../export/google.txt', // Export filename relative to this file
//        'filename'                      => '../google.txt', // Export filename relative to this file (for local test)
        'limit'                         => 500,             // limit for export !!!not available
        'debug'                         => false,           // enable / disable debug-output
        'silent'                        => false,            // enable / disable regular messages
        'header'                        => true,            // enable / disable headerline
        'langid'                        => 0,               // LanguageId for which you want to export
        'shippingcost'                  => array(           //shipping cost categories
                                            array('from' => 0 ,  'cost' => 6),
                                            array('from' => 20 , 'cost' => 2),
                                            array('from' => 50 , 'cost' => 0)
                                            ),
        'shippingcost_at'                  => array(           //shipping cost categories
                                            array('from' => 0 ,  'cost' => 14.90),
                                            array('from' => 20 , 'cost' => 9.90),
                                            array('from' => 50 , 'cost' => 4.90)
                                            ),/**/
        'productLinkPrefix'             => '/index.php?cl=details&anid=',       //standard product url prefix
        'googleProductLinkParameters'   => 'utm_source=google&utm_medium=mc&utm_campaign=gshopping', //google parameters for product        
        'imageurl'                      => '/out/pictures/generated/product/1/290_290_95/', //standard image url path
        'condition'                     => 'neu',                               //condition always new product
        'inStock'                       => 'auf Lager',                         //product in stock description
        'outOfStock'                    => 'nicht auf Lager',                   //product out of stock description       
        'cutFirstPosArticlenumber'      => 0,                                   // cut the first n position from the article number
        'generalVat'                    => 19,                                  // general vat value for net prices
        'netPrices'                     => true,                                // net prices true/false
        'categoryPathSeparator'         => '>');                                // category path separator

    protected $_entry = array(
        //'header'    => "ID;Titel;Beschreibung;Produkttyp;Google Produktkategorie;Link;Bildlink;Zustand;Verfügbarkeit;Preis;Marke;GTIN;MPN;Versand",
        'header'    => "ID;Titel;Beschreibung;Google Produktkategorie;Produkttyp;Link;Bildlink;Zustand;Verfügbarkeit;Preis;Marke;GTIN;MPN;Versand;Grundpreis Maß;Grundpreis Einheitsmaß",
        'fields'    => '#oxartnum#|#oxtitle#+#oxvarselect#|#oxlongdesc#|#google_categoryPath#|#categoryPath#|#seo_url_parent#|#imagelink#|#condition#|#availability#|#oxprice#|#brand#|#oxdistean#/#oxean#|#mpn#|#shippingcost#|#unitpricingmeasure#|#unitpricingbasemeasure#',
        //'fields'    => '#oxean#/#mpn#/#ERROR#|#oxtitle#+#oxvarselect#|#oxshortdesc#/#oxlongdesc#|#categoryPath#|#google_categoryPath#|#seo_url_parent#|#imagelink#|#condition#|#availability#|#oxprice#|#brand#|#oxdistean#/#oxean#|#mpn#|#shippingcost#',
        'separator' => '~'
    );
    
    /**
     * google specific
     * Calls the method from marmCsvExporter and replaces the value
     * @return string
     */
    public function getShippingcost($sCountryId = 'de')
    {
        //$shippingcost = parent::getShippingcost($sCountryId);
        //$shippingcost = 'DE:::'.$shippingcost;
        //$shippingcost = parent::getShippingcost('de');
        $shippingcost = 'DE:::'.parent::getShippingcost('de');
        $shippingcost .= ',';
        //$shippingcost .= parent::getShippingcost('at');
        $shippingcost .= 'AT:::'.parent::getShippingcost('at');
        
        return $shippingcost;
    }

    /**
     * google specific
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
        
        if (isset($this->_config['googleProductLinkParameters']))
        {
            $pos = strpos($sUrl, '?');
            
            if ($pos === false)
            {
                $sUrl .= '?'.$this->_config['googleProductLinkParameters'];
            }
            else
            {
                $sUrl .= '&'.$this->_config['googleProductLinkParameters'];
            }
        }
        
        return $sUrl;
    }    
    
}
$marmGoogleExporter = new marmGoogleExporter();
$marmGoogleExporter->start_export();