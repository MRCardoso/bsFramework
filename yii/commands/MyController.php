<?php
namespace app\commands;

use app\models\User;
use Yii;
use yii\base\ErrorException;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\ErrorAction;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

abstract class MyController extends Controller
{
    /**
     * define the model layer
     * @var
     */
    protected $_model;
    /**
     * @var array
     */
    protected $_params = [];

    private $_actionNoAuth = ['signin', 'signup'];
    private $_baseActionAuth = ['index', 'create', 'update', 'view', 'delete'];
    protected $_freeActions = ['index'];

    public function beforeAction($event)
    {
        if( !$this->validatePermission($event->controller->action->id) )
            throw new HttpException(403, t("the user don't has permission to access this interface"));
        return parent::beforeAction($event);
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => $this->_actionNoAuth,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => array_merge($this->_baseActionAuth, $this->_freeActions),
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    /**
     * Lists all Model class.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = $this->_model->search(Yii::$app->request->get());
        return $this->render('index', [
            'searchModel' => $this->_model,
            'dataProvider' => $dataProvider
        ]);
    }
    /**
     * Creates a new Model class.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string|\yii\web\Response
     * @throws HttpException
     */
    public function actionCreate()
    {
        $this->_model->status = User::ACTIVE;
        return $this->save($this->_model);
    }
    /**
     * Updates an existing Model class.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param $id
     * @return string|\yii\web\Response
     * @throws HttpException
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        return $this->save($this->findModel($id));
    }

    /**
     * run the create or update of one record
     *
     * @param $model
     * @return string|\yii\web\Response
     */
    private function save($model)
    {
        $model->setScenario('save');

        $action = t($model->isNewRecord?'create':'updated_at');

        if ( $model->load(Yii::$app->request->post()) )
        {

            if( permission($model,"interface") )
            {
                if( $model->save() )
                {
                    msf('success', $action);
                    return $this->redirect(['view', 'id' => $model->id]);
                }
                else
                {
                    msf('error', $action);
                }
            }
            else
            {
                msf('exception403');
            }
        }
        return $this->render('save', [ 'model' => $model, 'params' => $this->_params ]);
    }

    /**
     * Deletes an existing Model class.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if( $this->findModel($id)->delete() )
            msf('success', t('removed'));
        else
            msf('error', t('removed'));

        return $this->redirect(['index']);
    }
    /**
     * Displays a single Model class.
     *
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [ 'model' => $this->findModel($id) ]);
    }

    /**
     * Finds the Client model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = $this->_model->findOne($id)) !== null)
            return $model;
        else
            throw new NotFoundHttpException(t('The requested page does not exist.'));
    }
    private function validatePermission($action)
    {
        $model = NULL;
        if( ($id =  Yii::$app->request->get('id') ) != NULL )
            $model = $this->findModel($id);

        return permission($model, "interface", in_array($action, $this->_freeActions) );
    }
}