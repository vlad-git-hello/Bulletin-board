<form method="GET" action="{{ route('home.search', 4) }}"
      class="mb-4">
    @csrf
    <div class="row">
        <div class="col-7">
            <div class="form-group">
                <input type="text" class="form-control"
                       id="search" aria-describedby="search" placeholder="Search">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <input type="text" class="form-control"
                       id="search" aria-describedby="search" placeholder="Search">
            </div>
        </div>

        <div class="col-1">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div>
</form>
