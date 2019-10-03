@extends('layouts.app')

@section('pageName')
Dashboard
@endsection

@section('styles')

@endsection

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Dashboard</h3>
    </div>
    <div class="panel-body">
    <h1>Dashboard</h1>
        <div id="main" style="width:600px; height:400px;"></div>
    </div>

</div>
@endsection

@section('scripts')
<script src="{{ asset('js/echarts.min.js') }}"></script>
<script type="text/javascript">
        // based on prepared DOM, initialize echarts instance
        var myChart = echarts.init(document.getElementById('main'));

        option = {
            legend: {},
            tooltip: {},
            dataset: {
                source: [
                    ['product', '2015', '2016', '2017'],
                    ['Matcha Latte', 43.3, 85.8, 93.7],
                    ['Milk Tea', 83.1, 73.4, 55.1],
                    ['Cheese Cocoa', 86.4, 65.2, 82.5],
                    ['Walnut Brownie', 72.4, 53.9, 39.1]
                ]
            },
            xAxis: {type: 'category'},
            yAxis: {},
            // Declare several bar series, each will be mapped
            // to a column of dataset.source by default.
            series: [
                {type: 'bar'},
                {type: 'bar'},
                {type: 'bar'}
            ]
        };


        // use configuration item and data specified to show chart
        myChart.setOption(option);
    </script>
@endsection