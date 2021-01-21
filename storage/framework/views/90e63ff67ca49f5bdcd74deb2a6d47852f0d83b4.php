<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vision Google</title>
    <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/style.css')); ?>?" rel="stylesheet">
    <link href="<?php echo e(asset('css/croppie.css')); ?>" rel="stylesheet">
</head>

<body>

    <div id="vision" class="container mg-top-40">

        <h1>Upload Imagem</h1>
        <form id="formulario" role="form" method="POST" action="<?php echo e(asset('/vision/check-image-success')); ?>" class="form-horizontal" onsubmit="return false;" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

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
<script src="<?php echo e(asset('js/jquery-3.2.1.slim.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
<script>
    // send
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

    // Check for the File API support.
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
    /*
        $uploadCrop = $('#upload-demo').croppie({
            enableExif: true,
            viewport: {
                width: 300,
                height: 300,
                type: 'square'
            },
            boundary: {
                width: 300,
                height: 300
            }
        });
        $('#uploadImagem').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function() {});
            }
            reader.readAsDataURL(this.files[0]);
        });
        let face = {
            functions: {
                uploadImagem: function() {

                }
            },
            events: {
                clickRenderImagem: function() {

                    $uploadImagem = $('#uploadImagem').val();

                    if ($uploadImagem == '') {
                        alert('Coloque a foto');
                    }
                    $uploadCrop.croppie('result', {
                        type: 'canvas',
                        size: 'viewport'
                    }).then(function(resp) {
                        html = '<img src="' + resp + '" />';
                        $("#upload-preview").html(html);
                        $('#uploadImagemBase64').val(resp);
                    });
                }
            }
        }
        */
</script>

</html><?php /**PATH C:\Apache24\htdocs\vision\resources\views/check-image.blade.php ENDPATH**/ ?>