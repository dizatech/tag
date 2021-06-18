@component('panel.layouts.component', ['title' => 'ویرایش برچسب'])


    @slot('style')
    @endslot

    @slot('subject')
        <h1><i class="fa fa-users"></i> مدیریت برچسب‌ها، ویرایش</h1>
        <p>این بخش برای ویرایش برچسب می‌باشد.</p>
    @endslot

    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('tags.index') }}">مدیریت برچسب‌ها</a></li>
        <li class="breadcrumb-item">ویرایش برچسب</li>
    @endslot

    @slot('content')
        <div class="row">
            <div class="col-md-12">
                @component('components.accordion')
                    @slot('cards')
                        @component('components.collapse-card', ['id' => 'tag_edit', 'show' => 'show','title' => 'ویرایش برچسب'])
                            @slot('body')

                                <form action="{{ route('tags.update', $tag) }}" method="post" autocomplete="off">
                                    @csrf
                                    @method('patch')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">
                                                    <strong class="text-danger">*</strong>
                                                    <strong>نام برچسب</strong>
                                                </label>
                                                <input type="text"
                                                       value="{{ old('name', $tag->name) }}"
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
                                                       value="{{ old('slug', $tag->slug) }}"
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
                                                <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                                          id="description">{!! old('description', $tag->description) !!}</textarea>
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
                            @endslot
                        @endcomponent
                    @endslot
                @endcomponent
            </div>
        </div>
    @endslot

    @slot('script')

    @endslot

@endcomponent
