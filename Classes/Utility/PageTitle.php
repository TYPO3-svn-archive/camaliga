<?php
namespace quizpalme\Camaliga\Utility;

# oder so ähnlich: http://www.typo3forum.net/forum/news-tt_news-mininews-co/21636-tt_news-news-titel-seitentitel.html
class PageTitle {
	public function getTitleTag($content, $conf) {
		$id = 0;
		$trim = $GLOBALS['TSFE']->tmpl->setup['config.']['titleTagFunction.']['noTrimWrap'];
		$params = $_POST['tx_camaliga_pi1'];
		if (count($params) == 0)
			$params = $_GET['tx_camaliga_pi1'];
		if (count($params) > 0)
			$id = $params['content'];
		if ($id > 0) {
			$res4 = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
					'title',
					'tx_camaliga_domain_model_content',
					'uid = ' . intval($id));
			$rows = $GLOBALS['TYPO3_DB']->sql_num_rows($res4);
			if ($rows > 0) {
				$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res4);
				$pageTitle = $row['title'];
			}
			$GLOBALS['TYPO3_DB']->sql_free_result($res4);
		}
		return trim($pageTitle);
	}
}
