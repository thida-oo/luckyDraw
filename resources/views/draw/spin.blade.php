@extends('layouts.app')

@section('content')
<link href="{{ asset('css/spin.css') }}" rel="stylesheet">
<!-- 
<div class="wrapper">
    <div class="container">
        <canvas id="wheel"></canvas>
        <button id="spin-btn">SPIN</button>
        <img src="{{ asset('image/spinner-arrow-.svg') }}" alt="spinner-arrow">
    </div>
    <div id="final-value">
        <p>Click on Spin Button to start</p>
    </div>
</div>

<script>
    var probData = @json($prob_lists);
    var presentId = @json($id_lists);
    var presentLabel = @json($present_lists);


</script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    -->
    <!-- Chart JS Plugin for displaying text over chart -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.1.0/chartjs-plugin-datalabels.min.js"></script> -->
    <!-- Script -->
     <!-- <script src="{{ asset('js/spin.js') }}"></script>     -->

    <div id="chart"></div>
    <div id="question"><h1></h1></div>
    
    <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
    <script src="{{ asset('js/spin.js') }}"></script>

@endsection