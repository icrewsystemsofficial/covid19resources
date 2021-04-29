@extends('layouts.atlantis')
@section('title', 'OCR Dashboard')
@section('js')
    <script src="http://demo.themekita.com/atlantis/livepreview/examples/assets/js/plugin/select2/select2.full.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

        CKEDITOR.replace('desc');
    </script>
@endsection
@section('content')
<div class="panel-header bg-dark">
    <div class="page-inner py-5">
        <div class="d-flex align-`items-left align-items-md-center flex-column flex-md-row">
            <div class="col-md-8 col-md-6">
                <h2 class="text-white h2 pb-2 fw-bold">
                    OCR Reader
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">OCR</h4>
                </div>
                <div class="card-body">
                    {{-- <form action="{{ route('ocr.parse.text') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Choose File</label>
                            <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">
                            Upload File
                        </button>
                    </form> --}}
                    <form class="row row-cols-lg-auto g-3 align-items-center" action="{{ route('ocr.parse.text') }}" method="POST" enctype="multipart/form-data">
                       @csrf
                        <div class="col-3">
                            <label for="exampleFormControlFile1">Choose File</label>
                            <input type="file" class="form-control-file mt-1" name="image" id="exampleFormControlFile1">
                            <small>(Max file size is 5mb allowed)</small>
                        </div>
                        <div class="col-5">
                          <button type="submit" class="btn btn-primary btn-sm">Upload File</button>
                        </div>
                      </form>
                      <br>
                      <hr>  
                    <div class="form-group mt-2">
                        <label for="description"><strong>Body</strong></label>
                        <textarea class="form-control" name="description" id="desc" cols="30" rows="10">
                            @if (Cookie::get('parsedText'))
                              {{ Cookie::get('parsedText') }}
                             @else
                             Upload an image and get the results
                             @endif
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



