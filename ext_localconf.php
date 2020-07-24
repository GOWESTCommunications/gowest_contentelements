<?php
if(!defined('TYPO3_MODE')) die ('Access denied.');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'GoWest.gowest_contentelements',
    'Custom',
    array(
        'Mediaimage' => 'index',
        'Mediavideo' => 'index'
	),
	// non-cacheable actions
	array(
        'Mediaimage' => 'index',
        'Mediavideo' => 'index'
	)
);


//Labeling Plugins in Backend
if (TYPO3_MODE === 'BE') {
   $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info']['gowestcontentelements_custom']['gowest_contentelements'] = GoWest\GowestContentelements\Hook\CmsLayout::class .'->list_type_Info';
}


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript('gowest_contentelements','setup',    ' <INCLUDE_TYPOSCRIPT: source="FILE:EXT:gowest_contentelements/Configuration/TypoScript/setup.typoscript">');
