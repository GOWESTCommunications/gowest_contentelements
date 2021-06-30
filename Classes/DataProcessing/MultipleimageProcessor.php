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
        $sectionName = isset($processorConfiguration['sectionName']) ? $processorConfiguration['sectionName'] : 'items';
        $imageFields = isset($processorConfiguration['imageFields']) ? explode(',', $processorConfiguration['imageFields']) : ['image'];
        
        foreach($processedData['flexform_rendered']['settings'][$sectionName] as $key=>$value) {
            foreach($processedData['flexform_rendered']['settings'][$sectionName][$key] as $k=>$v) {
                foreach($imageFields as $imageField) {
                    $imageIds = explode(',', $processedData['flexform_rendered']['settings'][$sectionName][$key][$k][$imageField]);
                    foreach($imageIds as $imgId) {
                        if(is_numeric($imgId)) {
                            $imageObj = $resourceFactory->getFileObject((int)$imgId);
                            $image = [
                                'url' => $imageObj->getPublicUrl(),
                                'name' => $imageObj->getName()
                            ];
                            if(!is_array($processedData['flexform_rendered']['settings'][$sectionName][$key][$k][$imageField])) {
                                $processedData['flexform_rendered']['settings'][$sectionName][$key][$k][$imageField] = [];
                            }
                            $processedData['flexform_rendered']['settings'][$sectionName][$key][$k][$imageField][] = $image;
                        }
                    }
                }
            }
        }
        return $processedData;
    }
}
