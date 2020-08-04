<?php

namespace GoWest\GowestContentelements\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

class UspController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * Index action for this controller.
     *
     * @return void
    */
    public function indexAction() {

        $json['cols'] = $this->settings['cols'];
        $usps = $this->settings['usps'];
        $resourceFactory = \TYPO3\CMS\Core\Resource\ResourceFactory::getInstance();
        $counter = 0;
        foreach($usps as $k=>$v) {
            if($usps[$k]['uspconfiguration']) {
                if($usps[$k]['uspconfiguration']['image']) {
                    $json['usps'][$counter]['image']['url'] = \TYPO3\CMS\Core\Utility\GeneralUtility::locationHeaderUrl( '/' ) . $resourceFactory->getFileObject($usps[$k]['uspconfiguration']['image'])->getPublicUrl();
                    $json['usps'][$counter]['image']['name'] = $resourceFactory->getFileObject($usps[$k]['uspconfiguration']['image'])->getName();
                }
                $json['usps'][$counter]['title'] = $usps[$k]['uspconfiguration']['title'];
                $json['usps'][$counter]['description'] = $usps[$k]['uspconfiguration']['description'];

                if(strpos($usps[$k]['uspconfiguration']['link'], 't3://page?uid=') !== false) {
                    $pos = strpos($usps[$k]['uspconfiguration']['link'], 'uid=');
                    $pid = substr($usps[$k]['uspconfiguration']['link'], $pos+4);
                    $link = $this->uriBuilder
                    ->reset()
                    ->setTargetPageUid($pid)
                    ->build();
                    $uri = \TYPO3\CMS\Core\Utility\GeneralUtility::locationHeaderUrl($link);
                    $json['usps'][$counter]['link'] = $uri;

                    
                } else {
                    $json['usps'][$counter]['link'] = $usps[$k]['uspconfiguration']['link'];
                }
               
                $counter++;
            }
        }
        
        $json = json_encode($json, JSON_FORCE_OBJECT);

        return $json;
    }
}