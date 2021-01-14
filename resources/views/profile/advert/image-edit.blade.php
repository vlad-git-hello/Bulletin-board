<p>Добавить фото</p>

<form method="post" action="{{url('dropzone/store')}}" enctype="multipart/form-data"
      class="dropzone" id="dropzone">
    @csrf
    <div class="dz-message" data-dz-message>
        <span>Перетащите сюда файлы для загрузки</span>
    </div>
</form>
<script>
    const imagesNames = [];
    const imagesDelete = [];

    function test () {
        console.log(imagesNames, 'imagesNames')
        console.log(imagesDelete, 'imagesDelete')

        for (let i = 0; i < imagesNames.length; i++) {
            let addImage = $("<input class='d-none' name='addImages[]'>").val(imagesNames[i]);

            $('#imageNames').append(addImage);
        }

        for (let i = 0; i < imagesDelete.length; i++) {
            let deleteImage = $("<input class='d-none' name='deleteImages[]'>").val(imagesDelete[i]);

            $('#imageNames').append(deleteImage);
        }
    }

    Dropzone.options.dropzone =
        {
            init: function() {
                var myDropzone = this;

                const array = @json($advert->images);

                thisDropzone = this;
                $.each(array, function(key, {name}){
                    var mockFile = { name: name, size: 12345 };
                    myDropzone.emit("addedfile", mockFile);
                    myDropzone.emit("thumbnail", mockFile, "http://127.0.0.1:8000/storage/" + name);
                    myDropzone.emit("complete", mockFile);

                });
            },
            maxFilesize: 1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 60000,
            success: function (file, response) {
                file.imageName = response.imageName;
                imagesNames.push(response.imageName);
            },
            error: function (file, response) {
                return false;
            },
            removedfile: function (file) {
                if (file.imageName) {
                    let index = imagesNames.indexOf(file.imageName);

                    if (index > -1) {
                        imagesNames.splice(index, 1);
                    }

                    $.ajax({
                        url: '/dropzone/destroy/' + file.imageName,
                        type: 'delete',
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        success: function (data) {
                        },
                        error: function (msg) {
                        },
                    });
                } else  {
                    imagesDelete.push(file.name);
                }

                var fileRef;
                return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            }
        };
</script>
