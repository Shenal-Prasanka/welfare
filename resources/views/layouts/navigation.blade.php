<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="{{ route('profile.show') }}" class="d-block">
                {{ Auth::user()->getRoleNames()->first() ?? 'No Role' }}
            </a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="nav-icon fas fa-th text-pink"></i>
                    <p class="text-white">
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>

            @role('Admin')
                <!-- Master Data Dropdown  -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-database text-blue"></i>
                        <p class="text-white">
                            {{ __('Master Data') }}
                            <i class="right fas fa-angle-left text-blue"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview " style="display: none;">
                        <!-- User-Manage Dropdown -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="bi bi-person-workspace nav-icon text-success mr-2"></i>
                                <p class="text-white">
                                    {{ __('Users-Manage') }}
                                    <i class="right fas fa-angle-left text-success"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}" class="nav-link">
                                        <i class="fas fa-user-plus nav-icon text-primary"></i>
                                        <p>{{ __('Add User') }}</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('users.welfareshopaccess') }}" class="nav-link">
                                        <i class="bi bi-shop nav-icon text-primary"></i>
                                        <p>{{ __(' Welfareshop Access') }}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="{{ route('roles.index') }}" class="nav-link">
                                <i class="bi bi-person-fill-lock nav-icon text-red mr-2"></i>
                                <p>
                                    {{ __('Roles-Manage') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="{{ route('regements.index') }}" class="nav-link">
                                <i class="bi bi-star-half nav-icon text-orange mr-2"></i>
                                <p>
                                    {{ __('Regements-Manage') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="{{ route('ranks.index') }}" class="nav-link">
                                <i class="bi bi-bookmark-star-fill nav-icon text-yellow mr-2"></i>
                                <p>
                                    {{ __('Ranks-Manage') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="{{ route('units.index') }}" class="nav-link">
                                <i class="bi bi-house-lock nav-icon text-orange mr-2"></i>
                                <p>
                                    {{ __('Units-Manage') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="{{ route('categorys.index') }}" class="nav-link">
                                <i class="bi bi-tag-fill nav-icon text-success mr-2"></i>
                                <p>
                                    {{ __('Category-Manage') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="{{ route('loaninterests.index') }}" class="nav-link">
                                <i class="bi bi-percent nav-icon text-info mr-2"></i>
                                <p>
                                    {{ __('Loan Interest-Manage') }}
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endrole
           
            @role('Shop Coord OC||Shop Coord Clerk')
                <li class="nav-item">
                    <a href="{{ route('supplys.index') }}" class="nav-link">
                        <i class="bi bi-truck nav-icon text-info mr-2"></i>
                        <p>
                            {{ __(' Supply-Manage') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('welfares.index') }}" class="nav-link">
                        <i class="bi bi-bag-check-fill nav-icon text-blue mr-2"></i>
                        <p>
                            {{ __('Welfares-Manage') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link">
                        <i class="bi bi-laptop nav-icon text-warning mr-2"></i>
                        <p>
                            {{ __('Product-Manage') }}
                        </p>
                    </a>
                </li>
            @endrole
            @role('Welfare Shop Clerk||Welfare Shop OC||Shop Coord OC||Shop Coord Clerk')
                <li class="nav-item">
                    <a href="{{ route('purchaseorder.index') }}" class="nav-link">
                        <i class="bi bi-journal-text nav-icon text-info mr-2"></i>
                        <p>
                            {{ __('Purchase Orders') }}
                        </p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('stocks.index') }}" class="nav-link">
                        <i class="bi bi-box-seam nav-icon text-success mr-2"></i>
                        <p>
                            {{ __('Stock Management') }}
                        </p>
                    </a>
                </li>
            @endrole
            
            @role('Unit Clerk||Unit OC||Shop Coord Clerk||Shop Coord OC||Welfare Shop Clerk||Welfare Shop OC||Staff Officer')
                <li class="nav-item">
                    <a href="{{ route('itemloans.index') }}" class="nav-link">
                        <i class="bi bi-clipboard-check nav-icon text-primary mr-2"></i>
                        <p>
                            {{ __('Item Loans') }}
                        </p>
                    </a>
                </li>
            @endrole
            
            @role('Loan Clerk||Loan OC||Account SO||Staff Officer')
                <li class="nav-item">
                    <a href="{{ route('loans.index') }}" class="nav-link">
                        <i class="bi bi-cash-coin nav-icon text-success mr-2"></i>
                        <p>
                            {{ __('Loans') }}
                        </p>
                    </a>
                </li>
            @endrole
            
            @role('Membership Clerk||Membership OC')
                <li class="nav-item">
                    <a href="{{ route('memberships.index') }}" class="nav-link">
                        <i class="nav-iconbi bi-graph-up text-warning mr-2"></i>
                        <p class="text-white">
                            {{ __('Membership') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('welfarememberships.index') }}" class="nav-link">
                        <i class="nav-iconbi bi-graph-up text-warning mr-2"></i>
                        <p class="text-white">
                            {{ __('Welfare-Membership') }}
                        </p>
                    </a>
                </li>
            @endrole
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- AdminLTE CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

<!-- Initialize sidebar -->
<script>
    $(document).ready(function() {
        // Initialize the sidebar treeview
        $('[data-widget="treeview"]').Treeview('init');

        //Alternatively, you can use this if the above doesn't work
        $('[data-widget="treeview"]').each(function() {
            $(this).treeview();
        });
    });
</script>
