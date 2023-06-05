<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $name }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                    @if (!empty($name))
                        <li class="breadcrumb-item"><a href='{{ url($url) }}'>{{ $name }}</a></li>
                    @endif

                    @if (!empty($section_name))
                        <li class="breadcrumb-item active">{{ $section_name }}</li>
                    @endif
                    @if (!empty($sub_section_name))
                        <li class="breadcrumb-item active">{{ $sub_section_name }}</li>
                    @endif
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
