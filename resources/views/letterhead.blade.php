<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Letterhead Adder</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">

    <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-md text-center">
        <h1 class="text-2xl font-semibold mb-4 text-blue-600">📄 Add Company Letterhead to PDF</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-2 rounded mb-3">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('process') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="file" name="pdf" accept="application/pdf" required
                   class="block w-full text-gray-700 border border-gray-300 rounded-lg p-2" />
            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg">
                Upload & Add Letterhead
            </button>
        </form>
    </div>

    <footer class="text-gray-400 text-sm mt-4">
        Powered by Laravel • FPDI Library
    </footer>

</body>
</html>
