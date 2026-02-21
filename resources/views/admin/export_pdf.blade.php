<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        table, th, td { border: 1px solid black; }
        th { background: #f0f0f0; }
        td, th { padding: 5px; }
    </style>
</head>
<body>
<h3>Data Pendaftar {{ isset($gelombang) && $gelombang ? '- Gelombang ' . $gelombang : '- Semua Gelombang' }}</h3>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Alamat</th>
            <th>Gelombang</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $index => $p)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $p->nama_lengkap }}</td>
            <td>{{ $p->jenis_kelamin }}</td>
            <td>{{ $p->email }}</td>
            <td>{{ $p->no_hp }}</td>
            <td>{{ $p->alamat }}</td>
            <td>{{ $p->gelombang }}</td>
            <td>{{ $p->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
