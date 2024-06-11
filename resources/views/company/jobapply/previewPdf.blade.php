<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview PDF</title>
    <!-- Tambahkan link ke CSS Tabler UI -->
    <link href="https://unpkg.com/@tabler/core@1.0.0-beta5/dist/css/tabler.min.css" rel="stylesheet">
    <style>
        #pdf-canvas {
            width: 100%;
            height: auto;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">PDF Preview</h3>
            </div>
            <div class="card-body">
                <canvas id="pdf-canvas"></canvas>
            </div>
        </div>
    </div>

    <!-- Tambahkan script PDF.js dari node_modules -->
    <script src="{{ asset('node_modules/pdfjs-dist/build/pdf.min.js') }}"></script>
    <script>
        const url = '/storage/{{ $cv }}'; // Ganti dengan path ke file PDF Anda

        // Inisialisasi PDF.js
        const loadingTask = pdfjsLib.getDocument(url);
        loadingTask.promise.then(function(pdf) {
            console.log('PDF loaded');

            // Mendapatkan halaman pertama
            pdf.getPage(1).then(function(page) {
                console.log('Page loaded');

                const scale = 1.5;
                const viewport = page.getViewport({ scale: scale });

                // Siapkan canvas menggunakan dimensi halaman
                const canvas = document.getElementById('pdf-canvas');
                const context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render halaman ke dalam context canvas
                const renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                const renderTask = page.render(renderContext);
                renderTask.promise.then(function() {
                    console.log('Page rendered');
                });
            });
        }, function(reason) {
            console.error(reason);
        });
    </script>
</body>
</html>
