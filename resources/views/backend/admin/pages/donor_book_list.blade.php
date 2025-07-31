@extends('backend.admin.includes.admin_layout')
@section('content')
    <div class="page-content">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class=" mb-2" style="text-align:center">
                            <h3>Donor Book List</h3>
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
                            <table id="dataTableExample" class="table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="">SL</th>
                                        <th style="">Photo</th>
                                        <th style="">Name</th>
                                        <th style="">Author</th>
                                        <th style="">Category </th>
                                        <th style="">Issue Date</th>
                                        <th style="width:15%">action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['donor_book_list'] as $key => $single_book)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>
                                                <img src="{{ asset($single_book->photo ? $single_book->photo : 'backend_assets/images/user-dummy.png') }}"
                                                    alt="" loading="lazy" style="width:1000px" >
                                            </td>
                                            <td>
                                                {{ $single_book->name }}
                                            </td>
                                            <td>
                                                {{ $single_book->author }}
                                            </td>
                                            <td>
                                                {{ $single_book->category }}
                                            </td>

                                            <td>
                                                {{ date('d M Y', strtotime($single_book->issue_date)) }}
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
