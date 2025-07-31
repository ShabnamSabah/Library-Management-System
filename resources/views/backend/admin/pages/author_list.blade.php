@extends('backend.admin.includes.admin_layout')
@section('content')
    <div class="page-content">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class=" mb-2" style="text-align:center">
                            <h3>Author List</h3>
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

                                        <th style="">Name</th>
                                        <th style="">Total Book</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['author_list'] as $key => $single_author)
                                        <tr>
                                            <td>{{ $key+1 }}</td>

                                            <td>
                                                {{ $single_author->author}}
                                            </td>

                                            <td>
                                                {{ $single_author->book_count}}
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
