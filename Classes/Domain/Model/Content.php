<?php
namespace quizpalme\Camaliga\Domain\Model;

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
 * Content Model: die Schublade der Extension
 *
 * @package camaliga
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Content extends \TYPO3\CMS\Extbase\DomainObject\AbstractValueObject {

	/**
	 * Title
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * Short description
	 *
	 * @var \string
	 */
	protected $shortdesc;

	/**
	 * Long description
	 *
	 * @var \string
	 */
	protected $longdesc;

	/**
	 * Link to a page
	 *
	 * @var \string
	 */
	protected $link;

	/**
	 * Image
	 *
	 * @var \string
	 */
	protected $image;

	/**
	 * Street
	 *
	 * @var \string
	 */
	protected $street;
	
	/**
	 * Zip code
	 *
	 * @var \string
	 */
	protected $zip;
	
	/**
	 * City
	 *
	 * @var \string
	 */
	protected $city;
	
	/**
	 * Country
	 *
	 * @var \string
	 */
	protected $country;

	/**
	 * Phone number
	 *
	 * @var \string
	 */
	protected $phone;
	
	/**
	 * Mobile number
	 *
	 * @var \string
	 */
	protected $mobile;
	
	/**
	 * E-Mail
	 *
	 * @var \string
	 */
	protected $email;
	
	/**
	 * Latitude
	 *
	 * @var \float
	 */
	protected $latitude;

	/**
	 * Longitude
	 *
	 * @var \float
	 */
	protected $longitude;

	/**
	 * Custom variable 1
	 *
	 * @var \string
	 */
	protected $custom1;

	/**
	 * Custom variable 2
	 *
	 * @var \string
	 */
	protected $custom2;

	/**
	 * Custom variable 3
	 *
	 * @var \string
	 */
	protected $custom3;

	/**
	 * Mutter-Element: quizpalme\Camaliga\Domain\Model\Content
	 *
	 * @var \integer
	 */
	protected $mother;
	
	/**
	 * Categories. Früher: integer
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category>
	 */
	protected $categories;
	
	
	/**
	 * Returns the title
	 *
	 * @return \string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param \string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the shortdesc
	 *
	 * @return \string $shortdesc
	 */
	public function getShortdesc() {
		return $this->shortdesc;
	}

	/**
	 * Sets the shortdesc
	 *
	 * @param \string $shortdesc
	 * @return void
	 */
	public function setShortdesc($shortdesc) {
		$this->shortdesc = $shortdesc;
	}

	/**
	 * Returns the longdesc
	 *
	 * @return \string $longdesc
	 */
	public function getLongdesc() {
		return $this->longdesc;
	}

	/**
	 * Sets the longdesc
	 *
	 * @param \string $longdesc
	 * @return void
	 */
	public function setLongdesc($longdesc) {
		$this->longdesc = $longdesc;
	}

	/**
	 * Returns the link
	 *
	 * @return \string $link
	 */
	public function getLink() {
		return $this->link;
	}

	/**
	 * Sets the link
	 *
	 * @param \string $link
	 * @return void
	 */
	public function setLink($link) {
		$this->link = $link;
	}

	/**
	 * Returns the image
	 *
	 * @return \string $image
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * Sets the image
	 *
	 * @param \string $image
	 * @return void
	 */
	public function setImage($image) {
		$this->image = $image;
	}

	/**
	 * Returns the street
	 *
	 * @return \string $street
	 */
	public function getStreet() {
		return $this->street;
	}

	/**
	 * Sets the street
	 *
	 * @param \string $street
	 * @return void
	 */
	public function setStreet($street) {
		$this->street = $street;
	}
	
	/**
	 * Returns the zip
	 *
	 * @return \string $zip
	 */
	public function getZip() {
		return $this->zip;
	}

	/**
	 * Sets the zip
	 *
	 * @param \string $zip
	 * @return void
	 */
	public function setZip($zip) {
		$this->zip = $zip;
	}
	
	/**
	 * Returns the city
	 *
	 * @return \string $city
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Sets the city
	 *
	 * @param \string $city
	 * @return void
	 */
	public function setCity($city) {
		$this->city = $city;
	}
	
	/**
	 * Returns the country
	 *
	 * @return \string $country
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * Sets the country
	 *
	 * @param \string $country
	 * @return void
	 */
	public function setCountry($country) {
		$this->country = $country;
	}
	
	/**
	 * Returns the phone
	 *
	 * @return \string $phone
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * Sets the phone
	 *
	 * @param \string $phone
	 * @return void
	 */
	public function setPhone($phone) {
		$this->phone = $phone;
	}
	
	/**
	 * Returns the mobile
	 *
	 * @return \string $mobile
	 */
	public function getMobile() {
		return $this->mobile;
	}

	/**
	 * Sets the mobile
	 *
	 * @param \string $mobile
	 * @return void
	 */
	public function setMobile($mobile) {
		$this->mobile = $mobile;
	}
	
	/**
	 * Returns the email
	 *
	 * @return \string $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the email
	 *
	 * @param \string $email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
	}
	
	/**
	 * Returns the latitude
	 *
	 * @return \float $latitude
	 */
	public function getLatitude() {
		return $this->latitude;
	}

	/**
	 * Sets the latitude
	 *
	 * @param \float $latitude
	 * @return void
	 */
	public function setLatitude($latitude) {
		$this->latitude = $latitude;
	}

	/**
	 * Returns the longitude
	 *
	 * @return \float $longitude
	 */
	public function getLongitude() {
		return $this->longitude;
	}

	/**
	 * Sets the longitude
	 *
	 * @param \float $longitude
	 * @return void
	 */
	public function setLongitude($longitude) {
		$this->longitude = $longitude;
	}

	/**
	 * Returns the custom1
	 *
	 * @return \string $custom1
	 */
	public function getCustom1() {
		return $this->custom1;
	}

	/**
	 * Sets the custom1
	 *
	 * @param \string $custom1
	 * @return void
	 */
	public function setCustom1($custom1) {
		$this->custom1 = $custom1;
	}

	/**
	 * Returns the custom2
	 *
	 * @return \string $custom2
	 */
	public function getCustom2() {
		return $this->custom2;
	}

	/**
	 * Sets the custom2
	 *
	 * @param \string $custom2
	 * @return void
	 */
	public function setCustom2($custom2) {
		$this->custom2 = $custom2;
	}

	/**
	 * Returns the custom3
	 *
	 * @return \string $custom3
	 */
	public function getCustom3() {
		return $this->custom3;
	}

	/**
	 * Sets the custom3
	 *
	 * @param \string $custom3
	 * @return void
	 */
	public function setCustom3($custom3) {
		$this->custom3 = $custom3;
	}

	/**
	 * Returns the mother
	 *
	 * @return \quizpalme\Camaliga\Domain\Model\Content $mother
	 */
	public function getMother() {
		return $this->mother;
	}

	/**
	 * Sets the mother
	 *
	 * @param \quizpalme\Camaliga\Domain\Model\Content $mother
	 * @return void
	 */
	public function setMother(\quizpalme\Camaliga\Domain\Model\Content $mother) {
		$this->mother = $mother;
	}

	/**
	 * Adds a Category
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\Category $category
	 * @return void
	 */
	public function addCategory(\TYPO3\CMS\Extbase\Domain\Model\Category $category) {
		$this->categories->attach($category);
	}
	
	/**
	 * Removes a Category
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\Category $categoryToRemove The Category to be removed
	 * @return void
	 */
	public function removeCategory(\TYPO3\CMS\Extbase\Domain\Model\Category $categoryToRemove) {
		$this->categories->detach($categoryToRemove);
	}
	
	/**
	 * Sets the categories
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category> $categories
	 * @return void
	 */
	public function setCategories(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $categories) {
		$this->categories = $categories;
	}
	
	/**
	 * Returns the categories
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category> $categories
	 */
	public function getCategories() {
		return $this->categories;
	}
	
	/**
	 * Returns the categories: Kategorien und dessen Vater eines Elements
	 *
	 * @return \array categories
	 */
	public function getCategoriesAndParents() {
		$cats = array();
		if ($this->categories) {
			$configuration = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['camaliga']);
			$catMode = intval($configuration["categoryMode"]);
			$lang = intval($GLOBALS['TSFE']->config['config']['sys_language_uid']);
			// Step 1: select all categories of the current language
			$categoriesUtility = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('\quizpalme\Camaliga\Utility\AllCategories');
			$all_cats = $categoriesUtility->getCategoriesarrayComplete();
			// Step 2: aktuelle orig_uid herausfinden
			$orig_uid = intval($this->getUid());	// ist immer die original uid (nicht vom übersetzten Element!)
			if ($lang > 0 && $catMode == 0) {
				$res4 = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
						'uid',
						'tx_camaliga_domain_model_content',
						'deleted=0 AND hidden=0 AND sys_language_uid=' . $lang . ' AND t3_origuid=' . $orig_uid);
				if ($GLOBALS['TYPO3_DB']->sql_num_rows($res4) > 0) {
					while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res4))
						if ($row['uid']) {
							$orig_uid = intval($row['uid']);	// uid of the translated element
						}
				}
				$GLOBALS['TYPO3_DB']->sql_free_result($res4);
			}
			// Step 3: get the mm-categories of the current element (from the original or translated element)
			$res4 = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
				'uid_local',
				'sys_category_record_mm',
				"tablenames='tx_camaliga_domain_model_content' AND uid_foreign=" . $orig_uid);
			if ($GLOBALS['TYPO3_DB']->sql_num_rows($res4) > 0) {
				while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res4)){
					$uid = $row['uid_local'];
					if (!isset($all_cats[$uid]['parent'])) continue;
					$parent = (int) $all_cats[$uid]['parent'];
					//if (!$all_cats[$parent]['title'])	continue;
					if (!isset($cats[$parent])) {
						$cats[$parent] = array();
						$cats[$parent]['childs'] = array();
						$cats[$parent]['title'] = $all_cats[$parent]['title'];
					}
					if ($all_cats[$uid]['title'])
						$cats[$parent]['childs'][$uid] = $all_cats[$uid]['title'];
				}
			}
			$GLOBALS['TYPO3_DB']->sql_free_result($res4);
		}
		return $cats;
	}
}
?>