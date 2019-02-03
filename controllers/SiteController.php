<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\City;
use app\models\Country;
use app\models\Directions;
use yii\helpers\ArrayHelper;
use yii\httpclient\Client;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $cityModel = new City();
        $sql = 'Select DISTINCT c.id,c.name From city as c LEFT JOIN directions as d ON c.name = d.loc_from WHERE d.loc_from IS NOT NULL';
        $cities = City::findbySql($sql)->all();
        $citiesList = ArrayHelper::map($cities,'id','name');

        $nights = array();
        $i = 5;
        while($i < 16){
            $nights[] = $i;
            $i++;
        }

        return $this->render('index',[
            'cityM' => $cityModel,
            'cities' => $citiesList,
            'nights' => $nights
        ]);
    }

    public function actionTour(){
        if(yii::$app->request->isAjax){
            $input = yii::$app->request->post();
            list($day,$month,$year) = explode(" ",$input['date']);
            $date = $year.'-'.$month.'-'.$day;
            $out = array();

            $out[] = self::tours_get($input,$date);
            $out[] = self::tours_post($input,$date);

            return join("\n",$out);
        }
    }

    function tours_get($input,$date){
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('https://poedem.kz/test/search/partner1')
            ->setData([
                'departCity'=>$input['city'],
                'country'=>$input['country'],
                'date'=>$date,
                'nights'=>$input['nights']
            ])
            ->send();
        if($response->isOk){
            return $this->renderPartial('response_get',[
                'title' => 'Get - запрос',
                'tours' => $response->data['tours']
            ]);
        }

        return false;
    }

    function tours_post($input,$date){
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl('https://poedem.kz/test/search/partner2')
            ->setData([
                'cityId'=>$input['city'],
                'countryId'=>$input['country'],
                'dateFrom'=>$date,
                'nights'=>$input['nights']
            ])
            ->send();
        if($response->isOk){
            return $this->renderPartial('response_post',[
                'title' => 'POST - запрос',
                'tours' => $response->data['tours']['item']
            ]);
        }

        return false;
    }
}
