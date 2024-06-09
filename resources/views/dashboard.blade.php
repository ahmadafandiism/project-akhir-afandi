<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <style>
        /* Definisi Palet Warna */
        :root {
            --bg-gradient-start: #550C18; /* Warna Latar Gradient Mulai */
            --bg-gradient-end: #443730; /* Warna Latar Gradient Akhir */
            --bg-yellow: #786452; /* Warna Latar Kuning */
            --bg-green: #A5907E; /* Warna Latar Hijau */
            --border-yellow: #F7DAD9; /* Warna Border Kuning */
            --border-green: #F7DAD9; /* Warna Border Hijau */
            --text-yellow: #F7DAD9; /* Warna Teks Kuning */
            --text-green: #F7DAD9; /* Warna Teks Hijau */
        }

        /* Gaya Elemen */
        .bg-gradient {
            background: linear-gradient(to right, var(--bg-gradient-start), var(--bg-gradient-end));
        }
        .animate-pulse {
            animation: pulse 1s infinite;
        }
        @keyframes pulse {
            0% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
            100% {
                opacity: 1;
            }
        }
        .hover-scale:hover {
            transform: scale(1.05);
        }
        .rounded-lg {
            border-radius: 20px;
        }
        .shadow-lg {
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
        }
        .bg-yellow-200 {
            background-color: var(--bg-yellow);
        }
        .bg-green-200 {
            background-color: var(--bg-green);
        }
        .border-yellow-500 {
            border-color: var(--border-yellow);
        }
        .border-green-500 {
            border-color: var(--border-green);
        }
        .text-yellow-800 {
            color: var(--text-yellow);
        }
        .text-green-800 {
            color: var(--text-green);
        }
    </style>

    <div class="bg-gradient py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-6">
                <!-- Temperature Data -->
                <div class="bg-yellow-200 border border-yellow-500 rounded-lg overflow-hidden shadow-lg hover-scale" id="temperature-data">
                    <div class="p-6 text-yellow-800">
                        <h2 class="text-lg font-semibold mb-4">{{ __('Temperature Data') }}</h2>
                        <div>
                            <p><strong>{{ __('Temperature') }}:</strong> <span id="temperature" class="text-blue-500">--</span></p>
                            <canvas id="temperature-chart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <!-- Humidity Data -->
                <div class="bg-green-200 border border-green-500 rounded-lg overflow-hidden shadow-lg hover-scale" id="humidity-data">
                    <div class="p-6 text-green-800">
                        <h2 class="text-lg font-semibold mb-4">{{ __('Humidity Data') }}</h2>
                        <div>
                            <p><strong>{{ __('Humidity') }}:</strong> <span id="humidity" class="text-blue-500">--</span></p>
                            <canvas id="humidity-chart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <!-- Gas Data -->
                <div class="bg-yellow-200 border border-yellow-500 rounded-lg overflow-hidden shadow-lg hover-scale" id="gas-data">
                    <div class="p-6 text-yellow-800">
                        <h2 class="text-lg font-semibold mb-4">{{ __('Gas Data') }}</h2>
                        <div>
                            <p><strong>{{ __('Gas') }}:</strong> <span id="gas" class="text-blue-500">--</span></p>
                            <canvas id="gas-chart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <!-- Motion Data -->
                <div class="bg-green-200 border border-green-500 rounded-lg overflow-hidden shadow-lg hover-scale" id="motion-data">
                    <div class="p-6 text-green-800">
                        <h2 class="text-lg font-semibold mb-4">{{ __('Motion Data') }}</h2>
                        <div>
                            <p><strong>{{ __('Motion') }}:</strong> <span id="motion" class="text-blue-500">--</span></p>
                            <canvas id="motion-chart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <!-- Rainfall Data -->
                <div class="bg-yellow-200 border border-yellow-500 rounded-lg overflow-hidden shadow-lg hover-scale" id="rainfall-data">
                    <div class="p-6 text-yellow-800">
                        <h2 class="text-lg font-semibold mb-4">{{ __('Rainfall Data') }}</h2>
                        <div>
                            <p><strong>{{ __('Rainfall') }}:</strong> <span id="rainfall" class="text-blue-500">--</span></p>
                            <canvas id="rainfall-chart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <!-- LED Control and Notification -->
                <div class="bg-green-200 border border-green-500 rounded-lg overflow-hidden shadow-lg">
                    <div class="p-6 text-green-800">
                        <h2 class="text-lg font-semibold mb-4">{{ __('LED Control') }}</h2>
                        <div id="led-control" class="mb-4">
                            <div class="flex items-center mb-2">
                                <input type="checkbox" id="led1" class="mr-2">
                                <label for="led1" class="mr-4">{{ __('LED 1') }}</label>
                                <input type="checkbox" id="led2" class="mr-2">
                                <label for="led2">{{ __('LED 2') }}</label>
                            </div>
                            <button id="led-submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 hover-scale">{{ __('Submit') }}</button>
                        </div>
                        <h2 class="text-lg font-semibold mb-2">{{ __('Notification') }}</h2>
                        <div id="notification" class="border border-gray-300 p-4 rounded">
                            <p id="notification-text" class="text-gray-500">No new notifications.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Summary Table -->
            <div class="bg-white mt-8 p-6 rounded-lg shadow-lg">
                <h2 class="text-lg font-semibold mb-4">{{ __('Summary Table') }}</h2>
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 border-b">{{ __('Time') }}</th>
                            <th class="py-2 border-b">{{ __('Temperature') }}</th>
                            <th class="py-2 border-b">{{ __('Humidity') }}</th>
                            <th class="py-2 border-b">{{ __('Gas') }}</th>
                            <th class="py-2 border-b">{{ __('Motion') }}</th>
                            <th class="py-2 border-b">{{ __('Rainfall') }}</th>
                        </tr>
                    </thead>
                    <tbody id="summary-table-body">
                        <!-- Rows will be dynamically added here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    const sensorData = {
        temperature: "",
        humidity: "",
        gas: "",
        motion: "",
        rainfall: ""
    };

    function updateSensorData() {
        document.getElementById("temperature").innerText = sensorData.temperature;
        document.getElementById("humidity").innerText = sensorData.humidity;
        document.getElementById("gas").innerText = sensorData.gas;
        document.getElementById("motion").innerText = sensorData.motion;
        document.getElementById("rainfall").innerText = sensorData.rainfall;
    }

    function getRandomData() {
        return Math.floor(Math.random() * 100);
    }

    function renderCharts() {
        // Kode untuk merender grafik akan disisipkan di sini
    }

    function submitLEDControl() {
        // Kode untuk mengirim kontrol LED ke backend akan disisipkan di sini
    }

    // Kode event listener dan pemanggilan fungsi lainnya akan disisipkan di sini
</script>

</x-app-layout>
