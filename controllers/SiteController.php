<?php

namespace app\controllers;

use app\models\Basket;
use app\models\Brand;
use app\models\Catalog;
use app\models\ChangePassword;
use app\models\Comments;
use app\models\Compare;
use app\models\Contact;
use app\models\LoginForm;
use app\models\Orders;
use app\models\Product;
use app\models\SetError;
use app\models\SignUpForm;
use app\models\User;
use app\models\Wishlist;
use app\models\YandexMarket;
use Yii;
use yii\data\Pagination;
use yii\db\Expression;
use yii\db\Query;
use yii\debug\panels\EventPanel;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

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
                'only' => [
                    'about-us','calculator','contact','index','list','login',
                    'logout','password-reset','password-confirm','product','stock',
                    'error','payment-and-delivery','basket-mini','basket-mini-remove','basket','order','order-complete','user','confirm'
                    ,'order-remove','order-tracking', 'compare','wishlist'],
                'rules' => [
                    [
                        'actions' => [
                            'about-us','calculator','contact','index','list','login',
                            'password-reset','password-confirm','logout','product','stock',
                            'error','payment-and-delivery','basket-mini','basket-mini-remove','basket','order','order-complete','confirm','order-tracking',
                            'compare','wishlist'],
                        'allow' => true,
                        'roles' => ['?','user','admin'],
                    ],[
                        'actions' => ['user','order-remove'],
                        'allow' => true,
                        'roles' => ['user','admin'],
                    ]
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
        $brands = Brand::find()->limit(12)->all();
        $query = new Query;
        $query->select('catalog.name, catalog.id, COUNT(product.id)')
            ->from('catalog')
            ->leftJoin('product','idCatalog = catalog.id')
            ->where(['product.hidden'=>0])
            ->andWhere(['product.in_stock'=>1])
            ->andWhere(['catalog.status'=>Catalog::STATUS_ACTIVE])
            ->orderBy('COUNT(product.id) DESC')
            ->groupBy("catalog.id")
            ->limit(12);
        $category = $query->all();
        $products[0] = Product::findPopular();
        $products[1] = Product::findPopular('камины');
        $products[2] = Product::findPopular("тандыры");
        $products[3] = Product::findPopular("котлы");
        $products[4] = Product::findPopular("печи");
        return $this->render('index',['brands'=>$brands,'category'=>$category,'products'=>$products]);
    }

    public function actionUser()
    {
        $role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
        if(isset($role['admin']))
            return $this->redirect(['admin/index']);

        $user = User::findIdentity(Yii::$app->user->id);
        $orders = Orders::find()->where(['idUser'=>Yii::$app->user->id])->all();
        $pass = new ChangePassword(['scenario' => ChangePassword::SCENARIO_RESET]);
        $error = new SetError();

        if(Yii::$app->request->isPost){
            if($user->load(Yii::$app->request->post()) and $user->validate()){
                $user->save();
            }elseif($user->load(Yii::$app->request->post())){
                $error->setError($user,'');
            }
            if($pass->load(Yii::$app->request->post()) and $pass->change()){
                Yii::$app->session->setFlash('success','Пароль Успешно изменен');
            }elseif($pass->load(Yii::$app->request->post())){
                $error->setError($pass,'');
            }
            return $this->refresh();
        }

        return $this->render('user',['user'=>$user,'orders'=>$orders,'pass'=>$pass]);
    }

    public function actionAboutUs()
    {
        return $this->render('about-us');
    }

    public function actionCalculator()
    {
        return $this->render('calculator');
    }

    public function actionContact()
    {
        $contact = new Contact();
        if($contact->load(Yii::$app->request->post()) and $contact->save()){
            Yii::$app->session->setFlash('success','Ваша сообщение отправлено. Мы свяжемся с вами вближайшее время.');
            return $this->refresh();
        }
        return $this->render('contact',['contact'=>$contact]);
    }

    public function actionList()
    {
        $catalogs = Catalog::find()->where(['status'=>Catalog::STATUS_ACTIVE])->asArray()->all();//TODO Доделать вывод популярных товаров
        $products = Product::find()->where(['>','product.id','0'])->andWhere(['hidden'=>0]);
        if(Yii::$app->request->isGet){
            $get = Yii::$app->request->get();
            if(isset($get['main-data']) or isset($get['data'])){
                $condition = ['or',
                    ['like','product.name',$get['main-data']],
                    ['like','product.price',$get['main-data']],
                    ['like','product.property',$get['main-data']],
                    ['like','product.description',$get['main-data']],
                    ['like','product.article',$get['main-data']],
                    ['like','catalog.name',$get['main-data']],
                ];
                $products = $products->joinWith('catalog')->andWhere($condition);
            }
            if(isset($get['catalog'])){
                $catalog_find = Catalog::find()->where(['id'=>$get['catalog']])->andWhere(['status'=>Catalog::STATUS_ACTIVE])->one();
                if(isset($catalog_find->id)){
                    //$catalog_arr = Catalog::getTreeDown($catalog_find->id);
                    $products = $products->andWhere(['in','idCatalog',Catalog::getTreeDown($catalog_find->id)]);
                }
            }
            if(isset($get['brand'])){
                $products = $products->andWhere(['in','idBrand',$get['brand']]);
            }
            if(isset($get['price'])){
                $products = $products->orderBy(['price'=>$get['price']=='ASC'?SORT_ASC:SORT_DESC]);
            }
        }else{
            $products = Product::find()->where(['hidden'=>0])->andWhere(['in_stock'=>1])->joinWith('stat')->orderBy(['yandex_product_stat.clicks'=>SORT_DESC]);
        }
        $brands = Brand::find()->all();
        $countQuery = clone $products;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 36, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $products->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('list',['catalogs'=>$catalogs,'products'=>$products,'pages'=>$pages,'brands'=>$brands]);
    }

    public function actionProduct()
    {
        $comment = new Comments(['scenario' => (Yii::$app->user->isGuest?Comments::SCENARIO_NOT_AUTHORIZED:Comments::SCENARIO_AUTHORIZED)]);
        $error = new SetError();

        if(Yii::$app->request->isPost and $comment->load(Yii::$app->request->post())){
            $comment->idUser = !Yii::$app->user->isGuest?Yii::$app->user->id:null;
            if(!$comment->save()){
                $error->setError($comment,'');
            }
            return $this->refresh();
        }
        if(Yii::$app->request->isGet){
            $get = Yii::$app->request->get();
            $product = Product::find()->where(['id'=>$get['id']])->with(['comments'])->one();
            if(isset($product->id))
                return $this->render('product',['product'=>$product,'comment'=>$comment]);
        }

        return $this->render('error', ['name'=>'Продукт не найден','exception' => 404,'message'=>'Не удалось найти продукт с данным идентификатором']);
    }

    public function actionCompare(){
        $data = [];
        $products = [];
        if(!Yii::$app->user->isGuest){
            $data = Compare::find()->where(['idUser'=>Yii::$app->user->id])->andWhere(['status'=>Compare::STATUS_ADD])->all();
        }else{
            $session = Yii::$app->session;
            if(!$session->isActive)
                $session->open();
            if (!$session->has('compare'))
                $session->set('compare', $data);
            else
                $data = $session->get('compare');
        }
        if(!empty($data)){
            $products = Product::find()->where(['in','id',array_column($data,'idProduct')])->all();
        }
        return $this->render('compare',['data'=>$data,'products'=>$products]);
    }

    public function actionWishlist(){
        $data = [];
        $products = [];
        if(!Yii::$app->user->isGuest){
            $data = Wishlist::find()->where(['idUser'=>Yii::$app->user->id])->andWhere(['status'=>Compare::STATUS_ADD])->all();
        }else{
            $session = Yii::$app->session;
            if(!$session->isActive)
                $session->open();
            if (!$session->has('wishlist'))
                $session->set('wishlist', $data);
            else
                $data = $session->get('wishlist');
        }
        if(!empty($data)){
            $products = Product::find()->where(['in','id',array_column($data,'idProduct')])->all();
        }
        return $this->render('wishlist',['products'=>$products]);
    }

    public function actionBasket()
    {
        $basket = [];
        $products = [];

        if(Yii::$app->request->isPost){
            $get = Yii::$app->request->get();
            $post = Yii::$app->request->post();
            if(isset($post['Basket'])){
                if(Yii::$app->user->isGuest){
                    $session = Yii::$app->session;
                    if(!$session->isActive)
                        $session->open();
                    if ($session->has('basket') and !empty($basket = $session->get('basket'))){
                        $session->remove('basket');
                    }else{
                        $session->set('basket',[]);
                    }
                    $basket = [];
                }else{
                    Basket::updateAll(['status'=>Basket::STATUS_REMOVE],['idUser'=>Yii::$app->user->id,'status'=>Basket::STATUS_ADD]);
                }
                if(isset($post['Basket']['product_id'])){
                    foreach ($post['Basket']['product_id'] as $index => $product){
                        if(!Yii::$app->user->isGuest){
                            $new_basket = new Basket();
                            $new_basket->idUser = Yii::$app->user->id;
                            $new_basket->idProduct = $product;
                            $new_basket->count  = $post['Basket']['count'][$index];
                            $new_basket->save();
                        }else{
                            $basket[] = ["idProduct"=>$product,"count"=>$post['Basket']['count'][$index]];
                            $session->set('basket',$basket);
                        }
                    }
                }
                if($get['type'] == 'order'){
                    return $this->redirect(['site/order']);
                }
            }
        }
        if(!Yii::$app->user->isGuest){
            $basket = Basket::find()->where(['idUser'=>Yii::$app->user->id])->andWhere(['status'=>Basket::STATUS_ADD])->all();
            if(!empty($basket)){
                $products = Product::find()->where(['in','id',array_column($basket,'idProduct')])->all();
            }
        }else{
            $session = Yii::$app->session;
            if(!$session->isActive)
                $session->open();
            if (!$session->has('basket'))
                $session->set('basket', $basket);
            else
                $basket = $session->get('basket');
            if(!empty($basket)){
                $products = Product::find()->where(['in','id',array_column($basket,'idProduct')])->all();
            }
        }
        return $this->render('basket',['products'=>$products,'basket'=>$basket]);
    }

    public function actionOrder()
    {
        $total_price = 0;

        $login = new LoginForm();
        $sign_up = new SignUpForm();
        $order = new Orders();

        $error = new SetError();

        $basket = [];

        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if(Yii::$app->user->isGuest){
                $order->type = 0;
                if ($login->load(Yii::$app->request->post())) {
                    if($login->login()){
                        $user = User::findIdentity(Yii::$app->user->id);
                    }else{
                        $error->setError($order,'');
                    }
                } elseif($sign_up->load(Yii::$app->request->post())) {
                    $sign_up->username = strstr($sign_up->email,'@',true);
                    $sign_up->password = md5(Yii::$app->security->generateRandomString());
                    $user = $sign_up->signup(SignUpForm::SIGN_ORDER);
                    if(isset($user->id)){
                        $auth = Yii::$app->authManager;
                        $role = $auth->getRole('user');
                        $auth->assign($role, $user->id);
                        Yii::$app->user->login(User::findIdentity($user->id), 3600 * 24 * 30);
                    }else{
                        $error->setError($sign_up,'');
                    }
                }
            }else{
                $user = User::findIdentity(Yii::$app->user->id);
            }
            if(isset($user->id) and $order->load(Yii::$app->request->post())){
                $order->idUser = $user->id;
                if($order->save()){
                    if(!$order->type)
                        Yii::$app->session->remove('basket');
                    else
                        Basket::updateAll(['status'=>Basket::STATUS_REMOVE],['idUser'=>$user->id]);
                    if(isset($post['save'])){
                        $user->address = $order->address;
                        $user->name = $order->name;
                        $user->surname = $order->surname;
                        $user->tel = $order->tel;
                        $user->save();
                    }
                    if(!$order->type){
                        Yii::$app->session->setFlash('success','Ваш заказ успешно оформлен!<br> Для его активации нужно подтвердить аккаунт.<br> Вы можете это сделть с помощью письма отправленного на вашу почту '. $user->email);
                    }
                    return $this->redirect(['site/order-complete','id'=>$order->id]);
                }else{
                    $error->setError($order,'');
                }
            }else{
                $error->setError($order,'');
            }
        }
        if(Yii::$app->request->isGet){
            $get = Yii::$app->request->get();
            if(isset($get['id'])){
                if(!Yii::$app->user->isGuest){
                    $basket = Basket::find()->where(['idUser'=>Yii::$app->user->id])->andWhere(['status'=>Basket::STATUS_ADD])->andWhere(['idProduct'=>$get['id']])->one();
                    if(isset($basket['id'])){
                        Basket::updateAll(['count'=>new Expression('`count` + '.(isset($get['count'])?$get['count']:1))],['idUser'=>Yii::$app->user->id,'status'=>Basket::STATUS_ADD,'idProduct'=>$get['id']]);
                    }else{
                        (new Basket(['idProduct' => $get['id'],'count' => isset($get['count'])?$get['count']:1,'idUser' => Yii::$app->user->id]))->save();
                    }
                }else{
                    $session = Yii::$app->session;
                    if(!$session->isActive)
                        $session->open();
                    if (!$session->has('basket'))
                        $session->set('basket', $basket);
                    else
                        $basket = $session->get('basket');
                    if(in_array($get['id'],array_column($basket,'idProduct'))){
                        $basket[array_search($get['id'],array_column($basket,'idProduct'))]['count'] += isset($get['count'])?$get['count']:1;
                    }else{
                        $basket[] = ["idProduct"=>$get['id'],"count"=>isset($get['count'])?$get['count']:1];
                    }
                    $session->set('basket', $basket);
                }
            }
        }
        if(!Yii::$app->user->isGuest){
            $basket = Basket::find()->where(['idUser'=>Yii::$app->user->id])->andWhere(['status'=>Basket::STATUS_ADD])->all();
        }else{
            $session = Yii::$app->session;
            if(!$session->isActive)
                $session->open();
            if (!$session->has('basket'))
                $session->set('basket', $basket);
            else
                $basket = $session->get('basket');
        }
        if(!empty($basket)){
            $products = Product::find()->where(['in','id',array_column($basket,'idProduct')])->all();
            foreach ($basket as $back){
                $total_price += $back['count'] * $products[array_search($back['idProduct'],array_column($products,'id'))]['price'];
            }
        }
        return $this->render('order',['total_price'=>$total_price,'login'=>$login,'sign_up'=>$sign_up,'order'=>$order]);
    }

    public function actionOrderComplete()
    {
        if(Yii::$app->request->isGet){
            $get = Yii::$app->request->get();
            if(isset($get['id'])){
                $order = Orders::find()->where(['id'=>$get['id']])->one();
                return $this->render('order-complete',['order'=>$order]);
            }
        }elseif (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if(isset($post['id']) and isset($post['email'])){
                $user = User::findByEmail($post['email']);
                if(isset($user->id)){
                    $order = Orders::find()->where(['article'=>$post['id']])->andWhere(['idUser'=>$user->id])->one();
                    if(isset($order->id)){
                        return $this->render('order-complete',['order'=>$order]);
                    }
                }
            }
        }
        return $this->render('error', ['name'=>'Заказ не найден','exception' => 404,'message'=>'Не удалось найти заказ по указанным данным']);
    }

    public function actionOrderTracking()
    {
        return $this->render('order-tracking');
    }

    public function actionOrderRemove()
    {
        $data = ['success'=>true];
        $data['text'] = 'Не удалось получить данные о заказе :(';
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if(isset($post['id'])){
                $order = Orders::find()->where(['id'=>$post['id']])->one();
                if(isset($order->id)){
                    if($order->status < Orders::STATUS_ACTIVE){
                        Orders::updateAll(['status'=>Orders::STATUS_CANCELED],['id'=>$post['id'],'idUser'=>Yii::$app->user->id]);
                        $data['text'] = 'Заказ отменен';
                    }else{
                        $data['text'] = 'Не удалось отменить заказ, так как он уже является активным. Если вы настаиваете на его отмене, пожалуйста, свяжитесь с нами.';
                        return json_encode($data,JSON_UNESCAPED_UNICODE);
                    }
                }else{
                    $data['text'] = 'Не удалось получить данные о заказе 1 :(';
                }
            }
        }
        return json_encode($data,JSON_UNESCAPED_UNICODE);
    }

    public function actionBasketMini()
    {
        if(Yii::$app->request->isPost){
            $data = ['success'=>false];
            $post = Yii::$app->request->post();
            $product = Product::find()->where(['id'=>$post['id']])->one();
            if(isset($product['id']) and isset($post['type'])){
                if(!Yii::$app->user->isGuest){
                    if($post['type'] == 'basket')
                        (new Basket(['idUser' => Yii::$app->user->id,'count' => 1,'idProduct' => $product->id]))->save();
                    elseif ($post['type'] == 'wishlist')
                        (new Wishlist(['idUser' => Yii::$app->user->id,'idProduct' => $product->id]))->save();
                    elseif ($post['type'] == 'compare')
                        (new Compare(['idUser' => Yii::$app->user->id,'idProduct' => $product->id]))->save();
                }else{
                    $session = Yii::$app->session;
                    if(!$session->isActive)
                        $session->open();
                    $basket = [];
                    if (!$session->has($post['type']))
                        $session->set($post['type'], $basket);
                    else
                        $basket = $session->get($post['type']);
                    if(($key = array_search($post['id'],array_column($basket,'idProduct'))) !== FALSE and $post['type']=='basket'){
                        $basket[array_keys($basket)[$key]]['count'] += 1;
                    }else{
                        $basket[] = $post['type']=='basket'?["idProduct"=>$product['id'],"count"=>1]:["idProduct"=>$product['id']];
                    }
                    $session->set($post['type'], $basket);
                }
                if($post['type']=='basket'){
                    $data['data'] = '<li class="single-product-cart">
                        <div class="cart-img"><a href="#"><img src="/'.($product->img !== '[]'?json_decode($product->img,true)[0]['path']:"images/default/no-image.png").'" alt=""></a></div>
                        <div class="cart-title"><h4><a href="#">'.$product->name.'</a></h4><span>&#8381; '. ($product->new_price?$product->new_price:$product->price) .'</span></div>
                        <div class="cart-delete"><a href="#" data-basket-mini-delete="'.$product->id.'" data-basket-mini-type="basket">×</a></div>
                    </li>';
                    $data['price'] = ($product->new_price?$product->new_price:$product->price);
                }
                $data['success'] = true;
                $data['product'] = ['data'=>$product->toArray(['article','price','name']),'brand'=>$product->getBrandName(),'category'=>$product->getCatalogName()];
            }else{
                $data['error'] = 'Не удалось получить данные о продукте :(';
            }
            return json_encode($data);
        }
    }

    public function actionBasketMiniRemove(){
        if(Yii::$app->request->isPost){
            $data = ['success'=>false];
            $post = Yii::$app->request->post();
            if(isset($post['id']) and isset($post['type'])){
                if(!Yii::$app->user->isGuest){
                    if($post['type'] == 'basket')
                        Basket::updateAll(['status'=>Basket::STATUS_REMOVE],['idProduct'=>$post['id'],'idUser'=>Yii::$app->user->id]);
                    elseif ($post['type'] == 'wishlist')
                        Wishlist::updateAll(['status'=>Wishlist::STATUS_REMOVE],['idProduct'=>$post['id'],'idUser'=>Yii::$app->user->id]);
                    elseif ($post['type'] == 'compare')
                        Compare::updateAll(['status'=>Compare::STATUS_REMOVE],['idProduct'=>$post['id'],'idUser'=>Yii::$app->user->id]);
                }else{
                    $session = Yii::$app->session;
                    $basket = $session->get($post['type']);
                    if(($key = array_search($post['id'],array_column($basket,'idProduct'))) !== FALSE){
                        unset($basket[array_keys($basket)[$key]]);
                        $session->set($post['type'], $basket);
                    }else{
                        $data['error'] = 'Не удалить элемент из корзины, системная ошибка :(';
                        return json_encode($data);
                    }
                }
                if($post['type'] == 'basket'){
                    $product = Product::find()->where(['id'=>$post['id']])->one();
                    $data['price'] = ($product->new_price?$product->new_price:$product->price);
                    $data['product'] = ['data'=>$product->toArray(['article','price','name']),'brand'=>$product->getBrandName(),'category'=>$product->getCatalogName()];
                }
                $data['success'] = true;
            }else{
                $data['error'] = 'Не удалось получить данные о продукте :(';
            }
            return json_encode($data);
        }
    }

    public function actionStock()
    {
        return $this->render('stock');
    }

    public function actionPaymentAndDelivery()
    {
        return $this->render('payment-and-delivery');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            $role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
            if(in_array('admin',$role)){
                return $this->redirect(['admin/index']);
            }else{
                return $this->redirect(['site/user']);
            }
        }

        $model = new LoginForm();
        $sign_up = new SignUpForm();
        $error = new SetError();

        $type = 'log';
        if ($model->load(Yii::$app->request->post())) {
            if($model->login()){
                return $this->redirect(['site/user']);
            }else{
                $error->setError($model,'');
            }
        } elseif($sign_up->load(Yii::$app->request->post())) {
            if($user = $sign_up->signup(SignUpForm::SIGN_NORMAL) and isset($user->id)){
                $auth = Yii::$app->authManager;
                $role = $auth->getRole('user');
                $auth->assign($role, $user->id);
                Yii::$app->user->login(User::findIdentity($user->id), 3600 * 24 * 30);
                return $this->redirect(['site/user']);
            }else{
                $error->setError($sign_up,'');
                $type = 'sign';
            }
        }

        return $this->render('login', [
            'model' => $model,
            'sign_up'=>$sign_up,
            'type' => $type
        ]);
    }

    public function actionPasswordReset()
    {
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $user = User::find()->where(['or',['email'=>$post['data']],['username'=>$post['data']]])->one();
            if(isset($user->id)){
                $user->generatePasswordResetToken();
                $user->save();
            }else{
                Yii::$app->session->setFlash('error','Пользователь с таким Логином или Email не найден');
            }
        }
        return $this->render('password-reset');
    }

    public function actionPasswordConfirm()
    {
        $get = Yii::$app->request->get();
        if(isset($get['type']) and isset($get['key']) and $get['type'] == User::EMAIL_RESET_PASS['type']){
            $user = User::findByPasswordResetToken($get['key']);
            if(isset($user->id)){
                $reset = new ChangePassword(['scenario' => ChangePassword::SCENARIO_EMAIL_RESET]);
                if($reset->load(Yii::$app->request->post()) and $reset->change($user->id)){
                    Yii::$app->session->setFlash('success','Ваш пароль успешно изменен!');
                    return $this->redirect(['site/login']);
                }
                return $this->render('password-confirm',['reset'=>$reset]);
            }
        }
        return $this->render('password-confirm',['reset'=>false]);
    }

    public function actionConfirm()
    {
        $get = Yii::$app->request->get();
        if(isset($get['type']) and isset($get['key'])){
            $user = User::findIdentityByAccessToken($get['key']);
            if(isset($user->id)){
                $user->status = User::STATUS_ACTIVE;
                $user->save();
                Orders::updateAll(['status'=>Orders::STATUS_CONSIDERATION],['idUser'=>$user->id,'status'=>Orders::STATUS_UN_CONFIRMED]);
                return $this->render('confirm',['success'=>true]);
            }
        }
        return $this->render('confirm',['success'=>false]);
    }


    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
