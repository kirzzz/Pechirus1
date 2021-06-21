<?php

namespace app\controllers;

use app\models\Basket;
use app\models\Brand;
use app\models\Catalog;
use app\models\Comments;
use app\models\Contact;
use app\models\CopyProduct;
use app\models\Log;
use app\models\MultiUnload;
use app\models\MultiUpload;
use app\models\Orders;
use app\models\Product;
use app\models\ProductToSteal;
use app\models\Provider;
use app\models\SetError;
use app\models\Shipment;
use app\models\Steal;
use app\models\UploadForm;
use app\models\UploadFormMulti;
use app\models\User;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use function Matrix\trace;

class AdminController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['basket','brands','catalogs','comments','contact','index',
                    'notifications','orders','orders-details','shipments','user-edit','users','products',
                    'product','provider','upload','multiupload','product-fast-edit','functions','massupload',
                    'compare-products','steal-dashboard','steal-product'
                ],
                'rules' => [
                    [
                        'actions' => ['basket','brands','catalogs','comments','contact','index',
                            'notifications','orders','orders-details','shipments','user-edit','users','products',
                            'product','provider','upload','multiupload','product-fast-edit','functions','massupload',
                            'compare-products','steal-dashboard','steal-product'
                        ],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
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

    public function beforeAction($action)
    {
        $this->layout = '@app/views/layouts/admin.php'; //your layout name
        try {
            return parent::beforeAction($action);
        } catch (BadRequestHttpException $e) {
        }
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $general_stat = ['orders'=>['sum'=>0,'count'=>0],'users'=>['count'=>0],'products'=>['count'=>0]];
        $general_stat['orders']['sum'] = (new \yii\db\Query())->from('orders')->where(['>','orders.status',Orders::STATUS_CANCELED])->sum('price');
        $general_stat['orders']['count'] = Orders::find()->count();
        $general_stat['users']['count'] = User::find()->count();
        $general_stat['products']['count'] = Product::find()->count();
        $table_product = [];
        $table_product_temp = Orders::find()->all();
        $json = [];
        if (Yii::$app->request->isGet) {
            $get = Yii::$app->request->get();
            if(isset($get['date'])){
                $dates = explode('—',$get['date']);
                if(count($dates)>1){
                    $general_stat['orders']['sum'] = (new \yii\db\Query())->from('orders')->where(['>','orders.status',Orders::STATUS_CANCELED])
                        ->andWhere(['between', "FROM_UNIXTIME(created_at,'%Y-%m-%d')", trim($dates[0]), trim($dates[1]) ])->sum('price');
                    $general_stat['orders']['count'] = Orders::find()->where(['between', "FROM_UNIXTIME(created_at,'%Y-%m-%d')", trim($dates[0]), trim($dates[1]) ])->count();
                    $general_stat['users']['count'] = User::find()->where(['between', "FROM_UNIXTIME(created_at,'%Y-%m-%d')", trim($dates[0]), trim($dates[1]) ])->count();
                    $general_stat['products']['count'] = Product::find()->where(['between', "FROM_UNIXTIME(created_at,'%Y-%m-%d')", trim($dates[0]), trim($dates[1]) ])->count();
                    $table_product_temp = Orders::find()->where(['between', "FROM_UNIXTIME(created_at,'%Y-%m-%d')", trim($dates[0]), trim($dates[1]) ])->all();
                }
            }
        }
        if(!empty($table_product_temp)){
            foreach ($table_product_temp as $temp){
                $temp = json_decode($temp['productInfo'],true);
                $temp_1 =  array_column($temp,'idProduct');
                foreach ($temp_1 as $temp_1_1){
                    if(isset($json[$temp_1_1])){
                        $json[$temp_1_1] += $temp[array_search($temp_1_1,array_column($temp,'idProduct'))]['count'];
                    }else{
                        $json[$temp_1_1] = $temp[array_search($temp_1_1,array_column($temp,'idProduct'))]['count'];
                    }
                }
            }
            if(!empty($json)){
                arsort($json,SORT_NUMERIC);
                $json = array_slice($json, 0, 5, true);
                $table_product = Product::find()->where(['in','id',array_keys($json)])->all();
            }
        }
        return $this->render('index',['general_stat'=>$general_stat,'table_product'=>$table_product,'json'=>$json]);
    }

    public function actionUsers()
    {
        $data = User::find()->where(['!=','role','admin'])->all();
        $user_get = $data[0];
        $user_info['count_orders'] = Orders::find()->where(['idUser'=>$user_get['id']])->count();
        $user_info['count_baskets'] = Basket::find()->where(['and',['idUser'=>$user_get['id']],['status'=>Basket::STATUS_ADD]])->count();
        $user_info['count_comments'] = Comments::find()->where(['idUser'=>$user_get['id']])->count();
        if (Yii::$app->request->isGet) {
            $get = Yii::$app->request->get();
            if(isset($get['id'])){
                $user_get = User::findIdentity($get['id']);
                $user_info['count_orders'] = Orders::find()->where(['idUser'=>$user_get['id']])->count();
                $user_info['count_baskets'] = Basket::find()->where(['and',['idUser'=>$user_get['id']],['status'=>Basket::STATUS_ADD]])->count();
                $user_info['count_comments'] = Comments::find()->where(['idUser'=>$user_get['id']])->count();
            }
        }
        return $this->render('users',['data'=>$data,'user_get'=>$user_get,'user_info'=>$user_info]);
    }

    public function actionProduct()
    {
        $model = new Product();

        $error = '';
        $errors = new SetError();

        if (Yii::$app->request->isGet) {
            $get = Yii::$app->request->get();
            if(isset($get['id'])){
                $model = Product::findOne(['id'=>Yii::$app->request->get('id')]);
                if(!isset($model->id)){
                    $model = new Product();
                    Yii::$app->session->setFlash('error', 'Не удалось найти продукт с данным идентификатором.');
                }
            }
        }

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if(isset($post['Product']['id'])){
                $model = Product::findOne(['id'=>$post['Product']['id']]);
            }
            if($model->load(Yii::$app->request->post()) and $model->save()){
                if(isset($post['Product']['id']))
                    Yii::$app->session->setFlash('success', 'Продукт "'.$model->name.'" успешно обновлен!');
                else
                    Yii::$app->session->setFlash('success', 'Новый продукт "'.$model->name.'" успешно создан!');
                return $this->redirect(['product','id' => $model->id]);
            }else{
                $errors->setError($model,$error);
            }
        }

        $data_brands = Brand::find()->orderBy(['name'=>SORT_ASC])->all();
        $data_catalog = Catalog::find()->orderBy(['name'=>SORT_ASC])->asArray()->all();

        return $this->render('product',['model'=>$model,'data_brands'=>$data_brands,'data_catalog'=>$data_catalog]);
    }

    public function actionUpload(){
        $file = new UploadForm();

        $error = '';
        $errors = new SetError();

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $file->load($_FILES);
            $file->imageFile = UploadedFile::getInstanceByName('imageFile');
            if ($name = $file->uploadProduct($post['id'])) {
                return $name;
            }else{
                return $errors->setError($file,$error,1);
            }
        }

        return false;
    }

    public function actionMultiupload(){
        $file = new MultiUpload();

        $error = '';
        $errors = new SetError();

        if (Yii::$app->request->isPost) {
            if($file->load(Yii::$app->request->post())){
                $file->excel = UploadedFile::getInstance($file, 'excel');
                if($file->upload()){
                    Yii::$app->session->setFlash('success','Успешно');
                }else{
                    $errors->setError($file,$error);
                }
            }
        }

        return $this->render('multiupload',['file'=>$file]);
    }

    public function actionMassupload(){
        $unload = new MultiUnload();
        $href = false;

        $file = new MultiUpload();
        $filename = false;

        $error = '';
        $errors = new SetError();

        if (Yii::$app->request->isPost) {
            if($unload->load(Yii::$app->request->post())){
                if(!($href = $unload->createExcel())){
                    $errors->setError($unload,$error);
                }
            }else{
                $errors->setError($unload,$error);
            }
            if($file->load(Yii::$app->request->post())){
                $file->excel = UploadedFile::getInstance($file, 'excel');
                if(!($filename = $file->upload())){
                    $errors->setError($file,$error);
                }
            }
        }

        return $this->render('massupload',['unload'=>$unload,'href'=>$href,'data_catalog'=>Catalog::find()->all(),'file'=>$file,'filename'=>$filename]);
    }

    public function actionProducts(){
        $query = Product::find()->where(['>','id',0]);
        $data_catalog = Catalog::find()->all();

        if (Yii::$app->request->isGet) {
            $get = Yii::$app->request->get();
            if(isset($get['data']) and trim($get['data']) != ''){
                $condition = ['or',
                    ['like','name',$get['data']],
                    ['like','price',$get['data']],
                    ['like','description',$get['data']],
                    ['like','property',$get['data']],
                    ['like','count',$get['data']],
                    ['like','article',$get['data']]
                ];
                $query->andWhere($condition);
            }
            if(isset($get['catalog']) and trim($get['catalog']) != ''){
                //$query->andWhere(['idCatalog'=>$get['catalog']]);
                $query->andWhere(['in','idCatalog',Catalog::getTreeDown($get['catalog'])]);
            }
            if(isset($get['order']) and trim($get['order']) !== ''){
                if($get['order'] == 1){
                    $query->andWhere(['idCatalog'=>$get['catalog']]);
                }elseif ($get['order'] == 2){
                    $query->orderBy(['price'=>SORT_DESC]);
                }elseif ($get['order'] == 3){
                    $query->orderBy(['price'=>SORT_ASC]);
                }elseif ($get['order'] == 4){
                    $query->andWhere(['in_stock'=>0]);
                }elseif ($get['order'] == 5){
                    $query->andWhere(['hidden'=>1]);
                }elseif ($get['order'] == 6){
                    $query->andWhere(['hidden'=>0])->andWhere(['in_stock'=>1]);
                }elseif ($get['order'] == 7){
                    $query->andWhere('new_price IS NOT NULL');
                }
            }
        }

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 16, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $data = $query->offset($pages->offset)->limit($pages->limit)->all();


        return $this->render('products',['data'=>$data,'data_catalog'=>$data_catalog,'pages'=>$pages]);
    }
    public function actionProductFastEdit(){
        $data = ['success'=>false];
        $error = new SetError();
        if(Yii::$app->request->isAjax){
            $post = Yii::$app->request->post();
            if(isset($post['id'])){
                $product = Product::find()->where(['id'=>$post['id']])->one();
                $product->price = (isset($post['data']['price']) and $post['data']['price'] !== '')?$post['data']['price']:$product->price;
                $product->in_stock = (isset($post['data']['in_stock']) and $post['data']['in_stock'] !== '')?$post['data']['in_stock']:$product->in_stock;
                $product->count = (isset($post['data']['count']) and $post['data']['count'] !== '')?$post['data']['count']:$product->count;
                $product->hidden = (isset($post['data']['hidden']) and $post['data']['hidden'] !== '')?$post['data']['hidden']:$product->hidden;
                $product->status = (isset($post['data']['status']) and $post['data']['status'] !== '')?$post['data']['status']:$product->status;
                if(!$product->save()){
                    $data['error'] = $error->setError($product,'',1);
                }else{
                    $data['success'] = true;
                    $data['text'] = 'Продукт '.$product->name.' успешно обновлен!';
                }
            }else{
                $data['error'] = 'Не удалось найти продукт с данным идентификатором';
            }
        }else{
            $data['error'] = 'Неверный формат запроса';
        }
        return json_encode($data,JSON_UNESCAPED_UNICODE);
    }

    public function actionFunctions(){
        $data = ['success'=>false,'text'=>''];
        $error = new SetError();
        if(Yii::$app->request->isAjax){
            $post = Yii::$app->request->post();
            $functions = ['catalog-show','steal-compare'];
            if(isset($post['function']) and in_array($post['function'],$functions)){
                if($post['function'] == 'catalog-show'){
                    if (isset($post['id'])) {
                        $catalogs = Catalog::getTreeDown($post['id']);
                        if (!empty($catalogs)) {
                            if (isset($post['visible'])) {
                                Product::updateAll(['hidden' => (int)$post['visible']], ['in', 'idCatalog', $catalogs]);
                                $data['success'] = true;
                                $data['text'] = 'Все продукты в выбранной Вами категории и дочерних - ' . (!(int)$post['visible'] ? "Открыты" : "Скрыты");
                            } else {
                                $data['error'] = 'Не удалось определить передаваемое действие';
                            }
                        } else {
                            $data['error'] = 'Не удалось построить дерево категорий.';
                        }
                    } else {
                        $data['error'] = 'Не удалось определить передаваемый идентификатор каталога';
                    }
                }elseif ($post['function'] == 'steal-compare'){
                    if(isset($post['id'])){
                        $compare = ProductToSteal::find()->where(['id'=>$post['id']])->one();
                        if(isset($compare->id)){
                            $product = Product::find()->where(['id'=>$compare->id_product])->one();
                            $steal = Steal::find()->where(['offerId'=>$compare->id_steal])->one();
                            if(isset($steal->id) and isset($product->id)){
                                $types = ['remove','options','description','all','remove-all','accept'];
                                if(isset($post['type']) and in_array($post['type'],$types)){
                                    if($post['type'] == 'remove'){
                                        ProductToSteal::updateAll(['status'=>ProductToSteal::STATUS_REJECTED],['id'=>$compare->id]);
                                        $data['success'] = true;
                                        $data['text'] = 'Данный продукт был успешно исключен из сравнения.';
                                        $data['data'] = ['color'=>'red','type'=>'one'];
                                    }
                                    if($post['type'] == 'remove-all'){
                                        ProductToSteal::updateAll(['status'=>ProductToSteal::STATUS_REJECTED],['id_product'=>$compare->id_product,'status'=>ProductToSteal::STATUS_NO_SOLUTION]);
                                        $data['success'] = true;
                                        $data['text'] = 'Данные продукты были успешно исключены из сравнения.';
                                        $data['data'] = ['color'=>'red','type'=>'all'];
                                    }
                                    if ($post['type'] == 'options' or $post['type'] == 'all'){
                                        $product->property = json_encode(["myrows" =>json_decode($steal->parameters,true)],JSON_UNESCAPED_UNICODE);
                                        if($product->save()){
                                            $data['success'] = true;
                                            $data['text'] .= 'Характеристики продукта были успешно обновлены.';
                                        }else{
                                            $data['error'] = 'Не удалось обновить характеристики продукта.'.SetError::setErrorST($product,'',1);
                                        }
                                    }
                                    if ($post['type'] == 'description' or $post['type'] == 'all'){
                                        $product->description = $steal->description;
                                        if($product->save()){
                                            $data['success'] = true;
                                            $data['text'] .= 'Описание продукта было успешно обновлено.';
                                        }else{
                                            $data['error'] = 'Не удалось обновить описание продукта.'.SetError::setErrorST($product,'',1);
                                        }
                                    }
                                    if($post['type'] == 'accept'){
                                        ProductToSteal::updateAll(['status'=>ProductToSteal::STATUS_ACCEPT],['id'=>$compare->id]);
                                        ProductToSteal::updateAll(['status'=>ProductToSteal::STATUS_REJECTED],['id_product'=>$product->id,'status'=>ProductToSteal::STATUS_NO_SOLUTION]);
                                        Steal::updateAll(['idProduct'=>$product->id],['offerId'=>$compare->id_steal]);
                                        $data['success'] = true;
                                        $data['data'] = ['color'=>'green','type'=>'one'];
                                        $data['text'] = 'Соответствие между продуктами успешно назначено!';
                                    }
                                }else{
                                    $data['error'] = 'Не удалось определить требуемое действие.';
                                }
                            }else{
                                $data['error'] = 'Не удалось найти продукт или сравниваемый продукт.';
                            }
                        }else{
                            $data['error'] = 'Не удалось найти сравнение по переданному идентификатору.';
                        }
                    }else{
                        $data['error'] = 'Не удалось определить передаваемый идентификатор сравнения.';
                    }
                }
            }else{
                $data['error'] = 'Не удалось определить заданную функцию';
            }
        }else{
            $data['error'] = 'Неверный формат запроса';
        }
        return json_encode($data,JSON_UNESCAPED_UNICODE);
    }

    public function actionProvider()
    {
        $model = new Provider();

        $error = '';
        $errors = new SetError();

        if(Yii::$app->request->isGet){
            $get = Yii::$app->request->get();
            if(isset($get['type']) and isset($get['id']) and $get['type'] == 'edit'){
                $model = Provider::findOne(['id'=>$get['id']]);
            }elseif (isset($get['type']) and isset($get['id']) and $get['type'] == 'delete'){
                $del = Provider::findOne(['id'=>$get['id']]);
                if(isset($del->id)){
                    Shipment::updateAll(['codeProvider'=>null],['codeProvider' => $del->codeProvider]);
                    $del->delete();
                    Yii::$app->session->setFlash('success', 'Каталог "'.$del->name.'" успешно удален! Все поставки с данным поставщиком были обновлены..');
                }
                $this->redirect(['provider']);
            }
        }

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if (isset($post['Provider']['id']))
                $model = Provider::findOne(['id'=>$post['Provider']['id']]);
            if($model->load(Yii::$app->request->post()) and $model->save()){
                Yii::$app->session->setFlash('success', 'Новый поставщик "'.$model->name.'" успешно создан!');
                return $this->redirect('provider');
            }else{
                $errors->setError($model,$error);
            }
        }

        $data = Provider::find()->orderBy(['name'=>SORT_ASC])->all();
        return $this->render('provider',['model'=>$model,'data'=>$data]);
    }

    public function actionUserEdit()
    {
        return $this->render('user-edit');
    }

    public function actionCatalogs()
    {
        $model = new Catalog();
        $file = new UploadForm();

        $error = '';

        if(Yii::$app->request->isGet){
            $get = Yii::$app->request->get();
            if(isset($get['type']) and isset($get['id']) and $get['type'] == 'edit'){
                $model = Catalog::findOne(['id'=>$get['id']]);
            }elseif (isset($get['type']) and isset($get['id']) and $get['type'] == 'delete'){
                $del = Catalog::findOne(['id'=>$get['id']]);
                if(isset($del->id)){
                    Catalog::updateAll(['idParent' => $del->idParent], ['idParent'=>$del->article]);
                    $del->delete();
                    Yii::$app->session->setFlash('success', 'Каталог "'.$del->name.'" успешно удален! Все дочерние каталоги присвоены родителю удаленного каталога.');
                }
                $this->redirect(['catalogs']);
            }
        }

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if(isset($post['Catalog']) and !isset($post['Catalog']['output'])){
                $file->imageFile = UploadedFile::getInstance($file, 'imageFile');
                if(isset($post['Catalog']['id']))
                    $model = Catalog::findOne(['id'=>$post['Catalog']['id']]);
                $article = isset($model->article)?$model->article:((new \yii\db\Query())->from('catalog')->max('article') + 1);
                $name = null;
                if(isset($model->img) and $file->imageFile != NULL and $model->img != $file->getPath($model->article)){
                    unlink(Yii::$app->basePath . '/web/'.$model->img);
                }
                if ($file->imageFile and !$name = $file->upload($article)) {
                    foreach ($file->getErrors() as $err) {
                        $error .= implode(';', $err) . '<br/>';
                    }
                    Yii::$app->session->setFlash('error', $error);
                }
                $model->img = $file->imageFile?$name:$model->img;
                $model->name = $post['Catalog']['name'];
                $model->status = $post['Catalog']['status'];
                $model->article = $article;
                if($model->save()){
                    if(isset($post['Catalog']['id']))
                        Yii::$app->session->setFlash('success', 'Каталог "'.$model->name.'" успешно обновлен!');
                    else
                        Yii::$app->session->setFlash('success', 'Новый каталог "'.$model->name.'" успешно создан! Теперь вы можете изменить его расположение в структуре каталога.');
                    return $this->redirect('catalogs');
                }else{
                    foreach ($model->getErrors() as $err) {
                        $error .= implode(';', $err) . '<br/>';
                    }
                    Yii::$app->session->setFlash('error', $error);
                }
            }elseif(isset($post['Catalog']['output'])){
                $catalogs = json_decode($post['Catalog']['output'],true);
                function catSave($arr,$parent=null,$par_status=false){
                    foreach ($arr as $index=>$val){
                        $cat = Catalog::findOne(['article'=>$val['id']]);
                        $cat->name = $val['name'];
                        $cat->status = $par_status===false?$val['status']:$par_status;
                        $cat->idParent = $parent;
                        if(!$cat->save()){
                            foreach ($cat->getErrors() as $err) {
                                $error .= implode(';', $err) . '<br/>';
                            }
                            Yii::$app->session->setFlash('error', $error);
                        }
                        if(isset($val['children'])){
                            catSave($val['children'],$val['id'],$cat->status==0?$cat->status:false);
                        }
                    }
                }
                catSave($catalogs);
                return $this->refresh();
            }
        }

        $data = Catalog::find()->orderBy(['name'=>SORT_ASC])->asArray()->all();

        return $this->render('catalogs',['data'=>$data,'model'=>$model,'file'=>$file]);
    }

    public function actionOrders()
    {
        $orders = Orders::find();
        if(Yii::$app->request->isGet){
            $get = Yii::$app->request->get();
            if(!empty($get)){
                if(!empty($get['status'])){
                    $orders = $orders->orWhere(['in','status',$get['status']]);
                }
                if(!empty($get['type_of_delivery'])){
                    $orders = $orders->orWhere(['in','typeOfDelivery',$get['type_of_delivery']]);
                }
                if(!empty($get['region_of_delivery'])){
                    $orders = $orders->orWhere(['in','regionOfDelivery',$get['region_of_delivery']]);
                }
            }
        }
        $orders = $orders->orderBy(['updated_at'=>SORT_DESC])->all();
        return $this->render('orders',['orders'=>$orders]);
    }
    public function actionOrdersDetails()
    {
        $order = null;
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if(isset($post['id']) and isset($post['status'])){
                Orders::updateAll(['status'=>$post['status']],['id' => $post['id']]);
            }
            return $this->redirect(['admin/orders-details','id'=>$post['id']]);
        }
        if(Yii::$app->request->isGet){
            $get = Yii::$app->request->get();
            if(isset($get['id'])){
                $order = Orders::find()->where(['id'=>$get['id']])->one();
            }
        }
        return $this->render('orders-details',['order'=>$order]);
    }
    public function actionShipments()
    {
        return $this->render('shipments');
    }
    public function actionBasket()
    {
        $data = Basket::find()->orderBy(['created_at'=>SORT_DESC])->where(['status'=>Basket::STATUS_ADD])->all();
        return $this->render('basket',['data'=>$data]);
    }
    public function actionBrands()
    {
        $model = new Brand();
        $file = new UploadForm();

        $error = '';
        $errors = new SetError();

        if(Yii::$app->request->isGet){
            $get = Yii::$app->request->get();
            if(isset($get['type']) and isset($get['id']) and $get['type'] == 'edit'){
                $model = Brand::findOne(['id'=>$get['id']]);
            }elseif (isset($get['type']) and isset($get['id']) and $get['type'] == 'delete'){
                $del = Brand::findOne(['id'=>$get['id']]);
                if(isset($del->id)){
                    Product::updateAll(['idBrand'=>null],['idBrand' => $del->id]);
                    $del->delete();
                    Yii::$app->session->setFlash('success', 'Брэнд "'.$del->name.'" успешно удален! Все продукты с данным брэндом были обновлены.');
                }
                $this->redirect(['brands']);
            }
        }

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if (isset($post['Brand'])) {
                $file->imageFile = UploadedFile::getInstance($file, 'imageFile');

                if (isset($post['Brand']['id']))
                    $model = Brand::findOne(['id' => $post['Brand']['id']]);

                $name = null;

                if (isset($model->img) and $file->imageFile != NULL and $model->img != $file->getPath($model->name))
                    unlink(Yii::$app->basePath . '/web/' . $model->img);

                if ($file->imageFile and !$name = $file->upload($post['Brand']['name']))
                    $errors->setError($file,$error);

                if($model->load($post)){
                    $model->img = $file->imageFile?$name:$model->img;
                    if ($model->save()) {
                        if (isset($post['Brand']['id']))
                            Yii::$app->session->setFlash('success', 'Брэнд "' . $model->name . '" успешно обновлен!');
                        else
                            Yii::$app->session->setFlash('success', 'Новый Брэнд "' . $model->name . '" успешно создан!');

                        return $this->redirect('brands');
                    } else {
                        $errors->setError($model,$error);
                    }
                }else {
                    $errors->setError($model,$error);
                }
            }
        }

        $data = Brand::find()->orderBy(['name'=>SORT_ASC])->all();

        return $this->render('brands',['data'=>$data,'model'=>$model,'file'=>$file]);
    }

    public function actionCompareProducts()
    {
        $query = ProductToSteal::find()
            ->select(['id_product'])
            ->where(['product_to_steal.status'=>ProductToSteal::STATUS_NO_SOLUTION])
            ->distinct();

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 1, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $data = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('compare-products',['compare'=>$data,'pages'=>$pages]);
    }

    public function actionStealDashboard()
    {
        $data = ['top'=>[],'chart'=>[]];
        $data['top']['count-steal'] = Steal::find()->count();
        $data['top']['count-compare'] = Steal::find()->where(['not',['idProduct'=>null]])->count();
        $data['top']['count-site'] = Steal::find()->select(['siteName'])->distinct()->count();
        $data['top']['count-site-target'] = 10;
        $data['top']['steal-price-avg'] = Steal::find()->select(['price'])->where(['not',['idProduct'=>null]])->average('price');
        $data['top']['my-price-avg'] = Product::find()->select(['price'])->where(['in','id',Steal::comparesProductId()])->average('price');
        return $this->render('steal-dashboard',['data'=>$data]);
    }

    public function actionStealProduct()
    {
        $model = new CopyProduct();

        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if($model->load($post) and isset($model->steal_id)){
                if(isset($post['copy'])){
                    if($model->validate() and ($id = $model->addProduct())){
                        Yii::$app->session->setFlash('success','Продукт успешно скопирован в наш каталог!<br><a href="'.Url::toRoute(['site/product','id'=>$id]).'">Страница продукта</a>');
                    }else{
                        SetError::setErrorST($model,'#1003: Непредвиденная ошибка! Пожалуйста, свяжитесь с администратором сайта! <br> Запомните код ошибки в начале сообщения!');
                    }
                }elseif (isset($post['remove'])){
                    Steal::updateAll(['idProduct'=>-1],['id'=>$model->steal_id]);
                }else{
                    Yii::$app->session->setFlash('error','#1002: Непредвиденная ошибка! Пожалуйста, свяжитесь с администратором сайта! <br> Запомните код ошибки в начале сообщения!');
                }

            }else{
                Yii::$app->session->setFlash('error','#1001: Непредвиденная ошибка! Пожалуйста, свяжитесь с администратором сайта! <br> Запомните код ошибки в начале сообщения!');
            }
            $model = new CopyProduct();
        }

        $brand = "ВЕЗУВИЙ";
        $query = Steal::find()->where(['idProduct'=>null])->andWhere('JSON_CONTAINS(parameters,\'{"value" : "'.$brand.'"}\',\'$\')');

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 1, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $steal = $query->offset($pages->offset)->limit($pages->limit)->one();

        $model->steal_id = $steal->id;
        $model->id_brand = (Brand::find()->where("lower(name) like lower('%".$brand."%')")->one())->id;
        $model->price = $steal->price;
        $model->in_stock = true;
        $model->hidden = true;
        $model->id_catalog = '';

        return $this->render('steal-product',['steal'=>$steal,'pages'=>$pages,'model'=>$model]);
    }

    public function actionComments()
    {
        $comments = Comments::find()->orderBy(['created_at'=>SORT_DESC])->all();
        return $this->render('comments',['comments'=>$comments]);
    }
    public function actionContact()
    {
        $contacts = Contact::find()->orderBy(['created_at'=>SORT_DESC])->all();
        return $this->render('contact',['contacts'=>$contacts]);
    }
    public function actionNotifications()
    {
        $data = Log::find()->where(['in','type',[Log::TYPE_COMMENTS,Log::TYPE_USER,Log::TYPE_ORDERS,Log::TYPE_CONTACT]])->orderBy(['created_at'=>SORT_DESC])->all();
        return $this->render('notifications',['data'=>$data]);
    }
}
