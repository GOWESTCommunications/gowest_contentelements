<?php
defined('TYPO3_MODE') or die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'GoWest.gowest_contentelements',
    'Mediaimage',
    'mediaImage (GO.WEST Contentelements)'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'GoWest.gowest_contentelements',
    'Mediavideo',
    'mediaVideo (GO.WEST Contentelements)'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'GoWest.gowest_contentelements',
    'Landingpagemediaimage',
    'Landingpage MediaImage (GO.WEST Contentelements)'
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['gowestcontentelements_mediaimage'] = 'select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['gowestcontentelements_mediaimage'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('gowestcontentelements_mediaimage', 'FILE:EXT:' . 'gowest_contentelements' . '/Configuration/FlexForms/Flexform_mediaimage.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['gowestcontentelements_mediavideo'] = 'select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['gowestcontentelements_mediavideo'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('gowestcontentelements_mediavideo', 'FILE:EXT:' . 'gowest_contentelements' . '/Configuration/FlexForms/Flexform_mediavideo.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['gowestcontentelements_landingpagemediaimage'] = 'select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['gowestcontentelements_landingpagemediaimage'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('gowestcontentelements_landingpagemediaimage', 'FILE:EXT:' . 'gowest_contentelements' . '/Configuration/FlexForms/Flexform_landingpagemediaimage.xml');