@component('panel.layouts.component', ['title' => 'مدیریت برچسب‌ها'])

    @slot('style')
    @endslot

    @slot('subject')
        <h1><i class="fa fa-users"></i> مدیریت برچسب‌ها </h1>
        <p>مدیریت برچسب‌ها، ایجاد برچسب، ویرایش برچسب، حذف برچسب</p>
    @endslot

    @slot('breadcrumb')
        <li class="breadcrumb-item"> لیست برچسب‌ها </li>
    @endslot

    @slot('content')
        <div class="row">
            <div class="col-md-12">
                @component('components.accordion')
                    @slot('cards')
                        @component('components.collapse-card', ['id' => 'tag_index', 'show' => 'show', 'title' => 'لیست برچسب‌ها'])
                            @slot('body')
                                @component('components.collapse-search')
                                    @slot('form')
                                        <form class="clearfix">
                                            <div class="form-group">
                                                <label for="text-name-input">اطلاعات برچسب</label>
                                                <input type="text" class="form-control" id="text-name-input" name="keyword" value="{{ request()->query('keyword') }}" placeholder="نام برچسب">
                                            </div>
                                            <button type="submit" class="btn btn-primary float-left">جستجو</button>
                                        </form>
                                    @endslot
                                @endcomponent

                                <div class="mt-4">
                                    <a href={{ route('tags.create') }} type="button" class="btn btn-primary"><i class="fa fa-plus"></i> ایجاد برچسب</a>
                                </div>

                                @component('components.table')
                                    @slot('thead')
                                        <tr>
                                            <th>شناسه</th>
                                            <th>نام برچسب</th>
                                            <th>فعالیت</th>
                                        </tr>
                                    @endslot
                                    @slot('tbody')
                                        @forelse ($tags as $tag)
                                            <tr>
                                                <td>
                                                    {{ $tag->getKey() }}
                                                </td>
                                                <td>
                                                    {{ $tag->name }}
                                                </td>
                                                <td>
                                                    <a  href="{{ route('tags.edit', $tag) }}"
                                                        class="btn btn-sm btn-primary">
                                                        ویرایش تگ
                                                    </a>
                                                    <a  href="#" class="btn btn-sm btn-danger destroy_ajax" data-id="{{ $tag->id }}">
                                                        حذف
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">موردی برای نمایش وجود ندارد.</td>
                                            </tr>
                                        @endforelse
                                    @endslot
                                @endcomponent

                                {{--Paginate section--}}
                                {{ $tags->withQueryString()->links() }}
                            @endslot
                        @endcomponent
                    @endslot
                @endcomponent
            </div>
        </div>
    @endslot

    @slot('script')
        <script>
            $(".destroy_ajax").on('click', function (e) {
                e.preventDefault();
                let id = $(this).data('id');
                Swal.fire({
                    title: 'آیا برای حذف اطمینان دارید؟',
                    icon: 'warning',
                    showCancelButton: true,
                    customClass: {
                        confirmButton: 'btn btn-danger mx-2',
                        cancelButton: 'btn btn-light mx-2'
                    },
                    buttonsStyling: false,
                    confirmButtonText: 'حذف',
                    cancelButtonText: 'لغو',
                    showClass: {
                        popup: 'animated fadeInDown'
                    },
                    hideClass: {
                        popup: 'animated fadeOutUp'
                    }
                })
                    .then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "delete",
                                url: baseUrl + '/panel/tags/' + id,
                                dataType: 'json',
                                success: function (response) {
                                    Swal.fire({
                                        icon: 'success',
                                        text: 'عملیات حذف با موفقیت انجام شد.',
                                        confirmButtonText:'تایید',
                                        customClass: {
                                            confirmButton: 'btn btn-success',
                                        },
                                        buttonsStyling: false,
                                        showClass: {
                                            popup: 'animated fadeInDown'
                                        },
                                        hideClass: {
                                            popup: 'animated fadeOutUp'
                                        }
                                    })
                                        .then((response) => {
                                            location.reload();
                                        });
                                }
                            });
                        }
                    });
            });
        </script>
    @endslot

@endcomponent

