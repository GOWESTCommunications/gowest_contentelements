<?php
defined('TYPO3_MODE') or die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'GoWest.gowest_contentelements',
    'Smartsearch',
    'Smart-Search (GO.WEST Contentelements)'
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['gowestcontentelements_smartsearch'] = 'layout,select_key,pages,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['gowestcontentelements_smartsearch'] = 'pi_flexform,recursive';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('gowestcontentelements_smartsearch', 'FILE:EXT:' . 'gowest_contentelements' . '/Configuration/FlexForms/Flexform_smartsearch.xml');
