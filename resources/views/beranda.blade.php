@extends('welcome')

@section('content')
<style>
    :root {
        --primary: #4f46e5;
        --primary-light: #e0e7ff;
        --primary-lighter: #f0f4ff;
        --secondary: #7c3aed;
        --accent: #8b5cf6;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --info: #3b82f6;
        --background: #f8fafc;
        --foreground: #1e293b;
        --muted: #64748b;
        --border: #e2e8f0;
        --card-bg: #ffffff;
        --shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        --shadow-hover: 0 8px 30px rgba(0, 0, 0, 0.1);
        --radius-lg: 1.25rem;
        --radius-md: 0.75rem;
        --radius-sm: 0.5rem;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        background-color: var(--background);
        color: var(--foreground);
        line-height: 1.5;
    }

    .dashboard-header {
        margin-bottom: 3rem;
        text-align: center;
    }

    .dashboard-header h1 {
        font-weight: 800;
        font-size: 2.5rem;
        color: var(--foreground);
        margin-bottom: 0.5rem;
        background: linear-gradient(to right, var(--primary), var(--secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .dashboard-header h2 {
        font-weight: 500;
        font-size: 1.1rem;
        color: var(--muted);
        max-width: 600px;
        margin: 0 auto;
    }

    .dashboard-card {
        background: var(--card-bg);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow);
        padding: 2rem;
        border: 1px solid var(--border);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-hover);
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--foreground);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .card-title i {
        color: var(--primary);
        font-size: 1.2rem;
    }

    .date-label {
        font-size: 0.9rem;
        color: var(--muted);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .date-label i {
        font-size: 1rem;
    }

    .stat-container {
        display: flex;
        justify-content: space-between;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-item {
        flex: 1;
    }

    .stat-number {
        font-size: 2.75rem;
        font-weight: 800;
        color: var(--foreground);
        line-height: 1;
        margin-bottom: 0.5rem;
        font-feature-settings: 'tnum';
    }

    .stat-label {
        font-size: 0.9rem;
        color: var(--muted);
    }

    .trend-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        font-size: 0.8rem;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        margin-left: 0.5rem;
    }

    .trend-up {
        background-color: rgba(16, 185, 129, 0.1);
        color: var(--success);
    }

    .trend-down {
        background-color: rgba(239, 68, 68, 0.1);
        color: var(--danger);
    }

    .trend-neutral {
        background-color: rgba(59, 130, 246, 0.1);
        color: var(--info);
    }

    .chart-container {
        height: 240px;
        margin: 1.5rem 0;
        position: relative;
    }

    .chart-placeholder {
        width: 100%;
        height: 100%;
        background-color: var(--primary-light);
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-weight: 500;
    }

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        margin-top: 1.5rem;
    }

    .summary-item {
        background-color: var(--primary-lighter);
        border-radius: var(--radius-md);
        padding: 1.25rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    .summary-item:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow);
    }

    .members-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin-top: 1.5rem;
    }

    .members-table th {
        font-weight: 600;
        font-size: 0.85rem;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 0.75rem 1rem;
        border-bottom: 1px solid var(--border);
        position: sticky;
        top: 0;
        background-color: var(--card-bg);
    }

    .members-table td {
        padding: 1rem;
        border-bottom: 1px solid var(--border);
        vertical-align: middle;
    }

    .members-table tr:last-child td {
        border-bottom: none;
    }

    .members-table tr:hover td {
        background-color: var(--primary-light);
    }

    .member-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .member-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--primary-light);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-weight: 600;
        flex-shrink: 0;
    }

    .member-name {
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .member-position {
        font-size: 0.85rem;
        color: var(--muted);
    }

    .activity-badge {
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-size: 0.85rem;
        font-weight: 500;
        display: inline-block;
    }

    .badge-update {
        background-color: rgba(139, 92, 246, 0.1);
        color: var(--accent);
    }

    .badge-event {
        background-color: rgba(59, 130, 246, 0.1);
        color: var(--info);
    }

    .badge-upload {
        background-color: rgba(16, 185, 129, 0.1);
        color: var(--success);
    }

    .badge-share {
        background-color: rgba(245, 158, 11, 0.1);
        color: var(--warning);
    }

    .badge-testimonial {
        background-color: rgba(239, 68, 68, 0.1);
        color: var(--danger);
    }

    .divider {
        border-top: 1px solid var(--border);
        margin: 2rem 0;
    }

    .badge-container {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-top: 1.5rem;
    }

    .badge {
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-size: 0.85rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .badge-primary {
        background-color: var(--primary-light);
        color: var(--primary);
    }

    .badge-success {
        background-color: rgba(16, 185, 129, 0.1);
        color: var(--success);
    }

    .badge-warning {
        background-color: rgba(245, 158, 11, 0.1);
        color: var(--warning);
    }

    .badge-info {
        background-color: rgba(59, 130, 246, 0.1);
        color: var(--info);
    }

    /* Chart tooltip styles */
    .chart-tooltip {
        background: var(--card-bg) !important;
        border: 1px solid var(--border) !important;
        border-radius: var(--radius-sm) !important;
        box-shadow: var(--shadow) !important;
        padding: 0.75rem 1rem !important;
    }

    .chart-tooltip .label {
        color: var(--muted) !important;
        font-weight: 600 !important;
        font-size: 0.8rem !important;
        margin-bottom: 0.25rem !important;
    }

    .chart-tooltip .value {
        color: var(--foreground) !important;
        font-weight: 700 !important;
        font-size: 1rem !important;
    }

    @media (max-width: 768px) {
        .dashboard-header h1 {
            font-size: 2rem;
        }

        .stat-container {
            flex-direction: column;
            gap: 1.5rem;
        }

        .summary-grid {
            grid-template-columns: 1fr;
        }

        .stat-number {
            font-size: 2.25rem;
        }
        
        .chart-container {
            height: 200px;
        }
    }
</style>

<div class="container py-5">
    <div class="dashboard-header">
        <h1>JARINGAN ALUMNI</h1>
        <h2>Pantau perkembangan jaringan alumni SMKN 1 Bontang</h2>
    </div>

    <div class="row g-4">
        <!-- Total Pengguna Card -->
        <div class="col-lg-6">
            <div class="dashboard-card">
                <h3 class="card-title">
                    <i class="fas fa-users"></i>
                    Total Pengguna
                </h3>
                <div class="date-label">
                    <i class="fas fa-calendar-alt"></i>
                    Update terakhir: {{ now()->format('d F Y') }}
                </div>
                
                <div class="stat-container">
                    <div class="stat-item">
                        <div class="stat-number" id="total-users">1,458</div>
                        <div class="stat-label">Total pengguna terdaftar</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" id="active-users">
                            620
                            <span class="trend-badge trend-up">
                                <i class="fas fa-arrow-up"></i> 12%
                            </span>
                        </div>
                        <div class="stat-label">Pengguna aktif minggu ini</div>
                    </div>
                </div>
                
                <div class="chart-container">
                    <canvas id="userGrowthChart"></canvas>
                </div>
                
                <div class="badge-container">
                    <span class="badge badge-primary">
                        <i class="fas fa-user-plus"></i> 43 baru bulan ini
                    </span>
                    <span class="badge badge-success">
                        <i class="fas fa-check-circle"></i> 78% aktif
                    </span>
                    <span class="badge badge-warning">
                        <i class="fas fa-sync-alt"></i> 205 pembaruan profil
                    </span>
                </div>
            </div>
        </div>

        <!-- Aktivitas Terkini Card -->
        <div class="col-lg-6">
            <div class="dashboard-card">
                <h3 class="card-title">
                    <i class="fas fa-bell"></i>
                    Aktivitas Terkini
                </h3>
                <div class="date-label">
                    <i class="fas fa-clock"></i>
                    7 hari terakhir
                </div>
                
                <table class="members-table">
                    <thead>
                        <tr>
                            <th>Anggota</th>
                            <th>Aktivitas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="member-info">
                                    <div class="member-avatar">EL</div>
                                    <div>
                                        <div class="member-name">Edward Lindgren</div>
                                        <div class="member-position">Angkatan 2015</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="activity-badge badge-update">Memperbarui profil</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="member-info">
                                    <div class="member-avatar">LO</div>
                                    <div>
                                        <div class="member-name">Leonardo Oliveira</div>
                                        <div class="member-position">Angkatan 2017</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="activity-badge badge-event">Mendaftar acara</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="member-info">
                                    <div class="member-avatar">DL</div>
                                    <div>
                                        <div class="member-name">Dontae Little</div>
                                        <div class="member-position">Angkatan 2018</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="activity-badge badge-upload">Mengunggah CV</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="member-info">
                                    <div class="member-avatar">SB</div>
                                    <div>
                                        <div class="member-name">Sudanita Bakalowitz</div>
                                        <div class="member-position">Angkatan 2016</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="activity-badge badge-share">Membagikan lowongan</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="member-info">
                                    <div class="member-avatar">NY</div>
                                    <div>
                                        <div class="member-name">Naomi Yepes</div>
                                        <div class="member-position">Angkatan 2019</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="activity-badge badge-testimonial">Memberikan testimoni</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-4">
        <!-- Statistik Alumni Card -->
        <div class="col-lg-6">
            <div class="dashboard-card">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie"></i>
                    Statistik Alumni
                </h3>
                
                <div class="summary-grid">
                    <div class="summary-item">
                        <div class="stat-number" id="total-alumni">1,631</div>
                        <div class="stat-label">Total Alumni</div>
                    </div>
                    <div class="summary-item">
                        <div class="stat-number" id="active-alumni">
                            206
                            <span class="trend-badge trend-neutral">
                                <i class="fas fa-minus"></i> 2%
                            </span>
                        </div>
                        <div class="stat-label">Aktif bulan ini</div>
                    </div>
                    <div class="summary-item">
                        <div class="stat-number" id="event-attendees">113</div>
                        <div class="stat-label">Hadir acara</div>
                    </div>
                    <div class="summary-item">
                        <div class="stat-number" id="donors">78</div>
                        <div class="stat-label">Memberi donasi</div>
                    </div>
                </div>
                
                <div class="divider"></div>
                
                <div class="chart-container">
                    <canvas id="alumniDistributionChart"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Koneksi & Lowongan Card -->
        <div class="col-lg-6">
            <div class="dashboard-card">
                <h3 class="card-title">
                    <i class="fas fa-network-wired"></i>
                    Koneksi & Lowongan
                </h3>
                
                <div class="stat-container">
                    <div class="stat-item">
                        <div class="stat-number" id="active-jobs">12</div>
                        <div class="stat-label">Lowongan aktif</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" id="new-connections">
                            24
                            <span class="trend-badge trend-up">
                                <i class="fas fa-arrow-up"></i> 8%
                            </span>
                        </div>
                        <div class="stat-label">Koneksi dibuat</div>
                    </div>
                </div>
                
                <div class="chart-container">
                    <canvas id="jobTrendsChart"></canvas>
                </div>
                
                <div class="badge-container">
                    <span class="badge badge-primary">
                        <i class="fas fa-building"></i> 18 perusahaan rekanan
                    </span>
                    <span class="badge badge-info">
                        <i class="fas fa-handshake"></i> 32 mentor aktif
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate numbers
    const animateNumbers = (elements) => {
        elements.forEach(element => {
            const target = parseInt(element.innerText.replace(/,/g, ''));
            const duration = 2000;
            const start = 0;
            const increment = target / (duration / 16);
            
            let current = start;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    clearInterval(timer);
                    current = target;
                }
                element.innerText = Math.floor(current).toLocaleString('id-ID');
            }, 16);
        });
    };
    
    // Animate all stat numbers
    animateNumbers(document.querySelectorAll('.stat-number'));
    
    // Add hover effects to cards
    const cards = document.querySelectorAll('.dashboard-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-5px)';
            card.style.boxShadow = '0 8px 30px rgba(0, 0, 0, 0.1)';
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = '';
            card.style.boxShadow = '';
        });
    });

    // User Growth Chart
    const userGrowthCtx = document.getElementById('userGrowthChart').getContext('2d');
    const userGrowthChart = new Chart(userGrowthCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Pengguna Baru',
                data: [45, 60, 75, 90, 110, 130, 150, 170, 190, 210, 230, 250],
                borderColor: '#4f46e5',
                backgroundColor: 'rgba(79, 70, 229, 0.1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#4f46e5',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'var(--card-bg)',
                    titleColor: 'var(--foreground)',
                    bodyColor: 'var(--muted)',
                    borderColor: 'var(--border)',
                    borderWidth: 1,
                    padding: 12,
                    boxPadding: 6,
                    usePointStyle: true,
                    callbacks: {
                        label: function(context) {
                            return `${context.dataset.label}: ${context.parsed.y} orang`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        color: 'var(--muted)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: 'var(--muted)'
                    }
                }
            }
        }
    });

    // Alumni Distribution Chart
    const alumniDistributionCtx = document.getElementById('alumniDistributionChart').getContext('2d');
    const alumniDistributionChart = new Chart(alumniDistributionCtx, {
        type: 'doughnut',
        data: {
            labels: ['2015', '2016', '2017', '2018', '2019', '2020', '2021', '2022'],
            datasets: [{
                data: [120, 180, 210, 240, 260, 230, 200, 191],
                backgroundColor: [
                    '#4f46e5',
                    '#6366f1',
                    '#818cf8',
                    '#a5b4fc',
                    '#c7d2fe',
                    '#e0e7ff',
                    '#eff6ff',
                    '#f8fafc'
                ],
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        boxWidth: 12,
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'circle',
                        color: 'var(--muted)'
                    }
                },
                tooltip: {
                    backgroundColor: 'var(--card-bg)',
                    titleColor: 'var(--foreground)',
                    bodyColor: 'var(--muted)',
                    borderColor: 'var(--border)',
                    borderWidth: 1,
                    padding: 12,
                    boxPadding: 6,
                    usePointStyle: true,
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((context.parsed / total) * 100);
                            return `${context.label}: ${context.parsed} alumni (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // Job Trends Chart
    const jobTrendsCtx = document.getElementById('jobTrendsChart').getContext('2d');
    const jobTrendsChart = new Chart(jobTrendsCtx, {
        type: 'bar',
        data: {
            labels: ['Teknik', 'TI', 'Akuntansi', 'Bisnis', 'Bahasa', 'Lainnya'],
            datasets: [{
                label: 'Lowongan Pekerjaan',
                data: [8, 15, 6, 4, 3, 5],
                backgroundColor: [
                    'rgba(79, 70, 229, 0.8)',
                    'rgba(124, 58, 237, 0.8)',
                    'rgba(139, 92, 246, 0.8)',
                    'rgba(165, 180, 252, 0.8)',
                    'rgba(199, 210, 254, 0.8)',
                    'rgba(224, 231, 255, 0.8)'
                ],
                borderColor: [
                    'rgba(79, 70, 229, 1)',
                    'rgba(124, 58, 237, 1)',
                    'rgba(139, 92, 246, 1)',
                    'rgba(165, 180, 252, 1)',
                    'rgba(199, 210, 254, 1)',
                    'rgba(224, 231, 255, 1)'
                ],
                borderWidth: 0,
                borderRadius: 6,
                hoverBackgroundColor: [
                    'rgba(79, 70, 229, 1)',
                    'rgba(124, 58, 237, 1)',
                    'rgba(139, 92, 246, 1)',
                    'rgba(165, 180, 252, 1)',
                    'rgba(199, 210, 254, 1)',
                    'rgba(224, 231, 255, 1)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'var(--card-bg)',
                    titleColor: 'var(--foreground)',
                    bodyColor: 'var(--muted)',
                    borderColor: 'var(--border)',
                    borderWidth: 1,
                    padding: 12,
                    boxPadding: 6,
                    usePointStyle: true,
                    callbacks: {
                        label: function(context) {
                            return `${context.dataset.label} ${context.label}: ${context.parsed.y}`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        color: 'var(--muted)',
                        stepSize: 5
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: 'var(--muted)'
                    }
                }
            }
        }
    });
});
</script>
@endsection