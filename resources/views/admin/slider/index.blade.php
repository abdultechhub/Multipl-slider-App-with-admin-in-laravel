@extends('admin.layout.layout')

@section('content')
    @include('admin.layout.breadcrumb', [
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
                            <a href="{{ route('slider.index') }}" class="btn btn-primary">All Slider
                                <span class="badge badge-pill bg-success"> {{ count($slider) }}</span></a>
                        </div>
                        <a href="{{ route('slider.create') }}" class="btn btn-primary float-right">Add New Slider</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="dt_initial"
                                            class="table-bordered table-hover table-striped dataTable table" role="grid"
                                            aria-describedby="example1_info">
                                            <thead>
                                                <tr role="row">
                                                    <th>#</th>
                                                    <th>Slider Desk</th>
                                                    <th>Slider Tab</th>
                                                    <th>Slider Mobile</th>
                                                    <th>Slider Name</th>
                                                    <th>is Publish</th>
                                                    <th>Add Item</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($slider as $item)
                                                    <tr role="row" class="odd" data-id="{{ $item->id }}">
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>

                                                            <ul class="tbl_img_list">
                                                                @foreach ($item->slider_items as $item2)
                                                                    @if (!empty($item2->slider_image_desk))
                                                                        <li> <img
                                                                                src="{{ asset('/upload/slider/large/' . $item2->slider_image_desk) }}"
                                                                                class="img-fluid"></li>
                                                                    @endif
                                                                @endforeach

                                                            </ul>
                                                        </td>
                                                        <td>

                                                            <ul class="tbl_img_list">
                                                                @foreach ($item->slider_items as $item2)
                                                                    @if (!empty($item2->slider_image_tab))
                                                                        <li> <img
                                                                                src="{{ asset('/upload/slider/medium/' . $item2->slider_image_tab) }}"
                                                                                class="img-fluid"></li>
                                                                    @endif
                                                                @endforeach


                                                            </ul>
                                                        </td>
                                                        <td>

                                                            <ul class="tbl_img_list">
                                                                @foreach ($item->slider_items as $item2)
                                                                    @if (!empty($item2->slider_image_mobile))
                                                                        <li> <img
                                                                                src="{{ asset('/upload/slider/small/' . $item2->slider_image_mobile) }}"
                                                                                class="img-fluid"></li>
                                                                    @endif
                                                                @endforeach


                                                            </ul>
                                                        </td>
                                                        <td>{{ $item->title }}</td>


                                                        <td>
                                                            <div class="form-group m-0">
                                                                <select class="form-select is_published" name="is_publish"
                                                                    aria-label="save type">
                                                                    <option value="0"
                                                                        {{ $item->is_published == 0 ? 'selected' : '' }}>
                                                                        Draft
                                                                    </option>
                                                                    <option value="1"
                                                                        {{ $item->is_published == 1 ? 'selected' : '' }}>
                                                                        Public
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="input-group edit_delete" style="width:50px">
                                                                <a href="{{ url('admin/slider-item', $item) }}"
                                                                    class="btn btn-info" title="Add Item">+</a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group edit_delete">
                                                                <a href="{{ route('slider.edit', $item) }}"
                                                                    class="btn btn-info" title="Edit Data"><i
                                                                        class="fa fa-pencil"></i></a>

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
                var status_change_id = $(this).closest("tr").data('id');

                console.log(is_published);

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: '/admin/slider/changestatus',
                    data: {
                        'is_published': is_published,
                        'status_change_id': status_change_id
                    },
                    success: function(data) {
                        toastr.success(data.message);
                    }
                });
            })
        });
    </script>
@endsection
