<form action="{{ route('tags.store') }}" method="post" autocomplete="off">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="title">
                    <strong class="text-danger">*</strong>
                    <strong>نام برچسب</strong>
                </label>
                <input type="text"
                       value="{{ old('name') }}"
                       name="name" id="name"
                       class="form-control @error('name') is-invalid @enderror">
                @error('name')
                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                @enderror
            </div>

        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="slug">
                    <strong>slug</strong>
                </label>
                <input type="text"
                       value="{{ old('slug') }}"
                       id="slug"
                       name="slug"
                       style="direction: ltr"
                       class="form-control @error('slug') is-invalid @enderror">
                @error('slug')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">
                    <strong>توضیحات</strong>
                </label>
                <textarea name="description" class="form-control tinymce @error('description') is-invalid @enderror"
                          id="description">{!! old('description') !!}</textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                @enderror
            </div>
        </div>

    </div>

    <hr>

    <div>
        <button class="btn btn-success" type="submit">ثبت</button>
        <a
            href="{{ route('tags.index') }}"
            class="btn btn-danger"
        >
            انصراف
        </a>
    </div>

</form>
