@extends('backend.admin.includes.admin_layout')
@push('css')
<style>
    .progress-wrapper {
        width: 100%;
        margin: 10px 0;
        padding: 5px;
        border: 1px solid #ddd;
        position: relative;
    }
    .progress-bar {
        width: 0%;
        height: 20px;
        background: #4caf50;
        text-align: center;
        color: white;
        line-height: 20px;
    }
    .upload-done {
        background: #2196F3 !important;
    }
</style>
@endpush
@section('content')
    <div class="page-content">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class=" text-center mb-2">Book Cover Photo Upload</h3>
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
                        <form  id="uploadForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-3 mb-3">
                                    <div class="mb-3">
                                        <label class="form-label">Upload Photo (only .jpg image)</label>
                                        <input type="file" class="form-control" name="files[]" id="files" multiple accept=".jpg">
                                    </div>

                                </div>
                            </div>
                            <div class="text-center mt-2">
                                <button class="btn btn-xs btn-success" type="submit">Upload</button>
                            </div>
                        </form>
                        <div id="progress-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

<script>
    $(document).ready(function () {
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $('#uploadForm').on('submit', function (e) {
            e.preventDefault();
            let files = $('#files')[0].files;
            if (files.length === 0) return alert('Please select files.');

            $('#progress-container').html('');

            let formData = new FormData();
            for (let i = 0; i < files.length; i++) {
                formData.append('files[]', files[i]);

                let fileName = files[i].name;
                let fileId = 'file_' + i;

                let progressWrapper = $('<div class="progress-wrapper">').attr('id', fileId);
                progressWrapper.append(`<p>${fileName}</p>`);
                let progressBar = $('<div class="progress-bar">').text('0%');
                progressWrapper.append(progressBar);
                $('#progress-container').append(progressWrapper);
            }

            $.ajax({
                url: "{{ route('admin.photo.upload') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                xhr: function () {
                    let xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function (e) {
                        if (e.lengthComputable) {
                            let percent = Math.round((e.loaded / e.total) * 100);
                            $('.progress-bar').css('width', percent + '%').text(percent + '%');
                        }
                    }, false);
                    return xhr;
                },
                success: function (response) {
                    if (response.success) {
                        response.files.forEach((file, index) => {
                            let fileId = '#file_' + index;
                            $(fileId).find('.progress-bar')
                                .css('width', '100%')
                                .text('Upload Done')
                                .addClass('upload-done');
                            $(fileId).append(`<img src="${file.path}" style="margin:5px;height: 75px;width: auto;">`);
                        });
                    }
                },
                error: function (xhr, status, error) {
                    alert('Upload failed: ' + error); 
                }
            });
        });
    });
</script>
@endpush
