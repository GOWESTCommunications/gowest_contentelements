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

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript('gowest_contentelements','setup',    ' <INCLUDE_TYPOSCRIPT: source="FILE:EXT:gowest_contentelements/Configuration/TypoScript/setup.typoscript">');