<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form wire:submit.prevent="save" enctype="multipart/form-data">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('titles.'.$action) }} {{ __('dashboard.Department') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="name">{{ __('dashboard.Name') }} <span
                                        class="text-red">*</span></label>
                                <input wire:model="name" type="text" class="form-control" id="name"
                                       placeholder="">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
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
