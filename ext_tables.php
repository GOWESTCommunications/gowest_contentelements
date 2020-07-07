<?php
if(!defined('TYPO3_MODE')) die('Access denied.');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'gowest_contentelements',
    'Contentelements',
    'GO.WEST Contentelements'
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['gowestcontentelements_contentelements'] = 'layout,select_key,pages,recursive'; 
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['gowestcontentelements_contentelements'] = 'pi_flexform';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'gowestcontentelements_contentelements',
    'FILE:EXT:gowest_contentelements/Configuration/FlexForms/FlexForm.xml'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('gowest_contentelements', 'Configuration/TypoScript', 'GO.WEST Contentelements');