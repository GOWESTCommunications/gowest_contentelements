<?php

namespace GoWest\GowestContentelements\DataProcessing;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;
use TYPO3\CMS\Frontend\Service\TypoLinkCodecService;

/**
 * Fetch records from the database, using the default .select syntax from TypoScript.
 */
class MultipleimageProcessor implements DataProcessorInterface
{

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Fetches records from the database as an array
     *
     * @param ContentObjectRenderer $cObj The data of the content element or page
     * @param array $contentObjectConfiguration The configuration of Content Object
     * @param array $processorConfiguration The configuration of this processor
     * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
     *
     * @return array the processed data as key/value store
     */
    public function process(ContentObjectRenderer $cObj, array $contentObjectConfiguration, array $processorConfiguration, array $processedData)
    {
        $resourceFactory = \TYPO3\CMS\Core\Resource\ResourceFactory::getInstance();

        foreach($processedData['flexform_rendered']['settings']['items'] as $key=>$value) {
            foreach($processedData['flexform_rendered']['settings']['items'][$key]['configuration'] as $k=>$v) {
                if(is_numeric($processedData['flexform_rendered']['settings']['items'][$key]['configuration']['image'])) {
                    $tempimage = $processedData['flexform_rendered']['settings']['items'][$key]['configuration']['image'];
                    $processedData['flexform_rendered']['settings']['items'][$key]['configuration']['image'] = $resourceFactory->getFileObject((int)$processedData['flexform_rendered']['settings']['items'][$key]['configuration']['image'])->getPublicUrl();
                    $processedData['flexform_rendered']['settings']['items'][$key]['configuration']['imagename'] = $resourceFactory->getFileObject($tempimage)->getName();
                }
            }
        }
        return $processedData;
    }
}
