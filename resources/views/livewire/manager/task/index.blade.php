<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('dashboard.Tasks')</h3>
                    <div class="card-tools">
                        <a href="{{route('manager.employees.create')}}"
                           class="btn btn-dark">@lang('dashboard.Create')</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-6">
                            <input wire:model.live="keyword" type="search" class="form-control"
                                   placeholder="Search with title, status and employees' names">
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>@lang('dashboard.Title')</th>
                            <th>@lang('dashboard.Status')</th>
                            <th>@lang('dashboard.Employee')</th>
                            <th>@lang('dashboard.Operations')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($tasks as $task)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->status }}</td>
                                <td>{{ $task->employee->name }}</td>
                                <td>
                                    <div class="operations-btns" style="">
                                        <a href="{{ route('manager.tasks.edit', [$task->id]) }}"
                                           class="btn  btn-dark">@lang('dashboard.Edit')</a>
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
                                                        <button type="submit" wire:click="destroy({{$task->id}})"
                                                                class="btn btn-danger">@lang('dashboard.Delete')</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            @include('dashboard.core.includes.no-entries', ['columns' => 5])
                        @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $tasks->links() }}
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
