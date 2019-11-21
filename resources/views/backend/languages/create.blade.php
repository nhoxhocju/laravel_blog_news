@extends('backend.layouts.admin')
@section('title', __('Language'))
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
                    <h3 class="card-title">{{ __('Create language') }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
            <form role="form" action="{{ route('backend.language.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="card-body">
                        {{-- <div class="form-group">
                            <label>{{ __('Code') }}</label>
                            <input type="text" class="form-control" placeholder="{{ __('Enter code') }}">
                        </div> --}}
                        <div class="form-group">
                            <label>{{ __('Language') }}</label>
                            <select class="form-control" name="language">
                                    {{-- <option selected value="null">{{ __('Choose a Language...') }}</option> --}}
                                    @foreach($listLanguage as $lang => $key)
                            <option value="{{ $lang }}:{{ $key }}">{{ $key }}</option>
                                    @endforeach
                                  </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="{{ route('backend.language.index') }}"
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
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('vi-ckeditor', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });

</script>
{{-- <script>
    CKEDITOR.replace( 'vi-ckeditor' );
</script> --}}

<script>
    CKEDITOR.replace('en-ckeditor', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });

</script>
{{-- <script>
    CKEDITOR.replace( 'en-ckeditor' );
</script> --}}
@endsection
