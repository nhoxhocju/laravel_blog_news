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
                <a href="{{ route('backend.post.create') }}" class="btn btn-sm btn-primary float-right"><i
                        class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp;{{ __('Create post') }}</a>
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
                                            name="checked[]">
                                        {{-- <label>Check all</label> --}}
                                    </div>
                                </th>
                                <th class="w-10">{{ __('Thumbnail') }}</th>
                                <th class="w-10">{{ __('Tag') }}</th>
                                <th class="w-10">{{ __('Category') }}</th>
                                <th class="w-15">{{ __('Title') }}</th>
                                {{-- <th class="w-5">Status</th> --}}
                                <th class="">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($posts->isEmpty())
                            <tr>
                                <td class="text-center" colspan="6">{{ __('There are no post available') }}</td>
                            </tr>
                            @endif
                            @foreach ($posts as $post)
                            <tr>
                                <td class="w-5 text-center">
                                    <div class="form-check">
                                        <input class="form-check-input position-static item-checkbox" type="checkbox"
                                            value="{{ $post->id }}" name="checked[]">
                                    </div>
                                </td>
                                <td class="w-10">
                                    <a href="{{ asset("/thumbnail/$post->thumbnail") }}" data-toggle="lightbox"
                                        data-title="{{ $post->pivot->title }}" data-gallery="gallery">
                                        {{-- <img src="{{ asset("/thumbnail/$post->thumbnail") }}" class="img-fluid
                                        mb-2" alt="white sample"/> --}}
                                        {{$post->thumbnail}}
                                    </a>
                                    {{-- {{$post->thumbnail}} --}}
                                </td>
                                <td class="w-10"></td>
                                <td class="w-10">{{$convertCategories[$post->category_id]}}</td>

                                <td class="w-15">
                                    {{$post->pivot->title}}</td>
                                {{-- <td class="w-5">{{$post->pivot->status}}</td> --}}
                                <td class="">
                                    <div class="dropdown show">
                                        <a class="btn btn-primary dropdown-toggle" href="#" role="button"
                                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Action
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="{{ route('home.show', $post->id)}}"target="_blank">
                                                <i class="fa fa-eye" aria-hidden="true"></i> View
                                            </a>
                                            <a class="dropdown-item"
                                                href="{{ route('backend.post.edit', $post->pivot->post_id)}}"><i
                                                    class="fa fa-pencil-square-o"
                                                    aria-hidden="true"></i>&nbsp;{{ __('Edit') }}
                                            </a>
                                            <button class="dropdown-item"
                                                data-url="{{ route('backend.post.delete', $post->pivot->post_id) }}"
                                                data-id="{{$post->pivot->post_id}}" data-toggle="modal"
                                                data-target="#delModal"><i class="fa fa-trash"
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
                                        <button class="dropdown-item" data-target="#delCheckboxModal"
                                            data-url="{{ route('backend.post.deleteCheckbox') }}" data-toggle="modal"><i
                                                class="fa fa-trash"
                                                aria-hidden="true"></i>&nbsp;{{ __('Delete') }}</button>
                                    </div>
                                </div>
                            </td>
                        </tfoot>

                    </table>
                    <div class="pagination pull-right">{{ $posts->links() }}</div>
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
                <p>Are you sure you want to delete All?</p>
            </div>
            <div class="modal-footer">
                <form id="delCheckboxForm" action="" method="post">
                    @csrf
                    @method("DELETE")
                    <div class="checkboxDiv">
                        {{-- <input type="checkbox" value="" id="checked" name="checked[]" hidden> --}}
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

</script>
<script>
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

        // $('body').on('click', '#blankCheckbox', function() {
        //     //   $('.form-check-input').prop('checked', this.checked);
        //       console.log($("#blankCheckbox").checked.val());
        // });

        // $('body').on('click', '.form-check-input', function() {
        //     if($(".form-check-input").length == $(".form-check-input:checked").length) {
        //         $("#checkAll").prop("checked", "checked");
        //         // console.log($("#checkAll").val());
        //     } else {
        //         $("#checkAll").removeAttr("checked");
        //     }

        // });
    });

</script>


<script src="{{ asset('plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
<script src="{{ asset('plugins/filterizr/jquery.filterizr.min.js') }}"></script>
<script>
    $(function () {
        $(document).on('click', '[data-toggle="lightbox"]', function (event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });

        $('.filter-container').filterizr({
            gutterPixels: 3
        });
        $('.btn[data-filter]').on('click', function () {
            $('.btn[data-filter]').removeClass('active');
            $(this).addClass('active');
        });
    })

</script>
@endpush


<!-- /.row -->
@endsection
