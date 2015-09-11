<?php

namespace modules\sitemap\backend\controllers;

use Yii;
use yii\base\Model;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/* MODELS */
use common\models\Option;
use common\models\PostType;
use common\models\Taxonomy;

/**
 * Class DefaultController
 *
 * @package modules\sitemap\backend\controllers
 * @author  Agiel K. Saputra <13nightevil@gmail.com>
 * @since   1.0
 */
class DefaultController extends Controller
{
    private $_defaultOption = [];

    private $_optionName = 'sitemap';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'install'],
                        'allow'   => true,
                        'roles'   => ['administrator']
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete'      => ['post'],
                    'bulk-action' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Render option form for sitemap in backend.
     *
     * @return string
     */
    public function actionIndex()
    {
        $option = Option::get($this->_optionName);

        if (!$option) {
            return $this->redirect(['install']);
        }

        $postTypes = PostType::find()->all();
        $taxonomies = Taxonomy::find()->all();

        if( $post = Yii::$app->request->post('Option')) {
            if( Option::set( $this->_optionName, $post['option_value']) ){
                return $this->redirect(['index']);
            }
        }


        return $this->render('index', [
            'option'     => $option,
            'postTypes'  => $postTypes,
            'taxonomies' => $taxonomies,
        ]);
    }

    /**
     * Install sitemap by default option.
     */
    public function actionInstall()
    {
        if (Option::set('sitemap', $this->_defaultOption)) {
            $this->redirect(['index']);
        }
    }

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        /*  @var $postType \common\models\PostType */
        /*  @var $taxonomy \common\models\Taxonomy */
        if (parent::beforeAction($action)) {

            $this->_defaultOption['enable_sitemap'] = 1;
            $this->_defaultOption['entries_per_page'] = 1000;

            // Home
            $this->_defaultOption['home'] = [
                'priority'   => '1.0',
                'changefreq' => 'daily'
            ];

            // Post type default option
            foreach (PostType::find()->all() as $postType) {
                $this->_defaultOption['post_type'][ $postType->id ] = [
                    'enable'     => 1,
                    'priority'   => '0.6',
                    'changefreq' => 'weekly'
                ];
            }

            // Taxonomy default option
            foreach (Taxonomy::find()->all() as $taxonomy) {
                $this->_defaultOption['taxonomy'][ $taxonomy->id ] = [
                    'enable'     => 1,
                    'priority'   => '0.2',
                    'changefreq' => 'weekly'
                ];
            }

            // Media default option
            $this->_defaultOption['media'] = [
                'enable'     => 0,
                'priority'   => '0.2',
                'changefreq' => 'monthly'
            ];

            return true;
        }

        return false;
    }
}
