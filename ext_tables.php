<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'Camaliga: carousel/map/list/gallery'
);

if (TYPO3_MODE === 'BE') {
	/**
	 * Registers a Backend Module
	 */
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'quizpalme.' . $_EXTKEY,
		'web',	 // Make module a submodule of 'web'
		'imports',	// Submodule key
		'',			// Position
		array(
			'Backend' => 'index, import, importNews, importPicasa',
			
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_be.xlf',
		)
	);
}

// Include flex forms
$pluginSignature = str_replace('_','',$_EXTKEY) . '_' . 'pi1'; // myextensionname;
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:'.$_EXTKEY . '/Configuration/FlexForms/flexform_pi1.xml');

// Add static file
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Camaliga (carousel/map/list/gallery)');

// Add page TSConfig (funktioniert, bringt aber nichts)
if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('linkvalidator')) {
	$pageTsConfig = \TYPO3\CMS\Core\Utility\GeneralUtility::getUrl(
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TSconfig/Page/mod.linkvalidator.txt');
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig($pageTsConfig);
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_camaliga_domain_model_content', 'EXT:camaliga/Resources/Private/Language/locallang_csh_tx_camaliga_domain_model_content.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_camaliga_domain_model_content');
$TCA['tx_camaliga_domain_model_content'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,shortdesc,longdesc,street,zip,city,country',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Content.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_camaliga_domain_model_content.gif'
	),
);

// Kategorien. Mehr Infos dazu hier: http://wiki.typo3.org/TYPO3_6.0#Category
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
    $_EXTKEY,
    'tx_camaliga_domain_model_content',

    // The field is mandatory for TCEmain to work internally.
    $fieldName = 'categories',

    // optional: add TCA options which controls how the field is displayed. e.g position and name of the category tree.
    $options = array()
	/* 	// Override generic configuration, e.g. sort by title rather than by sorting
		'fieldConfiguration' => array(
			'foreign_table_where' => ' AND sys_category.sys_language_uid IN (-1, 0) ORDER BY sys_category.title ASC',
		)
	) */
);

/***************
 * Wizard pi1
 */
if (TYPO3_MODE == 'BE') {
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses'][$pluginSignature . '_wizicon'] =
		t3lib_extMgm::extPath($_EXTKEY) . 'Resources/Private/Php/class.' . $_EXTKEY . '_wizicon.php';
}
?>