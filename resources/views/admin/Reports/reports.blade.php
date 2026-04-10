@extends('dashboardadmin')
@section('content')
<div id="content">
    <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom current"><i class="icon-home"></i> Home</a></div>
        <h1>Báo cáo doanh thu</h1>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <h5>Chọn ngày</h5>
                    </div>
                    <div class="widget-content">
                        <input type="date" id="reportDate" value="{{ now()->toDateString() }}">
                    </div>
                </div>
                <div class="widget-box">
                    <div class="widget-title">
                        <h5>Biểu đồ doanh thu</h5>
                    </div>
                    <div class="widget-content">
                        <div id="revenueChart" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
                <div class="widget-box">
                    <div class="widget-title">
                        <h5>Biểu đồ trạng thái đơn hàng</h5>
                    </div>
                    <div class="widget-content">
                        <div id="orderStatusChart" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const renderCharts = (revenueData, orderStatusData) => {
            Highcharts.chart('revenueChart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Biểu đồ doanh thu'
                },
                xAxis: {
                    categories: ['Doanh thu năm', 'Doanh thu tháng', 'Doanh thu ngày']
                },
                yAxis: {
                    title: {
                        text: 'Doanh thu (VND)'
                    }
                },
                series: [{
                    name: 'Doanh thu',
                    data: revenueData,
                    colorByPoint: true
                }]
            });

            Highcharts.chart('orderStatusChart', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Biểu đồ trạng thái đơn hàng trong ngày'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
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
                            format: '<b>{point.name}</b>: {point.y} đơn hàng'
                        }
                    }
                },
                series: [{
                    name: 'Trạng thái',
                    colorByPoint: true,
                    data: orderStatusData
                }]
            });
        };

        const revenueData = @json([
            (float) $tongDoanhThuNam ?? 0,
            (float) $tongDoanhThuThang ?? 0,
            (float) $tongDoanhThuNgay ?? 0
        ]);
        const orderStatusData = @json($donHangTheoTrangThai->map(function ($item) {
            return ['name' => $item->TrangThai, 'y' => $item->SoLuong];
        }));

        renderCharts(revenueData, orderStatusData);

  
        document.getElementById('reportDate').addEventListener('change', function () {
            const selectedDate = this.value;
            fetch(`reports-by-date?date=${selectedDate}`)
                .then(response => response.json())
                .then(data => {
                    renderCharts(data.revenueData, data.orderStatusData);
                })
                .catch(error => console.error('Lỗi khi tải dữ liệu:', error));
        });
    });
</script>
@endsection