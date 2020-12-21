<?php

namespace GoWest\GowestContentelements\Xclass;

use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Backend\Utility\BackendUtility;

class DataHandler extends \TYPO3\CMS\Core\DataHandling\DataHandler
{

    /**
     * Use columns overrides for evaluation.
     *
     * Fetch the TCA ["config"] part for a specific field, including the columnsOverrides value.
     * Used for checkValue purposes currently (as it takes the checkValue_currentRecord value).
     *
     * @param string $table
     * @param string $field
     * @return array
     */
    protected function resolveFieldConfigurationAndRespectColumnsOverrides(string $table, string $field): array
    {
        $tcaFieldConf = $GLOBALS['TCA'][$table]['columns'][$field]['config'];
        $recordType = BackendUtility::getTCAtypeValue($table, $this->checkValue_currentRecord);
        $columnsOverridesConfigOfField = $GLOBALS['TCA'][$table]['types'][$recordType]['columnsOverrides'][$field]['config'] ?? null;
        if ($columnsOverridesConfigOfField) {
            ArrayUtility::mergeRecursiveWithOverrule($tcaFieldConf, $columnsOverridesConfigOfField);
        }
        if($tcaFieldConf == null) {
            return [];
        }
        return $tcaFieldConf;
    }

}