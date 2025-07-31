@extends('backend.admin.includes.admin_layout')
@push('css')
@endpush
@section('content')
    <div class="page-content">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class=" text-center mb-2">Book Edit</h3>
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
                        <form action="{{ route('admin.book.edit',$data['book']->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="issue_date" class="form-label">Issue Date *</label>
                                    <div class="input-group flatpickr" id="flatpickr-date">
                                        <input type="text" name="issue_date" value="{{ $data['book']->issue_date }}" id="news_date"
                                            class="form-control" placeholder="Select date" data-input>
                                        <span class="input-group-text input-group-addon" data-toggle><i
                                                data-feather="calendar"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="" class="form-label">Category *</label>
                                    <select name="category_id" class="form-select js-example-basic-single"
                                        id="" required>
                                        <option value="">Select</option>
                                        @foreach ($data['book_category'] as $single_category)
                                            <option value="{{ $single_category->id }}" @if($data['book']->category_id == $single_category->id) selected @endif>{{ $single_category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="" class="form-label">Rack *</label>
                                    <select name="rack_id" class="form-select js-example-basic-single"
                                        id="" required>
                                        <option value="">Select</option>
                                        @foreach ($data['racks'] as $single_rack)
                                            <option value="{{ $single_rack->id }}"@if($data['book']->rack_id == $single_rack->id) selected @endif>{{ $single_rack->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="" class="form-label">Donor </label>
                                    <select name="donor_id" class="form-select js-example-basic-single"
                                        id="" >
                                        <option value="">Select</option>
                                        @foreach ($data['donors'] as $single_donor)
                                            <option value="{{ $single_donor->id }}"@if($data['book']->donor_id == $single_donor->id) selected @endif>{{ $single_donor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="" class="form-label"> Name *</label>
                                    <input type="text" class="form-control" name="name" value="{{ $data['book']->name }}"
                                        placeholder="Enter Book Name" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="">Author*</label>
                                    <input type="text" name="author" class="form-control" value="{{ $data['book']->author }}"
                                        placeholder="Enter Author" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="">Volume No</label>
                                    <input type="text" name="volume_no" class="form-control" value="{{ $data['book']->volume_no }}"
                                        placeholder="Enter Volume" >
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="">Total Volume</label>
                                    <input type="text" name="total_volume" class="form-control" value="{{ $data['book']->total_volume }}"
                                        placeholder="Enter Total Volume" >
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="">Total Copy </label>
                                    <input type="number" name="total_copy" class="form-control" value="{{ $data['book']->total_copy}}"
                                        placeholder="Enter Total Copy">
                                </div>


                                <div class="col-md-3 mb-3">
                                    <div class="mb-3">
                                        <label class="form-label">Upload Photo</label>
                                        <input name="photo" class="form-control" type="file" id="imgPreview"
                                            onchange="readpicture(this, '#imgPreviewId');">
                                    </div>
                                    <div class="text-center">
                                        <img id="imgPreviewId" onclick="image_upload()"
                                            src="{{ asset($data['book']->photo ? $data['book']->photo : 'backend_assets/images/uploads_preview.png') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-2">
                                <button class="btn btn-xs btn-success" type="submit">Update</button>
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
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#news_date", {
            defaultDate: new Date(), // Sets the default date to the current date
            dateFormat: "Y-m-d", // Adjust the date format if needed
        });
    });
</script>
    <script>
        function image_upload() {

            $('#imgPreview').trigger('click');
        }

        function readpicture(input, preview_id) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(preview_id)
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }

        }
    </script>
@endpush
