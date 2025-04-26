<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Alumni - {{ $data->nama_lengk }}</title>
    <style>
        /* Modern Base Styles */
        :root {
            --primary: #3a86ff;
            --secondary: #2667cc;
            --accent: #8338ec;
            --light: #f8f9ff;
            --dark: #212529;
            --success: #06d6a0;
            --warning: #ff006e;
            --gray: #6c757d;
            --card-bg: #ffffff;
        }
        
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f0f4ff 0%, #e6f0ff 100%);
            color: var(--dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Modern Card Container */
        .card-container {
            max-width: 850px;
            margin: 30px;
            background: var(--card-bg);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
            transition: transform 0.3s ease;
        }
        
        .card-container:hover {
            transform: translateY(-5px);
        }
        
        /* Glassmorphism Header */
        .card-header {
            background: linear-gradient(135deg, rgba(58, 134, 255, 0.9) 0%, rgba(38, 103, 204, 0.9) 100%);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .card-header::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 70%);
            transform: rotate(30deg);
            animation: shine 8s infinite linear;
        }
        
        @keyframes shine {
            0% { transform: rotate(30deg) translate(-10%, -10%); }
            100% { transform: rotate(30deg) translate(10%, 10%); }
        }
        
        /* School Info */
        .school-info {
            flex: 1;
        }
        
        .school-info h2 {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
            letter-spacing: -0.5px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .school-info p {
            margin: 8px 0 0;
            font-size: 15px;
            opacity: 0.9;
            font-weight: 400;
        }
        
        /* Student Photo Style */
        .student-photo-container {
            width: 150px;
            height: 200px; /* 4:5 ratio */
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            background: #fff;
            border: 5px solid white;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 20px;
        }

        .student-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
        }
        
        /* Card Body */
        .card-body {
            padding: 40px;
        }
        
        /* Title Section */
        .title-section {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }
        
        .title-section h1 {
            margin: 0 0 15px;
            color: var(--primary);
            font-size: 32px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        
        /* Modern Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }
        
        .info-card {
            background: var(--light);
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.03);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(0,0,0,0.03);
        }
        
        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.08);
        }
        
        .info-card h3 {
            margin-top: 0;
            margin-bottom: 25px;
            padding-bottom: 12px;
            border-bottom: 2px solid rgba(58, 134, 255, 0.2);
            color: var(--primary);
            font-size: 20px;
            font-weight: 600;
            letter-spacing: -0.3px;
        }
        
        .info-card table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .info-card tr {
            margin-bottom: 15px;
            display: table-row;
        }
        
        .info-label {
            width: 140px;
            font-weight: 500;
            color: var(--gray);
            text-align: left;
            font-size: 15px;
            padding: 8px 0;
            vertical-align: top;
        }
        
        .info-separator {
            width: 10px;
            padding: 8px 5px;
            text-align: center;
            color: var(--gray);
            font-weight: 500;
            vertical-align: top;
        }
        
        .info-value {
            font-size: 15px;
            color: var(--dark);
            word-break: break-word;
            padding: 8px 0 8px 5px;
            vertical-align: top;
        }
        
        /* Modern Status Badge */
        .status-badge {
            display: inline-flex;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            align-items: center;
            margin: 2px 0;
        }
        
        .status-badge::before {
            content: "";
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 8px;
        }
        
        .status-1 { background-color: rgba(6, 214, 160, 0.1); color: #06a37a; } /* Bekerja */
        .status-1::before { background-color: #06d6a0; }
        
        .status-2 { background-color: rgba(58, 134, 255, 0.1); color: #2667cc; } /* Kuliah */
        .status-2::before { background-color: #3a86ff; }
        
        .status-3 { background-color: rgba(255, 0, 110, 0.1); color: #cc0060; } /* Tidak Ada Kabar */
        .status-3::before { background-color: #ff006e; }
        
        /* Modern Detail Tables */
        .detail-section {
            margin-bottom: 40px;
        }
        
        .detail-section h3 {
            color: var(--primary);
            font-size: 20px;
            margin-bottom: 20px;
            padding-left: 15px;
            border-left: 5px solid var(--accent);
            font-weight: 600;
            letter-spacing: -0.3px;
        }
        
        .detail-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: white;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }
        
        .detail-table th {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: var(--primary);
            padding: 18px;
            text-align: left;
            font-weight: 500;
            font-size: 15px;
        }
        
        .detail-table td {
            padding: 18px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            vertical-align: middle;
            font-size: 15px;
        }
        
        .detail-table tr:last-child td {
            border-bottom: none;
        }
        
        .detail-table tr:hover td {
            background-color: rgba(58, 134, 255, 0.03);
        }
        
        /* Modern Watermark */
        .watermark {
            position: absolute;
            bottom: 25px;
            right: 25px;
            font-size: 13px;
            color: rgba(0, 0, 0, 0.05);
            font-weight: 800;
            letter-spacing: 1px;
            transform: rotate(-5deg);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .card-container {
                margin: 15px;
                border-radius: 20px;
            }
            
            .card-header {
                flex-direction: column;
                text-align: center;
                padding-bottom: 0px;
            }
            
            .student-photo-container {
                margin: 20px auto 0;
                width: 120px;
                height: 160px;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .info-label {
                width: 120px;
            }
            
            .card-body {
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="card-container">
        <!-- Modern Header with Glassmorphism Effect -->
        <div class="card-header">
            <div class="school-info">
                <h2>SMK NEGRI 1 BONTANG</h2>
                <p>Jl. Cipto Mangunkusumo No.02, Gn. Elai, Kec. Bontang Utara, Kota Bontang, Kalimantan Timur 75313 | Telp: 082152666162</p>
            </div>
            
            <!-- Student Photo - Dipindahkan ke header dan di-align kanan -->
            <div class="student-photo-container">
                @if(!empty($data->image_base64))
                    <img src="{{ $data->image_base64 }}" 
                         alt="Foto Alumni {{ $data->nama_lengk }}" 
                         class="student-photo">
                @else
                    <img src="{{ asset('images/default-profile.png') }}" 
                         alt="Default Profile" 
                         class="student-photo">
                @endif
            </div>
        </div>
        
        <!-- Card Body -->
        <div class="card-body">
            <!-- Title Section -->
            <div class="title-section">
                <h1>DETAIL ALUMNI</h1>
            </div>
            
            <!-- Info Grid -->
            <div class="info-grid">
                <div class="info-card">
                    <h3>Informasi Pribadi</h3>
                    <table>
                        <tr>
                            <td class="info-label">Nama Lengkap</td>
                            <td class="info-separator">:</td>
                            <td class="info-value">{{ $data->nama_lengk }}</td>
                        </tr>
                        <tr>
                            <td class="info-label">NIS</td>
                            <td class="info-separator">:</td>
                            <td class="info-value">{{ $data->nis }}</td>
                        </tr>
                        <tr>
                            <td class="info-label">Jurusan</td>
                            <td class="info-separator">:</td>
                            <td class="info-value">{{ $data->jur_sekolah }}</td>
                        </tr>
                        <tr>
                            <td class="info-label">Tahun Lulus</td>
                            <td class="info-separator">:</td>
                            <td class="info-value">{{ $data->tahun_lulus }}</td>
                        </tr>
                    </table>
                </div><br>
                
                <div class="info-card">
                    <h3>Kontak & Status</h3>
                    <table>
                        <tr>
                            <td class="info-label">Telepon</td>
                            <td class="info-separator">:</td>
                            <td class="info-value">{{ $data->nomor_telp }}</td>
                        </tr>
                        <tr>
                            <td class="info-label">Alamat</td>
                            <td class="info-separator">:</td>
                            <td class="info-value">{{ $data->alamat_rum }}</td>
                        </tr>
                        <tr>
                            <td class="info-label">Wirausaha</td>
                            <td class="info-separator">:</td>
                            <td class="info-value">{{ $data->wirausaha ?: '-' }}</td>
                        </tr>
                        <tr>
                            <td class="info-label">Status</td>
                            <td class="info-separator">:</td>
                            <td class="info-value">
                                <span class="status-badge status-{{ $data->status }}">
                                    {{ $status_map[$data->status] ?? 'Tidak Diketahui' }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <!-- Status Specific Information -->
            @if($data->status == 1) <!-- Bekerja -->
            <div class="detail-section">
                <h3>Informasi Pekerjaan</h3>
                <table class="detail-table">
                    <thead>
                        <tr>
                            <th>Perusahaan</th>
                            <th>Jabatan</th>
                            <th>Lokasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $data->nama_per ?: '-' }}</td>
                            <td>{{ $data->nama_tok ?: '-' }}</td>
                            <td>{{ $data->lok_bekerja ?: '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @elseif($data->status == 2) <!-- Kuliah -->
            <div class="detail-section">
                <h3>Informasi Pendidikan Lanjut</h3>
                <table class="detail-table">
                    <thead>
                        <tr>
                            <th>Jalur</th>
                            <th>Perguruan Tinggi</th>
                            <th>Jurusan/Prodi</th>
                            <th>Lokasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $jalur_map[$data->jalur] ?? '-' }}</td>
                            <td>{{ $data->nama_perti ?: '-' }}</td>
                            <td>{{ $data->jur_prodi ?: '-' }}</td>
                            <td>{{ $data->lok_kuliah ?: '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @endif
        </div>
        
        <div class="watermark">SMK NEGRI 1 BONTANG</div>
    </div>
</body>
</html>