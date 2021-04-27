@extends('errors::illustrated-layout')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', 'The application is facing unusual amount of traffic, please wait and refresh in a minute or so. We appreciate your patience.')
