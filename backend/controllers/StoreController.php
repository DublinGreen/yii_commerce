<?php

class StoreController extends CrudController {

	
	public $modelName = 'Store';
	
	public function actionView($id) {
		parent::view($id, $this->modelName);
	}

	public function actionCreate() {		
		$model = new Store;
		parent::create($model, $this->modelName, 'store-form');
	}

	public function actionUpdate($id) {
		parent::update($id, $this->modelName, 'store-form');
	}
	
	public function actionDelete($id) {
		parent::delete($id, $this->modelName);
	}
	
	public function actionBatchDelete() {
		parent::batchDelete($this->modelName);
	}
	
	public function actionExportSelected() {
		parent::exportSelected($this->modelName);
	}
	
	public function actionExportAll() {
		parent::exportAll($this->modelName);
	}

	public function actionIndex() {
		parent::index($this->modelName);
	}

	public function actionAdmin() {
		$model = new Store('search');
		parent::admin($model, $this->modelName);
	}
}