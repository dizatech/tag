{{--Table section--}}
<div class="table-responsive pt-3 pb-3">
    <table class="table table-sm table-bordered table-hover" @if( isset( $id ) ) id="{{ $id }}" @endif>
        <thead class="text-primary">
            <tr>
                <th>شناسه</th>
                <th>نام برچسب</th>
                <th>فعالیت</th>
            </tr>
        </thead>
        <tbody>
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
        </tbody>
    </table>
</div>

{{--Paginate section--}}
{{ $tags->withQueryString()->links() }}

{{--Scripts section--}}
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
