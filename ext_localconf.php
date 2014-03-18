<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'quizpalme.' . $_EXTKEY,
	'Pi1',
	array(
		'Content' => 'list, listExtended, show, showExtended, random, carousel, carouselSeparated, scrollable, roundabout, flexslider2, galleryview, galleryviewExtended, galleryviewFancyBox, fancyBox, elastislide, innerfade, bootstrap, adGallery, adGalleryExtended, adGalleryFancyBox, owl, responsive, map, mapExtended',
	),
	// non-cacheable actions
	array(
		'Content' => 'random',
	)
);

?>