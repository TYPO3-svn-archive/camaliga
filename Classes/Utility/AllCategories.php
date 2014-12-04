<?php
namespace quizpalme\Camaliga\Utility;

/**
 * AllCategories: get all categories
 *
 * @package camaliga
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class AllCategories {

	/**
	 * Returns all categories: alle Kategorien
	 *
	 * @return \array categories
	 */
	public function getCategoriesarrayComplete() {
		$all_cats = array();
		$orig_uids = array();
		$orig_titles = array();
		$configuration = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['camaliga']);
		$catMode = intval($configuration["categoryMode"]);	// mode 0: use translated relations; 1: use original relations 
		$lang = intval($GLOBALS['TSFE']->config['config']['sys_language_uid']);
		$cat_lang = ($catMode) ? 0 : $lang;
		// Step 1: ggf. orig-cat-uid holen
		if ($lang > 0) {
			$res4 = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
					'uid, t3_origuid, title',
					'sys_category',
					'deleted=0 AND hidden=0 AND sys_language_uid=' . $lang);
			if ($GLOBALS['TYPO3_DB']->sql_num_rows($res4) > 0) {
				while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res4)){
					$orig_uids[$row['t3_origuid']] = $row['uid'];
					$orig_titles[$row['t3_origuid']] = $row['title'];
				}
			}
			$GLOBALS['TYPO3_DB']->sql_free_result($res4);
		}
		// Step 2: select all categories, because parent-title is needed too!
		$res4 = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
				'uid, parent, title, description, t3_origuid',
				'sys_category',
				'deleted=0 AND hidden=0 AND sys_language_uid=' . $cat_lang,
				'',
				'uid ASC');
		if ($GLOBALS['TYPO3_DB']->sql_num_rows($res4) > 0) {
			while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res4)){
				$uid = $row['uid'];
				$all_cats[$uid] = array();
				$all_cats[$uid]['parent'] = ($lang > 0 && $catMode == 0) ? $orig_uids[$row['parent']] : $row['parent'];	// Fall 1: parent des engl. Elements; 2: partent des deut. Elements
				$all_cats[$uid]['title']  = ($lang > 0 && $catMode == 1) ? $orig_titles[$uid]         : $row['title'];	// Fall 1: Titel der engl. Kat.; 2: aktueller Titel (engl.)
				$all_cats[$uid]['description'] = $row['description'];
			}
		}
		$GLOBALS['TYPO3_DB']->sql_free_result($res4);
		return $all_cats;
	}
}
?>