<aside class="main-sidebar">

    <section class="sidebar">
        <!--<div class="user-panel">
            <div class="pull-left image">
                <img src="/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>-->

        <!--        --><? //= dmstr\widgets\Menu::widget(
        //            [
        //                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
        //                'items' => [
        //                    ['label' => '&nbsp;', 'options' => ['class' => 'header'], 'encode' => false],
        //                    ['label' => 'Маҳсулотлар', 'icon' => 'gift', 'url' => ['product/index']],
        //                    ['label' => 'Менюлар', 'icon' => 'navicon', 'url' => ['menus-links/index']],
        //                    ['label' => 'Буюртмалар', 'icon' => 'cart-arrow-down', 'url' => ['order/index']],
        //                    ['label' => 'Янгиликлар', 'icon' => 'newspaper-o', 'url' => ['list/index', 'ci' => 3]],
        //                    ['label' => 'Саҳифалар', 'icon' => 'address-book-o', 'url' => ['list/index', 'ci' => 1]],
        //                    ['label' => 'Хизматлар', 'icon' => 'truck', 'url' => ['list/index', 'ci' => 2]],
        //                    ['label' => 'Фикрлар', 'icon' => 'comments-o', 'url' => ['/reviews']],
        //                    /*[
        //                        'label' => 'Some tools',
        //                        'icon' => 'share',
        //                        'url' => '#',
        //                        'items' => [
        //                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
        //                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
        //                            [
        //                                'label' => 'Level One',
        //                                'icon' => 'circle-o',
        //                                'url' => '#',
        //                                'items' => [
        //                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
        //                                    [
        //                                        'label' => 'Level Two',
        //                                        'icon' => 'circle-o',
        //                                        'url' => '#',
        //                                        'items' => [
        //                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
        //                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
        //                                        ],
        //                                    ],
        //                                ],
        //                            ],
        //                        ],
        //                    ],*/
        //                ],
        //            ]
        //        ) ?>
        <?= \backend\widgets\UserMenu::widget(['user' => Yii::$app->user]) ?>

    </section>

</aside>
