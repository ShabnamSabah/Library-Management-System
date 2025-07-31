@extends('backend.admin.includes.admin_layout')

@section('content')

    <div class="page-content">



        <div class="row justify-content-center">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-body">

                        <div class=" mb-2" style="text-align:center">

                            <h3>Returning Book List</h3>

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

                                        <th style="">Photo </th>

                                        <th style="">Book Info</th>

                                        <th style="">Member Info</th>



                                        <th style="">Dates </th>



                                        <th style="width:15%">action</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach ($data['returning_books'] as $key => $single_book)

                                        <tr>

                                            <td>{{ $key+1 }}</td>

                                            <td>

                                                <img src="{{ asset($single_book->book_photo) }}"

                                                    alt="" loading="lazy" style="width:auto; height: 45px;" >

                                            </td>

                                            <td>

                                                {{ $single_book->book_name }} <br>

                                                <span class="badge bg-success"> {{ $single_book->category }} </span>

                                            </td>

                                            <td>
                                                {{ $single_book->name }} <br>
                                                {{ 'Member Id:' . $single_book->membership_number }}

                                            </td>



                                            <td>

                                                {{ date('d/m/Y', strtotime($single_book->issue_date ))}} to <br>

                                                {{ date('d/m/Y', strtotime($single_book->return_date ))}}

                                            </td>



                                            <td>

                                                <a data-bs-toggle="modal" data-bs-target="#EditActualReturnDate"

                                                data-id="{{ $single_book->id }}"

                                                data-actual-return-date="{{ $single_book->actual_return_date}}"

                                                class="edit btn btn-success btn-icon"><i class="fa-solid fa-edit"></i></a>





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

    <div class="modal fade" id="EditActualReturnDate" tabindex="-1" aria-labelledby="EditActualReturnDate" aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header text-center">

                    <h6 class="title" id="defaultModalLabel">Add Return Date</h6>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>

                </div>

                <div class="modal-body">

                    <form action="{{ route('admin.get.returning.books') }}" method="POST">

                        @csrf

                        <div class="row justify-content-center g-2">

                            <div class="col-md-8">

                                <label class="form-label">Actual Return Date*</label>

                                <input type="hidden" name="id" id="id">

                                <div class="input-group flatpickr" id="flatpickr-date">

                                    <input type="text" name="actual_return_date" value="" id="news_date"

                                        class="form-control" placeholder="Select date" data-input required>

                                    <span class="input-group-text input-group-addon" data-toggle><i

                                            data-feather="calendar"></i></span>

                                </div>

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

    document.addEventListener('DOMContentLoaded', function() {

        flatpickr("#news_date", {

            defaultDate: new Date(), // Sets the default date to the current date

            dateFormat: "Y-m-d", // Adjust the date format if needed

        });

    });

</script>

<script>

    $(document).on('click', '.edit', function() {

        var id = $(this).data('id');

        var actual_return_date = $(this).data('actual-return-date');



        $('#id').val(id);

        $('#actual_return_date').val(actual_return_date);



    })

</script>

    <script>

        $(document).on('click', '#delete', function() {

            if (confirm('Are You Sure ?')) {

                let id = $(this).attr('data-delete');

                let row = $(this).closest('tr');

                $.ajax({

                    url: '/admin/get-returning-books/delete/' + id,

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

