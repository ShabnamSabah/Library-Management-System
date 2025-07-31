@extends('backend.admin.includes.admin_layout')
@section('content')
    <div class="page-content">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class=" mb-2" style="text-align:center">
                            <h3>Report</h3>
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

                        <form action="{{ route('admin.report') }}" method="post" target="_blank">
                          @csrf
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="issue_date" class="form-label">Start Date</label>
                                    <div class="input-group flatpickr" id="flatpickr-date">
                                        <input type="text" name="start_date" value="" id="news_date"
                                            class="form-control" placeholder="Select date" data-input>
                                        <span class="input-group-text input-group-addon" data-toggle><i
                                                data-feather="calendar"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="issue_date" class="form-label">End Date </label>
                                    <div class="input-group flatpickr" id="flatpickr-date">
                                        <input type="text" name="end_date" value="" id="news_date"
                                            class="form-control" placeholder="Select date" data-input >
                                        <span class="input-group-text input-group-addon" data-toggle><i
                                                data-feather="calendar"></i></span>
                                    </div>


                                </div>

                                <div class="col-md-3">
                                    <label for="" class="form-label"> Membership Number </label>
                                    <input type="text" class="form-control" name="membership_number"
                                        placeholder="Enter Membership Number" >
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="" class="form-label">Status </label>
                                    <select name="status" class="form-select js-example-basic-single"
                                        id="" >
                                        <option value="all">Select</option>
                                        <option value="0">Issued</option>
                                        <option value="1">Good</option>
                                        <option value="2">Defaulter</option>
                                    </select>
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
    </div>
        @endsection