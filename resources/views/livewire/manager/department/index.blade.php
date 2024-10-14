<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('dashboard.Tasks')</h3>
                    <div class="card-tools">
                        <a href="{{route('manager.departments.create')}}"
                           class="btn btn-dark">@lang('dashboard.Create')</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-6">
                            <input wire:model.live="keyword" type="search" class="form-control"
                                   placeholder="Search with name">
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>@lang('dashboard.Name')</th>
                            <th>@lang('dashboard.Employees Count')</th>
                            <th>@lang('dashboard.Total Employees Salaries')</th>
                            <th>@lang('dashboard.Operations')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($departments as $department)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $department->name }}</td>
                                <td>{{ $department->employees_count }}</td>
                                <td>{{ $department->employees_sum_salary }}</td>
                                <td>
                                    <div class="operations-btns" style="">
                                        <a href="{{ route('manager.departments.edit', [$department->id]) }}"
                                           class="btn  btn-dark">@lang('dashboard.Edit')</a>
                                        @if($department->is_deletable)
                                            <button class="btn btn-danger waves-effect waves-light"
                                                    data-toggle="modal"
                                                    data-target="#delete-modal{{ $loop->iteration }}">@lang('dashboard.delete')</button>
                                            <div id="delete-modal{{ $loop->iteration }}"
                                                 class="modal fade modal2 " tabindex="-1" role="dialog"
                                                 aria-labelledby="myModalLabel" aria-hidden="true"
                                                 style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content float-left">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">@lang('dashboard.confirm_delete')</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>@lang('dashboard.sure_delete')</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" data-dismiss="modal"
                                                                    class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                @lang('dashboard.close')
                                                            </button>
                                                            <button type="submit" wire:click="destroy({{$department->id}})"
                                                                    class="btn btn-danger">@lang('dashboard.Delete')</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            @include('dashboard.core.includes.no-entries', ['columns' => 5])
                        @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $departments->links() }}
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
