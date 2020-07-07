<?php
if(!defined('TYPO3_MODE')) die ('Access denied.');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'gowest_contentelements',
    'mediaImage',
    array(
        'Contentelements' => 'mediaImage',
	),
	// non-cacheable actions
	array(
		'Contentelements' => '',
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'gowest_contentelements',
    'mediaVideo',
    array(
        'Contentelements' => 'mediaVideo',
	),
	// non-cacheable actions
	array(
		'Contentelements' => '',
	)
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'FILE:EXT:gowest_contentelements/Classes/Controller/ContentelementsController.php',
    'FILE:EXT:gowest_contentelements/Configuration/FlexForms/FlexForm.xml'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript('gowest_contentelements','constants',' <INCLUDE_TYPOSCRIPT: source="FILE:EXT:gowest_contentelements/Configuration/TypoScript/constants.txt">');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript('gowest_contentelements','setup',    ' <INCLUDE_TYPOSCRIPT: source="FILE:EXT:gowest_contentelements/Configuration/TypoScript/setup.txt">');
