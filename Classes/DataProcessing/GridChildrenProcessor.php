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

use GridElementsTeam\Gridelements\Backend\LayoutSetup;
use GridElementsTeam\Gridelements\Plugin\Gridelements;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentDataProcessor;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * Fetch records from the database, using the default .select syntax from TypoScript.
 */
class GridChildrenProcessor extends \GridElementsTeam\Gridelements\DataProcessing\GridChildrenProcessor
{

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\Extbase\\Object\\ObjectManager');
        $configurationManager = $objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');
        $this->extbaseFrameworkConfiguration = $configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
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
    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ) {
        return parent::process(
            $cObj,
            $contentObjectConfiguration,
            $processorConfiguration,
            $processedData
        );
    }

    /**
     * Processes child records recursively to get other children into the same array
     *
     * @param $record
     */
    protected function processChildRecord($record)
    {
        parent::processChildRecord($record);

        $id = (int)$record['uid'];
        $this->checkOptions($record, true);
        /* @var $recordContentObjectRenderer ContentObjectRenderer */
        $recordContentObjectRenderer = GeneralUtility::makeInstance(ContentObjectRenderer::class);
        $recordContentObjectRenderer->start($record, 'tt_content');
        $this->processedRecordVariables[$id] = ['data' => $record];
        if (
            (int)$this->options['recursive'] > 0 &&
            $record['CType'] === 'gridelements_pi1' &&
            !empty($record['tx_gridelements_backend_layout'])
        ) {
        } else {

            $processedRecordVariablesBase =  $this->processedRecordVariables[$id];

            if (
                isset($this->extbaseFrameworkConfiguration['tt_content.'][$record['CType']])
                && is_array($this->extbaseFrameworkConfiguration['tt_content.'][$record['CType'] . '.'])
            ) {
                $this->processedRecordVariables[$id] = [
                    'data' => json_decode($recordContentObjectRenderer->cObjGetSingle(
                        $this->extbaseFrameworkConfiguration['tt_content.'][$record['CType']],
                        $this->extbaseFrameworkConfiguration['tt_content.'][$record['CType'] . '.']
                    ), TRUE),
                ];

                $this->processedRecordVariables[$id]['data']['tx_gridelements_columns'] = $processedRecordVariablesBase['data']['tx_gridelements_columns'];
            }
        }
    }


    /**
     * @return array
     */
    protected function sortRecordsIntoMatrix()
    {
        $processedColumns = [];
        foreach ($this->processedRecordVariables as $key => $processedRecord) {
            if (!isset($processedColumns[$processedRecord['data']['tx_gridelements_columns']])) {
                $processedColumns[$processedRecord['data']['tx_gridelements_columns']] = [];
            }
            $processedColumns[$processedRecord['data']['tx_gridelements_columns']][$key] = $processedRecord['data'];
        }
        if ($this->options['respectRows']) {
            $this->options['respectColumns'] = 1;
            $processedRows = [];
            if (!empty($this->processedData['data']['tx_gridelements_backend_layout_resolved'])) {
                foreach ($this->processedData['data']['tx_gridelements_backend_layout_resolved']['config']['rows.'] as $rowNumber => $row) {
                    foreach ($row['columns.'] as $column) {
                        $key = substr($rowNumber, 0, -1);
                        $processedRows[$key][$column['colPos']] = array_values($processedColumns[$column['colPos']]);
                    }
                }
            }
            return $processedRows;
        }
        return $processedColumns;
    }
}
