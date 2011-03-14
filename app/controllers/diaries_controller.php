<?php

class DiariesController extends AppController {

	var $name = 'Diaries';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Diary->recursive = 0;
		$this->set('diaries', $this->paginate());
	}


	function add() {
		if (!empty($this->data)) {
			$this->Diary->create();
			if ($this->Diary->save($this->data)) {
				$this->Session->setFlash(__('The Diary has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Diary could not be saved. Please, try again.', true));
			}
		}
		$children = $this->Diary->Child->find('list');
		$themes = $this->Diary->Theme->find('list');
		$this->set(compact('children', 'themes'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Diary', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Diary->save($this->data)) {
				$this->Session->setFlash(__('The Diary has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Diary could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Diary->read(null, $id);
		}
		$children = $this->Diary->Child->find('list');
		$themes = $this->Diary->Theme->find('list');
		$this->set(compact('children','themes'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Diary', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Diary->del($id)) {
			$this->Session->setFlash(__('Diary deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Diary could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

        function checkPost($hash = null){
            //hashを確認し、データがなければリダイレクト
            if(empty($hash)){
                $this->Session->setFlash(__('不正操作です。', true));
                $this->redirect('/children/');
            }
            $this->Diary->contain('Present');
            $diaryData = $this->Diary->find('first', array('conditions'=>array('hash' => $hash)));
            if(empty($diaryData)){
                //再チェックボタン用にハッシュタグを設定
                $this->set('nexthash',$hash);
                //unknown
                $this->render('post_unknown');
                return;
            }
            pr ($diaryData);

            //投稿反映画面の表示文言を設定
            $this->_infoStr($diaryData);

        }

        function _infoStr($data){
            $typelist = array('壁紙','デコメ絵文字','待受けFLASH','ポストカード');
            $this->set('getStr',$typelist[$data['Present']['present_type']]);
            $this->set('presentId',$data['Present']['id']);
            

            
        }
        
}
?>
