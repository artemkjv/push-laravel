@extends('layouts.layout')

@section('content')
    <div class="container">
        <form action="{{ route('home') }}" class="d-flex filters-wrapper mb-2">
            <div class="form-group">
                <label for="from">Date From</label>
                <input class="form-control" name="from" value="{{ \request()->get('from', \Carbon\Carbon::now()->firstOfMonth()->format('Y-m-d')) }}" id="from" type="date" placeholder="Date From">
            </div>
            <div class="form-group">
                <label for="to">Date To</label>
                <input class="form-control" value="{{ \request()->get('to', \Carbon\Carbon::now()->lastOfMonth()->format('Y-m-d')) }}" name="to" id="to" type="date" placeholder="Date To">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
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
            extra: {
                to: '{{ \request()->get('to') }}',
                from: '{{ \request()->get('from') }}'
            },
            el: '#home-chart',
            url: "@chart('home_chart', ['from' => \request()->get('from'), 'to' => \request()->get('to')])",
            hooks: new ChartisanHooks()
                .datasets([
                    {
                        type: 'line',
                        fill: false,
                        color: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }
                ])
        });
    </script>
@endsection
