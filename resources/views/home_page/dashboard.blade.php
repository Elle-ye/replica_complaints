@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/self/graphs.css') }}">
@endsection

@section('content')
    <h2>Dashboard</h2>

<!-- breadcrumbs -->
<ul class="breadcrumbs" style="--breadcrumbs-background: #f0f0f0; --breadcrumbs-color: #333333;">
    <li class="active" data-divider="›"><a href="#"><span class="icon mif-home"></span>Dashboard</a></li>
    {{-- <li data-divider="›"><a href="#">Library</a></li>
    <li class="active"><a href="#">Data</a></li> --}}
</ul>

    <div class="row mt-4">

        <div class="cell-md-4">
            <div class="card shadow-medium">
                <div class="card-header bg-primary">
                    Total Users
                </div>
                <div class="card-content p-4">
                    <h3>150</h3>
                </div>
            </div>
        </div>

        <div class="cell-md-4">
            <div class="card shadow-medium">
                <div class="card-header bg-success">
                    Sales
                </div>
                <div class="card-content p-4">
                    <h3>$2,450</h3>
                </div>
            </div>
        </div>

        <div class="cell-md-4">
            <div class="card shadow-medium">
                <div class="card-header bg-alert">
                    Pending Orders
                </div>
                <div class="card-content p-4">
                    <h3>23</h3>
                </div>
            </div>
        </div>

    </div>

    {{-- Line Graph --}}
    <div class="col-md-12 mb-10 pt-10">
        <div class="card ">
            <div class="card-header">
                <div class="header-content">
                    <div class="card-title">
                        <h2>Line Graph</h2>
                    </div>
                    <div class="card-description">Sub-text / Description</div>
                </div>
                <div class="d-flex justify-content-center align-items-center reverse-container me-2 gap-2">
                    <div class="stat-info col-md-6 order-sm-reverse1">
                        <span class="stat-label">Total:</span>
                        <span class="stat-value" id="total-value">0</span>
                    </div>
                    {{-- <select data-role="select">
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <option value="option3">Option 3</option>
                    </select> --}}
                    <div class="select-container order-sm-reverse2">

                        {{-- <select data-role="select"  id="chartType" class="">
                            <option value="otc">Some Product Name</option>
                            <option value="pm">Other Product Name</option>
                        </select> --}}
                        <select id="chartType" class="form-select w-auto">
                            <option value="otc">Some Product Name</option>
                            <option value="pm">Other Product Name</option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="card-content">
                <div class="chart-container">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-5 mb-10 pt-10">
        {{-- Doughnut Chart --}}
        <div class="col-md-6">
            <div class="card bg-light bg-gradient2">
                <div class="card-header">
                    <div class="header-content">
                        <div class="card-title">
                            <h2>Distribution</h2>
                        </div>
                        <div class="card-description">Product breakdown</div>
                    </div>
                </div>
                <div class="card-content">
                    <div class="chart-container pie-chart-container">
                        <canvas id="pieChart"></canvas>
                    </div>

                    <div class="stats-grid">
                        <div class="stat-card otc">
                            <div class="stat-header">
                                <div class="stat-icon otc"></div>
                                <span class="pie-stat-label">otc</span>
                            </div>
                            <div class="pie-stat-value" id="otc-pie-value">0</div>
                            <div class="stat-percentage" id="otc-pie-percentage">0%</div>
                        </div>

                        <div class="stat-card pm">
                            <div class="stat-header">
                                <div class="stat-icon pm"></div>
                                <span class="pie-stat-label">pm</span>
                            </div>
                            <div class="pie-stat-value" id="pm-pie-value">0</div>
                            <div class="stat-percentage" id="pm-pie-percentage">0%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <h4>Recent Users</h4>

        <div class="card shadow-medium">
            <table class="table striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Elham</td>
                        <td>elham@email.com</td>
                        <td><span class="badge success">Active</span></td>
                        <td><a href="#">More</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/self/graphs.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
