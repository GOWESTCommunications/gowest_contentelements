<?php
if(!defined('TYPO3_MODE')) die ('Access denied.');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'GoWest.gowest_contentelements',
    'MediaImage',
    [ 'Mediaimage' => 'index']
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'GoWest.gowest_contentelements',
    'MediaVideo',
    [ 'Mediavideo' => 'index']
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'GoWest.gowest_contentelements',
    'LandingpageMediaImage',
    [ 'Landingpagemediaimage' => 'index']
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript('gowest_contentelements','setup',    ' <INCLUDE_TYPOSCRIPT: source="FILE:EXT:gowest_contentelements/Configuration/TypoScript/setup.typoscript">');