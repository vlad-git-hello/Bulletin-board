@if(session('success'))
<div class="alert alert-success" role="alert">
    Категория {{ session('success') }} удалена!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
