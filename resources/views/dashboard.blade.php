<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (auth()->user()->is_admin)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex justify-between">
                        <div class="p-6 text-gray-900 text-3xl font-bold text-left">
                            {{ __('Approve Users') }}
                        </div>
                        <div class="p-6 text-gray-900 text-3xl font-bold text-right">
                            <a href="{{ route('create-user.view') }}"
                                class="rounded-xl bg-gray-600 text-white px-6 py-2 focus:outline-none focus-visible:ring-1 dark:hover:text-white">Add
                                User</a>
                        </div>
                    </div>

                    @if (session()->has('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                        <table
                            class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                            <thead>
                                <tr class="text-left">
                                    <th
                                        class="py-2 px-3 bg-gray-200 font-semibold text-sm uppercase border-b border-gray-300">
                                        Name</th>
                                    <th
                                        class="py-2 px-3 bg-gray-200 font-semibold text-sm uppercase border-b border-gray-300">
                                        Email</th>
                                    <th
                                        class="py-2 px-3 bg-gray-200 font-semibold text-sm uppercase border-b border-gray-300">
                                        Gender</th>
                                    <th
                                        class="py-2 px-3 bg-gray-200 font-semibold text-sm uppercase border-b border-gray-300">
                                        Registered At</th>
                                    <th
                                        class="py-2 px-3 bg-gray-200 font-semibold text-sm uppercase border-b border-gray-300">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="hover:bg-gray-100">
                                        <td class="py-4 px-6 border-b border-gray-300">{{ $user->name }}</td>
                                        <td class="py-4 px-6 border-b border-gray-300">{{ $user->email }}</td>
                                        <td class="py-4 px-6 border-b border-gray-300">{{ $user->gender }}</td>
                                        <td class="py-4 px-6 border-b border-gray-300">
                                            {{ $user->created_at->diffForHumans() }}</td>
                                        <td class="py-4 px-6 border-b border-gray-300">
                                            <form method="POST"
                                                action="{{ route('profile.approve', ['user' => $user->id]) }}">
                                                @csrf
                                                @method('POST')
                                                <button type="submit"
                                                    class="px-6 py-2 bg-green-300 rounded-xl">Approve</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $users->links('pagination.custom-pagination') }}
                </div>
            </div>
        </div>
    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 text-center text-2xl font-bold">
                        {{ __('Graphical data is shown below') }}
                    </div>
                    <div class="graphs gap-16">

                        <div id="pie-chart">
                            <p class="text-center">Users by provinces:</p>
                            <canvas id="myPieChart" width="600" height="600" class="mx-auto"></canvas>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div id="histogram">
                            <p class="text-center">Users by age:</p>
                            <canvas id="ageHistogram" width="200" height="200"></canvas>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div id="AreaChart">
                            <p class="text-center">Users by Creation Date:</p>
                            <canvas id="userCreationChart" width="400" height="200"></canvas>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>

<script>
    var ctx = document.getElementById('myPieChart').getContext('2d');
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($pieChartData['provinces']) !!},
            datasets: [{
                data: {!! json_encode($pieChartData['user_counts']) !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(51, 26, 486, 0.5)',
                    'rgba(15, 76, 86, 0.5)',
                    'rgba(143, 46, 186, 0.5)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(25, 206, 86, 1)',
                    'rgba(51, 26, 486, 1)',
                    'rgba(15, 76, 86, 1)',
                    'rgba(143, 46, 186, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: false, // Adjust as needed
            maintainAspectRatio: false, // Adjust as needed
            // Add other options like title, legend, etc. here
        }
    });
</script>

<script>
    var ctx = document.getElementById('ageHistogram').getContext('2d');
    var ages = {!! json_encode($histogramData['age_range']) !!}; // Assuming $ageGroups contains your age distribution data
    var counts = {!! json_encode($histogramData['user_counts']) !!}; // Assuming $userCounts contains corresponding user counts

    var ageHistogram = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ages,
            datasets: [{
                label: 'Age Distribution',
                data: counts,
                backgroundColor: 'rgba(54, 162, 235, 0.5)', // Adjust color as needed
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                }]
            }
        }
    });
</script>

<script>
    var ctx = document.getElementById('userCreationChart').getContext('2d');
    var creationDates = {!! json_encode($areaChartData['creation_dates']) !!}; // Assuming $creationDates contains creation dates
    var userCounts = {!! json_encode($areaChartData['user_counts']) !!}; // Assuming $userCounts contains corresponding user counts

    var userCreationChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: creationDates,
            datasets: [{
                label: 'User Creation',
                data: userCounts,
                fill: true,
                backgroundColor: 'rgba(54, 162, 235, 0.2)', // Adjust color and opacity as needed
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    type: 'time',
                    time: {
                        unit: 'day' // Adjust time unit as needed
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
