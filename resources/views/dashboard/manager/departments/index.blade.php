@extends('dashboard.core.app')
@section('title', __('dashboard.Department'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>@lang('dashboard.Department')</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <livewire:manager.department.index />
        <!-- /.container-fluid -->
    </section>

    <!-- /.content -->
@endsection
