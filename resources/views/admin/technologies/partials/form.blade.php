<form action="{{ route($routeName, $technology) }}" enctype="multipart/form-data" method="POST"
    class="p-5 needs-validation" novalidate>
    @csrf
    @method($method)

    @if ($errors->any())
        <div class="alert alert-danger">
            <h6>We were unable to process your submission due to errors. Please review and try again.</h6>
        </div>
    @endif

    <div class="card p-4">
        <h5 class="mb-3">
            Technologies editor
        </h5>

        <div class="mb-3">
            <label for="technology_name" class="form-label">
                Technology name
            </label>
            <input type="text" class="form-control w-25  @error('name') is-invalid @enderror" id="technology_name"
                placeholder="Insert technology's name" name="name" value="{{ old('name', $technology->name) }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="card-footer">
            <a href="{{ route('admin.technologies.index') }}" class="btn btn-dark"><i
                    class="fa-solid fa-arrow-left"></i></a>
            <button type="submit" class="btn btn-success"><i class="fa-solid fa-save"></i></button>
        </div>
    </div>
</form>
