@extends('backend.layouts.admin')
@section('title', __('List languages'))
@section('content')
<div class="row">
    <div class="col-12">
        @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title mx-auto">{{ __('List languages') }}</h3>
                {{-- <button type="button" class="btn btn-block btn-primary">Primary</button> --}}
                <a href="{{ route('backend.language.create') }}" class="btn btn-sm btn-primary float-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp;{{ __('Create language') }}</a>
                {{-- </div>   --}}
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Code') }}</th>
                                <th>{{ __('Language') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($languages as $lang)
                            <tr>
                                <td>{{$lang->id}}</td>
                                <td>{{$lang->code_language}}</td>
                                <td>{{$lang->language}}</td>
                                <td>
                                    <a href="#"
                                        class="btn btn-sm btn-primary mr-2 float-left"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;{{ __('Edit') }}</a>
                                    <form action="#" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;{{ __('Delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        {{-- <tfoot>
                        <tr>
                            <th>Rendering engine</th>
                            <th>Browser</th>
                            <th>Platform(s)</th>
                        </tr>
                    </tfoot> --}}
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@endsection
