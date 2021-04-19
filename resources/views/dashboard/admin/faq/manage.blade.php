@extends('layouts.atlantis')
@section('title', 'FAQ Admin')
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
<div class="page-inner">
    <div class="page-header mt-4">
        <a href="{{ route('admin.faq.index') }}" class="btn btn-warning btn-sm mr-3">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h4 class="page-title">Manage FAQ # {{ $faq->id }}</h4>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Manage FAQ Content</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.faq.update', $faq->id) }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="title"><strong>Title</strong></label>
                            <input type="text" name="title" class="form-control" required value="{{ $faq->title }}" />
                        </div>

                        <div class="form-group">
                            <label for="description"><strong>Body</strong></label>
                            <textarea class="form-control" name="description" id="desc" cols="30" rows="10">{{ $faq->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <div class="row">

                                <div class="col-md-6">
                                    <label for="categories" class="placeholder"><b>Category</b></label>
                                    <select class="form-control select2" name="categories[]" multiple="multiple">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                <?php
                                                    if(in_array($category->id, json_decode($faq->categories))) {
                                                        echo "selected";
                                                    }
                                                ?>
                                            >
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- <div class="col-md-4">
                                    <label for="state" class="placeholder"><b>State</b></label>
                                    <select name="state" class="form-control">
                                        @foreach ($states as $state)
                                            <?php if($faq->state == $state->name) {
                                                    $selected = 'selected';
                                                } else {
                                                    $selected = '';
                                                }
                                            ?>
                                            <option value="{{ $state->name }}" {{ $selected }}>
                                                {{ $state->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div> --}}

                                <div class="col-md-6">
                                    <label for="district" class="placeholder"><b>District</b></label>
                                    <select name="district" id="district" class="form-control">
                                        @foreach ($districts as $district)
                                            <?php if($faq->district == $district->name) {
                                                    $selected = 'selected';
                                                } else {
                                                    $selected = '';
                                                }
                                            ?>
                                            <option value="{{ $district->name }}" {{ $selected }}>
                                                {{ $district->name }}, {{ $district->state }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Status</label>
                                        <div class="selectgroup w-100">
                                            <label class="selectgroup-item">
                                                <input type="radio" name="status" value="1" class="selectgroup-input" <?php if($faq->status == 1) { echo "checked"; } ?>>
                                                <span class="selectgroup-button">Publish</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="status" value="0" class="selectgroup-input" <?php if($faq->status == 0) { echo "checked"; } ?>>
                                                <span class="selectgroup-button">Draft</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button class="btn btn-info btn-md" type="submit">
                                Update
                            </button>
                            <a href="{{ route('admin.faq.delete', $faq->id) }}" onclick="return confirm('Are you sure you wish to delete this FAQ? This action cannot be undone');" class="btn btn-danger btn-md">Delete</a>
                            <!-- Button to Open the Modal -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
