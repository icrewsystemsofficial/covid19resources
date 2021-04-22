@extends('layouts.atlantis') @section('title','Access Control Admin')
@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

@endsection @section('content')
<div class="page-inner">
    <div class="page-header mt-2">
        <div class="page-title">Access Control Admin</div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="mt-3">
                        <button
                            id="role_add"
                            type="button"
                            data-bs-toggle="modal" data-bs-target="#exampleModal"
                            class="w-100 btn btn-dark mb-4 text-uppercase"
                        >
                            create new role
                        </button>
                        <button class="w-100 btn btn-danger text-uppercase">
                            clear role cache
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <ul
                class="nav nav-pills nav-info mb-2 justify-content-start nav-pills-no-bd nav-pills-icons no-gutters"
                id="pills-tab"
                role="tablist"
            >
                <li class="nav-item col-md-6">
                    <a
                        class="nav-link active text-center"
                        id="pills-home-tab"
                        data-toggle="pill"
                        href="#pills-home"
                        role="tab"
                        aria-controls="pills-home"
                        aria-selected="true"
                        >Roles</a
                    >
                </li>
                <li class="nav-item col">
                    <a
                        class="nav-link text-center"
                        id="pills-profile-tab"
                        data-toggle="pill"
                        href="#pills-profile"
                        role="tab"
                        aria-controls="pills-profile"
                        aria-selected="false"
                        >Permissions</a
                    >
                </li>
            </ul>
            <div class="card">
                <div class="card-body">
                    <div class="tab-content mt-2 mb-3" id="pills-tabContent">
                        <div
                            class="tab-pane fade show active"
                            id="pills-home"
                            role="tabpanel"
                            aria-labelledby="pills-home-tab"
                        >
                            <div class="card">
                                <div
                                    class="card-body shadow-none bg-info-gradient text-white rounded"
                                >
                                    <h4 class="title fw-bold">
                                        <i
                                            class="fas fa-exclamation-triangle"
                                        ></i>
                                        Pro Tip
                                    </h4>
                                    <p>
                                        Each role has a perfect blend of
                                        required permissions for the
                                        application. You can create new roles
                                        and assign permissions to them.
                                    </p>
                                </div>
                            </div>

                            <h4>There are 5 roles in the App</h4>
                            <div class="p-4">
                                @foreach ($roles as $role)
                                <div
                                    class="d-flex align-items-center justify-content-between mb-3"
                                >
                                    <h4 class="text-capitalize">
                                        {{ $role->name }}
                                    </h4>
                                    <button class="btn btn-sm btn-info">
                                        Manage
                                    </button>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div
                            class="tab-pane fade"
                            id="pills-profile"
                            role="tabpanel"
                            aria-labelledby="pills-profile-tab"
                        >
                            <p>
                                Even the all-powerful Pointing has no control
                                about the blind texts it is an almost
                                unorthographic life One day however a small line
                                of blind text by the name of Lorem Ipsum decided
                                to leave for the far World of Grammar.
                            </p>
                            <p>
                                The Big Oxmox advised her not to do so, because
                                there were thousands of bad Commas, wild
                                Question Marks and devious Semikoli, but the
                                Little Blind Text didn’t listen. She packed her
                                seven versalia, put her initial into the belt
                                and made herself on the way.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create new role</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('accesscontrol.store') }}" method="POST">
            @csrf   
              <small class="form-text text-muted">You will be creating a new role in the system. After creating, you can assign permissions to that role.</small>
            <div class="form-group">
                <label for="role">Role Name</label>
                <input type="text" class="form-control" name="role" id="role" placeholder="Visitor">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Create Role</button>
        </div>
    </form>
      </div>
    </div>
  </div>
@endsection
