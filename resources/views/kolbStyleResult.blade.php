@extends('layouts.app')
@section('content')
    <script src="https://cdn.staticfile.org/Chart.js/3.9.1/chart.min.js"></script>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="text-white">
            <h3>{{Auth::user()->username}}的Kolb學習風格指數</h3>
        </div>

        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">分散者</th>
                    <th scope="col">同化者</th>
                    <th scope="col">收斂者</th>
                    <th scope="col">調適者</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row"></th>
                    @foreach($styles as $score)
                        <td>{{$score}}</td>
                    @endforeach
                </tr>
                </tbody>
            </table>
            <div class="m-2">
                <a class="btn btn-danger btn-lg" href="{{url("/")}}" role="button">回首頁</a>
            </div>
        </div>

        <div class="mt-8 mb-2 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <canvas id="kolb_learn_style_radar" width="300" height="300" class="mb-2"></canvas>
            <script>
                const ctx = document.getElementById('kolb_learn_style_radar');
                const data = {
                    labels: [
                        '分散者',
                        '同化者',
                        '收斂者',
                        '調適者',
                    ],
                    datasets: [{
                        label: 'Kolb學習風格指數',
                        borderDashOffset: 0.0,
                        data: [{{$styles['ce_score']}}, {{$styles['ro_score']}}, {{$styles['ac_score']}}, {{$styles['ae_score']}}],
                        fill: true,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgb(255, 99, 132)',
                        pointBackgroundColor: 'rgb(255, 99, 132)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(255, 99, 132)'
                    }]
                };
                const config = {
                    type: 'radar',
                    data: data,
                    options: {
                        responsive: true, // 设置图表为响应式，根据屏幕窗口变化而变化
                        maintainAspectRatio: false,// 保持图表原有比例
                        elements: {
                            line: {
                                borderWidth: 3 // 设置线条宽度
                            }
                        }
                    }
                };
                const myChart = new Chart(ctx, config);
            </script>
        </div>

    </div>
@endsection
