@extends('layouts.atlantis') 
@section('title','Access Control Admin')
@section('js')
    <script>
        $('#deleteRole').click(function(e) {
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
            swal("Alright!, Role deleted Successfully", {
                icon: "success",
                buttons : {
                    confirm : {
                        className: 'btn btn-success'
                    }
                }
            });
            window.location="{{ route('accesscontrol.delete', $role->id) }}";
        } else {
            swal.close()
        }
    });
})
    </script>
@endsection
@section('content')
<style>
.switch input { 
    display:none;
}
.switch {
    display:inline-block;
    width:60px;
    height:30px;
    margin:8px;
    transform:translateY(50%);
    position:relative;
    cursor: pointer;
}
/* Style Wired */
.slider {
    position:absolute;
    top:0;
    bottom:0;
    left:0;
    right:0;
    border-radius: 30px;
    box-shadow:0 0 0 2px #777, 0 0 4px #777;
    cursor:pointer;
    border:4px solid transparent;
    overflow:hidden;
     transition:.4s;
}
.slider:before {
    position:absolute;
    content:"";
    width:100%;
    height:100%;
    background:#777;
    border-radius:30px;
    transform:translateX(-30px);
    transition:.4s;
}

input:checked ~ .slider:before {
    transform:translateX(30px);
    background:limeGreen;
}
input:checked ~ .slider {
    box-shadow:0 0 0 2px limeGreen,0 0 2px limeGreen;
}
</style>
<div class="page-inner">
    <div class="page-header mt-2">
        <a href="{{ route('accesscontrol.index') }}" class="btn btn-warning btn-sm mr-3">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div class="page-title">Access Control Admin</div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div
                    class="card-body shadow-none bg-danger-gradient text-white rounded"
                >
                    <h4 class="title fw-bold">
                        <i class="fas fa-exclamation-triangle"></i>
                        Warning!
                    </h4>
                    <p class="mb-0">
                        Managing a system role. Excercise caution, this might have direct effects within the application.
                    </p>
                </div>
            </div>
            <div class="card">
                <div class="card-header h2">
                    Managing {{ $role->name }} role
                </div>
                <div class="card-body">
                    <form action="{{ route('accesscontrol.update',$role->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="role">Role name</label>
                            <input type="text" class="form-control" id="role" name="role" value="{{ $role->name }}">
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <h4>Access Permissions</h4>
                                <p>These are the permissions associated with this role.</p>
                            </div>
                            
                            <div class="col-md-8">
                                <div class="">
                                    <span>
                                        @forelse ($permissions as $perm)
                                        <?php
                                          if($role->hasPermissionTo($perm->name) == 1) {
                                            $checked = 'checked';
                                          } else {
                                            $checked = '';
                                          }
                                        ?>  
                      
                                        <!-- This is an example component -->
                                      <div class="d-flex align-items-baseline ">
                                        <label class="switch mx-2" checked>
                                            <input type="checkbox" name="{{ $perm->name }}" type="checkbox" class="hidden" {{ $checked }}>
                                            <span class="slider"></span>
                                        </label>
                                        <div class="mt-2">
                                           <h4 class="text-capitalize">{{ $perm->name }}</h4>
                                           <p>
                                            {{-- {{ Settings::getPermissionDescription($perm->name) }} --}}
                                           </p>
                                        </div>
                                    </div>
                      
                                      @empty
                                        <p>
                                          No permissions found for this role
                                        </p>
                                      @endforelse
                                    </span>
                                </div>
                            </div>

                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Update Role</button>
                    <button type="button" id="deleteRole" class="btn btn-danger">Delete Role</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
