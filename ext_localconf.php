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

//Labeling Plugins in Backend
//if (TYPO3_MODE === 'BE') {
//   $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info']['gowestcontentelements_contentelements']['gowest_contentelements'] = '/GOWEST\\Contentelements\\Hook\\CmsLayout::class->list_type_Info';
//}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript('gowest_contentelements','constants',' <INCLUDE_TYPOSCRIPT: source="FILE:EXT:gowest_contentelements/Configuration/TypoScript/constants.txt">');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript('gowest_contentelements','setup',    ' <INCLUDE_TYPOSCRIPT: source="FILE:EXT:gowest_contentelements/Configuration/TypoScript/setup.txt">');

//call_user_func(
//    function () {
//        $GLOBALS['TYPO3_CONF_VARS']['FE']['contentRenderingTemplates'][] = 'gowest_contentelements/Configuration/TypoScript/';
//        $GLOBALS['TYPO3_CONF_VARS']['FE']['ContentObjects'] = array_merge($GLOBALS['TYPO3_CONF_VARS']['FE']['ContentObjects'], [
//            'JSON' => GOWEST\Contentelements\Controller\ContentelementsController::class,
//        ]);
//    }
//);
