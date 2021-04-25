@extends('layouts.atlantis')
@section('title', 'User Admin')
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
                    <h4 class="card-title">Create New Setting </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.setting.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="title"><strong>Setting Name</strong></label>
                            <input type="text" name="name" class="form-control" required placeholder="Enter Setting Name" />
                        </div>
                        <div class="form-group">
                            <label for="email"><strong>Setting Value</strong></label>
                            <input type="text" name="value" class="form-control" required placeholder="Enter Setting value" />
                        </div>
                        <div class="form-group">
                            <label for="comment">Description</label>
                            <textarea class="form-control" name="description" placeholder="Setting Description" id="comment" rows="5"></textarea>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">Core Setting</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="core" value="1" class="selectgroup-input">
                                            <span class="selectgroup-button">Yes</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="core" value="0" class="selectgroup-input">
                                            <span class="selectgroup-button">No</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button class="btn btn-info btn-md" type="submit">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
