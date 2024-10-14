@php use App\Http\Enums\TaskStatus; @endphp
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form wire:submit.prevent="save" enctype="multipart/form-data">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('titles.'.$action) }} {{ __('dashboard.Employee') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="title">{{ __('dashboard.Title') }} <span
                                        class="text-red">*</span></label>
                                <input wire:model="title" type="text" class="form-control" id="title"
                                       placeholder="">
                                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group col-6">
                                <label for="description">{{ __('dashboard.Description') }} <span class="text-red">*</span></label>
                                <input wire:model="description" type="text" class="form-control" id="description"
                                       placeholder="">
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="status">{{ __('dashboard.Status') }} <span class="text-red">*</span></label>
                                <select id="status" class="form-control" wire:model="status">
                                    <option value="">------</option>
                                    @foreach(TaskStatus::values() as $taskStatus)
                                        <option value="{{$taskStatus}}">{{$taskStatus}}</option>
                                    @endforeach
                                </select>
                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group col-6">
                                <label for="employee_id">{{ __('dashboard.Employee') }} <span
                                        class="text-red">*</span></label>
                                <select id="employee_id" class="form-control" wire:model="employee_id">
                                    <option value="">------</option>
                                    @foreach($employees as $employee)
                                        <option value="{{$employee->id}}">{{$employee->name}}</option>
                                    @endforeach
                                </select>
                                @error('employee_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-dark">{{ __('dashboard.'.$action) }}</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->

        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
