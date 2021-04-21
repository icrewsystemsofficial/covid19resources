@extends('layouts.atlantis')
@section('title', 'Categories Admin')
@section('js')
    <script>
        $(document).ready( function () {
            $('#Categories_table').DataTable();
        });
    </script>
@endsection
