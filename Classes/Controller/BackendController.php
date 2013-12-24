<?php
namespace quizpalme\Camaliga\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Kurt Gusbeth <info@quizpalme.de>
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package camaliga
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class BackendController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * contentRepository
	 *
	 * @var \quizpalme\Camaliga\Domain\Repository\ContentRepository
	 * @inject
	 */
	protected $contentRepository;
	
	protected function getCurrentPageId() {
	 $pageId = (integer) \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('id');
	 if ($pageId > 0) {
	  return $pageId;
	 }
	 // get current site root
	 $rootPages = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('uid', 'pages', 'deleted=0 AND hidden=0 AND is_siteroot=1', '', '', '1');
	 if (count($rootPages) > 0) {
	  return $rootPages[0]['uid'];
	 }
	 // fallback
	 return self::DEFAULT_BACKEND_STORAGE_PID;
	}

	/**
	 * action index
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('pid', intval($this->getCurrentPageId()));
	}

	/**
	 * action Karussell-import
	 *
	 * @return void
	 */
	public function importAction() {
		$pid = intval($this->getCurrentPageId());
		$res = $GLOBALS['TYPO3_DB']->sql_query("SHOW TABLES LIKE 'tx_karussell_inhalt'");
		if ($GLOBALS['TYPO3_DB']->sql_num_rows($res)>0) {
			// get Karussell-entries for current PID
			$entries = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'tx_karussell_inhalt', 'deleted=0 AND hidden=0 AND pid=' . $pid, 'sorting', '', '');
			if (count($entries) > 0) {
				if ($this->request->hasArgument('cimport') || $this->request->hasArgument('dimport')) {
					// Import
					$insert = array();
					$insert['pid'] = $pid;
					$insert['tstamp'] = time();
					$insert['crdate'] = time();
					$insert['cruser_id'] = $GLOBALS['BE_USER']->user['uid'];
					for ($i=0; $i<count($entries); $i++) {
						$insert['sorting'] = $entries[$i]['sorting'];
						$insert['title'] = $entries[$i]['titel'];
						$insert['shortdesc'] = $entries[$i]['meldung'];
						$insert['link'] = $entries[$i]['link'];
						$bild = $entries[$i]['bild'];
						if (is_file(PATH_site . 'uploads/tx_camaliga/' . $bild)) {
							// wenn das Bild schon da ist, den Dateinamen ändern!
							for ($j=1;$j<100;$j++) {
								if (!is_file(PATH_site.'uploads/tx_camaliga/' . $j . '_' . $bild)) {
									$bild = $j . '_' . $bild;
									break;
								}
							}
						}
						$insert['image'] = $bild;
						$success = $GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_camaliga_domain_model_content', $insert);
						copy(PATH_site . 'uploads/tx_karussell/'.$entries[$i]['bild'], PATH_site . 'uploads/tx_camaliga/' . $bild);
						if ($this->request->hasArgument('dimport'))
							unlink(PATH_site . 'uploads/tx_karussell/'.$entries[$i]['bild']);
					}
					$this->flashMessageContainer->add(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:import.ok', 'OK'));
					if ($this->request->hasArgument('dimport')) {
						$GLOBALS['TYPO3_DB']->exec_DELETEquery('tx_karussell_inhalt', 'deleted=0 AND hidden=0 AND pid=' . $pid);
						$this->flashMessageContainer->add(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:import.del', 'deleted'));
					}
				}
				
				$this->view->assign('entries', $entries);
				$this->view->assign('error', 0);
			} else {
				$this->view->assign('error', 1);
			}
		} else {
			$this->view->assign('error', 1);
		}
	}

	/**
	 * action tt_news-import
	 *
	 * @return void
	 */
	public function importNewsAction() {
		$pid = intval($this->getCurrentPageId());
		$res = $GLOBALS['TYPO3_DB']->sql_query("SHOW TABLES LIKE 'tt_news'");
		if ($GLOBALS['TYPO3_DB']->sql_num_rows($res)>0) {
			// get Karussell-entries for current PID
			$entries = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'tt_news', 'deleted=0 AND hidden=0 AND pid=' . $pid, 'tstamp DESC', '', '');
			if (count($entries) > 0) {
				if ($this->request->hasArgument('cimport') || $this->request->hasArgument('dimport')) {
					// Import
					$insert = array();
					$insert['pid'] = $pid;
					$insert['cruser_id'] = $GLOBALS['BE_USER']->user['uid'];
					for ($i=0; $i<count($entries); $i++) {
						$insert['sorting'] = $i+1;
						$insert['tstamp'] = $entries[$i]['tstamp'];
						$insert['crdate'] = $entries[$i]['crdate'];
						$insert['title'] = $entries[$i]['title'];
						$insert['shortdesc'] = $entries[$i]['short'];
						$insert['link'] = $entries[$i]['link'];
						$bild = $entries[$i]['image'];
						if (is_file(PATH_site . 'uploads/tx_camaliga/' . $bild)) {
							// wenn das Bild schon da ist, den Dateinamen ändern!
							for ($j=1;$j<100;$j++) {
								if (!is_file(PATH_site . 'uploads/tx_camaliga/' . $j . '_' . $bild)) {
									$bild = $j . '_' . $bild;
									break;
								}
							}
						}
						$insert['image'] = $bild;
						$success = $GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_camaliga_domain_model_content', $insert);
						copy(PATH_site . 'uploads/pics/' . $entries[$i]['image'], PATH_site . 'uploads/tx_camaliga/' . $bild);
						if ($this->request->hasArgument('dimport'))
							unlink(PATH_site.'uploads/pics/' . $entries[$i]['image']);
					}
					$this->flashMessageContainer->add(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:import.ok', 'OK'));
					if ($this->request->hasArgument('dimport')) {
						$GLOBALS['TYPO3_DB']->exec_DELETEquery('tt_news', 'deleted=0 AND hidden=0 AND pid=' . $pid);
						$this->flashMessageContainer->add(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:import.del', 'deleted'));
					}
				}
				
				$this->view->assign('entries', $entries);
				$this->view->assign('error', 0);
			} else {
				$this->view->assign('error', 1);
			}
		} else {
			$this->view->assign('error', 1);
		}
	}
	
	/**
	 * action PicasaWeb-import
	 *
	 * @return void
	 */
	public function importPicasaAction() {
		$pid = intval($this->getCurrentPageId());
		
	}
}
?>