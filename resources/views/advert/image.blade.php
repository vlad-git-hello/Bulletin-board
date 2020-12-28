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

    function appendImages() {
        const array = [];

        for (let i = 0; i < imagesNames.length; i++) {
            const input = $("<input class='d-none' name='imageNames[]'>").val(imagesNames[i]);

            array.push(input);
        }

        $('#imageNames').append(array);
    }

    Dropzone.options.dropzone = {
        maxFilesize: 1,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        timeout: 60000,
        success: function (file, { imageName }) {
            file.imageName = imageName;
            imagesNames.push(imageName);
        },
        error: function (file, response) {
            return false;
        },
        removedfile: function (file) {
            request(file);
            removeImage(file);

            var fileRef;
            return (fileRef = file.previewElement) != null ?
                fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },
    };

    function request(file) {
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
    }

    function removeImage(file) {
        let index = imagesNames.indexOf(file.imageName);

        if (index > -1) {
            imagesNames.splice(index, 1);
        }
    }
</script>
