@extends('layouts.atlantis')
@section('title', 'Manage Mission')
@section('js')
<script src="https://demo.themekita.com/atlantis/livepreview/examples/assets/js/plugin/select2/select2.full.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        $('.select2').select2();
        CKEDITOR.replace('description');
    </script>
@endsection

@section('content')
<div class="page-inner">
    <div class="page-header mt-2">
        <h4 class="page-title">
            Manage an existing mission
        </h4>
    </div>
    <p class="mb-4">
         You can change the volunteer / status and the number of resources assigned to a particular mission.
    </p>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="">
                            Change mission details
                        </h4>
                    </div>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.mission.update', $mission->id) }}" method="POST">
                        @csrf
                        
                        <?php
                        	$users = App\Models\User::all();
                        ?>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="volunteer_id"> Select Volunteer</label>
                                    <select name="volunteer_id" id="" class="form-control select2">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ ($user->id == $mission->volunteer_id)?'selected':'' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status">
                                        Change Mission Status
                                    </label>
                                    <select name="status" id="change_mission_status" class="form-control select2">
                                    	<option value="0">Assigned</option>
                                    	<option value="1">In Progress</option>
                                    	<option value="3">Delayed</option>
                                    	<option value="3">Completed</option>
                                	</select>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title">
                                Mission Description
                            </label>

                            <textarea name="description" id="description">{{$mission->description}}</textarea>
                        </div>

                        <div class="form-group">

                            <div class="mt-2 mb-2">
                                Once the mission is created, the user will automatically be notified.
                            </div>

                            <button class="btn btn-success" type="submit">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
