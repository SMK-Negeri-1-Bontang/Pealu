@extends('welcome')

@section('content')
<style>
    :root {
        --primary: #6366f1;
        --primary-light: #e0e7ff;
        --primary-lighter: #f5f7ff;
        --secondary: #8b5cf6;
        --accent: #a78bfa;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --info: #3b82f6;
        --background: #f8fafc;
        --foreground: #1e293b;
        --muted: #64748b;
        --border: #e2e8f0;
        --card-bg: #ffffff;
        --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --card-shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        --radius-lg: 16px;
        --radius-md: 12px;
        --radius-sm: 8px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
        position: relative;
        padding-bottom: 1.5rem;
    }

    .dashboard-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: linear-gradient(to right, var(--primary), var(--secondary));
        border-radius: 2px;
    }

    .dashboard-header h1 {
        font-weight: 800;
        font-size: 2.75rem;
        color: var(--foreground);
        margin-bottom: 0.75rem;
        letter-spacing: -0.025em;
    }

    .dashboard-header h2 {
        font-weight: 500;
        font-size: 1.15rem;
        color: var(--muted);
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .dashboard-card {
        background: var(--card-bg);
        border-radius: var(--radius-lg);
        box-shadow: var(--card-shadow);
        padding: 2rem;
        border: 1px solid var(--border);
        transition: var(--transition);
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--card-shadow-hover);
    }

    .card-title {
        font-size: 1.35rem;
        font-weight: 700;
        color: var(--foreground);
        margin-bottom: 1.75rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        position: relative;
        padding-bottom: 0.75rem;
    }

    .card-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 3px;
        background: linear-gradient(to right, var(--primary), var(--secondary));
        border-radius: 3px;
    }

    .card-title i {
        color: var(--primary);
        font-size: 1.3rem;
        background: var(--primary-lighter);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
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
        padding: 1.25rem;
        background: var(--primary-lighter);
        border-radius: var(--radius-md);
        transition: var(--transition);
    }

    .stat-item:hover {
        transform: translateY(-3px);
        box-shadow: var(--card-shadow);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--foreground);
        line-height: 1;
        margin-bottom: 0.5rem;
        font-feature-settings: 'tnum';
        letter-spacing: -0.025em;
    }

    .stat-label {
        font-size: 0.9rem;
        color: var(--muted);
        font-weight: 500;
    }

    .trend-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        font-size: 0.75rem;
        padding: 0.35rem 0.75rem;
        border-radius: 9999px;
        margin-left: 0.5rem;
        font-weight: 600;
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
        height: 250px;
        margin: 2rem 0;
        position: relative;
    }

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.25rem;
        margin-top: 1.5rem;
    }

    .summary-item {
        background-color: var(--primary-lighter);
        border-radius: var(--radius-md);
        padding: 1.5rem;
        text-align: center;
        transition: var(--transition);
        border: 1px solid var(--border);
    }

    .summary-item:hover {
        transform: translateY(-3px);
        box-shadow: var(--card-shadow);
        background-color: var(--card-bg);
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
        padding: 1.25rem 1rem;
        border-bottom: 1px solid var(--border);
        vertical-align: middle;
        transition: var(--transition);
    }

    .members-table tr:last-child td {
        border-bottom: none;
    }

    .members-table tr:hover td {
        background-color: var(--primary-lighter);
    }

    .member-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .member-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background-color: var(--primary-light);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-weight: 600;
        flex-shrink: 0;
        border: 2px solid var(--primary-light);
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
        border: 1px solid rgba(139, 92, 246, 0.2);
    }

    .badge-event {
        background-color: rgba(59, 130, 246, 0.1);
        color: var(--info);
        border: 1px solid rgba(59, 130, 246, 0.2);
    }

    .badge-upload {
        background-color: rgba(16, 185, 129, 0.1);
        color: var(--success);
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .badge-share {
        background-color: rgba(245, 158, 11, 0.1);
        color: var(--warning);
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .badge-testimonial {
        background-color: rgba(239, 68, 68, 0.1);
        color: var(--danger);
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .divider {
        border-top: 1px solid var(--border);
        margin: 2rem 0;
        opacity: 0.5;
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
        border: 1px solid transparent;
    }

    .badge-primary {
        background-color: var(--primary-lighter);
        color: var(--primary);
        border-color: rgba(79, 70, 229, 0.2);
    }

    .badge-success {
        background-color: rgba(16, 185, 129, 0.1);
        color: var(--success);
        border-color: rgba(16, 185, 129, 0.2);
    }

    .badge-warning {
        background-color: rgba(245, 158, 11, 0.1);
        color: var(--warning);
        border-color: rgba(245, 158, 11, 0.2);
    }

    .badge-info {
        background-color: rgba(59, 130, 246, 0.1);
        color: var(--info);
        border-color: rgba(59, 130, 246, 0.2);
    }

    /* Chart tooltip styles */
    .chart-tooltip {
        background: var(--card-bg) !important;
        border: 1px solid var(--border) !important;
        border-radius: var(--radius-sm) !important;
        box-shadow: var(--card-shadow) !important;
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

    /* Floating action button */
    .fab {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: linear-gradient(to right, var(--primary), var(--secondary));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        cursor: pointer;
        transition: var(--transition);
        z-index: 50;
        border: none;
    }

    .fab:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .fab i {
        font-size: 1.5rem;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .dashboard-header h1 {
            font-size: 2.25rem;
        }
    }

    @media (max-width: 768px) {
        .dashboard-header h1 {
            font-size: 2rem;
        }

        .stat-container {
            flex-direction: column;
            gap: 1rem;
        }

        .summary-grid {
            grid-template-columns: 1fr;
        }

        .stat-number {
            font-size: 2rem;
        }
        
        .chart-container {
            height: 220px;
        }
    }

    @media (max-width: 576px) {
        .dashboard-card {
            padding: 1.5rem;
        }
        
        .card-title {
            font-size: 1.25rem;
        }
        
        .stat-number {
            font-size: 1.75rem;
        }
    }
</style>

<div class="container py-5">
    <div class="dashboard-header">
        <h1>JARINGAN ALUMNI</h1>
        <h2>Pantau perkembangan dan aktivitas terkini jaringan alumni SMKN 1 Bontang</h2>
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
                
                <div style="max-height: 400px; overflow-y: auto;">
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
                            <tr>
                                <td>
                                    <div class="member-info">
                                        <div class="member-avatar">RJ</div>
                                        <div>
                                            <div class="member-name">Rizky Jaya</div>
                                            <div class="member-position">Angkatan 2020</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="activity-badge badge-update">Memperbarui pekerjaan</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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
                    <span class="badge badge-success">
                        <i class="fas fa-briefcase"></i> 5 lowongan baru
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Floating Action Button -->
<button class="fab">
    <i class="fas fa-plus"></i>
</button>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate numbers with counting effect
    const animateNumbers = (elements) => {
        elements.forEach(element => {
            const target = parseInt(element.innerText.replace(/,/g, ''));
            const duration = 1500;
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
            card.style.boxShadow = '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)';
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
                borderColor: '#6366f1',
                backgroundColor: 'rgba(99, 102, 241, 0.1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#6366f1',
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
                    '#6366f1',
                    '#7c3aed',
                    '#8b5cf6',
                    '#a78bfa',
                    '#c4b5fd',
                    '#ddd6fe',
                    '#ede9fe',
                    '#f5f3ff'
                ],
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
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
                    'rgba(99, 102, 241, 0.8)',
                    'rgba(124, 58, 237, 0.8)',
                    'rgba(139, 92, 246, 0.8)',
                    'rgba(167, 139, 250, 0.8)',
                    'rgba(196, 181, 253, 0.8)',
                    'rgba(221, 214, 254, 0.8)'
                ],
                borderColor: [
                    'rgba(99, 102, 241, 1)',
                    'rgba(124, 58, 237, 1)',
                    'rgba(139, 92, 246, 1)',
                    'rgba(167, 139, 250, 1)',
                    'rgba(196, 181, 253, 1)',
                    'rgba(221, 214, 254, 1)'
                ],
                borderWidth: 0,
                borderRadius: 6,
                hoverBackgroundColor: [
                    'rgba(99, 102, 241, 1)',
                    'rgba(124, 58, 237, 1)',
                    'rgba(139, 92, 246, 1)',
                    'rgba(167, 139, 250, 1)',
                    'rgba(196, 181, 253, 1)',
                    'rgba(221, 214, 254, 1)'
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
    
    // Floating action button click handler
    const fab = document.querySelector('.fab');
    fab.addEventListener('click', function() {
        alert('Aksi tambahan akan dijalankan di sini!');
    });
});
</script>
@endsection