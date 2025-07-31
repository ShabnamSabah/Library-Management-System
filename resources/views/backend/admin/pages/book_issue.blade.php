@extends('backend.admin.includes.admin_layout')

@push('css')

@endpush

@section('content')

    <div class="page-content">

        <div class="row justify-content-center">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-body">

                        <h3 class=" text-center mb-2">Book Issue to Member</h3>

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

                        <form action="{{ route('admin.book.issue') }}" method="post">

                            @csrf

                            <div class="row">



                                <div class="col-md-3 mb-3">

                                    <label for="" class="form-label"> Membership Number *</label>

                                    <input type="text" class="form-control" name="membership_number"

                                        id="membership_number" placeholder="Enter Membership Number" required>

                                </div>

                                <div class="col-md-3 mb-3">

                                    <label for="" class="form-label">Rack *</label>

                                    <select name="rack_id" class="form-select js-example-basic-single" id="rack_id"

                                        id="" required>

                                        <option value="">Select</option>

                                        @foreach ($data['racks'] as $single_rack)

                                            <option value="{{ $single_rack->id }}">{{ $single_rack->name }}</option>

                                        @endforeach

                                    </select>

                                </div>

                                <div class="col-md-3 mb-3">

                                    <label for="" class="form-label">Category </label>

                                    <select name="category_id" class="form-select js-example-basic-single" id="category_id"

                                        id="">

                                        <option value="0">Select</option>

                                        @foreach ($data['book_category'] as $single_category)

                                            <option value="{{ $single_category->id }}">{{ $single_category->name }}</option>

                                        @endforeach

                                    </select>

                                </div>



                                <div class="col-md-3 mb-3">

                                    <label for="" class="form-label">Book *</label>

                                    <select name="book_id" class="form-select js-example-basic-single" id="book_id"

                                        id="" required>

                                        <option value="">Select</option>



                                    </select>





                                </div>



                                <div class="col-md-4 mb-3">

                                    <div class="studentInfo">

                                        <div class="studentImg">

                                            <img src="{{ asset('backend_assets/images/user-dummy.png')}}" alt=""

                                                id="member_photo">

                                        </div>

                                        <div class="studentText">

                                            <p id="member_name"> </p>
                                            <p id="member_id"> </p>
                                            <p id="member_phone"> </p>
                                          



                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-4 mb-3">

                                    <div class="bookInfo">

                                        <div class="bookImg">

                                            <img src="{{ asset('backend_assets/images/user-dummy.png')}}" alt=""

                                                id="book_photo">

                                        </div>

                                        <div class="bookText">

                                            <p id="book_name"> </p>

                                            <p id="volume_no"></p>

                                            <p id="total_copy"></p>

                                            <p id="total_volume"></p>

                                            <p id="author"></p>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label for="issue_date" class="form-label">Issue Date *</label>

                                    <div class="input-group flatpickr" id="flatpickr-date">

                                        <input type="text" name="issue_date" value="{{ date('Y-m-d') }}" id="news_date" class="form-control flatpickr-input" placeholder="Select date" data-input="" required readonly>

                                        <span class="input-group-text input-group-addon" data-toggle><i data-feather="calendar"></i></span>

                                    </div>



                                    <label for="issue_date" class="form-label mt-3">Return Date *</label>

                                    <div class="input-group flatpickr" id="flatpickr-date">

                                        <input type="text" name="return_date" value="" id="news_date" class="form-control" placeholder="Select date" data-input="" required>

                                        <span class="input-group-text input-group-addon" data-toggle><i data-feather="calendar"></i></span>

                                    </div>





                                </div>

                            </div>



                            <div class="text-center mt-2">

                                <button class="btn btn-xs btn-success" type="submit">Save</button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection



@push('js')



    <script>

        $("#membership_number").on('keyup', function() {

            var membership_number = $("#membership_number").val();



            if (membership_number) {

                $.ajax({

                    url: '/admin/get-member-info',

                    type: "GET",

                    data: {

                        'membership_number': membership_number

                    },

                    success: function(response) {
                        $("#member_name").text(response.name);
                        $("#member_id").text("Membership Number: " + response.membership_number);
                        $("#member_phone").text(response.phone);

                        // $("#total_volume").text("Total Volume: " + response.total_volume);
                        if (response.member_photo) {

                            var imageUrl = '../../' + response.member_photo;

                            $('#member_photo').attr('src', imageUrl).show();

                            } else {

                            var imageUrl = '../../backend_assets/images/user-dummy.png';

                            $('#member_photo').attr('src', imageUrl).show();

                            }
                    }

                })

            } else {


                $("#member_name").text("");
                $("#member_id").text("");
                 $("#member_phone").text("");
             
                var imageUrl = '../../backend_assets/images/user-dummy.png';
                $('member_photo').attr('src', imageUrl).show();

            }



        });

    </script>



    <script>

        $(document).on('change', '#rack_id, #category_id', function() {

            find_book_list();

        });



        function find_book_list() {

            var selectedRack = $("#rack_id").find(":selected").val();

            var selectedCategory = $("#category_id").find(":selected").val();

            $('#book_id').find('option').remove().end().append("<option value=''>Select A Book</option>");





            if (selectedRack || selectedCategory) {

                $.ajax({

                    url: '/admin/get-book-list',

                    type: "GET",

                    data: {

                        'rack_id': selectedRack,

                        'category_id': selectedCategory

                    },

                    success: function(response) {

                        if (response.length > 0) {



                            $.each(response, function() {



                                $("#book_id").append($('<option>', {

                                    value: this.id,

                                    text: this.name + " (" + "Volume " + this.volume_no +

                                        ")",

                                }));

                            });

                        } else {

                            $("#book_id").append("<option value=''>No Books Available</option>");

                        }

                    }

                })

            }

        }



        $(document).on('change', '#book_id', function() {

            var selectedBook = $("#book_id").find(":selected").val();

            if (selectedBook) {

                $.ajax({

                    url: '/admin/get-book-info/' + selectedBook,

                    type: "GET",



                    success: function(response) {

                        console.log(response);

                        if (response) {



                            $("#book_name").text(response.name);

                            $("#volume_no").text("Volume: " + response.volume_no);

                            $("#total_copy").text("Total Copy: " + response.total_copy);

                            $("#total_volume").text("Total Volume: " + response.total_volume);

                            $("#author").text("Author: " + response.author);

                            if (response.photo) {

                                var imageUrl = "../../" + response.photo;
                                // var imageUrl="https://gazipurdistrictbarassociation.com/" +  response.photo;

                                $('#book_photo').attr('src', imageUrl).show();

                            } else {

                                var imageUrl = '../../backend_assets/images/user-dummy.png';

                                $('#book_photo').attr('src', imageUrl).show();

                            }

                        } else {

                            $("#book_name").text("");

                            $("#volume_no").text("");

                            $("#total_copy").text("");

                            $("#total_volume").text("");

                            var imageUrl = '../../backend_assets/images/user-dummy.png';

                            $('#book_photo').attr('src', imageUrl).show();

                        }



                    }

                })

            } else {

                $("#book_name").val('N/A');

                $("#volume_no").text('N/A');

                $("#total_copy").text('N/A');

                $("#total_volume").text('N/A');

                var imageUrl = '../../backend_assets/images/user-dummy.png';

                $('#book_photo').attr('src', imageUrl).show();

            }

        });

    </script>

@endpush

