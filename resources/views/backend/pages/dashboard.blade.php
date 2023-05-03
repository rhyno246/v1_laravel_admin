@extends('backend.layout.admin')

@section('title')
    <title>Dashboard</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('backend/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/izitoast/css/iziToast.min.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-stats">
                    <div class="card-stats-title">
                        Thống kê đơn hàng
                    </div>
                    <div class="card-stats-items">
                        <div class="card-stats-item">
                            <div class="card-stats-item-count">24</div>
                            <div class="card-stats-item-label">Pending</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count">12</div>
                            <div class="card-stats-item-label">Shipping</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count">23</div>
                            <div class="card-stats-item-label">Completed</div>
                        </div>
                    </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-archive"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Orders</h4>
                    </div>
                    <div class="card-body">
                        59
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-chart">
                    <canvas id="products-chart" height="80"></canvas>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Thống kê sản phẩm</h4>
                    </div>
                    <div class="card-body">
                        {{ count($product) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-chart">
                    <canvas id="post-chart" height="80"></canvas>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Thống kê bài viết</h4>
                    </div>
                    <div class="card-body">
                        {{ count($post) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4>Tình trạng đơn hàng theo tháng</h4>
                </div>
                <div class="card-body">
                    sdasadadsd
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Phản hồi về sản phẩm</h4>
                </div>
                <div class="card-body">
                    dssdaasdsdsa
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Danh sách khách hàng</h4>
                    <div class="text-right">
                        @csrf
                        <a class="btn btn-danger d-none deleteSeleted" data-url="{{ route('customer.deleteselect') }}"
                            style="color: #fff"></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-page">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                                class="custom-control-input" id="checkbox-all" name="main-checkbox">
                                            <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th>Tên tài khoản</th>
                                    <th>Ảnh đại diện</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Thuộc nhóm</th>
                                    <th>Mật khẩu</th>
                                    <th>Đăng ký ngày</th>
                                    <th>Status</th>
                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr id="ids{{ $item->id }}">
                                        <td class="align-middle">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup"
                                                    class="custom-control-input" id="checkbox-{{ $item->id }}"
                                                    name="ids" value="{{ $item->id }}">
                                                <label for="checkbox-{{ $item->id }}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td class="align-middle">{{ $item->name }}</td>
                                        <td class="align-middle"><img
                                                src="{{ $item->src ? $item->src : asset('backend/assets/img/avatar/avatar-1.png') }}"
                                                alt="{{ $item->image_name }}"
                                                style="width: 50px; height: 50px; object-fit: cover; border-radius: 100px">
                                        </td>
                                        <td class="align-middle">{{ $item->email }}</td>
                                        <td class="align-middle">{{ $item->phone }}</td>
                                        <td class="align-middle">{{ $item->role }}</td>
                                        <td class="align-middle">{{ $item->password_dehash }}</td>
                                        <td class="align-middle">{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                        <td class="align-middle">
                                            <label class="custom-switch">
                                                <input type="checkbox"
                                                    data-url="{{ route('customer.statushome', ['id' => $item->id]) }}"
                                                    name="is-show-home" class="custom-switch-input"
                                                    {{ $item->status == 1 ? 'checked' : '' }}>
                                                <span class="custom-switch-indicator"></span>
                                            </label>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('customer.edit', ['id' => $item->id]) }}"
                                                    class="btn btn-primary mr-2">Sửa</a>
                                                <a href="{{ route('customer.delete', ['id' => $item->id]) }}"
                                                    data-url="{{ route('customer.delete', ['id' => $item->id]) }}"
                                                    class="btn btn-danger delete-model">Xóa</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('backend/assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('backend/assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/izitoast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/customDatatable.js') }}"></script>
    <script src="{{ asset('backend/assets/js/deleteModel.js') }}"></script>
    <script src="{{ asset('backend/assets/js/deleteSeleted.js') }}"></script>
    <script src="{{ asset('backend/assets/js/changeStatusHome.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/chart.min.js') }}"></script>
    <script>
        var product_data = @json($product_chart);
        var post_chart = @json($post_chart);
        var balance_chart = document.getElementById("products-chart").getContext('2d');

        var balance_chart_bg_color = balance_chart.createLinearGradient(0, 0, 0, 70);
        balance_chart_bg_color.addColorStop(0, 'rgba(63,82,227,.2)');
        balance_chart_bg_color.addColorStop(1, 'rgba(63,82,227,0)');

        var myChart = new Chart(balance_chart, {
            type: 'line',
            data: {
                labels: product_data.map(item => item.date),
                datasets: [{
                    label: 'Sản phẩm',
                    data: product_data.map(item => item.count),
                    backgroundColor: balance_chart_bg_color,
                    borderWidth: 3,
                    borderColor: 'rgba(63,82,227,1)',
                    pointBorderWidth: 0,
                    pointBorderColor: 'transparent',
                    pointRadius: 3,
                    pointBackgroundColor: 'transparent',
                    pointHoverBackgroundColor: 'rgba(63,82,227,1)',
                }]
            },
            options: {
                layout: {
                    padding: {
                        bottom: -1,
                        left: -1
                    }
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            beginAtZero: true,
                            display: false
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            drawBorder: false,
                            display: false,
                        },
                        ticks: {
                            display: false
                        }
                    }]
                },
            }
        });


        var sales_chart = document.getElementById("post-chart").getContext('2d');
        var sales_chart_bg_color = sales_chart.createLinearGradient(0, 0, 0, 80);
        var myChart2 = new Chart(sales_chart, {
            type: 'line',
            data: {
                labels: post_chart.map(item => item.date),
                datasets: [{
                    label: 'Bài viết',
                    data: post_chart.map(item => item.count),
                    borderWidth: 2,
                    backgroundColor: balance_chart_bg_color,
                    borderWidth: 3,
                    borderColor: 'rgba(63,82,227,1)',
                    pointBorderWidth: 0,
                    pointBorderColor: 'transparent',
                    pointRadius: 3,
                    pointBackgroundColor: 'transparent',
                    pointHoverBackgroundColor: 'rgba(63,82,227,1)',
                }]
            },
            options: {
                layout: {
                    padding: {
                        bottom: -1,
                        left: -1
                    }
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            beginAtZero: true,
                            display: false
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            drawBorder: false,
                            display: false,
                        },
                        ticks: {
                            display: false
                        }
                    }]
                },
            }
        });
    </script>
@endsection
