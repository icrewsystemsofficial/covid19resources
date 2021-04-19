@extends('layouts.atlantis')
@section('title', 'FAQ Admin')
@section('js')
    <script>
        $(document).ready( function () {
            $('#faq_table').DataTable();
        });
    </script>
@endsection
@section('content')
<div class="page-inner">
    <div class="page-header mt-2">
        <h4 class="page-title">FAQ Admin</h4>
    </div>
    <div class="row">
        <div class="col-md-12">

            <a href="{{ route('admin.faq.save') }}" class="btn btn-md btn-primary">
                Create new FAQ <i class="fas fa-plus"></i>
            </a>

            <br><br>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Manage FAQ Content</h4>
                </div>
                <div class="card-body">
                    <table id="faq_table" class="table table-hover">
                        <thead>
                            <th>Title</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Author</th>
                            <th>Options</th>
                        </thead>
                        <tbody>
                            @forelse ($faqs as $faq)
                                <tr>
                                    <td>{{ $faq->title }}</td>
                                    <td>{{ $faq->district.', '.$faq->state }}</td>
                                    <td>
                                        @if ($faq->status == 1)
                                            <span class="badge badge-success">
                                                Published
                                            </span>
                                        @else
                                            <span class="badge badge-dark">
                                                Draft
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $faq->author->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.faq.manage', $faq->id) }}" class="btn btn-sm btn-primary">
                                            Manage
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    Whoops! No FAQs added
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
