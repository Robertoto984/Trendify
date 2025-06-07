@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">تعديل المنتج: {{ $product->name }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">اسم المنتج</label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name"
                                   name="name"
                                   value="{{ old('name', $product->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="category_id">اختر الفئة</label>
                            <select name="category_id"
                                    id="category_id"
                                    class="custom-form-select @error('category_id') is-invalid @enderror">
                                <option value="">اختر الفئة</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="is_active">الحالة</label>
                            <select name="is_active"
                                    id="is_active"
                                    class="custom-form-select @error('is_active') is-invalid @enderror">
                                <option value="1" {{ old('is_active', $product->is_active) == 1 ? 'selected' : '' }}>فعالة</option>
                                <option value="0" {{ old('is_active', $product->is_active) == 0 ? 'selected' : '' }}>غير فعالة</option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="is_featured">الميزة</label>
                            <select name="is_featured"
                                    id="is_featured"
                                    class="custom-form-select @error('is_featured') is-invalid @enderror">
                                <option value="1" {{ old('is_featured', $product->is_featured) == 1 ? 'selected' : '' }}>مميز</option>
                                <option value="0" {{ old('is_featured', $product->is_featured) == 0 ? 'selected' : '' }}>غير مميز</option>
                            </select>
                            @error('is_featured')
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
                                      class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                @if($product->images->isNotEmpty())
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">الصور الحالية:</label>
                            <div class="d-flex flex-wrap gap-3">
                                @foreach($product->images as $img)
                                    <div class="position-relative text-center">
                                        <img src="{{ asset('storage/' . $img->path) }}"
                                            alt="Product Image"
                                            style="width: 120px; height: 120px; object-fit: cover; border: 3px solid {{ $img->is_featured ? '#cb0c9f' : '#ccc' }}; border-radius: 8px;">

                                            <button type="button"
                                                    class="btn btn-sm btn-danger delete-image"
                                                    data-id="{{ $img->id }}"
                                                    style="position: absolute; top: 5px; left: 5px; padding: 2px 6px; font-size: 14px;">
                                                &times;
                                            </button>
                                        <div class="form-check mt-1">
                                            <input type="radio"
                                                name="featured_image_id"
                                                value="{{ $img->id }}"
                                                {{ old('featured_image_id', $product->featuredImage?->id) == $img->id ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                صورة مميزة
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-6">
                            <label for="images">تغيير/إضافة صور المنتج (بحد أقصى 4 صور)</label>
                            <input type="file"
                                   id="images"
                                   name="images[]"
                                   class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror"
                                   multiple
                                   accept="image/*">
                            @error('images')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @error('images.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">تحديث</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">رجوع</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
