<?php

use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Update class for the extension manager.
 *
 * @package TYPO3
 * @subpackage tx_news
 */
class ext_update {
	
	/**
	 * Array of flash messages (params) array[][status,title,message]
	 *
	 * @var array
	 */
	protected $messageArray = array();

	/**
	 * @var \TYPO3\CMS\Core\Database\DatabaseConnection
	 */
	protected $databaseConnection;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->databaseConnection = $GLOBALS['TYPO3_DB'];
	}

	/**
	 * Main update function called by the extension manager.
	 *
	 * @return string
	 */
	public function main() {
		$this->processUpdates();
		return $this->generateOutput();
	}

	/**
	 * Called by the extension manager to determine if the update menu entry should by showed.
	 *
	 * @return bool
	 */
	public function access() {
		return TRUE;
	}

	/**
	 * The actual update function. Add your update task in here.
	 *
	 * @return void
	 */
	protected function processUpdates() {
		// The category relation needs to be updated when updating to Typo3 6.2
		$title = 'Update tx_camaliga_domain_model_content category-relation';

		// Update new record
		$update = array('fieldname' => 'categories');
		$this->databaseConnection->exec_UPDATEquery(
			'sys_category_record_mm',
			"tablenames='tx_camaliga_domain_model_content' AND fieldname=''",
			$update
		);

		$this->messageArray[] = array(FlashMessage::OK, $title, 'sys_category_record_mm has been updated!');
	}

	/**
	 * Generates output by using flash messages
	 *
	 * @return string
	 */
	protected function generateOutput() {
		$output = '';
		foreach ($this->messageArray as $messageItem) {
			/** @var \TYPO3\CMS\Core\Messaging\FlashMessage $flashMessage */
			$flashMessage = GeneralUtility::makeInstance(
				'TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
				$messageItem[2],
				$messageItem[1],
				$messageItem[0]);
			$output .= $flashMessage->render();
		}
		return $output;
	}
}
?>