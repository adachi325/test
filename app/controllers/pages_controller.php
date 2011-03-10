<?php

class PagesController extends AppController {
	public $name = 'Pages';
        public $uses = array();

        function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('*');
	}

	public function display() {
            
                if($this->Auth->user()) {
                    $this->set('login_user',$this->Auth->user());
                    $this->redirect('/children/');
                }

		$path = func_get_args();
		$count = count($path);
		if (!$count) {
			$this->notFound();
		}
		$page = $subpage = null;

		if (!empty($path[1])) {
			$subpage = $path[1];
		}

		if (!empty($path[0])) {
			$page = $path[0];
			if (method_exists($this, '_' . $page)) {
				$hasRenderd = $this->{'_' . $page}($path);
				if ($hasRenderd) {
					return;
				}
			}
		}

		$this->set(compact('page', 'subpage'));
		$this->render(implode('/', $path));

	}
}
