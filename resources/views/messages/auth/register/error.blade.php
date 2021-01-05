@if(session('error'))
<div class="alert alert-danger" role="alert">
    {{ session('error') }} If the letter has not arrived
    <a href="{{ route('verification.show') }}">click here to request another</a>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
