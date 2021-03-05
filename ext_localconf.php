<?php
if(!defined('TYPO3_MODE')) die ('Access denied.');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'GoWest.gowest_contentelements',
    'MediaImage',
    []
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'GoWest.gowest_contentelements',
    'MediaVideo',
    []
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'GoWest.gowest_contentelements',
    'LandingpageMediaImage',
    []
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'GoWest.gowest_contentelements',
    'UspTeaser',
    ['Usp' => 'index']
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'GoWest.gowest_contentelements',
    'ImageText',
    []
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'GoWest.gowest_contentelements',
    'HtmlVideo',
    []
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'GoWest.gowest_contentelements',
    'IframeVideo',
    []
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'GoWest.gowest_contentelements',
    'Quote',
    []
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'GoWest.gowest_contentelements',
    'Smartsearch',
    []
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'GoWest.gowest_contentelements',
    'LegalDisclosure',
    ['Legaldisclosure' => 'index']
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'GoWest.gowest_contentelements',
    'CsvTables',
    ['Csvtables' => 'index']
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'GoWest.gowest_contentelements',
    'Kennzahlen',
    []
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'GoWest.gowest_contentelements',
    'AnchorNavigation',
    []
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'GoWest.gowest_contentelements',
    'Faq',
    []
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'GoWest.gowest_contentelements',
    'ImageGallery',
    []
);


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript('gowest_contentelements','setup',    ' <INCLUDE_TYPOSCRIPT: source="FILE:EXT:gowest_contentelements/Configuration/TypoScript/setup.typoscript">');
$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['searchresult'] = \GoWest\GowestContentelements\Controller\SearchresultController::class . '::indexAction';


/** Override ContentUtility to make slide=-1 work **/
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][FriendsOfTYPO3\Headless\Utility\ContentUtility::class] = [
    'className' => GoWest\GowestContentelements\Xclass\ContentUtility::class
];

/** Override to make svg files work properly with GO.WEST Configuration **/
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][AUS\AusDriverAmazonS3\S3Adapter\MultipartUploaderAdapter::class] = [
    'className' => GoWest\GowestContentelements\Xclass\MultipartUploaderAdapter::class
];

/** Override to add copyright field to FAL Files **/
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][FriendsOfTYPO3\Headless\Utility\FileUtility::class] = [
    'className' => GoWest\GowestContentelements\Xclass\Headless\FileUtility::class
];

/** Extend DataHandler for Copy-Paste Contentelements Fix **/
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][TYPO3\CMS\Core\DataHandling\DataHandler::class] = [
    'className' => GoWest\GowestContentelements\Xclass\DataHandler::class
]; 

//Labeling Plugins in Backend
//if (TYPO3_MODE === 'BE') {
//    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info']['list']['gowest_contentelements'] = 'GoWest\GowestContentelements\Hook\CmsLayout->list_type_Info';
//}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:gowest_contentelements/Configuration/TsConfig/Page/Mod/Wizards/NewContentElement.tsconfig">'
);

$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

$iconRegistry->registerIcon(
   'gowestcontentelements-mediaimage',
   \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:gowest_contentelements/ext_icon.svg']
);
$iconRegistry->registerIcon(
    'gowestcontentelements-mediavideo',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:gowest_contentelements/ext_icon.svg']
);
$iconRegistry->registerIcon(
    'gowestcontentelements-landingpagemediaimage',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:gowest_contentelements/ext_icon.svg']
);
$iconRegistry->registerIcon(
    'gowestcontentelements-uspteaser',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:gowest_contentelements/ext_icon.svg']
);
$iconRegistry->registerIcon(
    'gowestcontentelements-imagetext',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:gowest_contentelements/ext_icon.svg']
);
$iconRegistry->registerIcon(
    'gowestcontentelements-htmlvideo',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:gowest_contentelements/ext_icon.svg']
);
$iconRegistry->registerIcon(
    'gowestcontentelements-iframevideo',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:gowest_contentelements/ext_icon.svg']
);
$iconRegistry->registerIcon(
    'gowestcontentelements-quote',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:gowest_contentelements/ext_icon.svg']
);
$iconRegistry->registerIcon(
    'gowestcontentelements-smartsearch',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:gowest_contentelements/ext_icon.svg']
);
$iconRegistry->registerIcon(
    'gowestcontentelements-legaldisclosure',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:gowest_contentelements/ext_icon.svg']
);
$iconRegistry->registerIcon(
    'gowestcontentelements-csvtables',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:gowest_contentelements/ext_icon.svg']
);
$iconRegistry->registerIcon(
    'gowestcontentelements-kennzahlen',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:gowest_contentelements/ext_icon.svg']
);