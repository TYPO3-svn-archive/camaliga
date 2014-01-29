<?php
namespace quizpalme\Camaliga\Domain\Repository;

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
 * Content Repository: das Herz der Extension
 *
 * @package camaliga
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class ContentRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * findAll ersetzen, wegen Sortierung
	 * @param	string	$sortBy		Sort by
	 * @param	string	$sortOrder	Sort order
	 * @param	boolean	$onlyDistinct	Only distinct entries?
	 * @param	array	$pids		Storage PIDs
	 */
	public function findAll($sortBy = 'sorting', $sortOrder = 'asc', $onlyDistinct = FALSE, $pids = array()) {
		$order = ($sortOrder == 'desc') ? \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING :
										 \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING;
		if ($sortBy=='sorting' || $sortBy=='tstamp' || $sortBy=='title' || $sortBy=='zip' || $sortBy=='city'
		 || $sortBy=='country' || $sortBy=='custom1' || $sortBy=='custom2' || $sortBy=='custom3') {
		 	//OK
		} else $sortBy = 'sorting';
		$query = $this->createQuery();
		if (count($pids)>0)
			$query->getQuerySettings()->setRespectStoragePage(FALSE);
		if ((count($pids)>0) && $onlyDistinct)
			$query->matching($query->logicalAnd( $query->in('pid', $pids), $query->equals('mother', 0)));
		else if (count($pids)>0)
			$query->matching($query->in('pid', $pids));
		else if ($onlyDistinct)
			$query->matching($query->equals('mother', 0));
		//	->setOffset($page * $limit)
		//	->setLimit($limit)
		return $query
			->setOrderings(	array($sortBy => $order) )
			->execute();
	}

	/**
	 * findByUids ersetzen, wegen Sortierung
	 * @param	array	$uids		UIDs
	 * @param	string	$sortBy		Sort by
	 * @param	string	$sortOrder	Sort order
	 */
	public function findByUids($uids, $sortBy = 'sorting', $sortOrder = 'asc') {
		$order = ($sortOrder == 'desc') ? \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING :
										 \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING;
		if ($sortBy=='sorting' || $sortBy=='tstamp' || $sortBy=='title' || $sortBy=='zip' || $sortBy=='city'
		 || $sortBy=='country' || $sortBy=='custom1' || $sortBy=='custom2' || $sortBy=='custom3') {
		 	//OK
		} else $sortBy = 'sorting';
		$query = $this->createQuery();
		//if ($onlyDistinct)
		//	$query->matching($query->logicalAnd($query->equals('mother', 0), $query->in('uid', $uids)));
		//else 
		$query->matching($query->in('uid', $uids));
		return $query
			->setOrderings(	array($sortBy => $order) )
			->execute();
	}
	
	/**
	 * findByCategories ersetzen, wegen Sortierung
	 * @param	array	$uids		UIDs
	 * @param	string	$sortBy		Sort by
	 * @param	string	$sortOrder	Sort order
	 * @param	boolean	$onlyDistinct	Only distinct entries?
	 * @param	array	$pids		Storage PIDs
	 */
	public function findByCategories($uids, $sortBy = 'sorting', $sortOrder = 'asc', $onlyDistinct = FALSE, $pids = array()) {
		if (count($uids) > 0) {
			$max = 0;
			$parents = array();	// Übergeordnete Elemente
			$childs = array();	// Kind-Elemente, die angezeigt werden sollen
			$twice = array();	// Kind-Elemente, die entfernt werden sollen
			$elements = array();	// Elemente, die gefunden wurden, mit Anzahl der Treffer bei der Suche zu diesem Element
			$results = array();		// Elemente, die zum Schluss übrig bleiben
			if (count($pids)>0) $where = ' AND con.pid IN (' . implode(',', $pids) . ')'; else $where = '';
			foreach ($uids as $uidsChilds) {
				// Search all elements of specified category/ies
				$res4 = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
					'DISTINCT mm.uid_foreign, con.mother',
					'sys_category_record_mm AS mm, tx_camaliga_domain_model_content AS con',
					"mm.tablenames='tx_camaliga_domain_model_content' AND
					 mm.uid_foreign=con.uid AND mm.uid_local IN (" . $uidsChilds . ')' . $where);
				$rows = $GLOBALS['TYPO3_DB']->sql_num_rows($res4);
				if ($rows>0) {
					while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res4)){
						$uid = $row['uid_foreign'];
						$elements[$uid]++;
						$parents[$uid] = $row['mother'];
						$childs[$uid] = 0;
					}
				}
				$GLOBALS['TYPO3_DB']->sql_free_result($res4);
				$max++;
			}
			
			// take only elements where all matches where true
			foreach ($elements as $uid => $count) {
				if ($count == $max) $results[] = $uid;
			}
			
			// wenn nur einmalige Elemente angezeigt werden sollen, dann weiter ausdünnen
			if ($onlyDistinct) {
				foreach ($results as $key => $uid) {
					$mother = $parents[$uid];
					if ($mother > 0) {
						// Es gibt ein Mutter-Element
						if (in_array($mother, $results)) {
							// Mutter-Element vorhanden, also dieses Kind entfernen
							$twice[$key] = $uid;
						} else {
							if ($childs[$mother]) {
								// Ähnliches Element vorhanden, also dieses Kind entfernen
								$twice[$key] = $uid;
							} else {
								// Dieses Kind statt der Mutter anzeigen
								$childs[$mother] = $uid;
							}
						}
					}
				}
				if (count($twice) > 0) {
					// Dieses nicht eindeutigen Elemente entfernen
					foreach ($twice as $key => $uid) {
						unset($results[$key]);
					}
				}
			}
			
			if (count($results) > 0) {
				// search all content elements of specified uids
				return $this->findByUids($results, $sortBy, $sortOrder);
			}
		} else {
			return $this->findAll($sortBy, $sortOrder, $onlyDistinct, $pids);
		}
	}
	
	/**
     * Get a random object
     */
    public function findRandom() {
        $rows = $this->createQuery()->execute()->count();
        $row_number = mt_rand(0, max(0, ($rows - 1)));
        return $this->createQuery()->setOffset($row_number)->setLimit(1)->execute();
    }

	/**
	 * findByMother2 ersetzen, wegen Schwestern
	 * @param	integer	$mother	Mutter-UID
	 * @param	integer	$child	Aktuelle Kind-UID
	 */
	public function findByMother2($mother, $child) {
		$mother = intval($mother);
		$child = intval($child);
		$query = $this->createQuery();
		if ($child > 0) {
			$query->matching($query->logicalAnd($query->equals('mother', $mother), $query->logicalNot($query->equals('uid', $child))));
		} else {
			$query->matching($query->equals('mother', $mother));
		}
		return $query->execute();
	}
	
	/**
     * Get the PIDs
     * 
	 * @return array
     */
    public function getStoragePids() {
        $query = $this->createQuery();
		return $query->getQuerySettings()->getStoragePageIds();
    }
}
?>