<?php
/**
 * Add camaliga extension to the wizard in page module
 *
 * @package TYPO3
 * @subpackage tx_camaliga
 */
class camaliga_pi1_wizicon {

	const KEY = 'camaliga';

	/**
	 * Processing the wizard items array
	 *
	 * @param array $wizardItems The wizard items
	 * @return array array with wizard items
	 */
	public function proc($wizardItems) {
		$wizardItems['plugins_tx_' . self::KEY] = array(
			'icon'			=> t3lib_extMgm::extRelPath(self::KEY) . 'Resources/Public/Icons/ce_wiz.gif',
			'title'			=> 'Camaliga',
			'description'	=> 'Camaliga: extbase carousel/map/list/gallery that uses Typo3 categories.',
			'params'		=> '&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=' . self::KEY . '_pi1'
		);

		return $wizardItems;
	}
}

//if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/camaliga/Resources/Private/Php/class.camaliga_wizicon.php']) {
//	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/camaliga/Resources/Private/Php/class.camaliga_wizicon.php']);
//}
?>