<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom File Input</title>
    <style>
        .custom-file-input {
            position: relative;
            display: inline-block;
            overflow: hidden;
        }

        .custom-file-input input[type="file"] {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }

        .btn-file {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
        }

        .file-name {
            margin-left: 10px;
            font-style: italic;
        }
    </style>
</head>
<body>
    <h4 class="font-weight-bold text-dark">Upload Digital Book</h4>
    <p class="font-weight-normal mb-2 text-muted">Upload the digital version of your book</p>

    <div class="custom-file-input">
        <button class="btn-file">Choose File</button>
        <input type="file" id="fileInput">
        <span class="file-name" id="fileName">No file chosen</span>
    </div>

    <script>
        const fileInput = document.getElementById('fileInput');
        const fileName = document.getElementById('fileName');

        fileInput.addEventListener('change', function() {
            fileName.textContent = this.files[0] ? this.files[0].name : 'No file chosen';
        });

        document.querySelector('.btn-file').addEventListener('click', function() {
            fileInput.click();
        });
    </script>
</body>
</html>
