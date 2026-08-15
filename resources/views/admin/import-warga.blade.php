<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Data Warga</title>
</head>
<body>

    <h2>Import Data Warga</h2>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if($errors->any())
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif

    <form action="{{ route('admin.import-warga.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="file" name="file" accept=".xlsx,.xls,.csv" required>

        <button type="submit">Import Data</button>
    </form>

</body>
</html>