<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiển thị Tài liệu trên Cổng Thông Tin</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.14.305/pdf.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .document-viewer {
            margin-bottom: 30px;
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }
        iframe {
            width: 100%;
            height: 600px;
            border: none;
        }
        canvas {
            display: block;
            margin: 0 auto;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <h2>Hiển thị Tài liệu Trực Tuyến</h2>
        
        <!-- Hiển thị Tệp Microsoft Word -->
        <div class="document-viewer">
            <h4>Tệp Microsoft Word</h4>
            <iframe src="https://docs.google.com/document/d/1Rd4BJ91_ypQb6CxFmpGU9nwfFMier6ad/edit?usp=drive_web&ouid=115983358825237422065&rtpof=true"></iframe>
        </div>

        <!-- Hiển thị Tệp Microsoft Excel -->
        <div class="document-viewer">
            <h4>Tệp Microsoft Excel</h4>
            <iframe src="https://docs.google.com/spreadsheets/d/1KEqAnwAp4c0foh-2F_uvGhVGfvxwfLRT1MTffr2VkE0/edit?usp=drive_web&ouid=115338283584374838800"></iframe>
        </div>

        <!-- Hiển thị Tệp PDF
        <div class="document-viewer">
    <h4>Tệp PDF</h4>
    <canvas id="pdf-canvas"></canvas>
    <script>
        // Đường dẫn tới tệp PDF thực tế
        const pdfUrl = 'https://app.luminpdf.com/vi/viewer/guest/1dPxsp1PLK07pJ0cE65aETeRuK4-TV09I';

        // Sử dụng pdf.js để hiển thị PDF
        pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
            pdf.getPage(1).then(function(page) {
                const scale = 1.5; // Kích thước hiển thị
                const viewport = page.getViewport({ scale: scale });
                const canvas = document.getElementById('pdf-canvas');
                const context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                page.render({
                    canvasContext: context,
                    viewport: viewport
                });
            });
        }).catch(function(error) {
            console.error("Lỗi khi tải tệp PDF:", error);
        });
    </script> -->
</div>


        <!-- Hiển thị Tệp PowerPoint -->
        <div class="document-viewer">
            <h4>Tệp Microsoft PowerPoint</h4>
            <iframe src="https://docs.google.com/presentation/d/1bD5CoG7BxEhNfhra1pTDeQEFdFTeJbap/edit?usp=drive_web&ouid=115983358825237422065&rtpof=true"></iframe>
        </div>
    </div>
</body>
</html>
