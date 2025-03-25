<!DOCTYPE html>
<html>
<head>
    <title>Invoice Pengajar</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; }
        .table th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Data Pengajar</h2>
        <p>Tanggal: {{ now()->format('d/m/Y') }}</p>
    </div>

    <table class="table">
        <tr>
            <th>NIP</th>
            <td>{{ $pengajar->nip }}</td>
        </tr>
        <tr>
            <th>Nama Lengkap</th>
            <td>{{ $pengajar->nama_lengkap }}</td>
        </tr>
        <!-- Tambahkan data lainnya sesuai kebutuhan -->
    </table>
</body>
</html>