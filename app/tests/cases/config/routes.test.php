<?php

App::import('Core', 'Dispatcher');

class UrlRoutingTestCase extends CakeTestCase {
	public $Dispatcher;
	public $url;

	public function startCase() {
		parent::startCase();

		$this->Dispatcher =& new Dispatcher();
	}

	public function endCase() {
		unset($this->Dispatcher);

		parent::endCase();
	}

	public function testAll() {
		$this->url = '/';
		$params = $this->Dispatcher->parseParams($this->url);

		$this->assertIdentical(isset($params['admin']) ,false);

		$this->url = '/ap/baby/1005';
		$params = $this->Dispatcher->parseParams($this->url);

		pr($params);
	}
}
