@extends('admin.layout')
@section('content')

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">إضافة مقاس جديد</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.sizes.store') }}"
                          method="POST">
                        @csrf

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="name">رمز المقاس</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger d-block mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">حفظ</button>
                            <a href="{{ route('admin.sizes.index') }}" class="btn btn-secondary">رجوع</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
