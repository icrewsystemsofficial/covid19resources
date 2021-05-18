@extends('layouts.atlantis')
@section('title', 'Resources Admin')
@section('js')
    <script>
        $(document).ready(function () {
            $('#resource_table').DataTable();
        });
    </script>
@endsection
@section('content')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div class="col-md-12">
                    <h2 class="text-white h2 pb-1 fw-bold">
                        Import Resources
                    </h2>
                    <h4 class="text-white pb-2">
                        The import tool is a convenient way to add multiple resources at the same time.
                    </h4>
                </div>
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <p class="p2">
                        <ol>
                            <li>
                                <i class="fa fa-check-circle text-success"></i> Download the sample file or export
                                the existing products and use it as a template.
                            </li>

                            <li>
                                <i class="fa fa-check-circle text-success"></i> Use the exact format the template
                                comes with. The first row <strong>has</strong> to be
                                the name of the column. The application will count from the second row.
                            </li>

                            <li>
                                <i class="fa fa-check-circle text-success"></i> After importing products, you can
                                add / remove images from the CDN module.
                            </li>

                            <li>
                                <i class="fa fa-times-circle text-danger"></i> Don't change the format, or add new
                                categories & brands that don't exist on the database.
                            </li>
                        </ol>
                        </p>

                        <form id="my_form" action="{{ route('admin.resources.import.file') }}" enctype="multipart/form-data"
                              method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="">Import File</label>
                                <input class="form-control" type="file" name="select_file" id="import_file"
                                       placeholder="Import file" >
                            </div>

                            <div class="form-group">
                                <button  class="btn btn-success btn-md" id="mybtn" onclick="processImport()">Process Import <i
                                            class="fa fa-sync ml-1" id="sync"></i></button>
                            </div>
                        </form>
                        <script>
                            function processImport() {
                                if( document.getElementById("import_file").files.length == 0 ){
                                    console.log("no files selected");
                                    $.notify({
                                        icon: 'flaticon-error',
                                        title: "Import Error",
                                        message: "Please Choose a file",
                                    },{
                                        type: 'danger',
                                        placement: {
                                            from: "top",
                                            align: "right"
                                        },
                                        time: 1000,
                                    });

                                } else {
                                    let button = document.getElementById('mybtn');
                                    let icon = document.getElementById('sync');
                                    icon.classList.toggle('fa-spin');
                                }


                            }
                        </script>
                        <hr>
                        <strong>Download</strong><br>
                        <a href="{{ route('admin.resources.exportsample') }}" class="btn btn-info btn-sm mb-2"> Download sample Xls</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
