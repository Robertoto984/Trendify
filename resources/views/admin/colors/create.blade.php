@extends('admin.layout')
@section('content')

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">إضافة لون جديد</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.colors.store') }}"
                          method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name">اسم اللون</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="text-danger d-block mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="hex_code">اللون (اضغط على اللون لاختيار اللون)</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="color"
                                               id="hex_code_picker"
                                               value="{{ old('hex_code', '#000000') }}"
                                               class="form-control form-control-color"
                                               style="width: 60px; height: 38px; padding: 2px;">
                        
                                        <input type="text"
                                               id="hex_code"
                                               name="hex"
                                               value="{{ old('hex', '#000000') }}"
                                               class="form-control"
                                               style="max-width: 120px;">
                                    </div>
                                    @error('hex')
                                        <span class="text-danger d-block mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">حفظ</button>
                            <a href="{{ route('admin.colors.index') }}" class="btn btn-secondary">رجوع</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection