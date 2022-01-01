@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">{{ __('Dashboard') }}</div>

        <div class="card-body">
            <div id="home-chart" style="height: 300px;"></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <script>

        const chart = new Chartisan({
            el: '#home-chart',
            url: "@chart('home_chart')",
            hooks: new ChartisanHooks()
                .datasets([{type: 'line', fill: false, color: 'rgb(75, 192, 192)', tension: 0.1}])
        });
    </script>
@endsection
