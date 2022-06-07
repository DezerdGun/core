<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Muzaffarov Mirsaid</a>
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
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                        'items' => [
                            [
                                        'label' => 'Lists',
                                        'iconStyle' => 'far',
                                        'items' => [
                                            ['label' => 'State List', 'url' => ['state/index'], 'iconStyle' => 'far'],
                                            ['label' => 'Container List', 'url' => ['container/index'], 'iconStyle' => 'far'],
                                            ['label' => 'Load List', 'url' => ['load/index'], 'iconStyle' => 'far'],
                                            ['label' => 'Truck List', 'url' => ['truck/index'], 'iconStyle' => 'far'],
                                        ]
                            ],
                    ],
                ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>