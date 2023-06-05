@extends('admin.layout.layout')
@section('content')
    @include('admin.layout.breadcrumb', [
        'name' => 'Slider',
        'url' => 'slider.index',
        'section_name' => 'Edit Slider',
    ])
    <section class="content">
        <form action="{{ route('slider.update', $slider) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="row">
                {{-- Add post Page --}}
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header with-border d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Update Slider</h3>
                            <a href="{{ route('slider.index') }}" class="btn btn-primary">Back List Post</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Slider Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="title" class="form-control" required=""
                                                value="{{ $slider->title }}">
                                        </div>
                                        @error('title')
                                            <span class="alert text-danger">{{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Slider Slug <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="slug" class="form-control"
                                                value="{{ $slider->slug }}">
                                        </div>
                                        @error('slug')
                                            <span class="alert text-danger">{{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <ul class="row sortable_outer connectedSortable" id="connectedSortable">
                                <?php
                                $num = 0;
                                ?>
                                @foreach ($slider->slider_items as $item)
                                    <?php $num++; ?>
                                    <li class="col-md-12 a1">
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    <span class="handle">
                                                        <i class="fa-solid fa-arrows-up-down-left-right"></i>
                                                    </span>
                                                    <input type="hidden" name="block_no[]" class="block_no"
                                                        value="{{ $item->position == 0 ? $num : $item->position }}">
                                                    <input type="hidden" name="block_id[]" class="block_id"
                                                        value="{{ $item->id }}">
                                                </h3>

                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger full_round_danger_btn"
                                                        data-toggle="tooltip" data-placement="bottom" title=""
                                                        id="code_{{ $item->id }}"
                                                        data-bs-original-title="Delete permanantly"
                                                        onclick="delete_single_slider_item_fn('{{ $item->id }}')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="card-body">
                                                <div class="row m-0">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="form group col-md-4">
                                                                <label for="">Slider Image Desktop</label>
                                                                <input type="file" name="slider_image_desk[]"
                                                                    class="form-control  mb-3">
                                                                <img src="{{ asset('upload/slider/large/' . $item->slider_image_desk) }}"
                                                                    alt="" class="img-fluid w-25 mb-2">
                                                            </div>
                                                            <div class="form group  col-md-4">
                                                                <label for="">Slider Image Tab</label>
                                                                <input type="file" name="slider_image_tab[]"
                                                                    class="form-control  mb-3">
                                                                <img src="{{ asset('upload/slider/medium/' . $item->slider_image_tab) }}"
                                                                    alt="" class="img-fluid w-25 mb-2">
                                                            </div>
                                                            <div class="form group  col-md-4">
                                                                <label for="">Slider Image Mobile</label>
                                                                <input type="file" name="slider_image_mobile[]"
                                                                    class="form-control  mb-3">
                                                                <img src="{{ asset('upload/slider/small/' . $item->slider_image_mobile) }}"
                                                                    alt="" class="img-fluid w-25 mb-2">
                                                            </div>
                                                            <div class="form group col-md-4">
                                                                <label for="">Slider Title</label>
                                                                <input type="text" name="s_item_title[]"
                                                                    class="form-control" value="{{ $item->title }}">
                                                            </div>
                                                            <div class="form group col-md-4">
                                                                <label for="">Button Text</label>
                                                                <input type="text" name="link_text[]"
                                                                    class="form-control" value="{{ $item->link_text }}">
                                                            </div>
                                                            <div class="form group col-md-4">
                                                                <label for="">Button Link</label>
                                                                <input type="text" name="link[]" class="form-control"
                                                                    value="{{ $item->link }}">
                                                            </div>
                                                            <div class="form group col-md-12 pt-3">
                                                                <label for="">Slider Description</label>
                                                                <input type="text" name="content[]"
                                                                    class="form-control" value="{{ $item->content }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    </li>
                                @endforeach
                            </ul>

                            <hr>

                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-info px-5 py-2">Save </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </form>


        <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection

@section('custom_style_link')
@endsection

@section('custom_script')
    <script>
        function media_remove(el) {
            var element = el;
            $(element).closest('li').fadeOut("slow",
                function() {
                    $(element).closest('li').remove();
                });
            //console.log($(this).closest('li'));
        }

        function delete_single_slider_item_fn(el_id) {
            var id = el_id;
            // $(id).closest('li').remove();
            console.log($(id).closest('li'));

            console.log(id);
            var token = $("meta[name='csrf-token']").attr("content");
            var confirm_msg = "Are you sure you want to permanently delete this code block \nThis action can't be undone?";
            if (confirm(confirm_msg)) {
                $.ajax({
                    url: "{{ url('/admin/slider/delete_single_slide_item') }}/" + id,
                    type: 'DELETE',
                    data: {
                        "id": id,
                        "_token": token,
                    },
                    success: function(data) {
                        if (data.status == 1) {
                            toastr.success(data.response);
                            $("#code_" + id).closest('li').addClass("remove_box_shadow");
                            $("#code_" + id).closest('li').fadeOut(800,
                                function() {
                                    $("#code_" + id).closest('li').remove();
                                });
                            adjust_position();
                        } else {
                            alert("Woops Somthing went wrong!!");
                        }
                    }
                });

            }
        }

        count = 1;


        function adjust_position() {
            $(".sortable_outer").find("li").each(function(index, el) {
                $(this).find(".display_block_no").html(index + 1); // if you need hidden data
                $(this).find(".block_no").val(index + 1); // if you need hidden data
            });

            console.log("moved");
        }
    </script>
@endsection
