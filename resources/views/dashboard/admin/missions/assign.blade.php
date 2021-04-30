@extends('layouts.atlantis')
@section('title', 'Assign New Mission')
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
            Creating a new mission
        </h4>
    </div>
    <p class="mb-4">
         You can ONLY create missions to volunteers who have marked themselves as available for missions.
    </p>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="">
                            Enter mission details
                        </h4>
                    </div>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.mission.create') }}" method="POST">
                        @csrf


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="volunteer_id">Volunteers (available for missions)</label>
                                    <select name="volunteer_id" id="" class="form-control select2">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">
                                        Type
                                    </label>
                                    <select name="type" id="" class="form-control">
                                        <option value="0">
                                            Tweet Verification
                                        </option>
                                        <option value="1">
                                            Resource Verification
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="to_verify">
                                        Number of resources to be assigned
                                    </label>
                                    <input type="text" name="total" class="form-control" value="{{ config('app.max_tweets_to_assign_in_a_mission') }}" placeholder="Number of resources to be assigned to this user for this mission">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title">
                                Mission Description
                            </label>

                            <textarea name="description" id="description">Your mission objective is to call the phone numbers in the Tweets and verify if the information they have provided accurate & mark them as verified</textarea>
                        </div>

                        <div class="form-group">

                            <div class="mt-2 mb-2">
                                Once the mission is created, the user will automatically be notified.
                            </div>

                            <button class="btn btn-success" type="submit">
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
