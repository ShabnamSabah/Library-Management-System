@extends('backend.admin.includes.admin_layout')
@push('css')
@endpush
@section('content')
<div class="page-content">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3 class=" text-center mb-2">Book Bulk Add</h3>
                    @if (session('success'))
                    <div style="width:100%" class="alert alert-primary alert-dismissible fade show" role="alert">
                        <strong> Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                    </div>
                    @elseif(session('error'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Failed!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                    </div>
                    @endif
                    <form action="{{ route('admin.book.bulk.add') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <label for="issue_date" class="form-label">Issue Date *</label>
                                <div class="input-group flatpickr" id="flatpickr-date">
                                    <input type="text" name="issue_date" value="{{ date('Y-m-d') }}" id="news_date" class="form-control"
                                        placeholder="Select date" data-input>
                                    <span class="input-group-text input-group-addon" data-toggle><i
                                            data-feather="calendar"></i></span>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="" class="form-label">Category *</label>
                                <select name="category_id" class="form-select js-example-basic-single" id="" required>
                                    <option value="">Select</option>
                                    @foreach ($data['book_category'] as $single_category)
                                    <option value="{{ $single_category->id }}">{{ $single_category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="" class="form-label">Rack *</label>
                                <select name="rack_id" class="form-select js-example-basic-single"
                                    id="" required>
                                    <option value="">Select</option>
                                    @foreach ($data['racks'] as $single_rack)
                                        <option value="{{ $single_rack->id }}">{{ $single_rack->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="" class="form-label">Donor </label>
                                <select name="donor_id" class="form-select js-example-basic-single" id="">
                                    <option value="">Select</option>
                                    @foreach ($data['donors'] as $single_donor)
                                    <option value="{{ $single_donor->id }}">{{ $single_donor->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div id="bookContainer">
                                <?php for ($y = 1; $y <= 1; $y++) { ?>
                                    <div class="row justify-content-center">
                                        <div class="col-md-2 mb-3">
                                            <label for="" class="form-label"> Name *</label>
                                            <input type="text" class="form-control" name="name[]"
                                                placeholder="Enter Book Name" required>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label for="" class="form-label"> Author </label>
                                            <input type="text" name="author[]" class="form-control"
                                                placeholder="Enter Author" >
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label class="form-label" for="">Volume No</label>
                                            <input type="text" name="volume_no[]" class="form-control"
                                                placeholder="Enter Volume" >
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label class="form-label" for="">Total Volume</label>
                                            <input type="text" name="total_volume[]" class="form-control"
                                                placeholder="Enter Total Volume" >
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label class="form-label" for="">Total Copy</label>
                                            <input type="number" name="total_copy[]" class="form-control"
                                                placeholder="Enter Total Copy">
                                        </div>
                                        <div class="col-md-2 mb-3 d-flex align-items-end">

                                            <div class="btn btn-danger remove-row" hidden> x </div>

                                        </div>

                                    </div>
                                    <?php } ?>
                                <?php for ($y = 2; $y <= 5; $y++) { ?>
                                <div class="row justify-content-center">
                                    <div class="col-md-2 mb-3">

                                        <input type="text" class="form-control" name="name[]"
                                            placeholder="Enter Book Name" required>
                                    </div>
                                    <div class="col-md-2 mb-3">

                                        <input type="text" name="author[]" class="form-control"
                                            placeholder="Enter Author" >
                                    </div>
                                    <div class="col-md-2 mb-3">

                                        <input type="text" name="volume_no[]" class="form-control"
                                            placeholder="Enter Volume" >
                                    </div>

                                    <div class="col-md-2 mb-3">

                                        <input type="text" name="total_volume[]" class="form-control"
                                            placeholder="Enter Total Volume" >
                                    </div>
                                    <div class="col-md-2 mb-3">
                                         <input type="number" name="total_copy[]" class="form-control"
                                            placeholder="Enter Total Copy" >
                                    </div>
                                    <div class="col-md-2 mb-3 d-flex align-items-end">

                                        <div class="btn btn-danger remove-row"> x </div>

                                    </div>
                                </div>
                                <?php } ?>
                            </div>

                        </div>
                        <div class="text-center mt-2">
                            <button class="btn btn-xs btn-primary" onclick="add_new_row()"><i class="fa fa-plus"></i>
                                Add</button>
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
    function add_new_row() {

            let newRow = `

            <div class="row justify-content-center">
                <div class="col-md-2 mb-3">

                    <input type="text" class="form-control" name="name[]"
                        placeholder="Enter Book Name" required>
                </div>
                <div class="col-md-2 mb-3">

                    <input type="text" name="author[]" class="form-control"
                        placeholder="Enter Author">
                </div>
                 <div class="col-md-2 mb-3">

                    <input type="text" name="volume_no[]" class="form-control"
                        placeholder="Enter Volume" >
                </div>

                <div class="col-md-2 mb-3">

                    <input type="text" name="total_volume[]" class="form-control"
                        placeholder="Enter Total Volume" >
                </div>
                <div class="col-md-2 mb-3">

                    <input type="number" name="total_copy[]" class="form-control"
                        placeholder="Enter Total Copy">
                </div>
                <div class="col-md-2 mb-3 d-flex align-items-end"">
                    <div class="btn btn-danger remove-row"> x </div>
               </div>
        </div>
      `;
      $("#bookContainer").append(newRow);
     }

     $(document).ready(function () {
        $(document).on("click", ".remove-row", function () {
            $(this).closest(".row").remove();
        });
    });
</script>
@endpush