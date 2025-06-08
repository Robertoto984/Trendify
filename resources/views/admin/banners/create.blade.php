@extends('admin.layout')
@section('content')

<div class="container-fluid py-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">إضافة لافتة جديدة</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.banners.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="title">عنوان اللافتة</label>
                            <input type="text"
                                   class="form-control @error('title') is-invalid @enderror"
                                   id="title"
                                   name="title"
                                   value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="status">الحالة</label>
                            <select name="status"
                                    id="status"
                                    class="custom-form-select @error('status') is-invalid @enderror">
                                <option value="1" {{ old('status','1') === '1' ? 'selected' : '' }}>فعالة</option>
                                <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>غير فعالة</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="description">الوصف</label>
                            <textarea id="description"
                                      name="description"
                                      rows="4"
                                      class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-6">
                            <label for="image">صورة المنتج</label>
                            <input type="file"
                                    id="image"
                                    name="image"
                                    class="form-control @error('image') is-invalid @enderror"
                                    accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                    <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">رجوع</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection