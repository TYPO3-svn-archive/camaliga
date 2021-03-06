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
		$oldIDs = array();
		$pid = intval($this->getCurrentPageId());
		$res = $GLOBALS['TYPO3_DB']->sql_query("SHOW TABLES LIKE 'tx_karussell_inhalt'");
		if ($GLOBALS['TYPO3_DB']->sql_num_rows($res)>0) {
			// get Karussell-entries for current PID
			$entries = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'tx_karussell_inhalt', 'deleted=0 AND hidden=0 AND pid=' . $pid, 'sys_language_uid, sorting', '', '');
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
						$insert['image'] = $this->checkImage($entries[$i]['bild']);
						$insert['t3_origuid'] = ($entries[$i]['t3_origuid']) ? intval($oldIDs[$entries[$i]['t3_origuid']]) : 0;
						$insert['l10n_parent'] = ($entries[$i]['l10n_parent']) ? intval($oldIDs[$entries[$i]['l10n_parent']]) : 0;
						$insert['sys_language_uid'] = $entries[$i]['sys_language_uid'];
						$success = $GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_camaliga_domain_model_content', $insert);
						if ($success){
		                    $oldIDs[$entries[$i]['uid']] = $GLOBALS['TYPO3_DB']->sql_insert_id();
						}
						copy(PATH_site . 'uploads/tx_karussell/'.$entries[$i]['bild'], PATH_site . 'uploads/tx_camaliga/' . $insert['image']);
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
						$insert['image'] = $this->checkImage($entries[$i]['image']);
						$insert['sys_language_uid'] = $entries[$i]['sys_language_uid'];
						$success = $GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_camaliga_domain_model_content', $insert);
						copy(PATH_site . 'uploads/pics/' . $entries[$i]['image'], PATH_site . 'uploads/tx_camaliga/' . $insert['image']);
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
		$importNr = $this->request->hasArgument('importNr') ? intval($this->request->getArgument('importNr')) : -1;
		$start = $this->request->hasArgument('start') ? intval($this->request->getArgument('start')) : 1;
		$max = $this->request->hasArgument('max') ? intval($this->request->getArgument('max')) : 25;
		$userID = $this->request->hasArgument('userid') ? $this->request->getArgument('userid') : '';
		$albumID = $this->request->hasArgument('albumid') ? $this->request->getArgument('albumid') : '';
		$imgsize = $this->request->hasArgument('imgsize') ? $this->request->getArgument('imgsize') : '720';
		
		if ($userID && $albumID) {
			$url = 'https://picasaweb.google.com/data/feed/api/user/' . $userID . '/albumid/' . $albumID . 
				'?start-index=' . $start . '&max-results=' . $max . '&imgmax=110&thumbsize=104';
			$ch=curl_init();
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			$data=curl_exec($ch);
			curl_close($ch);
	
		/*	$dom = new DOMDocument;
			$dom->loadXML($data); // data from cURL request		
			$xpath = new DOMXPath($dom);
			$names = $xpath->query('//feed/entry');
			foreach ($names as $name) {
			    echo $name->nodeValue;
			}*/
			$xml = simplexml_load_string($data);
			$json = json_encode($xml);
			$array = json_decode($json,TRUE);
	
			// Import
			$imported = FALSE;
			$array2 = array();
			$inserted = array();
			$insert = array();
			$insert['pid'] = $pid;
			$insert['tstamp'] = time();
			$insert['crdate'] = time();
			$insert['cruser_id'] = $GLOBALS['BE_USER']->user['uid'];
			
			foreach ($array['entry'] as $i => $entry) {
				$insert['sorting'] = $i+1;
				$insert['title'] = ($entry['summary']) ? $entry['summary'] : $entry['title'];
				$insert['image'] = $this->checkImage($entry['title']);
				$insert['custom1'] = $entry['content']['@attributes']['src'];
				$inserted[] = $insert;
				
				if (($i+1) == $importNr) {
					// Hiermit erhalten wir ein großes Bild:
					$url2 = $entry['id'] . '?imgmax=' . $imgsize;
					$ch=curl_init();
					curl_setopt($ch,CURLOPT_URL,$url2);
					curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
					$data2=curl_exec($ch);
					curl_close($ch);
					
					$xml2 = simplexml_load_string($data2);
					$json2 = json_encode($xml2);
					$array2 = json_decode($json2,TRUE);
					if ($array2['content']['@attributes']['src'])
						$insert['custom1'] = $array2['content']['@attributes']['src'];
					
					// copy image from the google server
					ob_start();
					$fp = fopen($insert['custom1'], "rb");
					fpassthru($fp);
					fclose($fp);
					$file = ob_get_contents();
					ob_end_clean();
					$fp = fopen(PATH_site . 'uploads/tx_camaliga/' . $insert['image'], "wb+");
					fwrite($fp, $file);
					fclose($fp);
					$insert['custom1'] = '';
					$imported = $insert['image'];
					
					$res4 = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
						'MAX(sorting) AS sorting',
						'tx_camaliga_domain_model_content',
						'pid = ' . $pid);
					$rows = $GLOBALS['TYPO3_DB']->sql_num_rows($res4);
					if ($rows>0) {
						while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res4)){
							$insert['sorting'] = $row['sorting'] + 10;
						}
						$GLOBALS['TYPO3_DB']->sql_free_result($res4);
					} else $insert['sorting'] = 10;
					
					// save the entry into the DB
					$success = $GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_camaliga_domain_model_content', $insert);
				}
			}
		}
		
		$this->view->assign('start', $start);
		$this->view->assign('max', $max);
		$this->view->assign('imgsize', $imgsize);
		$this->view->assign('userid', (string) $userID);
		$this->view->assign('albumid', (string) $albumID);
		$this->view->assign('imported', $imported);		
		$this->view->assign('result', $inserted);
		$this->view->assign('entries', $array['entry']);
		$this->view->assign('importentry', $array2);
	}
	
	/**
	 * Prüft, ob ein Bild schon vorhanden ist
	 *
	 * @return string
	 */
	function checkImage($bild) {
		if (is_file(PATH_site . 'uploads/tx_camaliga/' . $bild)) {
			// wenn das Bild schon da ist, den Dateinamen ändern!
			for ($j=1;$j<500;$j++) {
				if (!is_file(PATH_site . 'uploads/tx_camaliga/' . $j . '_' . $bild)) {
					$bild = $j . '_' . $bild;
					break;
				}
			}
		}
		return $bild;
	}
}
?>