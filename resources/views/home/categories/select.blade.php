<h4>Main categories!</h4>

<div class="accordion" id="accordionExample">
    @foreach($categories as $category)
        <div class="card">
            <div class="card-header" id="{{ $heading = 'heading' . $category->id }}">
                <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse"
                            data-target="#{{ $collapse = 'collapse' . $category->id }}"
                            aria-expanded="true" aria-controls="{{ $collapse }}">
                        {{ $category->title }}
                    </button>
                </h2>
            </div>

            <div id="{{ $collapse }}" class="collapse" aria-labelledby="{{ $heading }}"
                 data-parent="#accordionExample">
                <div class="card-body">
                    <div class="accordion" id="accordionExample2">
                        <div class="row">
                            @foreach($category->children as $children)
                                <div class="col-3">
                                    <h4>{{ $children->title }}</h4>
                                    @foreach($children->children as $child)
                                        <a href="{{ route('home.search', $child->id) }}">
                                            {{ $child->title }}
                                        </a>
                                        <br>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

