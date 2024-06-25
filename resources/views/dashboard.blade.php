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
                <div class="bg-yellow-200 border border-yellow-500 rounded-lg overflow-hidden shadow-lg hover-scale" id="temperature-data">
                    <div class="p-6 text-yellow-800">
                        <h2 class="text-lg font-semibold mb-4">{{ __('Temperature Data') }}</h2>
                        <div>
                            <p><strong>{{ __('Temperature') }}:</strong> <span id="temperature" class="text-blue-500">--</span></p>
                            <canvas id="temperature-chart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <!-- Menambahkan atribut id dan event listener ke setiap div -->
                <!-- Sisanya juga ditambahkan dengan cara yang sama -->
                <div class="bg-green-200 border border-green-500 rounded-lg overflow-hidden shadow-lg hover-scale" id="humidity-data">
                    <div class="p-6 text-green-800">
                        <h2 class="text-lg font-semibold mb-4">{{ __('Humidity Data') }}</h2>
                        <div>
                            <p><strong>{{ __('Humidity') }}:</strong> <span id="humidity" class="text-blue-500">--</span></p>
                            <canvas id="humidity-chart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="bg-yellow-200 border border-yellow-500 rounded-lg overflow-hidden shadow-lg hover-scale" id="gas-data">
                    <div class="p-6 text-yellow-800">
                        <h2 class="text-lg font-semibold mb-4">{{ __('Gas Data') }}</h2>
                        <div>
                            <p><strong>{{ __('Gas') }}:</strong> <span id="gas" class="text-blue-500">--</span></p>
                            <canvas id="gas-chart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="bg-green-200 border border-green-500 rounded-lg overflow-hidden shadow-lg hover-scale" id="motion-data">
                    <div class="p-6 text-green-800">
                        <h2 class="text-lg font-semibold mb-4">{{ __('Motion Data') }}</h2>
                        <div>
                            <p><strong>{{ __('Motion') }}:</strong> <span id="motion" class="text-blue-500">--</span></p>
                            <canvas id="motion-chart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="bg-yellow-200 border border-yellow-500 rounded-lg overflow-hidden shadow-lg hover-scale" id="rainfall-data">
                    <div class="p-6 text-yellow-800">
                        <h2 class="text-lg font-semibold mb-4">{{ __('Rainfall Data') }}</h2>
                        <div>
                            <p><strong>{{ __('Rainfall') }}:</strong> <span id="rainfall" class="text-blue-500">--</span></p>
                            <canvas id="rainfall-chart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="bg-green-200 border border-green-500 rounded-lg overflow-hidden shadow-lg hover-scale">
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
                            <th class="py-2 border-b">Time</th>
                            <th class="py-2 border-b">Temperature</th>
                            <th class="py-2 border-b">Humidity</th>
                            <th class="py-2 border-b">Gas</th>
                            <th class="py-2 border-b">Motion</th>
                            <th class="py-2 border-b">Rainfall</th>
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
            const temperatureCtx = document.getElementById('temperature-chart').getContext('2d');
            const humidityCtx = document.getElementById('humidity-chart').getContext('2d');
            const gasCtx = document.getElementById('gas-chart').getContext('2d');
            const motionCtx = document.getElementById('motion-chart').getContext('2d');
            const rainfallCtx = document.getElementById('rainfall-chart').getContext('2d');

            const temperatureChart = new Chart(temperatureCtx, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Temperature',
                        data: [],
                        backgroundColor: '#000000',
                        borderColor: '#FFFFFF',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const humidityChart = new Chart(humidityCtx, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Humidity',
                        data: [],
                        backgroundColor: '#000000',
                        borderColor: '#FFFFFF',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const gasChart = new Chart(gasCtx, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Gas',
                        data: [],
                        backgroundColor: '#000000',
                        borderColor: '#FFFFFF',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const motionChart = new Chart(motionCtx, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Motion',
                        data: [],
                        backgroundColor: '#000000',
                        borderColor: '#FFFFFF',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const rainfallChart = new Chart(rainfallCtx, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Rainfall',
                        data: [],
                        backgroundColor: '#000000',
                        borderColor: '#FFFFFF',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            setInterval(() => {
                const now = new Date();
                const time = `${now.getHours()}:${now.getMinutes()}:${now.getSeconds()}`;

                if (temperatureChart.data.labels.length > 20) {
                    temperatureChart.data.labels.shift();
                    temperatureChart.data.datasets[0].data.shift();
                }
                temperatureChart.data.labels.push(time);
                temperatureChart.data.datasets[0].data.push(getRandomData());
                temperatureChart.update();

                if (humidityChart.data.labels.length > 20) {
                    humidityChart.data.labels.shift();
                    humidityChart.data.datasets[0].data.shift();
                }
                humidityChart.data.labels.push(time);
                humidityChart.data.datasets[0].data.push(getRandomData());
                humidityChart.update();

                if (gasChart.data.labels.length > 20) {
                    gasChart.data.labels.shift();
                    gasChart.data.datasets[0].data.shift();
                }
                gasChart.data.labels.push(time);
                gasChart.data.datasets[0].data.push(getRandomData());
                gasChart.update();

                if (motionChart.data.labels.length > 20) {
                    motionChart.data.labels.shift();
                    motionChart.data.datasets[0].data.shift();
                }
                motionChart.data.labels.push(time);
                motionChart.data.datasets[0].data.push(getRandomData());
                motionChart.update();

                if (rainfallChart.data.labels.length > 20) {
                    rainfallChart.data.labels.shift();
                    rainfallChart.data.datasets[0].data.shift();
                }
                rainfallChart.data.labels.push(time);
                rainfallChart.data.datasets[0].data.push(getRandomData());
                rainfallChart.update();

                // Update summary table
                const summaryTableBody = document.getElementById('summary-table-body');
                const newRow = document.createElement('tr');

                // Mendapatkan nilai terakhir dari setiap dataset
                const lastTemperature = temperatureChart.data.datasets[0].data.slice(-1)[0];
                const lastHumidity = humidityChart.data.datasets[0].data.slice(-1)[0];
                const lastGas = gasChart.data.datasets[0].data.slice(-1)[0];
                const lastMotion = motionChart.data.datasets[0].data.slice(-1)[0];
                const lastRainfall = rainfallChart.data.datasets[0].data.slice(-1)[0];

                                    // Memeriksa perubahan data dan hanya menambahkan perubahan ke tabel
                    if (summaryTableBody.lastTemperature !== lastTemperature ||
                        summaryTableBody.lastHumidity !== lastHumidity ||
                        summaryTableBody.lastGas !== lastGas ||
                        summaryTableBody.lastMotion !== lastMotion ||
                        summaryTableBody.lastRainfall !== lastRainfall) {
                        // Menyimpan nilai terakhir untuk digunakan dalam pembandingan berikutnya
                        summaryTableBody.lastTemperature = lastTemperature;
                        summaryTableBody.lastHumidity = lastHumidity;
                        summaryTableBody.lastGas = lastGas;
                        summaryTableBody.lastMotion = lastMotion;
                        summaryTableBody.lastRainfall = lastRainfall;

                        // Membuat baris baru dengan nilai perubahan
                        newRow.innerHTML = `
                            <td class="py-2 border-b">${time}</td>
                            <td class="py-2 border-b">${lastTemperature}°C ${lastTemperature > 30 ? '🌡️' : ''}</td>
                            <td class="py-2 border-b">${lastHumidity}% ${lastHumidity < 40 ? '⚠️' : '✅'}</td>
                            <td class="py-2 border-b">${lastGas} ${lastGas > 50 ? '⚠️' : '✅'}</td>
                            <td class="py-2 border-b">${lastMotion}</td>
                            <td class="py-2 border-b">${lastRainfall}mm ${lastRainfall > 10 ? '🌧️' : ''}</td>
                        `;

                        // Menambahkan baris baru ke tabel
                        summaryTableBody.appendChild(newRow);

                        // Menghapus baris lama jika lebih dari 20 baris
                        if (summaryTableBody.rows.length > 5) {
                            summaryTableBody.deleteRow(0);
                        }

                        // Update notification
                        const notificationText = document.getElementById('notification-text');
                        let notificationMessage = '';

                        if (lastTemperature > 30) {
                            notificationMessage += `Temperature is high: ${lastTemperature}°C 🌡️\n`;
                        }

                        if (lastHumidity < 40) {
                            notificationMessage += `Humidity is low: ${lastHumidity}% ⚠️\n`;
                        } else {
                            notificationMessage += `Humidity is normal: ${lastHumidity}% ✅\n`;
                        }

                        if (lastGas > 50) {
                            notificationMessage += `Gas level is high: ${lastGas} ⚠️\n`;
                        } else {
                            notificationMessage += `Gas level is normal: ${lastGas} ✅\n`;
                        }

                        if (lastRainfall > 10) {
                            notificationMessage += `Rainfall is high: ${lastRainfall}mm 🌧️\n`;
                        }

                        notificationText.innerText = notificationMessage.trim() || 'No new notifications.';
                    }
                }, 1000);
            }

            function submitLEDControl() {
                const led1Checked = document.getElementById("led1").checked;
                const led2Checked = document.getElementById("led2").checked;

                // Simulasi kirim data ke backend
                console.log("LED 1:", led1Checked);
                console.log("LED 2:", led2Checked);

                // Tambahkan efek animasi
                const button = document.getElementById("led-submit");
                button.classList.add('animate-pulse');
                setTimeout(() => {
                    button.classList.remove('animate-pulse');
                }, 1000);
            }

            // Menambahkan event listener untuk setiap tabel
            document.getElementById("temperature-data").addEventListener("click", function() {
                temperature.blade.php = "/temperature-page"; // Ganti dengan URL halaman yang sesuai
            });

            document.getElementById("humidity-data").addEventListener("click", function() {
                window.location.href = "/humidity-page"; // Ganti dengan URL halaman yang sesuai
            });

            document.getElementById("gas-data").addEventListener("click", function() {
                window.location.href = "/gas-page"; // Ganti dengan URL halaman yang sesuai
            });

            document.getElementById("motion-data").addEventListener("click", function() {
                window.location.href = "/motion-page"; // Ganti dengan URL halaman yang sesuai
            });

            document.getElementById("rainfall-data").addEventListener("click", function() {
                rainfall.blade.php = "/rainfall-page"; // Ganti dengan URL halaman yang sesuai
            });

            updateSensorData();
            renderCharts();

            document.getElementById("led-submit").addEventListener("click", submitLEDControl);
        </script>
    </x-app-layout>


