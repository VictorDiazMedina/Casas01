<html>

<head>
    <title>Crop Before Uploading Image using Cropper JS & PHP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link href="cropperjs/cropper.min.css" rel="stylesheet" type="text/css" />
</head>
<style type="text/css">
img {
    display: block;
    max-width: 100%;
}

.preview {
    z
}
</style>

<body>


    <div class="preview">
        <div class="elementHeader" style="background-image: url('upload/bueno2.png');">
            <div class="elementHeaderProfile">
                <img src="upload/258f7809b0f024896cfe132c3bb9d55c.jpg" class="profile_image" alt="">
            </div>
            <div class="elementHeaderUpload">
                <div>
                    <h2 class="profileHeaderInfo__userCasa">Pixtoriin Diaz</h2>
                    <br>
                    <h3 class="profileHeaderInfo__userEstado">Cuernavaca</h3>
                </div>

                <form method="post">
                    <div id="div_Image">
                        <p class="p_Text">Subir Imagen</p>
                        <input type="file" name="image" id="imageBack" class="image">
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="grid">
        <div class="container">
            <h5>Upload Images</h5>
            <form method="post">
                <input type="file" name="image" class="image">
            </form>
        </div>
        <div class="container">
            <h5>Upload Images</h5>
            <form method="post">
                <input type="file" name="image" class="image">
            </form>
        </div>
        <div class="container">
            <h5>Upload Images</h5>
            <form method="post">
                <input type="file" name="image" class="image">
            </form>
        </div>
    </div>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Crop image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <!--  default image where we will set the src via jquery-->
                                <img id="image">
                            </div>
                            <div class="col-md-4">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="cropperjs/cropper.min.js" type="text/javascript"></script>
    <script>
    var bs_modal = $('#modal');
    var image = document.getElementById('image');
    var backg = document.getElementById('image');
    var cropper, reader, file;


    $("body").on("change", ".image", function(e) {
        var files = e.target.files;
        var done = function(url) {
            image.src = url;
            bs_modal.modal('show');
        };


        if (files && files.length > 0) {
            file = files[0];

            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function(e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    bs_modal.on('shown.bs.modal', function() {
        cropper = new Cropper(image, {
            dragMode: 'move',
            aspectRatio: 1345 / 232,
            autoCropArea: 0.65,
            restore: false,
            guides: false,
            center: false,
            highlight: false,
            cropBoxMovable: false,
            cropBoxResizable: false,
            toggleDragModeOnDblclick: false,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function() {
        cropper.destroy();
        cropper = null;
    });

    $("#crop").click(function() {
        canvas = cropper.getCroppedCanvas({
            width: 1345,
            height: 232,
        });

        canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
                var base64data = reader.result;

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "upload.php",
                    data: {
                        image: base64data
                    },
                    success: function(data) {
                        bs_modal.modal('hide');
                        alert("success upload image");
                    }
                });
            };
        });
    });
    </script>
</body>

</html>