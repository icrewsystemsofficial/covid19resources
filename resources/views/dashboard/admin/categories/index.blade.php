@extends('layouts.atlantis')
@section('title', 'Categories Admin')
@section('js')
    <script>
        $(document).ready( function () {
            $('#Categories_table').DataTable();
        });
    </script>
@endsection
@section('content')
<div class="page-inner">
    <div class="page-header mt-2">
        <h4 class="page-title">Categories Admin</h4>
    </div>
    <div class="row">
        <div class="col-md-12">

            <a href="{{ route('admin.categories.create') }}" class="btn btn-md btn-primary">
                Create new Categories <i class="fas fa-plus"></i>
            </a>

            <br><br>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Manage Categories <span class="badge badge-primary">{{ count($categories) }}</span></h4>
                </div>
                <div class="card-body">
                    <table id="" class="table table-hover">
                        <thead>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Options</th>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td class="text-center">
                                        @if ($category->status == 1)
                                            <span class="badge badge-success">
                                                Active
                                            </span>
                                        @else
                                            <span class="badge badge-warning">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.categories.manage', $category->id) }}" class="btn btn-sm btn-primary">
                                            Manage
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    Whoops! No Categoriess added
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
