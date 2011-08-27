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

                $article = $Article->getArticle($type, $this->removeDoubleQuote($cells[0]));
                if ($article) {
                    $rec['id'] = $article['Article']['id'];
                    $rec['release_date'] = $article['Article']['release_date'];
                } else {
                    $rec['release_date'] = $this->removeDoubleQuote($cells[4]);
                }
                $rec['external_id'] = $this->removeDoubleQuote($cells[0]);
                $rec['title'] = $this->removeDoubleQuote($cells[1]);
                $rec['body'] = $this->removeDoubleQuote($cells[2]);
                $rec['photo'] = $this->removeDoubleQuote($cells[3]);
                $rec['expire_date'] = $this->removeDoubleQuote($cells[5]);
                $rec['type'] = $type;

                $article['Article'] = $rec;

                $Article->create(false);
                $Article->save($article);
            }
        }
    }

    function removeDoubleQuote($str) {
        $ret = preg_replace('/^\"(.*?)\"$/', "$1", $str);
        $ret = preg_replace('/^\"/', "", $ret);
        $ret = preg_replace('/\"$/', "", $ret);

        return $ret;
    }

    function removeShimajiro($str) {
        return preg_replace('/^\/shimajiro\//', "/", $str);
    }

	function getNews() {
        
        //$url = "http://".$_SERVER["HTTP_HOST"]."/-apis/get_news.php?guid=ON&id=";
        $url = "http://".Configure::read('Api.ip')."/shimajiro/-apis/get_news.php?&id=";
        $type = 2;

        $this->__getCSV($url, $type);
	}

	function getWeather() {
        
        $url = "http://".Configure::read('Api.ip')."/shimajiro/-apis/get_weathers.php?&id=";
        $type = 2;

        $this->__getCSV($url, $type);
	}

	function getPsychologicalTest() {
        
        $url = "http://".Configure::read('Api.ip')."/shimajiro/-apis/get_psychological_tests.php?&id=";
        $type = 4;

        $this->__getCSV($url, $type);
	}

}
