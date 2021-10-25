<?php

/*
 * This file is part of the "headless" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 *
 * (c) 2020
 */

declare(strict_types=1);

namespace GoWest\GowestContentelements\Xclass;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * ContentUtility
 *
 * This class group elements by column position, for easier frontend rendering.
 */
class ContentUtility extends \FriendsOfTYPO3\Headless\Utility\ContentUtility
{
    /**
     * This method takes whole content as JSON string, breaks it per element, and pass to groupContentElementByColPos method to group content by colPos.
     *
     * @param $content
     * @param array $configuration
     * @return string|null
     */
    public function groupContent($content, array $configuration): string
    {
        if($configuration['10.']['slide']) {
            $contentData = $this->getSlideContentByColumns($content, $configuration);
        } else {
            $contents = $this->cObj->cObjGetSingle($configuration['10'], $configuration['10.']);
            $contentData = array_map('trim', (array_slice(explode('###BREAK###', $contents), 0, -1)));
        }
        
        return json_encode($contentData);
    }

    protected function getSlideContentByColumns($content, array $configuration) {
        
        $configurationCopy = $configuration;
        $configurationCopy['10.']['slide.'] = [
            'collect' => $configurationCopy['10.']['slide'],
            'selectFields' => 'uid,colPos',
        ];
        $allContents = $this->cObj->cObjGetSingle($configurationCopy['10'], $configurationCopy['10.']);
        $allContentData = array_map('trim', (array_slice(explode('###BREAK###', $allContents), 0, -1)));
        $allContentData = $this->groupContentElementsByColPos($allContentData);

        $contents = $this->cObj->cObjGetSingle($configuration['10'], $configuration['10.']);
        $contentData = array_map('trim', (array_slice(explode('###BREAK###', $contents), 0, -1)));
        $contentData = $this->groupContentElementsByColPos($contentData);

        if(count($allContentData) != count($contentData)) {
            foreach($allContentData as $colKey => $contentElements) {
                if(!isset($contentData[$colKey]) && $colKey != 'colPos') {
                    #where = {#colPos}=0
                    $curCol = $contentElements[0]->colPos;
                    $configuration['10.']['select.']['where'] = '{#colPos}=' . $curCol;
                    $colContents = $this->cObj->cObjGetSingle($configuration['10'], $configuration['10.']);
                    $colContentData = array_map('trim', (array_slice(explode('###BREAK###', $colContents), 0, -1)));
                    $colContentData = $this->groupContentElementsByColPos($colContentData);
                    $contentData[$colKey] = $colContentData[$colKey];
                }
            }
        }
        return $contentData;
    }
    
}
