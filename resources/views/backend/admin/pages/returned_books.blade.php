@extends('backend.admin.includes.admin_layout')

@section('content')

    <div class="page-content">



        <div class="row justify-content-center">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-body">

                        <div class=" mb-2" style="text-align:center">

                            <h3>Returned List</h3>

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

                            <table id="Table" class="table" style="width: 100%;">

                                <thead>

                                    <tr>

                                        <th style="">SL</th>

                                        <th style="">Photo </th>

                                        <th style="">Book Info</th>

                                        <th style="">Member Info</th>



                                        <th style="">Dates </th>

                                        <th style="">Status</th>



                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach ($data['returned_books'] as $key => $single_book)

                                        <tr>

                                            <td>{{ ++$data['serial'] }}</td>

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

                                                @if($single_book->status == 1)

                                                <span class="badge bg-success">Good</span> <br>

                                                {{ date('d/m/Y', strtotime($single_book->actual_return_date ))}}

                                                @elseif($single_book->status == 2)

                                                <span class="badge bg-danger">Defaulter</span> <br>

                                                {{ date('d/m/Y', strtotime($single_book->actual_return_date ))}}

                                                @endif

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>
                        <div class="mt-3">

                            {!!$data['returned_books']->withQueryString()->links('pagination::bootstrap-5') !!}

                            </div>


                    </div>

                </div>

            </div>

        </div>

    </div>



@endsection

