<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'quizpalme.' . $_EXTKEY,
	'Pi1',
	array(
		'Content' => 'list, listExtended, show, showExtended, random, carousel, carouselSeparated, responsiveCarousel, sgallery, skdslider, scrollable, roundabout, flipster, flexslider2, galleryview, galleryviewExtended, galleryviewFancyBox, fancyBox, elastislide, innerfade, bootstrap, adGallery, adGalleryExtended, adGalleryFancyBox, owl, owlSimpleModal, owl2, responsive, map, mapExtended',
	),
	// non-cacheable actions
	array(
		'Content' => 'random',
	)
);

// Hooks for ke_search
if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('ke_search')) {
	// register custom indexer hook
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['registerIndexerConfiguration'][]
		= 'EXT:camaliga/Classes/Hooks/class.user_kesearchhooks.php:user_kesearchhooks';
	
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['customIndexer'][]
		= 'EXT:camaliga/Classes/Hooks/class.user_kesearchhooks.php:user_kesearchhooks';
}
?>