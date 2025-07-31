@extends('backend.admin.includes.admin_layout')

@section('content')

    <div class="page-content">

        <div class="row justify-content-center">

            <div class="col-md-12">

                <h6 class="card-title mb-3">Welcome To Dashboard</h6>

               <div class="row">

                <div class="col-md-3 grid-margin stretch-card">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-baseline">

                                <h6 class="card-title mb-0">Total Book </h6>

                            </div>

                            <div class="mt-2" style="color: green ;font-size:18px">

                                {{ $data['total_book_copies'] }} <span class="badge bg-success"> {{ $data['total_book'] }} </span>

                            </div>

                            <div class="mt-2" style="">

                                <a href="{{ route('admin.book.list') }}">Book List <i

                                        class="fa-solid fa-arrow-right"></i></a>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-md-3 grid-margin stretch-card">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-baseline">

                                <h6 class="card-title mb-0">Total Author </h6>

                            </div>

                            <div class="mt-2" style="color: green ;font-size:18px">

                                {{ $data['total_author'] }}

                            </div>

                            <div class="mt-2" style="">

                                <a href="{{ route('admin.author.list') }}">Author List <i

                                        class="fa-solid fa-arrow-right"></i></a>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-md-3 grid-margin stretch-card">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-baseline">

                                <h6 class="card-title mb-0">Total Rack </h6>

                            </div>

                            <div class="mt-2" style="color: green ;font-size:18px">

                                {{ $data['total_rack'] }}

                            </div>

                            <div class="mt-2" style="">

                                <a href="{{ route('admin.racks') }}">Rack List <i

                                        class="fa-solid fa-arrow-right"></i></a>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-md-3 grid-margin stretch-card">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-baseline">

                                <h6 class="card-title mb-0">Total Member </h6>

                            </div>

                            <div class="mt-2" style="color: green ;font-size:18px">

                                {{ $data['total_member'] }}

                            </div>

                            <div class="mt-2" style="">

                                <a href="{{ route('admin.member.list') }}">Member List <i

                                        class="fa-solid fa-arrow-right"></i></a>

                            </div>

                        </div>

                    </div>

                </div>
                   <div class="col-md-3 grid-margin stretch-card">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-baseline">

                                <h6 class="card-title mb-0">Total Donor </h6>

                            </div>

                            <div class="mt-2" style="color: green ;font-size:18px">

                                {{ $data['total_donor'] }}

                            </div>

                            <div class="mt-2" style="">

                                <a href="{{ route('admin.donor') }}">Donor List <i

                                        class="fa-solid fa-arrow-right"></i></a>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-md-3 grid-margin stretch-card">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-baseline">

                                <h6 class="card-title mb-0">Total Issued Books </h6>

                            </div>

                            <div class="mt-2" style="color: green ;font-size:18px">

                                {{ $data['total_issue'] }}

                            </div>



                        </div>

                    </div>

                </div>

                <div class="col-md-3 grid-margin stretch-card">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-baseline">

                                <h6 class="card-title mb-0">Total Returning </h6>

                            </div>

                            <div class="mt-2" style="color: green ;font-size:18px">

                                {{ $data['total_returning'] }}

                            </div>



                        </div>

                    </div>

                </div>

                <div class="col-md-3 grid-margin stretch-card">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-baseline">

                                <h6 class="card-title mb-0">Today Returning </h6>

                            </div>

                            <div class="mt-2" style="color: green ;font-size:18px">

                                {{ $data['total_today_returning'] }}

                            </div>

                        </div>

                    </div>

                </div>

             
               </div>

            </div>

        </div>

    </div>

@endsection

