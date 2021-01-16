<form method="GET" action="{{ route('home.search', 4) }}"
      class="mb-4">
    @csrf
    <div class="form-group">
        <label for="search">Search</label>
        <input type="text" class="form-control"
               id="search" aria-describedby="search" placeholder="Search">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
