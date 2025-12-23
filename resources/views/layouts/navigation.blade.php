<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3">
        <div class="d-flex align-items-center">
            <div class="ml-3">
                <a href="{{ route('profile.show') }}" class="d-flex align-items-center" title="My Profile">
                    @if(auth()->user()->profile_image)
                        <img src="{{ route('image.show', auth()->user()->profile_image) }}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;" alt="Profile">
                    @else
                        <i class="fas fa-user-circle" style="font-size: 40px; color: #6c757d;"></i>
                    @endif
                </a>
            </div>
            <div class="info">
                <a href="{{ route('profile.show') }}" class="d-block text-left">
                    {{ Auth::user()->getRoleNames()->first() ?? 'No Role' }}
                </a>
            </div>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="px-3 pb-3">
        <div class="input-group">
            <input type="text" class="form-control form-control-sm bg-dark" placeholder="Search..." aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary btn-sm text-white" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="nav-icon fas fa-th text-white"></i>
                    <p class="text-white">
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>

            @role('Admin')

                        <!-- User-Manage Dropdown -->


                                <p class="text-white ml-3 mt-2">
                                    {{ __('USER-MANAGE') }}
                                </p>


                                <li class="nav-item ml-3">
                                    <a href="{{ route('users.index') }}" class="nav-link">
                                        <i class="fas fa-user-plus nav-icon text-white"></i>
                                        <p>{{ __('Add User') }}</p>
                                    </a>
                                </li>

                                <li class="nav-item ml-3">
                                    <a href="{{ route('users.welfareshopaccess') }}" class="nav-link">
                                        <i class="bi bi-shop nav-icon text-white"></i>
                                        <p>{{ __(' Welfare-Access') }}</p>
                                    </a>
                                </li>


                         <p class="text-white ml-3 mt-2">
                                    {{ __('OTHER-MANAGE') }}
                                </p>

                        <li class="nav-item has-treeview ml-3">
                            <a href="{{ route('roles.index') }}" class="nav-link">
                                <i class="bi bi-person-fill-lock nav-icon text-white mr-2"></i>
                                <p>
                                    {{ __('Roles') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview ml-3">
                            <a href="{{ route('regements.index') }}" class="nav-link">
                                <i class="bi bi-star-half nav-icon text-white mr-2"></i>
                                <p>
                                    {{ __('Regements') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview ml-3">
                            <a href="{{ route('ranks.index') }}" class="nav-link">
                                <i class="bi bi-bookmark-star-fill nav-icon text-white mr-2"></i>
                                <p>
                                    {{ __('Ranks') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview ml-3">
                            <a href="{{ route('units.index') }}" class="nav-link">
                                <i class="bi bi-house-lock nav-icon text-white mr-2"></i>
                                <p>
                                    {{ __('Units') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview ml-3">
                            <a href="{{ route('categorys.index') }}" class="nav-link">
                                <i class="bi bi-tag-fill nav-icon text-white mr-2"></i>
                                <p>
                                    {{ __('Category') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview ml-3">
                            <a href="{{ route('loaninterests.index') }}" class="nav-link">
                                <i class="bi bi-percent nav-icon text-white mr-2"></i>
                                <p>
                                    {{ __('Loan Interest') }}
                                </p>
                            </a>
                        </li>

            @endrole
           
            @role('Shop Coord OC||Shop Coord Clerk')
                <li class="nav-item">
                    <a href="{{ route('supplys.index') }}" class="nav-link">
                        <i class="bi bi-truck nav-icon text-white mr-2"></i>
                        <p>
                            {{ __(' Supply-Manage') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('welfares.index') }}" class="nav-link">
                        <i class="bi bi-bag-check-fill nav-icon text-white mr-2"></i>
                        <p>
                            {{ __('Welfares-Manage') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link">
                        <i class="bi bi-laptop nav-icon text-white mr-2"></i>
                        <p>
                            {{ __('Product-Manage') }}
                        </p>
                    </a>
                </li>
            @endrole
            @role('Welfare Shop Clerk||Welfare Shop OC||Shop Coord OC||Shop Coord Clerk')
                <li class="nav-item">
                    <a href="{{ route('purchaseorder.index') }}" class="nav-link">
                        <i class="bi bi-journal-text nav-icon text-white mr-2"></i>
                        <p>
                            {{ __('Purchase Orders') }}
                        </p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('stocks.index') }}" class="nav-link">
                        <i class="bi bi-box-seam nav-icon text-white mr-2"></i>
                        <p>
                            {{ __('Stock Management') }}
                        </p>
                    </a>
                </li>
            @endrole
            
            @role('Unit Clerk||Unit OC||Shop Coord Clerk||Shop Coord OC||Welfare Shop Clerk||Welfare Shop OC||Staff Officer')
                <li class="nav-item">
                    <a href="{{ route('itemloans.index') }}" class="nav-link">
                        <i class="bi bi-clipboard-check nav-icon text-white mr-2"></i>
                        <p>
                            {{ __('Item Loans') }}
                        </p>
                    </a>
                </li>
            @endrole
            
            @role('Unit Clerk||Unit OC||Welfare Shop Clerk||Welfare Shop OC')
                <li class="nav-item">
                    <a href="{{ route('reports.index') }}" class="nav-link">
                        <i class="fas fa-chart-bar nav-icon text-white mr-2"></i>
                        <p>
                            {{ __('Reports') }}
                        </p>
                    </a>
                </li>
            @endrole
            
            @role('Loan Clerk||Loan OC||Account SO||Staff Officer')
                <li class="nav-item">
                    <a href="{{ route('loans.index') }}" class="nav-link">
                        <i class="bi bi-cash-coin nav-icon text-white mr-2"></i>
                        <p>
                            {{ __('Loans') }}
                        </p>
                    </a>
                </li>
            @endrole
            
            @role('Membership Clerk||Membership OC')
                <li class="nav-item">
                    <a href="{{ route('memberships.index') }}" class="nav-link">
                        <i class="nav-iconbi bi-graph-up text-white mr-2"></i>
                        <p class="text-white">
                            {{ __('Membership') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('welfarememberships.index') }}" class="nav-link">
                        <i class="nav-iconbi bi-graph-up text-white mr-2"></i>
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
