<?php
class user_kesearchhooks {

	/**
	 * Adds the custom indexer to the TCA of indexer configurations, so that
	 * it's selectable in the backend as an indexer type when you create a
	 * new indexer configuration.
	 *
	 * @param array $params
	 * @param type $pObj
	 */
	function registerIndexerConfiguration(&$params, $pObj) {

			// add item to "type" field
		$newArray = array(
				'Camaliga elements (camaliga)',
				'customcamaliga',
				t3lib_extMgm::extRelPath('camaliga') . 'ext_icon.gif'
				);
		$params['items'][] = $newArray;

			// enable "sysfolder" field
		$GLOBALS['TCA']['tx_kesearch_indexerconfig']['columns']['sysfolder']['displayCond'] .= ',customcamaliga';
	}

	/**
	 * Custom indexer for ke_search
	 *
	 * @param   array $indexerConfig Configuration from TYPO3 Backend
	 * @param   array $indexerObject Reference to indexer class.
	 * @return  string Output.
	 * @author  Christian Buelter <buelter@kennziffer.com>
	 * @since   Fri Jan 07 2011 16:01:51 GMT+0100
	 */
	public function customIndexer(&$indexerConfig, &$indexerObject) {
		if($indexerConfig['type'] == 'customcamaliga') {
			$content = '';

				// get all the entries to index
				// don't index hidden or deleted elements, BUT
				// get the elements with frontend user group access restrictions
				// or time (start / stop) restrictions.
				// Copy those restrictions to the index.
			$fields = '*';
			$table = 'tx_camaliga_domain_model_content';
			$where = 'pid IN (' . $indexerConfig['sysfolder'] . ') AND hidden = 0 AND deleted = 0';
			$groupBy = '';
			$orderBy = '';
			$limit = '';
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($fields,$table,$where,$groupBy,$orderBy,$limit);
			$resCount = $GLOBALS['TYPO3_DB']->sql_num_rows($res);

				// Loop through the records and write them to the index.
			if($resCount) {
				while ( ($record = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) ) {

						// compile the information which should go into the index
						// the field names depend on the table you want to index!
					$title = strip_tags($record['title']);
					$abstract = strip_tags($record['shortdesc']);
					$content = strip_tags($record['longdesc']);
					$place = strip_tags($record['city']);
					$place .= ($record['city'] && $record['country']) ? ', ' . strip_tags($record['country'])
																	  : ' ' . strip_tags($record['country']);
					$fullContent = $title . "\n" . $abstract . "\n" . $content . "\n" .$place;
					$params = '&tx_camaliga_pi1[content]=' . $record['uid'];
					$tags = '#camaliga#';
					$additionalFields = array(
							'sortdate' => $record['crdate'],
							'orig_uid' => $record['uid'],
							'orig_pid' => $record['pid'],
							);

						// ... and store the information in the index
					$indexerObject->storeInIndex(
							$indexerConfig['storagepid'],   // storage PID
							$title,                         // record title
							'customcamaliga',                  	// content type
							$indexerConfig['targetpid'],    // target PID: where is the single view?
							$fullContent,                   // indexed content, includes the title (linebreak after title)
							$tags,                          // tags for faceted search
							$params,                        // typolink params for singleview
							$abstract,                      // abstract; shown in result list if not empty
							$record['sys_language_uid'],    // language uid
							$record['starttime'],           // starttime
							$record['endtime'],             // endtime
							0,        					    // fe_group
							false,                          // debug only?
							$additionalFields               // additionalFields
							);
				}
				$content = '<p><b>Camaliga Indexer "' . $indexerConfig['title'] . '": ' . $resCount . ' elements have been indexed.</b></p>';
			}
			return $content;
		}
	}
}
?>
