@extends('layouts.atlantis')
@section('title', 'Setting Admin')
@section('js')
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                $.notify({
                    icon: 'flaticon-error',
                    title: "{{ config('app.name') }}",
                    message: "{{ $error }}",
                    },{
                    type: 'danger',
                    placement: {
                        from: "top",
                        align: "right"
                    },
                    time: 1000,
                });
            @endforeach
        @endif

        $('#deleteSetting').click(function(e) {
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        buttons:{
            cancel: {
                visible: true,
                text : 'No, cancel!',
                className: 'btn btn-danger'
            },
            confirm: {
                text : 'Yes, delete it!',
                className : 'btn btn-success'
            }
        }
    }).then((willDelete) => {
        if (willDelete) {
            swal("Alright!, Setting deleted Successfully", {
                icon: "success",
                buttons : {
                    confirm : {
                        className: 'btn btn-success'
                    }
                }
            });
            window.location="{{ route('admin.setting.delete',$setting->id) }}";
        } else {
            swal.close()
        }
    });
})
    </script>
@endsection
@section('content')
<div class="page-inner">
    <div class="page-header mt-4">
        <a href="{{ route('admin.setting.index') }}" class="btn btn-warning btn-sm mr-3">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h4 class="page-title">Setting Admin</h4>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Update Setting </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.setting.update',$setting->id) }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="title"><strong>Setting Name</strong></label>
                            <input type="text" name="name" disabled class="form-control" value="{{ $setting->name }}" required placeholder="Enter Setting Name" />
                            <input type="hidden" name="name" id="" value="{{ $setting->name }}" />
                        </div>
                        <div class="form-group">
                            <label for="email"><strong>Setting Value</strong></label>
                            <input type="text" name="value"  value="{{ $setting->value }}" class="form-control" required placeholder="Enter Setting value" />
                        </div>
                        <div class="form-group">
                            <label for="comment">Description</label>
                            <textarea class="form-control"  name="description" placeholder="Setting Description" id="comment" rows="5">{{ $setting->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Core Setting</label>
                                    @php
                                    if($setting->core == 1) {
                                        $color = 'success';
                                    } else if($setting->core == 0) {
                                        $color = 'warning';
                                    }
                                @endphp
                                    <div class="selectgroup selectgroup-{{ $color }} w-100 " id="selectGroup">
                                        <label class="selectgroup-item">
                                            <input type="radio"  onclick="changeSelectorColor('success');" name="core" value="1" {{ ($setting->core == "1")? "checked" : "" }} class="selectgroup-input">
                                            <span class="selectgroup-button mr-1">Yes <i class="fa fa-check-circle "></i></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" onclick="changeSelectorColor('warning');" name="core" value="0" {{ ($setting->core == "0")? "checked" : "" }} class="selectgroup-input  ">
                                            <span class="selectgroup-button mr-1">No<i class="fa fa-exclamation-triangle "></i></span>
                                        </label>

                                        <script>
                                            function changeSelectorColor(color) {
                                                var selectGroup = document.getElementById('selectGroup');
                                                selectGroup.className = "selectgroup selectgroup-" + color + " w-100";
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button class="btn btn-info btn-md" type="submit">
                                Update
                            </button>
                           @if ($setting->core == 1)

                           @else
                           <button class="btn btn-danger btn-md" type="button" id="deleteSetting" type="submit">
                               Delete
                           </button>
                           @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
