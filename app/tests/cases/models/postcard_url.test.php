<?php
/* PostcardUrl Test cases generated on: 2011-03-31 14:03:09 : 1301550129*/
App::import('Model', 'PostcardUrl');

class PostcardUrlTestCase extends CakeTestCase {
	var $fixtures = array('app.postcard_url', 'app.child', 'app.user', 'app.line', 'app.content','app.month', 'app.issue', 'app.present', 'app.month', 'app.diary', 'app.theme', 'app.child_present');

	function startTest() {
		$this->PostcardUrl =& ClassRegistry::init('PostcardUrl');
	}

	function endTest() {
		unset($this->PostcardUrl);
		ClassRegistry::flush();
	}

	function testIsValiable() {

            $p =& $this->PostcardUrl;

            //正常系
            $options = array();
            $options['0'] = '1234';
            $options['1'] = '1232234';
            $options['2'] = '8902345';
            $options['3'] = '9898212314';

            $i = 1;
            foreach($options as $token) {
                $this->assertEqual($p->isValiable($token),1, '正常系'.$i);
                $i++;
            }
            
            //異常系
            $options = array();
            $options['0'] = 'てすとー';
            $options['1'] = 'h98ohofwh';
            $options['2'] = '';
            $options['3'] = null;

            $i = 1;
            foreach($options as $token) {
                $this->assertEqual($p->isValiable($token),null, '異常系'.$i);
                $i++;
            }
	}

	function testGetExpiredUrls() {
		$p =& $this->PostcardUrl;
		
		$result = $p->getExpiredUrls();
		//期限切れデータ検索
		$this->assertEqual(count($result), 2, 'レコード取得数 %s');
	}
}
?>
