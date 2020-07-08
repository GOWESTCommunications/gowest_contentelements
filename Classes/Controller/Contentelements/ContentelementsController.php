<?php

declare(strict_types=1);

namespace GOWEST\Contentelements\Controller;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\AbstractContentObject;
use TYPO3\CMS\Frontend\ContentObject\ContentDataProcessor;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

class ContentelementsController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * @param ContentObjectRenderer $cObj
     */
    public function __construct(ContentObjectRenderer $cObj)
    {
        parent::__construct($cObj);
        $this->contentDataProcessor = GeneralUtility::makeInstance(ContentDataProcessor::class);
    }

    /**
     * Rendering the cObject, JSON
     * @param array $conf Array of TypoScript properties
     * @return string The HTML output
     */
    public function render($conf = []): string
    {
        $data = [];

        if (!is_array($conf)) {
            $conf = [];
        }

        if (isset($conf['fields.'])) {
            $data = $this->cObjGet($conf['fields.']);
        }
        if (isset($conf['dataProcessing.'])) {
            $data = $this->processFieldWithDataProcessing($conf);
        }

        //$json = json_encode($this->decodeFieldsIfRequired($data));

        if (isset($conf['renderObj.'])) {
            $json = $this->cObj->stdWrap($json, $conf['renderObj.']);
        }

        return $json;
    }

    public function mediaImage() {
        
    }

    public function mediaVideo() {
        
    }
}