<?php

App::import('Shell', 'AppShell');
class GetContentShell extends AppShell {

    //var $uses = array('Article');

	function main() {
        $this->getNews();
        $this->getWeather();
        $this->getPsychologicalTest();
	}

	function __getCSV($url, $type) {
        
        $Article =& ClassRegistry::init('Article');

        $data = file_get_contents($url);
        if ($type != 4) {
            $lines = split("\n", $data);
        } else {
            $lines[] = $data;
        }

        $article = array();
        foreach ($lines as $line) {
            $cells = explode(',', $line);
            
            if (count($cells) >= 6 ) {
                
                $rec = array();

                $article_id = $Article->getArticleId($type, $this->removeDoubleQuote($cells[0]));
                if ($article_id > -1) {
                    $rec['id'] = $article_id;
                }
                $rec['external_id'] = $this->removeDoubleQuote($cells[0]);
                $rec['title'] = $this->removeDoubleQuote($cells[1]);
                $rec['body'] = $this->removeDoubleQuote($cells[2]);
                $rec['photo'] = $this->removeDoubleQuote($cells[3]);
                $rec['release_date'] = $this->removeDoubleQuote($cells[4]);
                $rec['expire_date'] = $this->removeDoubleQuote($cells[5]);
                $rec['type'] = $type;

                $article['Article'] = $rec;

                $Article->create(false);
                $Article->save($article);
            }
        }
    }

    function removeDoubleQuote($str) {
        return preg_replace('/^\"(.*?)\"$/', "$1", $str);
    }

    function removeShimajiro($str) {
        return preg_replace('/^\/shimajiro\//', "/", $str);
    }

	function getNews() {
        
        //$url = "http://".$_SERVER["HTTP_HOST"]."/-apis/get_news.php?guid=ON&id=";
        $url = "http://".Configure::read('Api.domain')."/shimajiro/-apis/get_news.php?&id=";
        $type = 2;

        $this->__getCSV($url, $type);
	}

	function getWeather() {
        
        $url = "http://".Configure::read('Api.domain')."/shimajiro/-apis/get_weathers.php?&id=";
        $type = 2;

        $this->__getCSV($url, $type);
	}

	function getPsychologicalTest() {
        
        $url = "http://".Configure::read('Api.domain')."/shimajiro/-apis/get_psychological_tests.php?&id=";
        $type = 4;

        $this->__getCSV($url, $type);
	}

}
