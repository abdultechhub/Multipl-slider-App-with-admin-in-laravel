@extends('admin.layout.layout')
@section('content')
    @include('admin.layout.breadcrumb', [
        'name' => 'Slider Post',
        'url' => 'slider.index',
        'section_name' => 'Add Slider',
    ])
    <section class="content">
        <form action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                {{-- Add post Page --}}
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header with-border d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Add New Slider</h3>
                            <a href="{{ route('slider.index') }}" class="btn btn-primary">Back List Slider</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Slider Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="title" class="form-control" required=""
                                                data-validation-required-message="This field is required">
                                            <div class="help-block"></div>
                                        </div>
                                        @error('title')
                                            <span class="alert text-danger">{{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <ul class="row sortable_outer connectedSortable" id="connectedSortable">
                                <li class="col-md-12 a1">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title" editable>
                                                <span class="handle">
                                                    <i class="fa-solid fa-arrows-up-down-left-right"></i>
                                                </span>
                                                <input type="hidden" name="block_no[]" class="block_no" value="1">
                                            </h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool remove_code_block">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>

                                        </div>

                                        <div class="card-body">
                                            <div class="row m-0">
                                                <div class="col-md-3">
                                                    <div class="form group">
                                                        <input type="file" name="slider_image_desk[]"
                                                            class="form-control" required>
                                                        <img src="" alt="" class="img-fluid">
                                                    </div>
                                                    <div class="form group">
                                                        <input type="file" name="slider_image_tab[]"
                                                            class="form-control">
                                                        <img src="" alt="" class="img-fluid">
                                                    </div>
                                                    <div class="form group">
                                                        <input type="file" name="slider_image_mobile[]"
                                                            class="form-control">
                                                        <img src="" alt="" class="img-fluid">
                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="form group col-md-4">
                                                            <label for="">Slider Title</label>
                                                            <input type="text" name="s_item_title[]"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form group col-md-4">
                                                            <label for="">Button Text</label>
                                                            <input type="text" name="link_text[]" class="form-control">
                                                        </div>
                                                        <div class="form group col-md-4">
                                                            <label for="">Button Link</label>
                                                            <input type="text" name="link[]" class="form-control">
                                                        </div>
                                                        <div class="form group col-md-12 pt-3">
                                                            <label for="">Slider Description</label>
                                                            <input type="text" name="content[]" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </li>
                            </ul>

                            <div>
                                <button type="button" class="btn btn-primary" onclick="addMore()">Add New slider
                                    Layer</button>
                            </div>

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
    <!-- CodeMirror -->

    <script>
        function media_remove(el) {
            var element = el;
            $(element).closest('li').remove();
            console.log($(this).closest('li'));
        }
        count = 1;

        function addMore() {
            var codde_block = `<li class="col-md-12 a1">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title" editable>
                                                <span class="handle">
                                                    <i class="fa-solid fa-arrows-up-down-left-right"></i>
                                                </span>
                                                <input type="hidden" name="block_no[]" class="block_no" value="1">
                                            </h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool remove_code_block">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>

                                        </div>

                                        <div class="card-body">
                                            <div class="row m-0">
                                                <div class="col-md-3">
                                                    <div class="form group">
                                                        <input type="file" name="slider_image_desk[]"
                                                            class="form-control" required>
                                                        <img src="" alt="" class="img-fluid">
                                                    </div>
                                                    <div class="form group">
                                                        <input type="file" name="slider_image_tab[]"
                                                            class="form-control">
                                                        <img src="" alt="" class="img-fluid">
                                                    </div>
                                                    <div class="form group">
                                                        <input type="file" name="slider_image_mobile[]"
                                                            class="form-control">
                                                        <img src="" alt="" class="img-fluid">
                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="form group col-md-4">
                                                            <label for="">Slider Title</label>
                                                            <input type="text" name="s_item_title[]"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form group col-md-4">
                                                            <label for="">Button Text</label>
                                                            <input type="text" name="link_text[]" class="form-control">
                                                        </div>
                                                        <div class="form group col-md-4">
                                                            <label for="">Button Link</label>
                                                            <input type="text" name="link[]" class="form-control">
                                                        </div>
                                                        <div class="form group col-md-12 pt-3">
                                                            <label for="">Slider Description</label>
                                                            <input type="text" name="content[]" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </li>`;
            $(".sortable_outer").append(codde_block);
            var block_length = $('.sortable_outer').find('.display_block_no').length;
            //$('.sortable_outer').find('.display_block_no').not(':first').last().html(block_length);
            //$(this).html().find(".display_block_no").html(count+1);

            adjust_position();

            console.log(block_length);
            count++;

            setTimeout(function() {
                $(".sortable_outer").find("li").removeClass("add_box_shadow")
            }, 700);

            $('.dynamic_description').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ]
            });
            return false;

        }


        $("body").on('click', '.remove_code_block', function() {
            console.log("cl");
            var remove_list = $(this).closest('li');
            remove_list.addClass("remove_box_shadow");
            if (confirm("Are you sure you want to delete this?")) {
                setTimeout(function() {
                    remove_list.remove();
                    //console.log("ok");
                }, 700);
                //console.log("ok");
            } else {
                remove_list.removeClass("remove_box_shadow");
                return false;
            }

            setTimeout(function() {
                adjust_position();
            }, 701);
        });
    </script>
@endsection
