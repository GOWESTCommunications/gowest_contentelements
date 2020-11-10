<?php

namespace GoWest\GowestContentelements\Controller;

class LegaldisclosureController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * Index action for this controller.
     *
     * @return void
    */
    public function indexAction() {
        $resourceFactory = \TYPO3\CMS\Core\Resource\ResourceFactory::getInstance();

        //Address Sheet
        $json['company'] = $this->settings['company'];
        $json['companySub'] = $this->settings['companySub'];
        $json['street'] = $this->settings['street'];
        $json['zip'] = $this->settings['zip'];
        $json['city'] = $this->settings['city'];
        $json['country'] = $this->settings['country'];
        $json['email'] = $this->settings['email'];
        $json['phone'] = $this->settings['phone'];
        $json['fax'] = $this->settings['fax'];

        $additionalFieldAddress = $this->settings['additionalFieldAddress'];
        
        $counterAddress = 0;
        foreach($additionalFieldAddress as $k=>$v) {
            if($additionalFieldAddress[$k]['container']) {
                $json['additionalFieldAddress'][$counterAddress]['labelAddress'] = $additionalFieldAddress[$k]['container']['labelAddress'];
                $json['additionalFieldAddress'][$counterAddress]['valueAddress'] = $additionalFieldAddress[$k]['container']['valueAddress'];
               
                $counterAddress++;
            }
        }
        
        //Company Sheet
        $json['manager'] = $this->settings['manager'];
        $json['registerNumber'] = $this->settings['registerNumber'];
        $json['jurisdictionCourt'] = $this->settings['jurisdictionCourt'];
        $json['authority'] = $this->settings['authority'];
        $json['enterpriseObjective'] = $this->settings['enterpriseObjective'];
        $json['uid'] = $this->settings['uid'];

        $additionalFieldCompany = $this->settings['additionalFieldCompany'];
        $counterCompany = 0;
        foreach($additionalFieldCompany as $k=>$v) {
            if($additionalFieldCompany[$k]['container']) {
                $json['additionalFieldCompany'][$counterCompany]['labelCompany'] = $additionalFieldCompany[$k]['container']['labelCompany'];
                $json['additionalFieldCompany'][$counterCompany]['valueCompany'] = $additionalFieldCompany[$k]['container']['valueCompany'];
               
                $counterCompany++;
            }
        }

        //Bank Sheet
        $bank = $this->settings['bankSheet'];
        $counterBank = 0;
        foreach($bank as $k=>$v) {
            if($bank[$k]['container']) {
                $json['bank'][$counterBank]['bankName'] = $bank[$k]['container']['bankName'];
                $json['bank'][$counterBank]['iban'] = $bank[$k]['container']['iban'];
                $json['bank'][$counterBank]['bic'] = $bank[$k]['container']['bic'];
               
                $counterBank++;
            }
        }

        //Image Licensing Sheet
        $imageLicensing = $this->settings['imageLicensing'];
        $counterImageLicensing = 0;
        foreach($imageLicensing as $k=>$v) {
            if($imageLicensing[$k]['container']) {
                $json['imageLicensing'][$counterImageLicensing]['imageCreditsTitle'] = $imageLicensing[$k]['container']['imageCreditsTitle'];
                if(strpos($imageLicensing[$k]['container']['imageCredits'], 't3://page?uid=') !== false) {
                    $pos = strpos($imageLicensing[$k]['container']['imageCredits'], 'uid=');
                    $pid = substr($imageLicensing[$k]['container']['imageCredits'], $pos+4);
                    $link = $this->uriBuilder
                    ->reset()
                    ->setTargetPageUid($pid)
                    ->build();
                    //$uri = \TYPO3\CMS\Core\Utility\GeneralUtility::locationHeaderUrl($link);
                    $json['imageLicensing'][$counterImageLicensing]['imageCredits'] = $link; 
                } else {
                    $json['imageLicensing'][$counterImageLicensing]['imageCredits'] = $imageLicensing[$k]['container']['imageCredits'];
                }
               
                $counterImageLicensing++;
            }
        }

        //AGB Sheet
        
        $agbs = $this->settings['agbs'];
        $counterAgbs = 0;
        foreach($agbs as $k=>$v) {
            if($agbs[$k]['container']) {
                if(strpos($agbs[$k]['container']['agb'], 't3://page?uid=') !== false) {
                    $pos = strpos($agbs[$k]['container']['agb'], 'uid=');
                    $pid = substr($agbs[$k]['container']['agb'], $pos+4);
                    $link = $this->uriBuilder
                    ->reset()
                    ->setTargetPageUid($pid)
                    ->build();
                    //$uri = \TYPO3\CMS\Core\Utility\GeneralUtility::locationHeaderUrl($link);
                    $json['agbs'][$counterAgbs]['agb'] = $link; 
                } else {
                    $json['agbs'][$counterAgbs]['agb'] = $agbs[$k]['container']['agb'];
                }
                
                $counterAgbs++;
            }
        }

        //Link Comission Sheet
        $json['linkcomission'] = $this->settings['showLink'];

        //Realization Sheet
        $json['realizationWebdesign'] = $this->settings['realizationWebdesign'];
        $json['realizationWebconcept'] = $this->settings['realizationWebconcept'];
        $json['realizationWebtech'] = $this->settings['realizationWebtech'];
        $json['realizationWebcontent'] = $this->settings['realizationWebcontent'];
        $json['realizationWebeditorial'] = $this->settings['realizationWebeditorial'];
        $json['realizationWebseo'] = $this->settings['realizationWebseo'];
        
        $json = json_encode($json, JSON_FORCE_OBJECT);

        return $json;
    }
}