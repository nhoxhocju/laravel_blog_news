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

    <div class="row">
        <!-- left column -->
        <div class="col-lg-12 col-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Create category') }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="{{ route('backend.category.store') }}" method="post">
                    @method('POST')
                    @csrf
                    <div class="card-body">
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
                                    <label>{{ __('Category') }}</label>
                            <input type="text" class="form-control" placeholder="{{ __('Enter name category') }}"
                                        name="category-{{ $language->code_language }}">
                                    
                                </div>
                                @endforeach

                            </div>
                        </div>

                    </div>

                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a href="{{ route('backend.category.index') }}" class="btn btn-default mr-2">{{ __('Back') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <!--/.col (left) -->
    </div>

<script type="text/javascript">
    // var holder = document.getElementById("holder");
    var radios = document.getElementsByName('radio');
    var languages = <?php echo json_encode($languages); ?>;
    // var ckedit;
    // console.log(radios);
    // languages.forEach(function (lang) {
        for(var i = 0; i < radios.length; i++){
            // if(lang['code_language'] == )
            radios[i].onclick = function(){
                // if(lang['code_language'] == this.value)
                // console.log(this.value);
                languages.forEach(function (lang) {
                    if(this.value == lang['code_language']){
                        console.log('meo');
                        alert(document.getElementById('title-' + lang['code_language']).value);
                    }
                })
                // console.log(this.value);
            }
        }
    // });
    // alert(document.getElementById("radio").value);
</script>
</div><!-- /.container-fluid -->
{{-- <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script> --}}
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
    var options = {
        filebrowserImageBrowseUrl: '../../laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '../../laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '../../laravel-filemanager?type=Files',
        filebrowserUploadUrl: '../../laravel-filemanager/upload?type=Files&_token='
    };

</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
<script>
    $('#lfm').filemanager('image', {
        prefix: '../../laravel-filemanager'
    });

</script>

{{-- <script>
    // document.getElementById("data-offer-id").click()
    alert(document.getElementById("data-offer-id").val())
</script> --}}


@endsection
