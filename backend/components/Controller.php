<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	
	public $tab;
	
	private $_assetsBase;
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	public function getAssetsBase()
	{
			if ($this->_assetsBase === null) {
					$this->_assetsBase = Yii::app()->assetManager->publish(
							Yii::getPathOfAlias('application.assets'),
							false,
							-1,
							defined('YII_DEBUG') && YII_DEBUG
					);
			}
			return $this->_assetsBase;
	}
	
	public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'changePassword - error, login, logout, password, passwordVerify, recovery, changepassword',
        );
    }
	
	/**
     * Creates a rule to validate user's password freshness.
     * @return array the array of rules to validate against
     */
    public function changePasswordRules()
    {
        return array(
            'days' => 30,
        );
    }
 
    /**
     * Runs the Password filter
     * @param type $filterChain 
     */
    public function filterChangePassword($filterChain)
    {
        $filter = new ChangePasswordFilter();
        $filter->setRules($this->changePasswordRules());
        $filter->filter($filterChain);
    }
	
	public function behaviors()
    {
        return array(
            'eexcelview'=>array(
                'class'=>'ext.eexcelview.EExcelBehavior',
            ),
        );
    }
	
	public function accessRules()
    {
        return array(
			/*array('allow',
				'actions'=>array('view', 'index','download'),
				'controllers'=>array('log'),
                'roles'=>array('viewLog'),
            ),
			array('allow',
				'actions'=>array('view', 'index','admin'),
				'controllers'=>array('auditTrail'),
                'roles'=>array('viewAuditTrail'),
            ),
			array('allow',
				'actions'=>array('report'),
				'controllers'=>array('instrument'),
                'roles'=>array('viewInstrumentReport'),
            ),
			array('allow',
				'actions'=>array('create'),
				'controllers'=>array('instrument'),
                'roles'=>array('createInstrument'),
            ),
			array('allow',
				'actions'=>array('update','admin'),
				'controllers'=>array('instrument'),
                'roles'=>array('editInstrument'),
            ),
			array('allow',
				'actions'=>array('view', 'index'),
				'controllers'=>array('instrument'),
                'roles'=>array('viewInstrument'),
            ),
			array('allow',
				'actions'=>array('create'),
				'controllers'=>array('branch'),
                'roles'=>array('createBranch'),
            ),
			array('allow',
				'actions'=>array('update','admin'),
				'controllers'=>array('branch'),
                'roles'=>array('editBranch'),
            ),
			array('allow',
				'actions'=>array('view', 'index'),
				'controllers'=>array('branch'),
                'roles'=>array('viewBranch'),
            ),
			array('allow',
				'actions'=>array('create'),
				'controllers'=>array('authItem','role'),
                'roles'=>array('createPrivilege'),
            ),
			array('allow',
				'actions'=>array('update','admin','revoke','removeChild','addChild'),
				'controllers'=>array('authItem','role','assignment'),
                'roles'=>array('editPrivilege'),
            ),
			array('allow',
				'actions'=>array('view', 'index'),
				'controllers'=>array('assignment','authItem','role'),
                'roles'=>array('viewPrivilege'),
            ),
			array('allow',
				'actions'=>array('create'),
				'controllers'=>array('group'),
                'roles'=>array('createGroup'),
            ),
			array('allow',
				'actions'=>array('update','admin'),
				'controllers'=>array('group'),
                'roles'=>array('editGroup'),
            ),
			array('allow',
				'actions'=>array('view', 'index'),
				'controllers'=>array('group'),
                'roles'=>array('viewGroup'),
            ),
			array('allow',
				'actions'=>array('view', 'index'),
				'controllers'=>array('user','default'),
                'roles'=>array('viewUser'),
            ),
			array('allow',
				'actions'=>array('update','admin','view', 'index'),
				'controllers'=>array('admin'),
                'roles'=>array('editUser'),
            ),
			array('allow',
				'actions'=>array('create'),
				'controllers'=>array('admin'),
                'roles'=>array('createUser'),
            ),
			array('allow',
				'actions'=>array('index'),
				'controllers'=>array('site'),
                'users'=>array('*'),
            ),
			array('allow',
				'actions'=>array('error'),
				'controllers'=>array('site'),
                'users'=>array('*'),
            ),
			array('allow',
				'actions'=>array('recovery','changepassword'),
				'controllers'=>array('recovery'),
                'users'=>array('*'),
            ),	
			array('allow',
				'actions'=>array('changepassword'),
				'controllers'=>array('profile'),
                'roles'=>array('updatePassword'),
            ),	
			array('allow',
				'actions'=>array('view','profile'),
				'controllers'=>array('profile'),
                'users'=>array('*'),
            ),
			array('allow',
				'controllers'=>array('logout', 'login', 'activation'),
                'users'=>array('*'),
            ),*/		
            array('allow',
                'users'=>array('*'),
            ),
        );
    }
	
	public function startsWith($haystack, $needle)
	{
		return !strncmp($haystack, $needle, strlen($needle));
	}

	public function endsWith($haystack, $needle)
	{
		$length = strlen($needle);
		if ($length == 0) {
			return true;
		}

		return (substr($haystack, -$length) === $needle);
	}
}