@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 text-gray-800">Dashboard</h1>
</div>

<div id="chart_div" style="height: 500px;"></div>
@endsection

@push('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        const chartData = @json($chartData);

        google.charts.load('current', { packages: ['corechart'] });
        google.charts.setOnLoadCallback(() => {
            const data = google.visualization.arrayToDataTable(chartData);
            const options = {
                title: 'Broj rezervacija po tipu usluge',
                pieHole: 0.4,
            };
            const chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        });
    </script>
@endpush
