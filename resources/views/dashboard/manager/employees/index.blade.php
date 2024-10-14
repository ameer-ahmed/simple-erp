@extends('dashboard.core.app')
@section('title', __('dashboard.Employees'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>@lang('dashboard.Employees')</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <livewire:manager.employee.index />
        <!-- /.container-fluid -->
    </section>

    <!-- /.content -->
@endsection
