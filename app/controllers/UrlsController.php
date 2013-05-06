<?php

namespace app\controllers;

use app\models\Urls;
use lithium\action\DispatchException;

class UrlsController extends \lithium\action\Controller {

	public function index() {
		$urls = Urls::all();
		return compact('urls');
	}

	public function view() {
		$url = Urls::first($this->request->id);
		return compact('url');
	}

	public function add() {
		$url = Urls::create();

		if (($this->request->data) && $url->save($this->request->data)) {
			return $this->redirect(array('Urls::view', 'args' => array($url->id)));
		}
		return compact('url');
	}

	public function edit() {
		$url = Urls::find($this->request->id);

		if (!$url) {
			return $this->redirect('Urls::index');
		}
		if (($this->request->data) && $url->save($this->request->data)) {
			return $this->redirect(array('Urls::view', 'args' => array($url->id)));
		}
		return compact('url');
	}

	public function delete() {
		if (!$this->request->is('post') && !$this->request->is('delete')) {
			$msg = "Urls::delete can only be called with http:post or http:delete.";
			throw new DispatchException($msg);
		}
		Urls::find($this->request->id)->delete();
		return $this->redirect('Urls::index');
	}
}

?>