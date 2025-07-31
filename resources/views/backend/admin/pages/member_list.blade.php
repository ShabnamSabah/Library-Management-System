@extends('backend.admin.includes.admin_layout')

@section('content')

    <div class="page-content">



        <div class="row justify-content-center">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-body">

                        <div class=" mb-2" style="text-align:center">

                            <h3>Memeber List</h3>

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

                                        <th style="">Phone</th>

                                        <th style="">Email </th>


                                        <th style="width:15%">action</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach ($data['member_list'] as $key => $single_member)

                                        <tr>

                                            <td>{{ $key+1 }}</td>

                                            <td>

                                                <img src="{{ asset($single_member->member_photo) }}"

                                                    alt="{{ $single_member->id }}.jpg" loading="lazy" style="width:auto; height: 45px;" >

                                            </td>

                                            <td>

                                                {{ $single_member->name }} <br>

                                                 {{ 'M. Id: '. $single_member->membership_number }} 

                                            </td>

                                            <td>

                                                {{ $single_member->phone}}

                                            </td>

                                            <td>

                                                {{ $single_member->email }}

                                            </td>

                                    
                                            <td>

                                                <a href="{{ route('admin.member.edit', $single_member->id) }}"

                                                    class="btn btn-success btn-icon" href=""><i

                                                        class="fa-solid fa-edit"></i></a>





                                                <a class="btn btn-danger btn-icon" data-delete="{{ $single_member->id }}"

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

                    url: '/admin/member/delete/' + id,

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

