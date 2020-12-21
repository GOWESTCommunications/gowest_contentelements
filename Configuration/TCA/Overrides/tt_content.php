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

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'GoWest.gowest_contentelements',
    'Smartsearch',
    'Smart-Search (GO.WEST Contentelements)'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'GoWest.gowest_contentelements',
    'LegalDisclosure',
    'Legal Disclosure (GO.WEST Contentelements)'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'GoWest.gowest_contentelements',
    'CsvTables',
    'CSV Tables (GO.WEST Contentelements)'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'GoWest.gowest_contentelements',
    'Kennzahlen',
    'Kennzahlen (GO.WEST Contentelements)'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'GoWest.gowest_contentelements',
    'AnchorNavigation',
    'Anchor Navigation (GO.WEST Contentelements)'
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['gowestcontentelements_mediaimage'] = 'layout,select_key,pages,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['gowestcontentelements_mediaimage'] = 'pi_flexform,recursive';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('gowestcontentelements_mediaimage', 'FILE:EXT:' . 'gowest_contentelements' . '/Configuration/FlexForms/Flexform_mediaimage.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['gowestcontentelements_mediavideo'] = 'layout,select_key,pages,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['gowestcontentelements_mediavideo'] = 'pi_flexform,recursive';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('gowestcontentelements_mediavideo', 'FILE:EXT:' . 'gowest_contentelements' . '/Configuration/FlexForms/Flexform_mediavideo.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['gowestcontentelements_landingpagemediaimage'] = 'layout,select_key,pages,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['gowestcontentelements_landingpagemediaimage'] = 'pi_flexform,recursive';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('gowestcontentelements_landingpagemediaimage', 'FILE:EXT:' . 'gowest_contentelements' . '/Configuration/FlexForms/Flexform_landingpagemediaimage.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['gowestcontentelements_uspteaser'] = 'layout,select_key,pages,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['gowestcontentelements_uspteaser'] = 'pi_flexform,recursive';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('gowestcontentelements_uspteaser', 'FILE:EXT:' . 'gowest_contentelements' . '/Configuration/FlexForms/Flexform_uspteaser.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['gowestcontentelements_imagetext'] = 'layout,select_key,pages,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['gowestcontentelements_imagetext'] = 'pi_flexform,recursive';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('gowestcontentelements_imagetext', 'FILE:EXT:' . 'gowest_contentelements' . '/Configuration/FlexForms/Flexform_imagetext.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['gowestcontentelements_htmlvideo'] = 'layout,select_key,pages,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['gowestcontentelements_htmlvideo'] = 'pi_flexform,recursive';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('gowestcontentelements_htmlvideo', 'FILE:EXT:' . 'gowest_contentelements' . '/Configuration/FlexForms/Flexform_htmlvideo.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['gowestcontentelements_iframevideo'] = 'layout,select_key,pages,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['gowestcontentelements_iframevideo'] = 'pi_flexform,recursive';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('gowestcontentelements_iframevideo', 'FILE:EXT:' . 'gowest_contentelements' . '/Configuration/FlexForms/Flexform_iframevideo.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['gowestcontentelements_quote'] = 'layout,select_key,pages,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['gowestcontentelements_quote'] = 'pi_flexform,recursive';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('gowestcontentelements_quote', 'FILE:EXT:' . 'gowest_contentelements' . '/Configuration/FlexForms/Flexform_quote.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['gowestcontentelements_smartsearch'] = 'layout,select_key,pages,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['gowestcontentelements_smartsearch'] = 'pi_flexform,recursive';

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['gowestcontentelements_legaldisclosure'] = 'layout,select_key,pages,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['gowestcontentelements_legaldisclosure'] = 'pi_flexform,recursive';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('gowestcontentelements_legaldisclosure', 'FILE:EXT:' . 'gowest_contentelements' . '/Configuration/FlexForms/Flexform_legaldisclosure.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['gowestcontentelements_csvtables'] = 'layout,select_key,pages,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['gowestcontentelements_csvtables'] = 'pi_flexform,recursive';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('gowestcontentelements_csvtables', 'FILE:EXT:' . 'gowest_contentelements' . '/Configuration/FlexForms/Flexform_csvtables.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['gowestcontentelements_kennzahlen'] = 'layout,select_key,pages,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['gowestcontentelements_kennzahlen'] = 'pi_flexform,recursive';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('gowestcontentelements_kennzahlen', 'FILE:EXT:' . 'gowest_contentelements' . '/Configuration/FlexForms/Flexform_kennzahlen.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['gowestcontentelements_anchornavigation'] = 'layout,select_key,pages,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['gowestcontentelements_anchornavigation'] = 'pi_flexform,recursive';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('gowestcontentelements_anchornavigation', 'FILE:EXT:' . 'gowest_contentelements' . '/Configuration/FlexForms/Flexform_anchornavigation.xml');

