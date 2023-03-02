<form action="{{ route($routeName, $type) }}" enctype="multipart/form-data" method="POST" class="p-5 needs-validation"
    novalidate>
    @csrf
    @method($method)

    @if ($errors->any())
        <div class="alert alert-danger">
            <h6>We were unable to process your submission due to errors. Please review and try again.</h6>
        </div>
    @endif

    <div class="card p-4">
        <h5 class="mb-3">
            Types editor
        </h5>

        <div class="mb-3">
            <label for="type_name" class="form-label">
                Type name
            </label>
            <input type="text" class="form-control w-25  @error('name') is-invalid @enderror" id="type_name"
                placeholder="Insert type's name" name="name" value="{{ old('name', $type->name) }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="card-footer">
            <a href="{{ route('admin.types.index') }}" class="btn btn-dark"><i class="fa-solid fa-arrow-left"></i></a>
            <button type="submit" class="btn btn-success"><i class="fa-solid fa-save"></i></button>
        </div>
    </div>
</form>
