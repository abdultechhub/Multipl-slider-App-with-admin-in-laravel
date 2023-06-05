@extends('admin.layout.layout')
@section('content')
    @include('admin.layout.breadcrumb', [
        'name' => 'Add Slider Item',
        'url' => 'slider.index',
        'section_name' => 'Add Slider Item',
    ])
    <section class="content">
        <form action="{{ route('slider.store_slider_item') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                {{-- Add post Page --}}
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header with-border d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Add New Slider Item</h3>
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
                                                value="{{ $slider->title }}" readonly>
                                            <input type="hidden" name="slider_id" class="form-control" required=""
                                                value="{{ $slider->id }}">
                                        </div>
                                        @error('title')
                                            <span class="alert text-danger">{{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="row m-0">
                                <div class="col-md-3">
                                    <div class="form group">
                                        <input type="file" name="slider_image_desk" class="form-control" required>
                                        <img src="" alt="" class="img-fluid">
                                    </div>
                                    <div class="form group">
                                        <input type="file" name="slider_image_tab" class="form-control">
                                        <img src="" alt="" class="img-fluid">
                                    </div>
                                    <div class="form group">
                                        <input type="file" name="slider_image_mobile" class="form-control">
                                        <img src="" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="form group col-md-4">
                                            <label for="">Slider Title</label>
                                            <input type="text" name="s_item_title" class="form-control">
                                        </div>
                                        <div class="form group col-md-4">
                                            <label for="">Button Text</label>
                                            <input type="text" name="link_text" class="form-control">
                                        </div>
                                        <div class="form group col-md-4">
                                            <label for="">Button Link</label>
                                            <input type="text" name="link" class="form-control">
                                        </div>
                                        <div class="form group col-md-12 pt-3">
                                            <label for="">Slider Description</label>
                                            <input type="text" name="content" class="form-control">
                                        </div>
                                    </div>
                                </div>
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
        $(document).ready(function() {

            $("#selectfile").bind('change', function(e) {
                // var filename = $("#selectfile").val();
                var filename = this.files[0].name;
                var files = $(this)[0].files;
                if (files.length < 1) {
                    $("#blankFile").text("No File Chosen..");
                    $(".success").hide();
                } else {
                    //console.log(files.length);
                    if (files.length > 1) {
                        $("#blankFile").html(files.length + " files selected");
                    } else {
                        $("#blankFile").html(filename);
                    }
                    //$("#blankFile").text(filename.replace("C:\\fakepath\\",""));
                    //addFiles(event);
                    $(".success").show();
                }
            });
        });


        $('#summernote_ed1').summernote();
        $('#summernote_ed2').summernote();
    </script>
@endsection
