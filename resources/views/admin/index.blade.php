@extends('layouts.admin')

@section('content')
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="mountain text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <h6> Mountains </h6>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $mountains->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-mountain fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                <h6> Mountin Active </h6>
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        {{ number_format($mountains->where('check_active', 1)->count()) }}
                                    </div>
                                </div>
                                {{-- <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: {{ $mountains->where('check_active', 1)->count() }}"
                                            aria-valuenow="{{ $mountains->where('check_active', 1)->count() }}"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                <h6> Mountin Not-Active </h6>
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        {{ number_format($mountains->where('check_active', 0)->count()) }}
                                    </div>
                                </div>
                                {{-- <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: {{ ($mountains->where('check_active', 0)->count() / $mountains->count()) * 100 }}%"
                                            aria-valuenow="{{ ($mountains->where('check_active', 0)->count() / $mountains->count()) * 100 }}"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-auto">

                            <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                <h6>Income This Month</h6>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                RM {{ $incomeThisMonth }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Content Row -->

    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary text-uppercase">
                        Chart of Groups Checked In This Year
                    </h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="groupChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary text-uppercase">
                        Revenue Sources
                    </h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="statusChart"></canvas>
                    </div>

                </div>
            </div>
        </div>

        <!-- Content Row -->

        <script>
            var labels = [];
            var counts = [];

            var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
                "November", "December"
            ];

            @foreach ($groups as $group)
                var monthNumber = parseInt("{{ $group->month }}");
                var monthName = monthNames[monthNumber - 1];
                labels.push(monthName);
                counts.push({{ $group->count }});
            @endforeach

            var ctx = document.getElementById('groupChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Check-Ins',
                        data: counts,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            precision: 0,
                            ticks: {
                                stepSize: 1
                            },
                            callback: function(value) {
                                if (value % 1 === 0) {
                                    return value.toFixed(0);
                                }
                            }
                        }
                    }
                }
            });
        </script>

        <script>
            var statusCounts = {!! json_encode($statusCounts) !!};
            var statusLabels = [];
            var statusData = [];
            var statusColors = [];

            for (var i = 0; i < statusCounts.length; i++) {
                var status = statusCounts[i].status;
                var count = statusCounts[i].count;

                statusLabels.push(getStatusLabel(status));
                statusData.push(count);
                statusColors.push(getStatusColor(status));
            }

            function getStatusLabel(status) {
                switch (status) {
                    case "0":
                        return 'Not Started Yet';
                    case "1":
                        return 'Started';
                    case "2":
                        return 'Finished';
                    default:
                        return 'Unknown';
                }
            }

            function getStatusColor(status) {
                switch (status) {
                    case "0":
                        return '#ff6384';
                    case "1":
                        return '#36a2eb';
                    case "2":
                        return '#4bc0c0';
                    default:
                        return '#cccccc';
                }
            }

            var ctx = document.getElementById('statusChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: statusLabels,
                    datasets: [{
                        data: statusData,
                        backgroundColor: statusColors
                    }]
                },
                options: {
                    responsive: true,
                    legend: {
                        position: 'bottom',
                    }
                }
            });
        </script>


        {{-- <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Chart of Climbers Age</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-8 col-lg-7">
                        <div class="chart-area">
                            <canvas id="bar-chart" width="800" height="450"></canvas>
                        </div>
                    </div>

                </div>
            </div>
        </div> --}}

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Select Month and Year</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.route') }}" method="get">
                    <div class="row">
                        <div class="col-md-3">
                            <select class="form-select" name="month">
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ $selectedMonth == $i ? 'selected' : '' }}>
                                        {{ Carbon\Carbon::create(0, $i, 1)->format('F') }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" name="year">
                                @for ($i = 2020; $i <= now()->year; $i++)
                                    <option value="{{ $i }}" {{ $selectedYear == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
                <!-- ======= Chart Section ======= -->
                <section class="chart-section mt-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-8 col-lg-7">
                                <div class="chart-area">
                                    <canvas id="bar-chart" width="800" height="450"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </section><!-- Chart Section -->


            </div>
        </div>



        <script>
            new Chart(document.getElementById("bar-chart"), {
                type: 'bar',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: [{
                        label: "Population (millions)",
                        backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
                        data: {!! json_encode($data) !!}
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Predicted world population (millions) in 2050'
                    }
                }
            });
        </script>


        {{-- <script>
            new Chart(document.getElementById("bar-chart"), {
                type: 'bar',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: [{
                        label: "Population (millions)",
                        backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
                        data: {!! json_encode($data) !!}
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Predicted world population (millions) in 2050'
                    }
                }
            });
        </script> --}}
    @endsection
