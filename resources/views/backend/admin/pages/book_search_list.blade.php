@extends('backend.admin.includes.admin_layout')
@section('content')
    <div class="page-content">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class=" mb-2" style="text-align:center">
                            <h3>Book Search Result</h3>
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

                        <form action="{{ route('admin.book.search') }}" method="post">
                          @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="" class="form-label"> Book Name </label>
                                    <input type="text" class="form-control" name="name" value="{{ $data['book_name'] }}"
                                        placeholder="Enter Book Name" >
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="" class="form-label">Category </label>
                                    <select name="category" class="form-select js-example-basic-single"
                                        id="" >
                                        <option value="">Select</option>
                                        @foreach ($data['book_category'] as $single_category)
                                            <option value="{{ $single_category->id }}" @if($data['category']==$single_category->id) selected @endif>{{ $single_category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="" class="form-label">Rack </label>
                                    <select name="rack_id" class="form-select js-example-basic-single"
                                        id="" >
                                        <option value="">Select</option>
                                        @foreach ($data['rack_list'] as $single_rack)
                                            <option value="{{ $single_rack->id }}" @if($data['rack_id']==$single_rack->id) selected @endif>{{ $single_rack->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="form-label"> Author </label>
                                    <input type="text" class="form-control" name="author" value="{{ $data['author'] }}"
                                        placeholder="Enter Author" >
                                </div>
                                <div class="text-center mt-2">
                                    <button class="btn btn-xs btn-primary" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive" id="print_data">
                            <table id="dataTableExample" class="table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="">SL</th>
                                        <th style="">Photo</th>
                                        <th style="">Name</th>
                                        <th style="">Volume</th>
                                        <th style="">Copy </th>
                                        <th style="">Rack</th> 
                                        <th style="">Author</th>
                                        <th style="width:15%">action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['book_search_list'] as $key => $single_book)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>
                                                <img src="{{ asset($single_book->photo) }}"
                                                    alt="{{ $single_book->id }}.jpg" loading="lazy" style="width:auto; height: 45px;" >
                                            </td>
                                            <td>
                                                {{ $single_book->name }} <br>
                                                <span class="badge bg-success"> {{ $single_book->category }} </span>
                                            </td> 
                                            <td>
                                                {{ $single_book->volume_no }}
                                            </td>
                                            <td>
                                                {{ $single_book->total_copy }}
                                            </td>
                                            <td>
                                                {{ $single_book->rack_name }}
                                            </td>
                                            
                                            <td>
                                                {{ $single_book->author }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.book.edit', $single_book->id) }}"
                                                    class="btn btn-success btn-icon" href=""><i
                                                        class="fa-solid fa-edit"></i></a>


                                                <a class="btn btn-danger btn-icon" data-delete="{{ $single_book->id }}"
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
@endsection
@push('js')
    <script>
        $(document).on('click', '#delete', function() {
            if (confirm('Are You Sure ?')) {
                let id = $(this).attr('data-delete');
                let row = $(this).closest('tr');
                $.ajax({
                    url: '/admin/book/delete/' + id,
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
