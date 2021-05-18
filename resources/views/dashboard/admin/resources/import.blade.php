@extends('layouts.atlantis')
@section('title', 'Resources Admin')
@section('js')
    <script>
        $(document).ready( function () {
            $('#resource_table').DataTable();
        });
    </script>
@endsection
@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div class="col-md-12 text-center">
                <h1 class="text-white pb-2 h1 fw-bold">
				Import Resources
                </h1>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    <i class="fas fa-check-circle">Download the sample file and use the exact format.</i><br>
                    <i class="fas fa-times-circle">Dont't change the format</i><br>
                    <br><strong>Import File</strong>
                    <hr><br><form action="{{ route('admin.resources.import.file') }}" method="post" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <input type="file" class="fas fa-upload" name="select_file" accept="file/.xlsx" required />

                <input type="submit" name="upload" class="btn btn-primary btn-sm mb-2" value="Import Resource data">

            </form>
            <br>
            <strong>Download</strong><br>
            <a href="{{ route('admin.resources.exportsample') }}" class="btn btn-primary btn-sm mb-2"><i class="fas fa-download"></i> Download sample Xls</a>
<br>
                    </div>
                    <br>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
