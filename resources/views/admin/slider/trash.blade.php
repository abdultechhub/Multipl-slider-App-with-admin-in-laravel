@extends('admin.admin_master')

@section('dashboard_content')
    @include('admin.dashboard_layout.breadcrumb', [
        'name' => 'Slider',
        'url' => 'slider.index',
        'section_name' => 'All Slider',
    ])
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header with-border d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('slider.index') }}" class="btn btn-light">All Slider
                                <span class="badge badge-pill bg-success"> {{ count($slider) }}</span></a>
                            <a href="{{ route('slider.trash_folder') }}" class="btn btn-primary ml-2">Trash
                                <span class="badge badge-pill bg-warning">{{ count($trash_slider) }}</span></a>
                            <a href="{{ route('slider.draft_folder') }}" class="btn btn-light ml-2">Draft
                                <span class="badge badge-pill bg-info">{{ count($draft_slider) }}</span></a>
                        </div>
                        <a href="{{ route('slider.create') }}" class="btn btn-primary float-right">Add New Post</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1"
                                            class="table-bordered table-hover table-striped dataTable table" role="grid"
                                            aria-describedby="example1_info">
                                            <thead>
                                                <tr role="row">
                                                    <th>#</th>
                                                    <th>Slider img</th>
                                                    <th>title</th>
                                                    <th>Slug</th>
                                                    <th>content</th>
                                                    <th>Restore</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($trash_slider as $item)
                                                    <tr role="row" class="odd" data-id="{{ $item->id }}">
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>

                                                            <ul class="tbl_img_list">
                                                                @foreach ($item->slider_items as $item2)
                                                                    <li> <img src="{{ asset($item2->slider_img) }}"
                                                                            class="img-fluid"></li>
                                                                @endforeach

                                                            </ul>
                                                        </td>
                                                        <td>{{ $item->title }}</td>
                                                        <td>{{ $item->slug }}</td>
                                                        <td>{{ \Illuminate\Support\Str::limit(strip_tags($item->content), 100) }}
                                                        </td>

                                                        <td>
                                                            <form action="{{ route('slider.restore', $item) }}"
                                                                method="post" onsubmit="return validate_restor(this);">
                                                                @method('POST')
                                                                @csrf
                                                                <button type="submit" class="btn btn-success"
                                                                    data-toggle="tooltip" data-placement="bottom"
                                                                    title="Restore post" id="restore">
                                                                    <i class="fa-solid fa-trash-can-arrow-up"></i></button>
                                                            </form>
                                                        </td>

                                                        <td>
                                                            <div class="input-group edit_delete">
                                                                <form action="{{ route('slider.destroy', $item) }}"
                                                                    method="post"
                                                                    onsubmit="return validate_permanet_delete(this);">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-danger"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Permanantly delete" id="delete_permanently">
                                                                        <i class="fa fa-trash"></i></button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection

@section('custom_script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function() {
            $('.is_published').on('change', function() {
                var is_published = $(this).val();
                var post_id = $(this).closest("tr").data('id');

                console.log(is_published);

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: '/admin/slider/changestatus',
                    data: {
                        'is_published': is_published,
                        'post_id': post_id
                    },
                    success: function(data) {
                        toastr.success(data.message);
                    }
                });
            })
        })
    </script>
@endsection
