@extends('backend.admin.includes.admin_layout')
@section('content')
    <div class="page-content">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="caseAddHeader">
                            <h3>Book Category List</h3>
                            <div>
                                <button type="button" class="btn btn-success btn-xs addButton" data-bs-toggle="modal"
                                    data-bs-target="#AddBookCategory"><i class="fa-solid fa-plus"></i> Add </button>
                            </div>
                        </div>

                        <div class="mt-3">
                            @if (session('success'))
                            <div style="width:100%" class="alert alert-primary alert-dismissible fade show" role="alert">
                                <strong> Success!</strong> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="btn-close"></button>
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Failed!</strong> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="btn-close"></button>
                            </div>
                        @endif
                            <div id="success"></div>
                            <div id="failed"></div>
                        </div>
                        <div class="table-responsive" id="print_data">
                            <table id="dataTableExample" class="table tableSmall" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="">SL</th>
                                        <th style="">Name</th>
                                        <th style="">Priority</th>
                                        <th style="width:15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['book_category_list'] as $key => $single_category)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>


                                            <td>
                                                {{ $single_category->name }} <br>

                                            </td>
                                            <td>
                                                {{ $single_category->priority}} <br>

                                            </td>
                                            <td>
                                                <a data-bs-toggle="modal" data-bs-target="#EditBookCategory"
                                                data-id="{{ $single_category->id }}"
                                                data-name="{{ $single_category->name }}"
                                                  data-priority="{{ $single_category->priority }}"
                                                class="edit btn btn-success btn-icon"><i class="fa-solid fa-edit"></i></a>

                                                <a class="btn btn-danger btn-icon" data-delete="{{ $single_category->id }}"
                                                    id="delete"><i class="fa-solid fa-trash"></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="AddBookCategory" tabindex="-1" aria-labelledby="AddBookCategory" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h6 class="title" id="defaultModalLabel">ADD Book Category</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.book.category') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="">Name *</label>
                                <input type="text" class="form-control" placeholder="Enter Name" name="name" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="">Priority</label>
                                <input type="number" class="form-control" placeholder="Enter Priority" name="priority">
                            </div>
                            <div class="col-12 text-center mt-3">
                                <button class="btn btn-xs btn-success" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="EditBookCategory" tabindex="-1" aria-labelledby="EditBookCategory" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h6 class="title" id="defaultModalLabel">Update category</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.book.category') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name*</label>
                                <input type="hidden" name="id" id="id">

                                    <input type="text" class="form-control" placeholder="Enter Name" name="name"  id="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="">Priority</label>
                                <input type="number" class="form-control" placeholder="Enter Priority" name="priority" id="priority" required>
                            </div>

                            <div class="col-12 text-center mt-3">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
<script>
    $(document).on('click', '.edit', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var priority = $(this).data('priority');

        $('#id').val(id);
        $('#name').val(name);
        $('#priority').val(priority);

    })
</script>
    <script>
        $(document).on('click', '#delete', function() {
            if (confirm('Are You Sure ?')) {
                let id = $(this).attr('data-delete');
                let row = $(this).closest('tr');
                $.ajax({
                    url: '/admin/category/delete/' + id,
                    success: function(data) {
                        var data_object = JSON.parse(data);
                        if (data_object.status == 'SUCCESS') {
                            row.remove();
                            $('#Table tbody tr').each(function(index) {
                                $(this).find('td:first').text(index + 1);
                            });
                            $('#success').css('display', 'block');
                            $('#success').html(
                                '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success! </strong>' +
                                data_object.message +
                                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button></div>'
                            );
                        } else {
                            $('#failed').html('display', 'block');
                            $('#failed').html(
                                '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Failed! </strong>' +
                                data_object.message +
                                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button></div>'
                            );
                        }

                    }
                });
            }
        });
    </script>
@endpush
