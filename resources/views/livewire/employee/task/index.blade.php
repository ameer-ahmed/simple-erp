@php use App\Http\Enums\TaskStatus;use Illuminate\Support\Str; @endphp
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('dashboard.Tasks')</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-6">
                            <input wire:model.live="keyword" type="search" class="form-control"
                                   placeholder="Search with title, status and managers' names">
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>@lang('dashboard.Title')</th>
                            <th>@lang('dashboard.Description')</th>
                            <th>@lang('dashboard.Manager')</th>
                            <th>@lang('dashboard.Status')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($tasks as $task)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ Str::limit($task->description) }}</td>
                                <td>{{ $task->manager->name }}</td>
                                <td>
                                    <select wire:change="updateStatus({{$task->id}})"
                                            wire:model.live="statuses.{{ $task->id }}"
                                            class="form-control">
                                        @foreach(TaskStatus::values() as $status)
                                            <option
                                                value="{{ $status }}" @selected($task->status == $status)>{{ $status }}</option>
                                        @endforeach
                                    </select>
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
