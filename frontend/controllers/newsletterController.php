
<?php

exit("Hello");

class AddNewsletter extends CrudController {
	public $current;
	public $currentLink = 'all';
	
	public function actionLogin(){
		$model = new LoginForm;
		$form = new CForm('application.views.site.loginForm', $model);
		if($form->submitted('login') && $form->validate())
			$this->redirect(array('site/index'));
		else
			$this->render('login', array('form'=>$form));
	}
 
}
?>