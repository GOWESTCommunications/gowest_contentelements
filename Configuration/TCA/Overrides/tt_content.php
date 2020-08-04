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

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'GoWest.gowest_contentelements',
    'UspTeaser',
    'USP-Teaser (GO.WEST Contentelements)'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'GoWest.gowest_contentelements',
    'Imagetext',
    'Image-Text (GO.WEST Contentelements)'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'GoWest.gowest_contentelements',
    'Htmlvideo',
    'HTML5 Video (GO.WEST Contentelements)'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'GoWest.gowest_contentelements',
    'Iframevideo',
    'Iframe Video (Youtube/Vimeo) (GO.WEST Contentelements)'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'GoWest.gowest_contentelements',
    'Quote',
    'Quote (GO.WEST Contentelements)'
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['gowestcontentelements_mediaimage'] = 'select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['gowestcontentelements_mediaimage'] = 'pi_flexform,recursive';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('gowestcontentelements_mediaimage', 'FILE:EXT:' . 'gowest_contentelements' . '/Configuration/FlexForms/Flexform_mediaimage.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['gowestcontentelements_mediavideo'] = 'select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['gowestcontentelements_mediavideo'] = 'pi_flexform,recursive';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('gowestcontentelements_mediavideo', 'FILE:EXT:' . 'gowest_contentelements' . '/Configuration/FlexForms/Flexform_mediavideo.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['gowestcontentelements_landingpagemediaimage'] = 'select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['gowestcontentelements_landingpagemediaimage'] = 'pi_flexform,recursive';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('gowestcontentelements_landingpagemediaimage', 'FILE:EXT:' . 'gowest_contentelements' . '/Configuration/FlexForms/Flexform_landingpagemediaimage.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['gowestcontentelements_uspteaser'] = 'select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['gowestcontentelements_uspteaser'] = 'pi_flexform,recursive';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('gowestcontentelements_uspteaser', 'FILE:EXT:' . 'gowest_contentelements' . '/Configuration/FlexForms/Flexform_uspteaser.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['gowestcontentelements_imagetext'] = 'select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['gowestcontentelements_imagetext'] = 'pi_flexform,recursive';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('gowestcontentelements_imagetext', 'FILE:EXT:' . 'gowest_contentelements' . '/Configuration/FlexForms/Flexform_imagetext.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['gowestcontentelements_htmlvideo'] = 'select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['gowestcontentelements_htmlvideo'] = 'pi_flexform,recursive';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('gowestcontentelements_htmlvideo', 'FILE:EXT:' . 'gowest_contentelements' . '/Configuration/FlexForms/Flexform_htmlvideo.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['gowestcontentelements_iframevideo'] = 'select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['gowestcontentelements_iframevideo'] = 'pi_flexform,recursive';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('gowestcontentelements_iframevideo', 'FILE:EXT:' . 'gowest_contentelements' . '/Configuration/FlexForms/Flexform_iframevideo.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['gowestcontentelements_quote'] = 'select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['gowestcontentelements_quote'] = 'pi_flexform,recursive';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('gowestcontentelements_quote', 'FILE:EXT:' . 'gowest_contentelements' . '/Configuration/FlexForms/Flexform_quote.xml');