@extends('admin.layouts.master')
@section('title', 'Dashboard')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="{{ route("admin.dashboard.index") }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-sync fa-sm text-white-50 "></i> Refresh</a>
        </div>

        <!-- Content Row -->
        <div class="row">

        </div>

    </div>
@endsection
