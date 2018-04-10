<aside class="main-sidebar">

    <section class="sidebar">

        <?=
        dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                    'items' => [
                        ['label' => 'Navigation', 'options' => ['class' => 'header']],
                        ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/site/index']],
                        ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                        [
                            'label' => 'Users',
                            'icon' => 'users',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Admin', 'icon' => 'user-secret', 'url' => ['/admin'],],
                                ['label' => 'Distributor', 'icon' => 'user', 'url' => ['/distributor'],],
                                ['label' => 'Manager', 'icon' => 'users', 'url' => ['/manager'],],
                            ],
                        ],
                        ['label' => 'Company', 'icon' => 'building', 'url' => ['/company/index']],
                        ['label' => 'Sales Person', 'icon' => 'shopping-cart', 'url' => ['/sales-person/index']],
                        ['label' => 'Shop', 'icon' => 'globe', 'url' => ['/shop/index']],
                        [
                            'label' => 'Products',
                            'icon' => 'th',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Manage Product', 'icon' => 'list', 'url' => ['product/index'],],
                                ['label' => 'Create Product', 'icon' => 'cloud-upload', 'url' => ['product/create'],],
                            ]
                        ],
                        [
                            'label' => 'Damage Products',
                            'icon' => 'trash',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Manage Damage Product', 'icon' => 'list', 'url' => ['damage-product/index'],],
                                ['label' => 'Add Damage Product', 'icon' => 'cloud-upload', 'url' => ['damage-product/create'],],
                            ]
                        ],
                    ],
                ]
        )
        ?>

    </section>

</aside>
