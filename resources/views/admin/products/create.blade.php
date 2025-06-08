@extends('admin.layout')
@section('content')

<div class="container-fluid py-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">إضافة منتج جديد</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.products.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">اسم المنتج</label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name"
                                   name="name"
                                   value="{{ old('name') }}">
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
                                            {{ old('category_id') == $cat->id ? 'selected' : '' }}>
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
                                <option value="1" {{ old('is_active','1') === '1' ? 'selected' : '' }}>فعالة</option>
                                <option value="0" {{ old('is_active') === '0' ? 'selected' : '' }}>غير فعالة</option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="is_featured">تخفيضات</label>
                            <select name="is_featured"
                                    id="is_featured"
                                    class="custom-form-select @error('is_featured') is-invalid @enderror">
                                <option value="1" {{ old('is_featured','0') === '1' ? 'selected' : '' }}>نعم</option>
                                <option value="0" {{ old('is_featured','0') === '0' ? 'selected' : '' }}>لا</option>
                            </select>
                            @error('is_featured')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="is_new">منتج جديد</label>
                            <select name="is_new"
                                    id="is_new"
                                    class="custom-form-select @error('is_new') is-invalid @enderror">
                                <option value="1" {{ old('is_new','0') === '1' ? 'selected' : '' }}>نعم</option>
                                <option value="0" {{ old('is_new','0') === '0' ? 'selected' : '' }}>لا</option>
                            </select>
                            @error('is_new')
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
                            <label for="images">صور المنتج (بحد أقصى 4 صور)</label>
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

                {{-- <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="use_variant_prices">هل تريد تحديد أسعار وكميات حسب اللون والمقاس؟</label>
                            <select id="use_variant_prices" name="use_variant_prices" class="form-control">
                                <option value="0" {{ old('use_variant_prices') == '0' ? 'selected' : '' }}>لا</option>
                                <option value="1" {{ old('use_variant_prices') == '1' ? 'selected' : '' }}>نعم</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="variants-section" style="display: none;">
                    <h5>تفاصيل الألوان والمقاسات:</h5>
                    <div class="row">
                        <div class="col-md-3">
                            <label>اللون</label>
                        </div>
                        <div class="col-md-3">
                            <label>المقاس</label>
                        </div>
                        <div class="col-md-2">
                            <label>السعر</label>
                        </div>
                        <div class="col-md-2">
                            <label>الكمية</label>
                        </div>
                        <div class="col-md-2">
                            <label>حذف</label>
                        </div>
                    </div>
                
                    <div id="variants-wrapper"></div>
                
                    <button type="button" class="btn btn-sm btn-info mt-3" onclick="addVariantRow()">+ إضافة</button>
                </div> --}}
                
                

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">رجوع</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


{{-- @section('scripts')

<script>
    document.getElementById('use_variant_prices').addEventListener('change', function () {
        const section = document.getElementById('variants-section');
        section.style.display = this.value == '1' ? 'block' : 'none';
    });

    function addVariantRow() {
        const wrapper = document.getElementById('variants-wrapper');
        const index = wrapper.children.length;

        const html = `
        <div class="row variant-row mb-2">
            <div class="col-md-3">
                <select name="variants[${index}][color_id]" class="form-control" required>
                    <option value="">اختر اللون</option>
                    @foreach($colors as $color)
                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="variants[${index}][size_id]" class="form-control" required>
                    <option value="">اختر المقاس</option>
                    @foreach($sizes as $size)
                        <option value="{{ $size->id }}">{{ $size->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="variants[${index}][price]" class="form-control" placeholder="السعر" required>
            </div>
            <div class="col-md-2">
                <input type="number" name="variants[${index}][stock]" class="form-control" placeholder="الكمية" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.variant-row').remove()">حذف</button>
            </div>
        </div>`;
        wrapper.insertAdjacentHTML('beforeend', html);
    }
</script>

@endsection --}}
