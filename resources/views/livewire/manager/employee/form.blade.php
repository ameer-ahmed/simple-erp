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
                                <label for="first_name">{{ __('dashboard.First Name') }} <span class="text-red">*</span></label>
                                <input wire:model="first_name" type="text" class="form-control" id="first_name"
                                       placeholder="">
                                @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group col-6">
                                <label for="last_name">{{ __('dashboard.Last Name') }} <span
                                        class="text-red">*</span></label>
                                <input wire:model="last_name" type="text" class="form-control" id="last_name"
                                       placeholder="">
                                @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="email">{{ __('dashboard.Email') }} <span class="text-red">*</span></label>
                                <input wire:model="email" type="email" class="form-control" id="email" placeholder="">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group col-6">
                                <label for="phone">{{ __('dashboard.Phone') }} <span class="text-red">*</span></label>
                                <input wire:model="phone" type="text" class="form-control" id="phone" placeholder="">
                                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="password">{{ __('dashboard.Password') }} @if($id == null)
                                        <span class="text-red">*</span>
                                    @endif</label>
                                <input wire:model="password" type="password" class="form-control" id="password"
                                       placeholder="">
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group col-6">
                                <label
                                    for="password_confirmation">{{ __('dashboard.password_confirmation') }} @if($id == null)
                                        <span class="text-red">*</span>
                                    @endif</label>
                                <input wire:model="password_confirmation" type="password" class="form-control"
                                       id="password_confirmation" placeholder="">
                                @error('password_confirmation') <span
                                    class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="salary">{{ __('dashboard.Salary') }} <span class="text-red">*</span></label>
                                <input wire:model="salary" type="number" min="0" step="0.01" class="form-control"
                                       id="salary" placeholder="">
                                @error('salary') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group col-6">
                                <label for="image">{{ __('dashboard.Image') }} @if($id == null)
                                        <span class="text-red">*</span>
                                    @endif</label>
                                <input wire:model="image" type="file" class="form-control" id="image" placeholder="">
                                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
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
