@extends('backend.layouts.admin')
@section('title', __('Posts'))
@section('content')
<div class="container-fluid">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
        @endforeach
    </div>
    @endif
    @if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    <div class="row">
        <!-- left column -->
        <div class="col-lg-12 col-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Edit post') }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="{{ route('backend.post.update', $post->id) }}"  enctype="multipart/form-data" method="post">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Thumbnail</label>
                            <div class="input-group">
                                {{-- <input type="button" id="lfm" data-input="thumbnail" data-preview="holder"
                                    value="Upload"> --}}
                                <input id="thumbnail" type="file" onchange="readURL(this)" class="form-control" value="{{ $post->thumbnail }}" name="thumbnail">
                            </div>
                        <img id="holder" src="{{ asset("thumbnail/$post->thumbnail") }}" style="margin-top:15px;max-height:300px;">
                        </div>
                        <div class="form-group">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                @php $count = 1; @endphp
                                @foreach ($languages as $language)
                                <li class="nav-item">
                                    <a class="nav-link {{ ($count++ == 1) ? "active" : "" }}"
                                        id="{{ $language->code_language }}-tab" data-toggle="tab"
                                        href="#{{ $language->code_language }}" role="tab">
                                        {{ __($language->language) }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                @php $count = 1; @endphp
                                @foreach ($languages as $language)
                                <div class="tab-pane fade show {{ ($count++ == 1) ? "active" : "" }}"
                                    id="{{ $language->code_language }}" role="tabpanel">
                                    <label>{{ __('Title') }}</label>
                                    <input type="text" class="form-control" placeholder="{{ __('Enter title post') }}"
                                        value="{{ $language->pivot->title }}"
                                        name="title-{{ $language->code_language }}">
                                    <label>{{ __('Content') }}</label>
                                    <textarea class="form-control" id="{{ $language->code_language }}-ckeditor"
                                        name="content-{{ $language->code_language }}">{{ $language->pivot->content }}</textarea>
                                </div>
                                @endforeach

                            </div>
                        </div>

                        <!-- /.card-body -->

                        <div class="card-footer">
                            <a href="{{ route('backend.post.index') }}"
                                class="btn btn-default mr-2">{{ __('Back') }}</a>
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                </form>
            </div>
        </div>
        <!--/.col (left) -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->


<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
    var options = {
        filebrowserImageBrowseUrl: '../../../laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '../../../laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '../../../laravel-filemanager?type=Files',
        filebrowserUploadUrl: '../../../laravel-filemanager/upload?type=Files&_token='
    };

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
<script>
    $('#lfm').filemanager('image', {
        prefix: '../../../laravel-filemanager'
    });

</script>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#holder')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }    
</script>

<script>
    var languages = <?php echo json_encode($languages); ?> ;
    var ckedit;
    languages.forEach(function (lang) {
        ckedit = lang['code_language'] + "-ckeditor";
        CKEDITOR.replace(ckedit, options)
    });

</script>

@endsection
