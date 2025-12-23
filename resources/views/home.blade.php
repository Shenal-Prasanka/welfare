@extends('layouts.app')

@section('content')
<style>
    .product-card {
        transition: all 0.3s ease;
        border-left: 4px solid #007bff;
        height: 100%;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .product-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 15px;
    }
    
    .stat-card {
        border-radius: 10px;
        transition: transform 0.2s;
    }
    
    .stat-card:hover {
        transform: translateY(-3px);
    }
    
    .category-badge {
        font-size: 0.75rem;
        padding: 4px 10px;
    }
    
    .category-filter {
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .category-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .category-section {
        animation: fadeIn 0.5s ease-in;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const categoryFilters = document.querySelectorAll('.category-filter');
    const categorySections = document.querySelectorAll('.category-section');
    
    // Show only the first category by default
    if (categoryFilters.length > 0 && categorySections.length > 0) {
        const firstCategory = categoryFilters[0].getAttribute('data-category');
        categorySections.forEach(section => {
            const sectionCategory = section.getAttribute('data-category');
            section.style.display = (sectionCategory === firstCategory) ? 'block' : 'none';
        });
    }
    
    // Handle category filter clicks
    categoryFilters.forEach(filter => {
        filter.addEventListener('click', function() {
            const selectedCategory = this.getAttribute('data-category');
            
            // Remove active class from all filters
            categoryFilters.forEach(f => f.classList.remove('active'));
            
            // Add active class to clicked filter
            this.classList.add('active');
            
            // Show only selected category
            categorySections.forEach(section => {
                const sectionCategory = section.getAttribute('data-category');
                section.style.display = (sectionCategory === selectedCategory) ? 'block' : 'none';
            });
        });
    });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const ctx = document.getElementById('welfareChart').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun'],
            datasets: [{
                data: [2, 4, 3, 5, 6, {{ $welfares ?? 0 }}],
                borderColor: '#ffffff',
                backgroundColor: 'rgba(255,255,255,0.2)',
                fill: true,
                tension: 0.4,
                pointRadius: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: { enabled: false }
            },
            scales: {
                x: { display: false },
                y: { display: false }
            }
        }
    });

});
</script>



<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        @if(auth()->user()->hasRole('Welfare Shop Clerk') || auth()->user()->hasRole('Welfare Shop OC'))
            <!-- Category Filter and Products -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title"><i class="fas fa-cubes mr-2"></i>Available Products</h3>
                        </div>
                        <div class="card-body">
                            @if($categories->count() > 0)
                                <!-- Category Filter Buttons -->
                                <div class="mb-4">
                                    <h5 class="mb-3"><i class="fas fa-filter mr-2"></i>Select Category:</h5>
                                    <div class="btn-group-toggle d-flex flex-wrap" data-toggle="buttons">
                                        @foreach($categories as $index => $category)
                                            <label class="btn btn-outline-primary m-1 category-filter {{ $index === 0 ? 'active' : '' }}" data-category="{{ $category->category }}">
                                                <input type="radio" name="category" {{ $index === 0 ? 'checked' : '' }}> 
                                                <i class="fas fa-tag mr-1"></i>{{ $category->category }} ({{ $category->products_count }})
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                <hr>

                                <!-- Products Display -->
                                @foreach($categoryStocks as $categoryName => $products)
                                    <div class="category-section" data-category="{{ $categoryName }}">
                                        <h4 class="mb-3 text-primary">
                                            <i class="fas fa-folder-open mr-2"></i>{{ $categoryName }}
                                        </h4>
                                        <div class="row mb-4">
                                            @foreach($products as $product)
                                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                                    <div class="card product-card">
                                                        <div class="card-body text-center">
                                                            <div class="product-icon bg-primary text-white mx-auto">
                                                                <i class="fas fa-box"></i>
                                                            </div>
                                                            <h5 class="card-title font-weight-bold">{{ $product->item_name }}</h5>
                                                            @if($product->item_model)
                                                                <small class="text-muted d-block mb-2">
                                                                    <i class="fas fa-barcode mr-1"></i>{{ $product->item_model }}
                                                                </small>
                                                            @endif
                                                            <span class="badge badge-success category-badge mb-2">
                                                                {{ $product->item_category }}
                                                            </span>
                                                            <div class="mt-3">
                                                                <div class="mb-3">
                                                                    <h2 class="text-primary mb-0">{{ $product->available_count }}</h2>
                                                                    <small class="text-muted">Available in Stock</small>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <strong class="text-success">Welfare Price:</strong>
                                                                    <h5 class="text-success mb-0">Rs. {{ number_format($product->welfare_price, 2) }}</h5>
                                                                </div>
                                                                <div>
                                                                    <small class="text-muted">Normal Price: Rs. {{ number_format($product->normal_price, 2) }}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-info text-center">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    No available stock items found in your welfare shop.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @elseif(auth()->user()->hasRole('Shop Coord Clerk') || auth()->user()->hasRole('Shop Coord OC'))
            <!-- Shop Coordinator Dashboard - Welfare Shop Wise Stock Count -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
    
                        <div class="card-body">
                            @if(isset($welfareStockCounts) && $welfareStockCounts->count() > 0)
                                @foreach($welfareStockCounts as $welfareStock)
                                    <div class="card mb-4 shadow">
                                        <div class="card-header bg-dark text-white">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h4 class="mb-0">
                                                    <i class="fas fa-store mr-2"></i>{{ $welfareStock->welfare_name }}
                                                </h4>
                                                <div>
                                                    <span class="badge badge-light mr-2">
                                                        <i class="fas fa-boxes mr-1"></i>{{ number_format($welfareStock->total_stock) }} Total Stock
                                                    </span>
                                                    <span class="badge badge-light">
                                                        <i class="fas fa-box mr-1"></i>{{ $welfareStock->product_count }} Products
                                                    </span>
                                                </div>
                                            </div>
                                          
                                        </div>
                                        <div class="card-body">
                                            @if($welfareStock->products->count() > 0)
                                                <div class="table-responsive">
                                                    <table class="table table-hover mb-0" style="border: 2px solid black;">
                                                        <thead class="" style="border-bottom: 2px solid black;">
                                                            <tr>

                                                                <th width="40%">Product Name</th>
                                                                <th width="15%">Product Number</th>
                                                                <th width="10%" class="text-center">Available</th>
                                                                <th width="10%" class="text-center">Issued</th>
                                                                <th width="10%" class="text-center">Damaged</th>
                                                               

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($welfareStock->products as $index => $product)
                                                                <tr>

                                                                    <td>
                                                                        <strong>{{ $product->product_name }}</strong>
                                                                    </td>
                                                                    <td>
                                                                        <span class="badge badge-secondary">{{ $product->product_number }}</span>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <span class="badge badge-success">{{ $product->available_count }}</span>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <span class="badge badge-warning">{{ $product->issued_count }}</span>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <span class="badge badge-danger">{{ $product->damaged_count }}</span>
                                                                    </td>

                                                               

                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                        
                                                    </table>
                                                </div>
                                            @else
                                                <div class="alert alert-info mb-0">
                                                    <i class="fas fa-info-circle mr-2"></i>No products in stock for this welfare shop.
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-info text-center">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    No stock data available for welfare shops.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

           <!-- Summary Statistics -->
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $welfares ?? 0 }}</h3>
                <p>Total Welfare Shops</p>

            </div>

            <div class="icon">
                <i class="fas fa-store"></i>
            </div>
        </div>
    </div>
</div>


                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalStockItems ?? 0 }}</h3>
                            <p>Total Stock Items</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $products ?? 0 }}</h3>
                            <p>Total Products</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $totalSuppliers ?? 0 }}</h3>
                            <p>Total Suppliers</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-truck"></i>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Default Dashboard for Other Roles -->
            <div class="row">
                <div class="col-lg-2 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $totalSuppliers }}</h3>
                            <p>Total Suppliers</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-truck text-white"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $welfares }}</h3>
                            <p>Total WelfareShops</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-store text-white"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $products }}</h3>
                            <p>Total Products</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-box-open text-white"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $regements }}</h3>
                            <p>Total Regiments</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-flag text-white"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $ranks }}</h3>
                            <p>Total Ranks</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-star text-white"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-6">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{ $units }}</h3>
                            <p>Total Units</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div id="product"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div id="welfare"></div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript">
        Highcharts.chart('product', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Product for 2025'
            },
            xAxis: {
                categories: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
                crosshair: true,
                accessibility: {
                    description: 'month'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'count'
                }
            },
            tooltip: {
                valueSuffix: ' (100 MT)'
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [
                {
                    name: 'Products',
                    data: [
                        @foreach($productCounts as $count) 
                            {{ $count }},
                        @endforeach
                    ]
                }
            ]
        });

        Highcharts.chart('welfare', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Welfare for 2025'
            },
            xAxis: {
                categories: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
                crosshair: true,
                accessibility: {
                    description: 'month'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'count'
                }
            },
            tooltip: {
                valueSuffix: ' Welfares'
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [
                {
                    name: 'Welfares',
                    data: [
                        @foreach($welfareCounts as $count) 
                            {{ $count }},
                        @endforeach
                    ]
                }
            ]
        });
    </script>
    @endpush

<!-- Goals and To-Do List Row -->
<div class="row">
    <!-- Goal Completion - Left Column -->
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header">
                <h3 class="card-title">Goal Completion</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="progress-group mb-4">
                    Add Products to Cart
                    <span class="float-right"><b>160</b>/200</span>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 80%"></div>
                    </div>
                </div>

                <div class="progress-group mb-4">
                    Complete Purchase
                    <span class="float-right"><b>310</b>/400</span>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: 75%"></div>
                    </div>
                </div>

                <div class="progress-group mb-4">
                    <span class="progress-text">Visit Premium Page</span>
                    <span class="float-right"><b>480</b>/800</span>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: 60%"></div>
                    </div>
                </div>

                <div class="progress-group">
                    Send Inquiries
                    <span class="float-right"><b>250</b>/500</span>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: 50%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- To-Do List - Right Column -->
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header">
                <h3 class="card-title">To-Do List</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <ul class="todo-list" data-widget="todo-list">
                    <li>
                        <div class="icheck-primary d-inline ml-2">
                            <input type="checkbox" value="" name="todo1" id="todoCheck1">
                            <label for="todoCheck1"></label>
                        </div>
                        <span class="text">Design a nice theme</span>
                        <small class="badge badge-danger"><i class="far fa-clock"></i> 2 mins</small>
                        <div class="tools">
                            <i class="fas fa-edit"></i>
                            <i class="fas fa-trash-o"></i>
                        </div>
                    </li>
                    <li>
                        <div class="icheck-primary d-inline ml-2">
                            <input type="checkbox" value="" name="todo2" id="todoCheck2" checked>
                            <label for="todoCheck2"></label>
                        </div>
                        <span class="text">Make the theme responsive</span>
                        <small class="badge badge-info"><i class="far fa-clock"></i> 4 hours</small>
                        <div class="tools">
                            <i class="fas fa-edit"></i>
                            <i class="fas fa-trash-o"></i>
                        </div>
                    </li>
                    <li>
                        <div class="icheck-primary d-inline ml-2">
                            <input type="checkbox" value="" name="todo3" id="todoCheck3">
                            <label for="todoCheck3"></label>
                        </div>
                        <span class="text">Let theme shine like a star</span>
                        <small class="badge badge-warning"><i class="far fa-clock"></i> 1 day</small>
                        <div class="tools">
                            <i class="fas fa-edit"></i>
                            <i class="fas fa-trash-o"></i>
                        </div>
                    </li>
                    <li>
                        <div class="icheck-primary d-inline ml-2">
                            <input type="checkbox" value="" name="todo4" id="todoCheck4">
                            <label for="todoCheck4"></label>
                        </div>
                        <span class="text">Let theme shine like a star</span>
                        <small class="badge badge-success"><i class="far fa-clock"></i> 3 days</small>
                        <div class="tools">
                            <i class="fas fa-edit"></i>
                            <i class="fas fa-trash-o"></i>
                        </div>
                    </li>
                    <li>
                        <div class="icheck-primary d-inline ml-2">
                            <input type="checkbox" value="" name="todo5" id="todoCheck5">
                            <label for="todoCheck5"></label>
                        </div>
                        <span class="text">Check your messages and notifications</span>
                        <small class="badge badge-primary"><i class="far fa-clock"></i> 1 week</small>
                        <div class="tools">
                            <i class="fas fa-edit"></i>
                            <i class="fas fa-trash-o"></i>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="card-footer clearfix">
                <button type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add item</button>
            </div>
        </div>
    </div>
</div>

<!-- Row for both cards -->
<div class="row mt-3 mb-3">
    <!-- Recently Added Products - Left Column -->
    <div class="col-md-6">
        <div class="card h-100" style="min-height: 500px;">
            <div class="card-header">
                <h3 class="card-title">Price List</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    @forelse($recentProducts as $product)
                    <li class="item">
                        <div class="product-info">
                            <a href="javascript:void(0)" class="product-title">
                                {{ $product->product }}
                                <span class="badge badge-danger float-right mr-2">Rs. {{ number_format($product->welfare_price, 2) }}</span>
                            </a>
                            <span class="product-description">
                                {{ $product->vat ? 'VAT: ' . $product->vat . '%' : '' }}
                                {{ $product->tax ? ' | Tax: ' . $product->tax . '%' : '' }}
                                @if($product->category)
                                 | {{ $product->category->category }}
                                @endif
                            </span>
                        </div>
                    </li>
                    @empty
                    <li class="item">
                        <div class="product-info">
                            <span class="product-description text-muted">
                                No recently added products found.
                            </span>
                        </div>
                    </li>
                    @endforelse
                </ul>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('products.index') }}" class="uppercase">View All Products</a>
            </div>
        </div>
    </div>

    <!-- Product Distribution by Welfare - Right Column -->
    <div class="col-md-6">
        <div class="card h-100" style="min-height: 500px;">
            <div class="card-header">
                <h3 class="card-title">Product Distribution</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div id="welfareProductChart" style="min-width: 100%; height: 400px;"></div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Highcharts.chart('welfareProductChart', {
            chart: {
                type: 'pie',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                style: {
                    fontFamily: 'Nunito, sans-serif'
                }
            },
            title: {
                text: 'Product Distribution by Welfare',
                align: 'center',
                style: {
                    fontSize: '14px',
                    fontWeight: 'bold',
                    color: '#333'
                }
            },
            subtitle: {
                text: 'Click on segments for details',
                align: 'center',
                style: {
                    fontSize: '11px',
                    color: '#666'
                }
            },
            tooltip: {
                pointFormat: '<b>{point.percentage:.1f}%</b> of products<br/>{point.y} products'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f}%',
                        style: {
                            fontSize: '11px',
                            fontWeight: 'normal',
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    },
                    showInLegend: true,
                    size: '100%',
                    innerSize: '40%',
                    dataLabels: {
                        enabled: true,
                        distance: 10,
                        style: {
                            fontSize: '11px',
                            textOverflow: 'none'
                        }
                    }
                }
            },
            series: [{
                name: 'Products',
                colorByPoint: true,
                data: @json($welfareProductDistribution),
                dataLabels: {
                    enabled: true,
                    format: '{point.name}: {point.percentage:.1f}%',
                    distance: 10,
                    style: {
                        fontSize: '11px',
                        textOverflow: 'none'
                    }
                },
                point: {
                    events: {
                        mouseOver: function() {
                            this.series.chart.setTitle({
                                text: `Product Distribution - ${this.name}`
                            });
                        },
                        mouseOut: function() {
                            this.series.chart.setTitle({
                                text: 'Product Distribution by Welfare'
                            });
                        }
                    }
                }
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
    });
</script>
@endpush
@endsection
