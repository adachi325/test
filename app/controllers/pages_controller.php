<?php

class PagesController extends AppController {
	public $name = 'Pages';
        public $uses = array();

        function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('*');
	}


	public function display() {

            //ログイン済みならマイページへ遷移
            if($this->Auth->user()) {
                $this->set('login_user',$this->Auth->user());
                $this->redirect('/children/');
            }

            $this->render('/pages/top/');
	}
}
?>