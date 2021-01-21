<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QRCODE</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}?" rel="stylesheet">
    <link href="{{asset('css/croppie.css')}}" rel="stylesheet">
</head>

<body>

    <div id="vision" class="container mg-top-40">

        <h1>Upload Imagem</h1>
        <form id="formulario" role="form" method="POST" action="{{asset('/vision/check-qrcode-success')}}" class="form-horizontal" onsubmit="return false;" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-group">
                <div class="card column">
                    <div class="card-block">
                        <span class="title">Imagem</span>
                        <div class="text-center mg-top-20">
                            <input type="file" id="image" name="image" class="form-control" />
                            <hr>
                            <img id="imgPreview" class="img-fluid">
                        </div>
                    </div>
                    <div class="text-center mg-top-40">
                        <p><a class="btn btn-secondary" onclick="send('');">Analisar</a></p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
<script src="{{asset('js/jquery-3.2.1.slim.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script>
    function send() {
        let image = document.getElementById('image').value;
        if (image == "") {
            alert('Faça upload e um arquivo.');
            return false;
        }
        setTimeout(function() {
            document.getElementById('formulario').submit();
        }, 800);
    }

    if (window.File && window.FileReader && window.FileList && window.Blob) {
        document.getElementById('image').addEventListener('change', handleFileSelect, false);
    } else {
        alert('The File APIs are not fully supported in this browser.');
    }

    function handleFileSelect(evt) {
        var f = evt.target.files[0]; // FileList object
        var reader = new FileReader();
        // Closure to capture the file information.
        reader.onload = (function(theFile) {
            return function(e) {
                var binaryData = e.target.result;
                var base64String = window.btoa(binaryData);
                //alert('Conversão para base64 concluída.');
                document.getElementById('imgPreview').src = 'data:image/jpeg;base64,' + base64String;
            };
        })(f);
        // Read in the image file as a data URL.
        reader.readAsBinaryString(f);
    }
</script>

</html>