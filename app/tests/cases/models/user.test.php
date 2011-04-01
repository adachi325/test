<?php
/* User Test cases generated on: 2011-03-31 14:03:05 : 1301550185*/
App::import('Model', 'User');

class UserTestCase extends CakeTestCase {
	var $fixtures = array('app.user', 'app.child', 'app.line', 'app.content', 'app.issue', 'app.present', 'app.month', 'app.diary', 'app.theme', 'app.child_present', 'app.postcard_url');

	function startTest() {
		$this->User =& ClassRegistry::init('User');
	}

	function endTest() {
		unset($this->User);
		ClassRegistry::flush();
	}

        function test_register(){
            $u = $this->User;
            $datas = array();

            //正常系
            $datas['0'] = Array(
                'User'  => Array ('loginid' => 'uiui','dc_user' => 1,'password' => '6083c163496d88d309abb6037b701f99978ef76f','uid' => '00002892a15','carrier' => 0,),
                'Child' => Array ('0' => Array('nickname' => 'ういうい','sex' => 1,'birth_year' => '2004','birth_month' => '3','line_id' => 4,'benesse_user' => 1,))
            );
            $datas['1'] = Array(
                'User'  => Array ('loginid' => 'he2e287he3','dc_user' => 0,'password' => '6083c163496d88d309abb6037b701f99978ef76f','uid' => '00002892a15','carrier' => 0,),
                'Child' => Array ('0' => Array('nickname' => 'ういうい','sex' => 0,'birth_year' => '2004','birth_month' => '2','line_id' => 4,'benesse_user' => 1,))
            );
            $datas['2'] = Array(
                'User'  => Array ('loginid' => 'sndl22ed','dc_user' => 0,'password' => 'dfidgwgfyueugfuwgeugwugfwigefugwfigwwgfuy','uid' => '00002892a15','carrier' => 0,),
                'Child' => Array ('0' => Array('nickname' => 'ういうい','sex' => 0,'birth_year' => '2004','birth_month' => '4','line_id' => 4,'benesse_user' => 1,))
            );
            $datas['3'] = Array(
                'User'  => Array ('loginid' => 'sdjldo82','dc_user' => 0,'password' => '6083c163496d88d309abb6037b701f99978ef76f','uid' => '00002892a15','carrier' => 0,),
                'Child' => Array ('0' => Array('nickname' => 'meary','sex' => 0,'birth_year' => '2004','birth_month' => '3','line_id' => 1,'benesse_user' => 1,))
            );
            $datas['4'] = Array(
                'User'  => Array ('loginid' => 'd2983dn92','dc_user' => 0,'password' => '6083c163496d88d309abb6037b701f99978ef76f','uid' => '00002892a15','carrier' => 0,),
                'Child' => Array ('0' => Array('nickname' => 'わーい','sex' => 1,'birth_year' => '2011','birth_month' => '3','line_id' => 2,'benesse_user' => 1,))
            );
            $datas['5'] = Array(
                'User'  => Array ('loginid' => 'd23ljoid2','dc_user' => 0,'password' => '6083c163496d88d309abb6037b701f99978ef76f','uid' => '00002892a15','carrier' => 0,),
                'Child' => Array ('0' => Array('nickname' => '２23y21','sex' => 1,'birth_year' => '2011','birth_month' => '5','line_id' => 3,'benesse_user' => 0,))
            );
            $datas['6'] = Array(
                'User'  => Array ('loginid' => '3984209','dc_user' => 0,'password' => 'nhd9oh2do97h27273392873hd872h9d392d29','uid' => '0000289215','carrier' => 1,),
                'Child' => Array ('0' => Array('nickname' => 'testzin','sex' => 0,'birth_year' => '2011','birth_month' => '1','line_id' => 4,'benesse_user' => 0,))
            );
            $datas['7'] = Array(
                'User'  => Array ('loginid' => 'd2m2lomdo23','dc_user' => 0,'password' => 'shjahdlkahdkhaldaiuwhliudhaliudhliuahd','uid' => '0000289-weqe2a15','carrier' => 2,),
                'Child' => Array ('0' => Array('nickname' => 'meaてすとry','sex' => 0,'birth_year' => '2011','birth_month' => '11','line_id' => 5,'benesse_user' => 0,))
            );
            $datas['8'] = Array(
                'User'  => Array ('loginid' => 'dbd2jhb23','dc_user' => 0,'password' => '66219368216396872168ye78y21e91ye8','uid' => '00qewqe002892a15','carrier' => 3,),
                'Child' => Array ('0' => Array('nickname' => 'テスト人','sex' => 0,'birth_year' => '2011','birth_month' => '9','line_id' => 6,'benesse_user' => 0,))
            );
            $i=1;
            foreach($datas as $data) {
                //pr($data);
                $this->assertTrue($u->_register($data), '正常系'.$i);
                $i++;
            }

            //異常系(loginID)
            $datasf = array();
            $datasf['0'] = Array(
                'User'  => Array ('loginid' => 'ＵｉＵｕ','dc_user' => 1,'password' => '6083c163496d88d309abb6037b701f99978ef76f','uid' => '00002892a15','carrier' => 0,),
                'Child' => Array ('0' => Array('nickname' => 'ういうい','sex' => 1,'birth_year' => '2004','birth_month' => '3','line_id' => 4,'benesse_user' => 1,))
            );
            $datasf['1'] = Array(
                'User'  => Array ('loginid' => 'ういうい','dc_user' => 0,'password' => '6083c163496d88d309abb6037b701f99978ef76f','uid' => '00002892a15','carrier' => 0,),
                'Child' => Array ('0' => Array('nickname' => 'ういうい','sex' => 0,'birth_year' => '2004','birth_month' => '2','line_id' => 4,'benesse_user' => 1,))
            );
            $datasf['2'] = Array(
                'User'  => Array ('loginid' => '22ううji','dc_user' => 0,'password' => '6083c163496d88d309abb6037b701f99978ef76f','uid' => '00002892a15','carrier' => 0,),
                'Child' => Array ('0' => Array('nickname' => 'ういうい','sex' => 0,'birth_year' => '2004','birth_month' => '4','line_id' => 4,'benesse_user' => 1,))
            );
            $datasf['3'] = Array(
                'User'  => Array ('loginid' => null,'dc_user' => 0,'password' => '6083c163496d88d309abb6037b701f99978ef76f','uid' => '00002892a15','carrier' => 0,),
                'Child' => Array ('0' => Array('nickname' => 'meary','sex' => 0,'birth_year' => '2004','birth_month' => '3','line_id' => 1,'benesse_user' => 1,))
            );
            $datasf['4'] = Array(
                'User'  => Array ('loginid' => '+','dc_user' => 0,'password' => '6083c163496d88d309abb6037b701f99978ef76f','uid' => '00002892a15','carrier' => 0,),
                'Child' => Array ('0' => Array('nickname' => 'meary','sex' => 0,'birth_year' => '2004','birth_month' => '3','line_id' => 1,'benesse_user' => 1,))
            );
            $datasf['5'] = Array(
                'User'  => Array ('loginid' => '＋＊％＄＆','dc_user' => 0,'password' => '6083c163496d88d309abb6037b701f99978ef76f','uid' => '00002892a15','carrier' => 0,),
                'Child' => Array ('0' => Array('nickname' => 'meary','sex' => 0,'birth_year' => '2004','birth_month' => '3','line_id' => 1,'benesse_user' => 1,))
            );
            $i=1;
            foreach($datasf as $data) {
                //pr($data);
                $this->assertFalse($u->_register($data), '異常系【loginId】'.$i);
                $i++;
            }

            //異常系(dc_user)
            $datasf = array();
            $datasf['0'] = Array(
                'User'  => Array ('loginid' => '1','dc_user' => null,'password' => '6083c163496d88d309abb6037b701f99978ef76f','uid' => '00002892a15','carrier' => 0,),
                'Child' => Array ('0' => Array('nickname' => 'ういうい','sex' => 1,'birth_year' => '2004','birth_month' => '3','line_id' => 4,'benesse_user' => 1,))
            );
            $datasf['1'] = Array(
                'User'  => Array ('loginid' => '1','dc_user' => 'うへへ','password' => '6083c163496d88d309abb6037b701f99978ef76f','uid' => '00002892a15','carrier' => 0,),
                'Child' => Array ('0' => Array('nickname' => 'ういうい','sex' => 0,'birth_year' => '2004','birth_month' => '4','line_id' => 4,'benesse_user' => 1,))
            );
            $datasf['2'] = Array(
                'User'  => Array ('loginid' => '1','dc_user' => 'aaaaa','password' => '6083c163496d88d309abb6037b701f99978ef76f','uid' => '00002892a15','carrier' => 0,),
                'Child' => Array ('0' => Array('nickname' => 'ういうい','sex' => 0,'birth_year' => '2004','birth_month' => '4','line_id' => 4,'benesse_user' => 1,))
            );
            $datasf['3'] = Array(
                'User'  => Array ('loginid' => '1','dc_user' => 'aa1aaa','password' => '6083c163496d88d309abb6037b701f99978ef76f','uid' => '00002892a15','carrier' => 0,),
                'Child' => Array ('0' => Array('nickname' => 'ういうい','sex' => 0,'birth_year' => '2004','birth_month' => '4','line_id' => 4,'benesse_user' => 1,))
            );
            $datasf['4'] = Array(
                'User'  => Array ('loginid' => '1','dc_user' => '2','password' => '6083c163496d88d309abb6037b701f99978ef76f','uid' => '00002892a15','carrier' => 0,),
                'Child' => Array ('0' => Array('nickname' => 'ういうい','sex' => 0,'birth_year' => '2004','birth_month' => '4','line_id' => 4,'benesse_user' => 1,))
            );
            $i=1;
            foreach($datasf as $data) {
                //pr($data);
                $this->assertFalse($u->_register($data), '異常系【dc_user】'.$i);
                $i++;
            }

           //異常系(password)
            $datasf = array();
            $datasf['0'] = Array(
                'User'  => Array ('loginid' => '1','dc_user' => '0','password' => null, 'uid' => '00002892a15','carrier' => 0,),
                'Child' => Array ('0' => Array('nickname' => 'ういうい','sex' => 1,'birth_year' => '2004','birth_month' => '3','line_id' => 4,'benesse_user' => 1,))
            );
            $i=1;
            foreach($datasf as $data) {
                //pr($data);
                $this->assertFalse($u->_register($data), '異常系【password】'.$i);
                $i++;
            }

           //異常系(uid)
            $datasf = array();
            $datasf['0'] = Array(
                'User'  => Array ('loginid' => '1','dc_user' => '0','password' => '6083c163496d88d309abb6037b701f99978ef76f', 'uid' => null,'carrier' => 0,),
                'Child' => Array ('0' => Array('nickname' => 'ういうい','sex' => 1,'birth_year' => '2004','birth_month' => '3','line_id' => 4,'benesse_user' => 1,))
            );
            $datasf['1'] = Array(
                'User'  => Array ('loginid' => '1','dc_user' => '1','password' => '6083c163496d88d309abb6037b701f99978ef76f','uid' => '','carrier' => 0,),
                'Child' => Array ('0' => Array('nickname' => 'ういうい','sex' => 0,'birth_year' => '2004','birth_month' => '2','line_id' => 4,'benesse_user' => 1,))
            );
            $i=1;
            foreach($datasf as $data) {
                //pr($data);
                $this->assertFalse($u->_register($data), '異常系【uid】'.$i);
                $i++;
            }

           //異常系(carrier)
            $datasf = array();
            $datasf['0'] = Array(
                'User'  => Array ('loginid' => 'uiui','dc_user' => 1,'password' => '6083c163496d88d309abb6037b701f99978ef76f','uid' => '00002892a15','carrier' => null,),
                'Child' => Array ('0' => Array('nickname' => 'ういうい','sex' => 1,'birth_year' => '2004','birth_month' => '3','line_id' => 4,'benesse_user' => 1,))
            );
            $datasf['2'] = Array(
                'User'  => Array ('loginid' => 'he2e287he3','dc_user' => 0,'password' => '6083c163496d88d309abb6037b701f99978ef76f','uid' => '00002892a15','carrier' => 10,),
                'Child' => Array ('0' => Array('nickname' => 'ういうい','sex' => 0,'birth_year' => '2004','birth_month' => '2','line_id' => 4,'benesse_user' => 1,))
            );
            $datasf['3'] = Array(
                'User'  => Array ('loginid' => 'he2e287he3','dc_user' => 0,'password' => '6083c163496d88d309abb6037b701f99978ef76f','uid' => '00002892a15','carrier' => a,),
                'Child' => Array ('0' => Array('nickname' => 'ういうい','sex' => 0,'birth_year' => '2004','birth_month' => '2','line_id' => 4,'benesse_user' => 1,))
            );
            $i=1;
            foreach($datasf as $data) {
                //pr($data);
                $this->assertFalse($u->_register($data), '異常系【carrier】'.$i);
                $i++;
            }
        }

}
?>