<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= $assetDir ?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?=yii::$app->user->identity->email ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?= \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => 'Lists',
                        'icon' => 'list',
                        'items' => [
                            ['label' => 'State List', 'url' => ['state/index'], 'iconStyle' => 'far'],
                            ['label' => 'Container List', 'url' => ['container/index'], 'iconStyle' => 'far'],
                            ['label' => 'Load List', 'url' => ['load/index'], 'iconStyle' => 'far'],
                            ['label' => 'Truck List', 'url' => ['truck/index'], 'iconStyle' => 'far'],

                            ['label' => 'Truck types', 'url' => ['/truck-types'], 'iconStyle' => 'far'],
                            ['label' => 'Equipment', 'url' => ['/equipment'], 'iconStyle' => 'far'],
                            ['label' => 'Load modes', 'url' => ['loadmodes/index'], 'iconStyle' => 'far'],
                          ['label' => 'Owner list', 'url' => ['owner/index'], 'iconStyle' => 'far'],
                        ],
                    ],
                    ['label' => 'Users', 'url' => ['user/index'], 'icon' => 'user'],
                    ['label' => 'Epos', 'url' => ['epos/index'], 'icon' => 'user'],
                    ['label' => 'Tieto', 'url' => ['tieto-transaction-types/index'], 'icon' => 'user'],
                    ['label' => 'Pages', 'url' => ['page/index'], 'icon' => 'filter'],
                    ['label' => 'Load-Bid-History', 'url' => ['load-bid-history/index'], 'icon' => 'fa fa-history'],
                    ['label' => 'Usefull', 'url' => ['usefull/index'], 'iconStyle' => 'fas fa-power-off'],
                    ['label' => 'BankServices', 'url' => ['bank-services/index'], 'iconStyle' => 'fas fa-power-off'],
                    ['label' => 'LinkProvider', 'url' => ['link-provider/index'], 'iconStyle' => 'fas fa-power-off'],
                    ['label' => 'CardProductsReissueBlock', 'url' => ['card-products-reissue-block/index'], 'iconStyle' => 'fas fa-power-off'],
                    ['label' => 'CardDelivery', 'url' => ['card-delivery/index'], 'iconStyle' => 'far'],
                ],
            ]);
            // https://www.w3schools.com/icons/fontawesome5_icons_users_people.asp
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
