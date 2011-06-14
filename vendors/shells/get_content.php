<?php

App::import('Shell', 'AppShell');
class GetContentShell extends AppShell {

    var $uses = array('Article');

	function main() {
        $this->getNews();
        $this->getWheather();
        $this->getPsycologicalTest();
	}

	function __getCSV($url, $type) {
        
        //$Article =& ClassRegistry::init('Article');

        $data = file_get_contents($url);
        $lines = explode("¥n", $data);

        $article = array();
        foreach ($lines as $line) {
            if (count($line) >=6 ) {
                $cells = explode(',', $line);
                
                if ($Article->isUnique($type, $cell[5])) {
                    $rec = array();

                    $rec['external_id'] = $cells[0];
                    $rec['title'] = $cells[1];
                    $rec['body'] = $cells[2];
                    $rec['photo'] = $cells[3];
                    $rec['release_date'] = $cells[4];
                    $rec['expire_date'] = $cells[5];
                    $rec['type'] = $type;

                    $article['Article'] = $rec;

                    $Article->create();
                    $Article->save($article);
                }
            }
        }
	}

	function getNews() {
        
        //$url = "http://".$_SERVER["HTTP_HOST"]."/-apis/get_news.php?guid=ON&id=";
        $url = "http://".Configure::read('Api.domain')."/-apis/get_news.php?guid=ON&id=";
        $type = 2;

        $this->__getCSV($url, $type);
	}

	function getWheather() {
        
        $url = "http://".Configure::read('Api.domain')."/-apis/get_wheather.php?guid=ON&id=";
        $type = 2;

        $this->__getCSV($url, $type);
	}

	function getPsycologicalTest() {
        
        $url = "http://".Configure::read('Api.domain')."/-apis/get_psycological_test.php?guid=ON&id=";
        $type = 3;

        $this->__getCSV($url, $type);
	}

}
