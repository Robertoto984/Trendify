@extends('admin.layout')
@section('content')

<div class="container-fluid py-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">إضافة مخزون جديد</h5>
        </div>
        <div class="card-body">
            <form action="{{route('admin.store-house.store')}}"
                  method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="product_id">اختر المنتج</label>
                            <select name="product_id"
                                    id="product_id"
                                    class="custom-form-select @error('product_id') is-invalid @enderror">
                                <option value="">اختر المنتج</option>
                                @foreach ($products as $pro)
                                    <option value="{{ $pro->id }}"
                                            {{ old('product_id') == $pro->id ? 'selected' : '' }}>
                                        {{ $pro->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="qty">الكمية</label>
                            <input type="number"
                                   class="form-control @error('qty') is-invalid @enderror"
                                   id="qty"
                                   name="qty"
                                   value="{{ old('qty') }}">
                            @error('qty')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="purchase_price">سعر الشراء</label>
                            <input type="number"
                                   class="form-control @error('purchase_price') is-invalid @enderror"
                                   id="purchase_price"
                                   name="purchase_price"
                                   value="{{ old('purchase_price') }}">
                            @error('purchase_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="sale_price">سعر المبيع</label>
                            <input type="number"
                                   class="form-control @error('sale_price') is-invalid @enderror"
                                   id="sale_price"
                                   name="sale_price"
                                   value="{{ old('sale_price') }}">
                            @error('sale_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
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
                        <div class="col-md-2">
                            <label>اللون</label>
                        </div>
                        <div class="col-md-2">
                            <label>المقاس</label>
                        </div>
                        <div class="col-md-2">
                            <label>سعر الشراء</label>
                        </div>
                        <div class="col-md-2">
                            <label>سعر المبيع</label>
                        </div>
                        <div class="col-md-2">
                            <label>الكمية</label>
                        </div>
                        <div class="col-md-2">
                            <label>حذف</label>
                        </div>
                    </div>
                
                    <div id="variants-wrapper"></div>
                
                    <button type="button" class="btn btn-sm btn-success mt-3" onclick="addVariantRow()">+</button>
                </div>
                
                

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">رجوع</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
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
            <div class="col-md-2">
                <select name="variants[${index}][color_id]" class="form-control" required>
                    <option value="">اختر اللون</option>
                    @foreach($colors as $color)
                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="variants[${index}][size_id]" class="form-control" required>
                    <option value="">اختر المقاس</option>
                    @foreach($sizes as $size)
                        <option value="{{ $size->id }}">{{ $size->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="variants[${index}][purchase_price]" class="form-control" placeholder="سعر الشراء" required>
            </div>
            <div class="col-md-2">
                <input type="number" name="variants[${index}][sale_price]" class="form-control" placeholder="سعر المبيع" required>
            </div>
            <div class="col-md-2">
                <input type="number" name="variants[${index}][qty]" class="form-control" placeholder="الكمية" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.variant-row').remove()">حذف</button>
            </div>
        </div>`;
        wrapper.insertAdjacentHTML('beforeend', html);
    }
</script>
@endsection