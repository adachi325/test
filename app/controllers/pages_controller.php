<?php
App::import('Controller', 'KtaiApp');
class PagesController extends KtaiAppController {
	public $name = 'Pages';
	public $uses = array();
        public $components = array('Auth','Ktai');

	public $pageTitles = array(
		'rules' => 'ご利用規約',
		'privacy' => '個人情報の取り扱い',
		'guide' => 'ご利用ガイド',
	);
        
        function beforeFilter() {
            $this->Auth->allow('*');
            parent::beforeFilter();
	}
        
	public function display() {

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
