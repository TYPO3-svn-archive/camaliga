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
 * Content Controller: der Körper der Extension
 *
 * @package camaliga
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class ContentController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * contentRepository
	 *
	 * @var \quizpalme\Camaliga\Domain\Repository\ContentRepository
	 * @inject
	 */
	protected $contentRepository;
	
	/**
	 * configurationManager
	 * 
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
	 */
	protected $configurationManager;
	
	/**
	 * Injects the configuration manager, retrieves the plugin settings from it, 
	 * merges / overrides the FlexForm settings with Typoscript settings if FlexForm setting is empty
	 *
	 * @param \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager Instance of the Configuration Manager
	 * @return void
	 */
	public function injectConfigurationManager(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager) {
		$this->configurationManager = $configurationManager;

		/* $tsSettings = $this->configurationManager->getConfiguration(
			\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK,
			'Camaliga',
			'Pi1'
		); */
		$tsSettings = $this->configurationManager->getConfiguration(
			\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT
		);
		$tsSettings = $tsSettings['plugin.']['tx_camaliga.']['settings.'];
		$originalSettings = $this->configurationManager->getConfiguration(
			\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS
		);
		/* \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($tsSettings);
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($originalSettings); */
		
		// start override
		if (isset($tsSettings['overrideFlexformSettingsIfEmpty']) && $tsSettings['overrideFlexformSettingsIfEmpty']==1) {
			// if flexform setting is empty and value is available in TS
			foreach ($tsSettings as $key=>$value) {
				if ($key == 'img.' || $key == 'item.') continue;
				if (!$originalSettings[$key] && isset($value))
					$originalSettings[$key] = $value;
			}
			foreach ($tsSettings['img.'] as $key=>$value) {
				if ((!$originalSettings['img'][$key] && $originalSettings['img'][$key]!=='0') && isset($value))
					$originalSettings['img'][$key] = $value;
			}
			foreach ($tsSettings['item.'] as $key=>$value) {
				if ((!$originalSettings['item'][$key] && $originalSettings['item'][$key]!=='0') && isset($value))
					$originalSettings['item'][$key] = $value;
			}
		}
		$this->settings = $originalSettings;
	}
	
	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$storagePidsArray = $this->contentRepository->getStoragePids();
		$storagePidsComma = implode(',', $storagePidsArray);
		if (!$storagePidsComma) {		// nix ausgewählt => aktuelle PID nehmen
			$storagePidsComma = intval($GLOBALS["TSFE"]->id);
			$storagePidsArray = array($storagePidsComma);
			$storagePidsOnly = array($storagePidsComma);
		} else {
			$storagePidsOnly = array();
		}
		$categoryUids = array();
		if ($this->settings['defaultCatIDs']) {
			$defaultCats = explode(',', $this->settings['defaultCatIDs']);
			foreach ($defaultCats as $defCat) {
				$selected = intval(trim($defCat));
				$categoryUids[$selected] = $selected;
			}
		}
		
		if (count($categoryUids) > 0) {
			$contents = $this->contentRepository->findByCategories($categoryUids, $sortBy, $sortOrder, $this->settings['onlyDistinct'], $storagePidsOnly);
		} else {
			$contents = $this->contentRepository->findAll($this->settings['sortBy'], $this->settings['sortOrder'], $this->settings['onlyDistinct'], $storagePidsOnly);
		}
		if ($this->settings['random']) $contents = $this->sortObjects($contents);
		
		$cobjData = $this->configurationManager->getContentObject();
		
		$this->view->assign('uid', $cobjData->data['uid']);
		$this->view->assign('pid', $GLOBALS["TSFE"]->id);
		$this->view->assign('contents', $contents);
		$this->view->assign('storagePIDsArray', $storagePidsArray);	// alle PIDs als Array
		$this->view->assign('storagePIDsComma', $storagePidsComma);	// alle PIDs kommasepariert
		$item_width = intval($this->settings['item']['width']);
		$padding_item_width = $item_width + 2 * intval($this->settings['item']['padding']);
		$total_item_width = $padding_item_width + 2 * intval($this->settings['item']['margin']);
		$total_width = intval($this->settings['item']['items']) * $total_item_width;
		$this->view->assign('paddingItemWidth', $padding_item_width);
		$this->view->assign('totalItemWidth', $total_item_width);
		$this->view->assign('itemWidth', (($this->settings['addPadding']) ? $padding_item_width : $item_width));
		$this->view->assign('totalWidth', $total_width);
		$item_height = intval($this->settings['item']['height']);
		$padding_item_height = $item_height + 2 * intval($this->settings['item']['padding']);
		$total_item_height = $padding_item_height + 2 * intval($this->settings['item']['margin']);
		$this->view->assign('paddingItemHeight', $padding_item_height);
		$this->view->assign('totalItemHeight', $total_item_height);
		$this->view->assign('itemHeight', (($this->settings['addPadding']) ? $padding_item_height : $item_height));
	}
	
	/**
	 * action listExtended
	 *
	 * @return void
	 */
	public function listExtendedAction() {
		$sortBy = ($this->request->hasArgument('sortBy')) ? $this->request->getArgument('sortBy') : $this->settings['sortBy'];
		$sortOrder = ($this->request->hasArgument('sortOrder')) ? $this->request->getArgument('sortOrder') : $this->settings['sortOrder'];
		$categoryUids = array();
		$configuration = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['camaliga']);
		$catMode = intval($configuration["categoryMode"]);
		//$catMode = intval($this->settings['categoryMode']);
		$lang = intval($GLOBALS['TSFE']->config['config']['sys_language_uid']);
		$cat_lang = ($catMode) ? 0 : $lang;
		$tableName = 'tx_camaliga_domain_model_content';
		$start = ($this->request->hasArgument('start')) ? intval($this->request->getArgument('start')) : 1;
		$storagePidsArray = $this->contentRepository->getStoragePids();
		$storagePidsComma = implode(',', $storagePidsArray);
		$storagePidsData = array();
		$storagePidsOnly = array();
		if (count($storagePidsArray)>1) {	// bei mehr als einer PID eine Auswahl anbieten
			$res4 = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
				'uid, title',
				'pages',
				'uid IN (' . $storagePidsComma . ')');
			$rows = $GLOBALS['TYPO3_DB']->sql_num_rows($res4);
			if ($rows>0) {
				while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res4)){
					$uid = $row['uid'];
					$storagePidsData[$uid] = array();
					$storagePidsData[$uid]['uid'] = $uid;
					$storagePidsData[$uid]['title'] = $row['title'];
					$storagePidsData[$uid]['selected'] = 0;
				}
				$GLOBALS['TYPO3_DB']->sql_free_result($res4);
			}
			$defPids = ',' . str_replace(' ', '', $this->settings['defaultStoragePids']) . ',';
			foreach ($storagePidsArray as $aPID) {
				// Prüfen, ob nur bestimmte Ordner ausgewählt sind
				if ($this->request->hasArgument('search')) {
					// PID übermittelt?
					if ($this->request->hasArgument('pid_' . $aPID)) {
						if ($this->request->getArgument('pid_' . $aPID) == $aPID) {
							$storagePidsData[$aPID]['selected'] = $aPID;
							$storagePidsOnly[] = intval($aPID);
						}
					}
				} else if ($this->settings['defaultStoragePids']) {
					// Default-PID vorhanden?
					if (strpos($defPids, ',' . $aPID . ',') !== false) {
						$storagePidsData[$aPID]['selected'] = $aPID;
						$storagePidsOnly[] = intval($aPID);
					}
				}
			}
		} else if (!$storagePidsComma) {		// nix ausgewählt => aktuelle PID nehmen
			$storagePidsComma = intval($GLOBALS["TSFE"]->id);
			$storagePidsArray = array($storagePidsComma);
			$storagePidsOnly = array($storagePidsComma);
		}
		if (count($storagePidsOnly)>0)
			$storagePidsOnlyComma = implode(',', $storagePidsOnly);
		else 
			$storagePidsOnlyComma = $storagePidsComma; 
			
		// Step 0: Categories
		$cats = array();
		// Step 1: get all categories
		$categoriesUtility = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('\quizpalme\Camaliga\Utility\AllCategories');
		$all_cats = $categoriesUtility->getCategoriesarrayComplete();
		// Step 2: select categories, used by this extension AND used by this storagePids: needed for the category-restriction at the bottom
		$search = false;	// search by user selection?
		$res4 = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
			'DISTINCT mm.uid_local',
			'sys_category AS cat, sys_category_record_mm AS mm, tx_camaliga_domain_model_content car',
			"cat.uid = mm.uid_local AND mm.tablenames='" . $tableName . "' AND mm.uid_foreign=car.uid".
				" AND car.pid IN (" . $storagePidsOnlyComma . ') AND cat.sys_language_uid=' . $cat_lang,
			'',
			'cat.title');
		if ($GLOBALS['TYPO3_DB']->sql_num_rows($res4) > 0) {
			while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res4)){
				$uid = $row['uid_local'];
				if (!$all_cats[$uid]['parent']) continue;
				$parent = $all_cats[$uid]['parent'];
				if (!is_array($cats[$parent])) {
					$selected = ($this->request->hasArgument('cat'.$parent)) ?
						  intval($this->request->getArgument('cat'.$parent)) : 0;
					if ($selected > 0) {
						$categoryUids[$selected] = $selected;
						$search = true;
					}
					$cats[$parent] = array();
					$cats[$parent]['childs'] = array();
					$cats[$parent]['selected'] = $selected;
					$cats[$parent]['title'] = $all_cats[$parent]['title'];
					$cats[$parent]['description'] = $all_cats[$parent]['description'];
				}
				$selected = ($this->request->hasArgument('cat'.$parent.'_'.$uid)) ?
					  intval($this->request->getArgument('cat'.$parent.'_'.$uid)) : 0;
				if ($selected > 0) {
					$categoryUids[$parent] = ($categoryUids[$parent]) ? $categoryUids[$parent].",$selected" : $selected;
					$search = true;
				}
				if ($all_cats[$uid]['title']) {
					$cats[$parent]['childs'][$uid] = array();
					$cats[$parent]['childs'][$uid]['selected'] = $selected;
					$cats[$parent]['childs'][$uid]['title'] = $all_cats[$uid]['title'];
				}
			}
			$GLOBALS['TYPO3_DB']->sql_free_result($res4);
			
			// wenn nix ausgewählt wurde, aber doch submitted wurde
			if ($this->request->hasArgument('search')) $search = true;
			
			// keine Suche => default cats auswählen
			if (!$search && $this->settings['defaultCatIDs']) {
				$defaultCats = explode(',', $this->settings['defaultCatIDs']);
				foreach ($defaultCats as $defCat) {
					$uid = $selected = intval(trim($defCat));
					$parent = $all_cats[$uid]['parent'];
					if ($cats[$parent]['description'] == 'checkbox') {
						$cats[$parent]['childs'][$uid]['selected'] = $selected;
						$categoryUids[$parent] = ($categoryUids[$parent]) ? $categoryUids[$parent].",$selected" : $selected;
					} else {
						$cats[$parent]['selected'] = $selected;
						$categoryUids[$selected] = $selected;
					}
				}
			}
		}
		
		if (count($categoryUids) > 0) {
			// official solution (not enough): http://wiki.typo3.org/TYPO3_6.0#Category
			// Sort categories (doesnt work): http://www.php-kurs.com/arrays-mehrdimensional.htm 
			// find entries by category
			$contents = $this->contentRepository->findByCategories($categoryUids, $sortBy, $sortOrder, $this->settings['onlyDistinct'], $storagePidsOnly);
		} else {
			$contents = $this->contentRepository->findAll($sortBy, $sortOrder, $this->settings['onlyDistinct'], $storagePidsOnly);
		}
		if ($this->settings['random']) $contents = $this->sortObjects($contents);
				  
		$cobjData = $this->configurationManager->getContentObject();
		
		//$this->view->assign('lang1', $GLOBALS['TSFE']->config['config']['sys_language_uid']);
		$this->view->assign('lang', $cobjData->data['sys_language_uid']);
		$this->view->assign('uid', $cobjData->data['uid']);
		$this->view->assign('pid', $GLOBALS["TSFE"]->id);
		$this->view->assign('contents', $contents);
		$this->view->assign('sortBy_selected', $sortBy);
		$this->view->assign('sortOrder_selected', $sortOrder);
		$this->view->assign('categories', $cats);
		$this->view->assign('defaultCatIDs', $this->settings['defaultCatIDs']);
		$this->view->assign('storagePIDsArray', $storagePidsArray);	// alle PIDs als Array
		$this->view->assign('storagePIDsComma', $storagePidsComma);	// alle PIDs kommasepariert
		$this->view->assign('storagePIDsData', $storagePidsData);	// alle Daten zu den PIDS
		$this->view->assign('start', $start);
		$item_width = intval($this->settings['item']['width']);
		$padding_item_width = $item_width + 2 * intval($this->settings['item']['padding']);
		$total_item_width = $padding_item_width + 2 * intval($this->settings['item']['margin']);
		$total_width = intval($this->settings['item']['items']) * $total_item_width;
		$this->view->assign('paddingItemWidth', $padding_item_width);
		$this->view->assign('totalItemWidth', $total_item_width);
		$this->view->assign('itemWidth', (($this->settings['addPadding']) ? $padding_item_width : $item_width));
		$this->view->assign('totalWidth', $total_width);
		$item_height = intval($this->settings['item']['height']);
		$padding_item_height = $item_height + 2 * intval($this->settings['item']['padding']);
		$total_item_height = $padding_item_height + 2 * intval($this->settings['item']['margin']);
		$this->view->assign('paddingItemHeight', $padding_item_height);
		$this->view->assign('totalItemHeight', $total_item_height);
		$this->view->assign('itemHeight', (($this->settings['addPadding']) ? $padding_item_height : $item_height));
	}

	/**
	 * action show one element
	 *
	 * @param $content
	 * @return void
	 */
	public function showAction(\quizpalme\Camaliga\Domain\Model\Content $content) {
		$this->view->assign('content', $content);
		$this->view->assign('error', 0);
	}

	/**
	 * action show one element, extended
	 *
	 * @param $content
	 * @return void
	 */
	public function showExtendedAction(\quizpalme\Camaliga\Domain\Model\Content $content) {
		$this->view->assign('content', $content);
		$this->view->assign('error', 0);
		if ($content->getMother() > 0) {
			// wir haben hier ein Kind
			$this->view->assign('parent', $this->contentRepository->findByUid($content->getMother()));
			$this->view->assign('hasParent', 1);
			$this->view->assign('childs', $this->contentRepository->findByMother2($content->getMother(), $content->getUid()));
		} else {
			// wir haben hier die Mutter
			$this->view->assign('parent', '');
			$this->view->assign('hasParent', 0);
			$this->view->assign('childs', $this->contentRepository->findByMother2($content->getUid(), 0));
		}
	}
	
	/**
	 * action carousel
	 *
	 * @return void
	 */
	public function carouselAction() {
		$this->listAction();
	}

	/**
	 * action separated carousel
	 *
	 * @return void
	 */
	public function carouselSeparatedAction() {
		$this->listAction();
	}
	
	/**
	 * action scrollable
	 *
	 * @return void
	 */
	public function scrollableAction() {
		$this->listAction();
	}

	/**
	 * action roundabout
	 *
	 * @return void
	 */
	public function roundaboutAction() {
		$this->listAction();
	}

	/**
	 * action flipster
	 *
	 * @return void
	 */
	public function flipsterAction() {
		$this->listAction();
	}
	
	/**
	 * action bootstrap
	 *
	 * @return void
	 */
	public function bootstrapAction() {
		$this->listAction();
	}

	/**
	 * action S Gallery
	 *
	 * @return void
	 */
	public function sgalleryAction() {
		$this->listAction();
	}
	
	/**
	 * action AD Gallery
	 *
	 * @return void
	 */
	public function adGalleryAction() {
		$this->listAction();
	}

	/**
	 * action AD Gallery + FancyBox
	 *
	 * @return void
	 */
	public function adGalleryFancyBoxAction() {
		$this->listAction();
	}

	/**
	 * action AD Gallery extended
	 *
	 * @return void
	 */
	public function adGalleryExtendedAction() {
		$this->listExtendedAction();
	}

	/**
	 * action GalleryView
	 *
	 * @return void
	 */
	public function galleryviewAction() {
		$this->listAction();
	}

	/**
	 * action GalleryView extended
	 *
	 * @return void
	 */
	public function galleryviewExtendedAction() {
		$this->listExtendedAction();
	}

	/**
	 * action GalleryView + FancyBox
	 *
	 * @return void
	 */
	public function galleryviewFancyboxAction() {
		$this->listAction();
	}

	/**
	 * action FancyBox
	 *
	 * @return void
	 */
	public function fancyBoxAction() {
		$this->listAction();
	}
	
	/**
	 * action Elastislide
	 *
	 * @return void
	 */
	public function elastislideAction() {
		$this->listAction();
	}

	/**
	 * action Innerfade
	 *
	 * @return void
	 */
	public function innerfadeAction() {
		$this->listAction();
	}
	
	/**
	 * action FlexSlider 2
	 *
	 * @return void
	 */
	public function flexslider2Action() {
		$this->listAction();
	}
	
	/**
	 * action Responsive carousel
	 * 
	 * @return void
	 */
	public function responsiveAction() {
		$this->listAction();
	}

	/**
	 * action Responsive carousel (2)
	 *
	 * @return void
	 */
	public function responsiveCarouselAction() {
		$this->listAction();
	}
	
	/**
	 * action OWL carousel + SimpleModal
	 *
	 * @return void
	 */
	public function owlSimpleModalAction() {
		$this->listAction();
	}

	/**
	 * action OWL carousel
	 *
	 * @return void
	 */
	public function owlAction() {
		$this->listAction();
	}
	
	/**
	 * action OWL carousel 2
	 *
	 * @return void
	 */
	public function owl2Action() {
		$this->listAction();
	}

	/**
	 * action SDKSlider
	 *
	 * @return void
	 */
	public function skdsliderAction() {
		$this->listAction();
	}
	
	/**
	 * action test
	 *
	 * @return void
	 */
	public function testAction() {
		$this->listAction();
	}
	
	/**
	 * action Map
	 *
	 * @return void
	 */
	public function mapAction() {
		$this->listAction();
	}
	
	/**
	 * action Map extended
	 *
	 * @return void
	 */
	public function mapExtendedAction() {
		$this->listExtendedAction();
	}
	
	/**
	 * action one random uncached element
	 *
	 * @return void
	 */
	public function randomAction() {
		$contents = $this->contentRepository->findRandom();
		$this->view->assign('contents', $contents);
	}

	/**
	* Zufälliges sortieren der Ergebnisse
	* 
	* @return array 
	*/ 
	private function sortObjects($objects) {
	   /** 
	   * zuerst holen wir uns alle gewünschten Objekte, welche später in Fuid in zufälliger Reihenfolge ausgegeben werden sollen 
	   * und erstellen ein zusätzelichen Array, in welches mittels array_push() die UIDs der Objekte   geschrieben werden 
	  */
	  $uidArray = array();
	   foreach($objects as $object) { 
	    array_push($uidArray, $object->getUid()); 
	  } 
	   /** 
	   * shuffle verwürfelt den Inhalt das UID Arrays 
	   * außerdem erstellen wir ein neues Array, welches später von der Funktion zurückgegeben wird
	   */
	  shuffle($uidArray); 
	  $objectArray = array(); 
	  /** 
	  * für jeden Eintrag im UID Array gehen wir durch die vorhandenen Objekte 
	  * und wenn die aktuelle uid im Array = der Uid des aktuellen Objektes ist 
	  * wir das Objekt in das $objectArray geschrieben und zurückgegeben 
	  */ 
	  foreach ($uidArray as $uid) { 
	     foreach($objects as $object) { 
	      if($uid == $object->getUid()) { 
	       array_push($objectArray, $object); 
	      } 
	     } 
	  } 
	  return $objectArray; 
	}
}
?>