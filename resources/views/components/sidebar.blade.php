<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">@lang('Quick Admin')</h5>
        <a href="{{ route('categories.create') }}" class="btn btn-secondary btn-block text-light">@lang('Create Category')</a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Block Title</h5>
        <h6 class="card-subtitle mb-2 text-muted">subtitle</h6>
        <p class="card-text">Some quick example text to build on the sidebar.</p>
    </div>
</div>

@yield('sidebar')