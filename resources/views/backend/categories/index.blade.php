@extends('backend.layouts.admin')
@section('title', __('Posts'))
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
                <h3 class="card-title mx-auto">{{ __('List posts') }}</h3>
                {{-- <button type="button" class="btn btn-block btn-primary">Primary</button> --}}
                <a href="{{ route('backend.category.create') }}" class="btn btn-sm btn-primary float-right"><i
                        class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp;{{ __('Create category') }}</a>
                {{-- </div>   --}}
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="w-5 text-center">
                                    <div class="form-check">
                                        <input class="form-check-input position-static" type="checkbox" id="checkAll"
                                            value="option1" aria-label="...">
                                        {{-- <label>Check all</label> --}}
                                    </div>
                                </th>
                                {{-- <th class="w-5">#</th> --}}
                                <th class="w-10">{{ __('Name') }}</th>
                                {{-- <th class="w-5">Status</th> --}}
                                <th class="">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($categories->isEmpty())
                            <tr>
                                <td class="text-center" colspan="6">{{ __('There are no category available') }}</td>
                            </tr>
                            @endif
                            @foreach ($categories as $cat)
                            <tr>
                                <td class="w-5 text-center">
                                    <div class="form-check">
                                        <input class="form-check-input position-static item-checkbox" type="checkbox"
                                    value="{{ $cat->id }}">
                                    </div>
                                </td>
                                <td class="w-50">{{ $cat->pivot->name }}</td>
                                {{-- <td class="w-5">{{$post->pivot->status}}</td> --}}
                                <td class="">
                                    <div class="dropdown show">
                                        <a class="btn btn-primary dropdown-toggle" href="#" role="button"
                                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Action
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item"
                                                href="{{ route('backend.category.edit', $cat->id) }}"><i
                                                    class="fa fa-pencil-square-o"
                                                    aria-hidden="true"></i>&nbsp;{{ __('Edit') }}
                                            </a>
                                            <button class="dropdown-item"
                                                data-url="{{ route('backend.category.delete', $cat->id) }}"
                                                data-id="{{ $cat->id }}" data-toggle="modal" data-target="#delModal"><i
                                                    class="fa fa-trash"
                                                    aria-hidden="true"></i>&nbsp;{{ __('Delete') }}
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <td>
                                <div class="dropdown show">
                                    <a class="btn btn-primary dropdown-toggle" href="#" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" data-toggle="modal" data-url="{{ route('backend.category.deleteCheckbox')}}" data-target="#delCheckboxModal" href="#"><i
                                        class="fa fa-trash"
                                        aria-hidden="true"></i>&nbsp;{{ __('Delete') }}</a>
                                    </div>
                                </div>
                            </td>
                        </tfoot>


                    </table>
                    {{-- <div class="pagination pull-right">{{ $posts->links() }}
                </div> --}}
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>
<!-- /.col -->
</div>
<div class="modal" id="delModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete?</p>
            </div>
            <div class="modal-footer">
                <form id="delForm" action="" method="post">
                    @csrf
                    @method("DELETE")
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-danger" type="submit"><i class="fa fa-trash"
                            aria-hidden="true"></i>&nbsp;{{ __('Delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="delCheckboxModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete?</p>
                </div>
                <div class="modal-footer">
                    <form id="delCheckboxForm" action="" method="post">
                        @csrf
                        @method("DELETE")
                        <div class="checkboxDiv">

                        </div>
                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-danger" type="submit"><i class="fa fa-trash"
                                aria-hidden="true"></i>&nbsp;{{ __('Delete') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
{{-- <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
 --}}
{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> --}}
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> --}}
@push('post-index-scripts')
<script>
    var id = 10;
    // alert("{{ route('backend.post.delete',"+ id +") }}");
    $('#delModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var url = button.data('url');
        var id = button.data('id');
        // console.log(url);

        $('#delForm').attr("action", url);
    });

    $('#delCheckboxModal').on('show.bs.modal', function (event) {
        var arrayChecked = [];
        var button = $(event.relatedTarget);
        var url = button.data('url');

        $('#delCheckboxForm').attr("action", url);
        var inputCheckboxs = $('input.item-checkbox').filter(':checked');
        inputCheckboxs.each(function (position) {
            $(".checkboxDiv").append("<input type='text' value=" + inputCheckboxs[position].value +
                " name='checked[]' hidden>")
        })
        $('#checked').val(arrayChecked);
    });

</script>
<script type="text/javascript">
    jQuery(function ($) {
        $('body').on('click', '#checkAll', function () {
            $('.form-check-input').prop('checked', this.checked);
        });

    });

</script>
@endpush

<!-- /.row -->
@endsection
