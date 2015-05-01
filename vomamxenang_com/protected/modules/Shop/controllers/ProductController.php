<?php

class ProductController extends FrontendController {
    public $includeText = 'Vỏ mâm xe nâng | ';

    public function actionIndex($flashOrder = '') {
        if ($flashOrder) {
            Helper::setFlash('SUCCESS_ORDER', Helper::t('SUCCESS_ORDER'));
        }

        Yii::import('Admin.models.Category');
        $criteria = new CDbCriteria();
        $criteria->compare('parent_id', 0);
        $categories = Cache::usingCache('Category', $criteria, '', false);

        // seo
        $this->breadcrumbs = array(
            ' - Trang chủ'
        );

        $pageTitle = $this->pageTitle = $this->includeText . 'Trang chủ';
        $keywords =  str_replace(' - ', ',', $pageTitle);
        $seo = array(
            'keywords' => Yii::app()->language == 'vi' ? '' : 'homepage, ',
            'description' => Yii::app()->language == 'vi' ? '' : 'homepage, ',
            'title' => $pageTitle,
            'type' => 'Shop',
            'url' => Yii::app()->createAbsoluteUrl(Yii::app()->request->requestUri),
            'image' => '',
            'site_name' => $pageTitle,
        );
        Helper::seo($seo);

        $this->render('index', array(
            'categories' => $categories
        ));
    }

    public function actionSearch($kw) {
        if ($kw) {
            $aliasKW = Helper::unicode_convert($kw);
            $page = Helper::get('page') ? Helper::get('page') : 1;
            $criteria = new CDbCriteria();

            $criteria->compare('status', APPROVED);
            $criteria->addSearchCondition('name', $kw);
            $modelProducts = Cache::usingCache('Products', $criteria, '', false, Cache_Time, '', 1, 'search-' . $aliasKW);

            $cache['paging'] = new Paging(Helper::url('/Shop/product/search', array('kw' => $kw)), count($modelProducts), ITEM_PER_PAGE, $page, 4, '', $kw);
            $limit = array('begin' => $cache['paging']->begin, 'end' => $cache['paging']->rows_in_page);
            $cache['products'] = Cache::usingCache('Products', $criteria, '', false, Cache_Time, $limit, $page, 'search-' . $aliasKW);

            // seo
            $this->breadcrumbs = array(
                'Tìm kiếm - Từ khóa "' . $kw . "'"
            );
            $pageTitle = $this->pageTitle =  $this->includeText . 'Tìm kiếm - Từ khóa"' . $kw . '"';
            $seo = array(
                'keywords'    => Yii::app()->language == 'vi' ? "Tìm kiếm - Từ khóa'{$kw}' " . DEFAULT_META_KEYWORDS . ' vomamxenang.com' : "product '{$kw}', product '{$kw}' design web, product '{$kw}' vomamxenang.com",
                'description' => Yii::app()->language == 'vi' ? "Tìm kiếm - Từ khóa '{$kw}' " . DEFAULT_META_DESCRIPTION . ' vomamxenang.com'  : "product '{$kw}', product '{$kw}' design web, product '{$kw}' vomamxenang.com",
                'title'       => $pageTitle,
                'type'        => 'Sản phẩm',
                'url'         => Yii::app()->createAbsoluteUrl(Yii::app()->request->requestUri),
                'image'       => '',
                'site_name'   => $pageTitle,
            );
            Helper::seo($seo);

            $this->render('search', array(
                'products' => $cache,
                'kw' => $kw,
                'isOnIndex' => true
            ));
        } else {
            throw new CHttpException(400, 'ERROR_LINK');
        }
    }

    public function actionListProductsByCategory($cateAlias, $tab = '') {
        $this->layout = '//layouts/list';
        $criteriaCate = new CDbCriteria();
        $criteriaCate->compare('alias', $cateAlias);
        $criteriaCate->compare('status', APPROVED);

        $arrCate = array();
        $modelCate = Cache::usingCache('Category', $criteriaCate, $cateAlias, false, Cache_Time, 1, 1, '-view-' . $tab . $cateAlias);
        $cateName = ucfirst($modelCate->name);

        // seo
        $this->breadcrumbs = array(
            "{$cateName}"
        );
        $pageTitle = $this->pageTitle = $this->includeText . "{$modelCate->name}";
        $seo = array(
            'keywords' => Yii::app()->language == 'vi' ? "{$modelCate->description} " . DEFAULT_META_KEYWORDS . 'vomamxenang.com' : 'homepage, homepage design web, homepage vomamxenang.com',
            'description' => Yii::app()->language == 'vi' ? "{$modelCate->description} " . DEFAULT_META_DESCRIPTION . ' vomamxenang.com' : 'homepage, homepage design web, homepage vomamxenang.com',
            'title' => $pageTitle,
            'type' => 'Sản phẩm',
            'url' => Yii::app()->createAbsoluteUrl(Yii::app()->request->requestUri),
            'image' => '',
            'site_name' => $pageTitle,
        );
        Helper::seo($seo);

		$this->render('listProducts', array(
            'cateAlias' => $cateAlias,
            'tab' => $tab,
        ));
    }

    public function actionView($alias) {
        if (!isset($alias)) {
            throw new CHttpException(400, Helper::t('ERROR_LINK'));
        }
        $this->layout = '//layouts/list';
        $criteria = Products::model()->createCriteria();
        $products = Cache::usingCache('Products', $criteria, '', false, Cache_Time, '', 1, 'view-' . $alias);
        if (count($products)) {
            $productDetail = $older = $newer = array();
            foreach ($products as $k => $product) {
                $arrayNewer[] = $product;
                if ($product->alias == $alias) {
                    // get Product by alias
                    foreach ($arrayNewer as $j => $arrNewer) {
                        if ($k == $j + 1) {
                            // get newer Product
                            $newer = $arrNewer;
                            break;
                        }
                    }
                    $productDetail = $product;
                }
                if ($productDetail) {
                    if ($product->id < $productDetail->id) {
                        // get older Product
                        $older = $product;
                        break;
                    }
                }
            }
            if (!$productDetail) {
                throw new CHttpException(400, Helper::t('ERROR_LINK'));
            }
        }
        // action Review
        $modelReview = new Review;
        if (Helper::post('Review')) {
            // validate
            Helper::performAjaxValidation($modelReview, 'review-form');
            // save
            $actionReview = $modelReview->saveParams($modelReview, Helper::post('Review'), $productDetail->id);
            if ($actionReview) {
                Helper::setFlash('successMessage', Yii::t('translate', 'successSubmittingReview'));
                $this->redirect(array('view', 'cateAlias' => Helper::get('cateAlias'), 'alias' => $alias));
            }
        }
        // add Product to Cart
        if (Helper::post('quantity') && Helper::post('alias')) {
            $quantity = Helper::post('quantity');
            $aliasAddCart = Helper::post('alias');
            $cookieCart = Cart::AddOrShowCart($aliasAddCart, $quantity);
            $countCookieCart = count($cookieCart);
            if ($countCookieCart) {
                $arrayInfoCart = array(
                    'name'           => $productDetail->name,
                    'quantity'       => $quantity,
                    'amountProducts' => $countCookieCart
                );
                echo CJSON::encode($arrayInfoCart);
                Yii::app()->end();
            } else {
                Helper::setFlash('error_add_cart', Yii::t('translate', 'error_add_cart'));
                $this->redirect(array('view', 'alias' => $alias));
            }
        }
        // seo
        $this->breadcrumbs = array(
            $productDetail->name
        );
        $pageTitle = $this->pageTitle = $this->includeText . $productDetail->name;
        $seo = array(
            'keywords'    => Yii::app()->language == 'vi' ? "{$productDetail->name}, {$productDetail->info} " . DEFAULT_META_KEYWORDS . 'vomamxenang.com' : "{$productDetail->name}, {$productDetail->info}",
            'description' => Yii::app()->language == 'vi' ? "{$productDetail->name}, {$productDetail->info} " . DEFAULT_META_DESCRIPTION . ' vomamxenang.com'  : "{$productDetail->name}, {$productDetail->info}",
            'title'       => $pageTitle,
            'type'        => 'Sản phẩm',
            'url'         => Yii::app()->createAbsoluteUrl(Yii::app()->request->requestUri),
            'image'       => Yii::app()->createAbsoluteUrl(Helper::renderImage($productDetail->image, 'uploads/details/Products', ',', true, true)),
            'site_name'   => $pageTitle,
        );
        Helper::seo($seo);
        $this->render('view', array(
            'data'        => $productDetail,
            'newer'       => $newer,
            'older'       => $older,
            'alias'       => $alias,
            'modelReview' => $modelReview
        ));
    }

    public function actionViewCart() {
        $this->layout = '//layouts/cart';

        $showCart = array();
        if (!Cart::hasCookie('Cart')) {
            throw new CHttpException(400, Helper::t('ERROR_LINK'));
        }
        if (Cart::hasCookie('Cart') && Cart::getCookie('Cart') != '[]') {
            $cart = Cart::getCookie('Cart');
            $totalValueAfterUpdate = Cart::getCookie('totalValueAfterUpdate');
            $showCart = Helper::objectToArray($cart);
        } else {
            if (!Cart::hasCookie('Cart')) {
                Cart::removeCookie();
            }
            $this->redirect(array('/site/index'));
        }
        if (Helper::user()->isGuest) {
            $modelUser = new User();
            Helper::post('register') ? $modelUser->setScenario('register') : $modelUser->setScenario('asGuest');
        } else {
            $modelUser = User::model()->findByPk(Helper::user()->id);
            $modelUser->setScenario('profile');
        }
        if (Helper::post('User')) {
            // validate
            Helper::performAjaxValidation($modelUser, 'user-form');
            // assign data
            $postUser = Helper::post('User');
            $validateCode = Helper::randomString('all');
            $model = User::model()->assignValue($modelUser, $postUser, $validateCode);
            if ($model->save()) {
                Helper::setFlash('successRegister', Yii::t('translate', 'successRegister'));
                // send mail
                // data
                $url = Yii::app()->createAbsoluteUrl('/site/confirm', array('code' => $validateCode));
                $params = array(
                    'viewPath' => 'application.views.site.mail',
                    'view'     => 'registration_confirmation',
                    'subject'  => 'Vỏ mâm xe nâng | Xác nhận đăng ký thành viên',
                    'body'     => array(
                        'username' => $model->username,
                        'password' => $postUser['password'],
                        'link'     => CHtml::link($url, $url, array('target' => '_blank')),
                    ),
                    'mailTo'   => $model->email,
		    'mailFrom' => array(ADMIN_EMAIL => 'Vỏ mâm xe nâng - ' .ADMIN_EMAIL )
                );
                // send
                Helper::sendMail($params);
                $this->redirect(array('/site/login'));
            } else {
                throw new CHttpException(400, Yii::t('translate', 'Error_Action_code'));
            }
        }

        // seo
        $this->breadcrumbs = array(
            'Xem giỏ hàng của bạn'
        );
        $pageTitle = $this->pageTitle = $this->includeText . 'Giỏ hàng của bạn - Thông tin giỏ hàng';
        $seo = array(
            'keywords'    => Yii::app()->language == 'vi' ? "giỏ hàng của bạn, thông tin giỏ hàng " . DEFAULT_META_KEYWORDS . 'vomamxenang.com' : "your card, your cart info",
            'description' => Yii::app()->language == 'vi' ? "giỏ hàng của bạn, thông tin giỏ hàng " . DEFAULT_META_DESCRIPTION . ' vomamxenang.com' : "your card, your cart info",
            'title'       => $pageTitle,
            'type'        => 'Sản phẩm',
            'url'         => Yii::app()->createAbsoluteUrl(Yii::app()->request->requestUri),
            'image'       => '',
            'site_name'   => $pageTitle,
        );
        Helper::seo($seo);

        $this->render('cart', array(
            'modelUser'             => $modelUser,
            'showCart'              => $showCart,
            'totalValueAfterUpdate' => $totalValueAfterUpdate
        ));
    }

    public function actionUpdateOrDeleteCart() {
        if (Cart::hasCookie('Cart') && Cart::getCookie('Cart') == '[]') {
            Cart::removeCookie();
        }

        if (Helper::post()) {
            $this->layout = false;
            $category = Helper::post('category');
            $type = Helper::post('type');
            $alias = Helper::post('alias');
            $quantity = Helper::post('quantity');
            $totalValueBefore = Helper::post('totalValueBefore');
            $valueBefore = Helper::post('valueBefore');

            if (($type == 'updateCart' || $type == 'addCart') && $quantity > 0) {
                $dataCart = Cart::AddOrShowCart($category, $alias, $quantity, $valueBefore, $totalValueBefore, $type);
            } elseif ($type == 'delOneCart' || $quantity == 0) {
                $newCart = Cart::RemoveProduct($alias, $valueBefore, $totalValueBefore);
                $dataCart[] = Helper::objectToArray($newCart);
                $dataCart[] = $totalValueBefore - $valueBefore;
                $dataCart[] = Helper::formatNumber($totalValueBefore - $valueBefore);
                $dataCart[] = count($newCart);
                $dataCart = array_merge($dataCart);
            }
            $dataCart = Helper::objectToArray($dataCart);

            echo CJSON::encode($dataCart);
            Yii::app()->end();
        } else {
            throw new CHttpException(400, Helper::t('ERROR_LINK'));
        }
    }

    public function actionUserOrder() {
        if (Helper::post('userInfo')) {
            $userInfo = Helper::post('userInfo');
            if (count($userInfo) > 10) {
                $arrayBillTo = array(
                    'username'  => $userInfo[0],
                    'email'     => $userInfo[1],
                    'full_name' => $userInfo[2],
                    'phone'     => $userInfo[3],
                    'address'   => $userInfo[4],
                    'description'  => $userInfo[7],
                );
                $arrayShipTo = array(
                    'full_name' => !empty($userInfo[8]) ? $userInfo[8] : $userInfo[2],
                    'phone'     => !empty($userInfo[9]) ? $userInfo[9] : $userInfo[3],
                    'address'   => !empty($userInfo[10]) ? $userInfo[10] : $userInfo[4],
                    'other'     => !empty($userInfo[11]) ? $userInfo[11] : ''
                );
            } else {
                $arrayBillTo = array(
                    'email'     => $userInfo[0],
                    'full_name' => $userInfo[1],
                    'phone'     => $userInfo[2],
                    'address'   => $userInfo[3],
                    'description'      => $userInfo[4]
                );
                $arrayShipTo = array(
                    'full_name' => !empty($userInfo[5]) ? $userInfo[5] : $userInfo[1],
                    'phone'     => !empty($userInfo[6]) ? $userInfo[6] : $userInfo[2],
                    'address'   => !empty($userInfo[7]) ? $userInfo[7] : $userInfo[3],
                    'other'     => !empty($userInfo[8]) ? $userInfo[8] : ''
                );
            }

            Cart::setCookie('billTo', json_encode($arrayBillTo));
            Cart::setCookie('shipTo', json_encode($arrayShipTo));
            echo CJSON::encode('Add-Cookie-success');
            Yii::app()->end();
        } else {
            throw new CHttpException(400, Helper::t('ERROR_LINK'));
        }
    }

    public function actionConfirmOrder() {
        $this->layout = '//layouts/cart';
        if (!Cart::hasCookie('Cart') && Helper::post('confirmOrder')) {
            throw new CHttpException(400, Helper::t('ERROR_LINK'));
        }
        $cart = Helper::objectToArray(Cart::getCookie('Cart'));
        $billTo = Helper::objectToArray(Cart::getCookie('billTo'));
        $shipTo = Helper::objectToArray(Cart::getCookie('shipTo'));

        $cartInfo = Cart::hasCookie('cartInfo') ? nl2br(Cart::getCookie('cartInfo')) : '';
        if (Helper::post('confirmOrder')) {
            // update to Product
            foreach ($cart as $gh) {
                $alias = $gh['alias'];
                $quantity = $gh['quantity'];
                $category = $gh['category'];
                // update
                Products::model()->updateQuantityAndTotalBuy($alias, $quantity, $category);
            }
            // add to Order
            // insert into Order
            $data = Orders::model()->insertToOrder($billTo, $shipTo, $cart, $cartInfo);
            // send mail
            // data
            $params = array(
                'viewPath' => 'application.views.site.mail',
                'view'     => 'send_cart_order',
                'subject'  => 'Vỏ mâm xe nâng - Đơn đặt hàng',
                'body'     => array(
                    'billTo'   => $billTo,
                    'shipTo'   => $shipTo,
                    'userCart' => $cart,
                    'cartInfo' => $cartInfo
                ),
                'mailTo'   => $billTo['email'],
                'mailFrom' => array(ADMIN_EMAIL => 'Vỏ mâm xe nâng - ' . ADMIN_EMAIL)
            );
            // send
            Helper::sendMail($params);
            // remove Cart
            Cart::removeCookie();
            Helper::setFlash('SUCCESS_ORDER', Helper::t('SUCCESS_ORDER'));

            echo CJSON::encode($data);
            Yii::app()->end();
        }

        // seo
        $this->breadcrumbs = array(
            'Xác nhân đơn hàng của bạn'
        );
        $pageTitle = $this->pageTitle = $this->includeText . 'Xác nhận đơn hàng';
        $seo = array(
            'keywords'    => Yii::app()->language == 'vi' ? "xác nhận đơn hàng, xác nhân đơn hàng của bạn " . DEFAULT_META_KEYWORDS . 'vomamxenang.com' : "confirm your order",
            'description' => Yii::app()->language == 'vi' ? "xác nhận đơn hàng, xác nhân đơn hàng của bạn " . DEFAULT_META_DESCRIPTION . ' vomamxenang.com' : "confirm your order",
            'title'       => $pageTitle,
            'type'        => 'Sản phẩm',
            'url'         => Yii::app()->createAbsoluteUrl(Yii::app()->request->requestUri),
            'image'       => '',
            'site_name'   => $pageTitle,
        );
        Helper::seo($seo);

        $this->render('confirmOrder', array(
            'userCart' => $cart,
            'billTo'   => $billTo,
            'shipTo'   => $shipTo,
            'cartInfo' => $cartInfo
        ));
    }

    public function actionReadNews($newsAlias) {
        $this->layout = '//layouts/cart';
        $criteria = new CDbCriteria();
        $criteria->compare('status', APPROVED);
        $criteria->compare('alias', $newsAlias);

        $news = Cache::usingCache('News', $criteria, $newsAlias, false, Cache_Time, 1, 1, $newsAlias);
        if (!$news) {
            throw new CHttpException(400, Helper::t('ERROR_LINK'));
        }

        // seo
        $typeNews = Lookup::item('Type_News', $news->type_news);
        $this->breadcrumbs = array(
            $typeNews . " - " . $news->title
        );
        $pageTitle = $this->pageTitle = $this->includeText . $news->title . " - " . $typeNews;
        $seo = array(
            'keywords'    => Yii::app()->language == 'vi' ? "$news->title, $typeNews $news->title " . DEFAULT_META_KEYWORDS . 'vomamxenang.com' : "$news->title, $typeNews $news->title",
            'description' => Yii::app()->language == 'vi' ? "$news->title, $typeNews $news->title " . DEFAULT_META_DESCRIPTION . ' vomamxenang.com' : "$news->title, $typeNews $news->title",
            'title'       => $pageTitle,
            'type'        => 'Tin Tức',
            'url'         => Yii::app()->createAbsoluteUrl(Yii::app()->request->requestUri),
            'image'       => '',
            'site_name'   => $pageTitle,
        );
        Helper::seo($seo);

        $this->render('readNews', array(
            'data' => $news
        ));
    }

    public function actionFAQ() {
        $this->layout = '//layouts/news';

        $modelQa = new Qa();
        // Uncomment the following line if AJAX validation is needed
        Helper::performAjaxValidation($modelQa, 'qa-form');
        if (isset($_POST['Qa'])) {
            $modelQa->attributes = $_POST['Qa'];
            $modelQa->parent_id = Helper::post('current') ? Helper::post('current') : 0;

            if ($modelQa->save()) {
                $scriptAlertSuccess = 'alert("Chân thành cám ơn bạn đã gửi câu hỏi cho chúng tôi, Chúng tôi sẽ hồi âm trong thời gian sớm nhất. Thanks"); parent.window.location = parent.window.location;';
                Helper::cs()->registerScript('scriptAlertSuccess', $scriptAlertSuccess, CClientScript::POS_END);
            }
        }

        // seo
        $this->breadcrumbs = array(
            'Hỏi đáp'
        );
        $pageTitle = $this->pageTitle = $this->includeText . 'Hỏi đáp';
        $seo = array(
            'keywords'    => Yii::app()->language == 'vi' ? "Hỏi đáp, đặt câu hỏi, những vấn đề liên quan đến shop của chúng tôi " . DEFAULT_META_KEYWORDS . 'vomamxenang.com' : "FAQ, send your question, regarding to our shop",
            'description' => Yii::app()->language == 'vi' ? "Hỏi đáp, đặt câu hỏi, những vấn đề liên quan đến shop của chúng tôi " . DEFAULT_META_DESCRIPTION . ' vomamxenang.com' : "FAQ, send your question, regarding to our shop",
            'title'       => $pageTitle,
            'type'        => 'FAQ',
            'url'         => Yii::app()->createAbsoluteUrl(Yii::app()->request->requestUri),
            'image'       => '',
            'site_name'   => $pageTitle,
        );
        Helper::seo($seo);

        $this->render('faq', array(
            'model' => $modelQa
        ));
    }
}
