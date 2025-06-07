@extends('admin.layout')
@section('content')

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <a href="{{ route('admin.store-house.create') }}" class="btn bg-gradient-primary">
          إضافة
      </a>
      {{-- <h5 class="mb-0 ms-6">عدد المقاسات: {{ $sizes->count() }}</h5> --}}
    </div>

    <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>قائمة المخازن</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                        الاسم
                      </th>
                      <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                        الكمية
                      </th>
                      <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                         عدد الألوان
                      </th>
                      <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                         عدد المقاسات
                      </th>
                      <th class="text-secondary text-center opacity-7">الإجراءات</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as $pro)
                    <tr id="row-{{ $pro->id }}" class="main-product-row">

                        <td class="align-middle text-center">{{ $pro->name }}</td>
                        <td class="align-middle text-center">{{ $pro->total_qty ?? 0 }}</td>
                        <td class="align-middle text-center">{{ $pro->unique_colors_count }}</td>
                        <td class="align-middle text-center">{{ $pro->unique_sizes_count }}</td>
                        <td class="align-middle text-center">
                            <button type="button" class="btn btn-primary" onclick="toggleDetails({{ $pro->id }})">
                                عرض التفاصيل
                            </button>
                        </td>
                      </tr>
                      <tr id="details-{{ $pro->id }}" style="display: none;">
                        <td colspan="4">
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>اللون</th>
                                        <th>المقاس</th>
                                        <th>الكمية</th>
                                        <th>سعر الشراء</th>
                                        <th>سعر البيع</th>
                                        <th>تاريخ الإنشاء</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pro->storeHouses as $stock)
                                        @php
                                            $price = $pro->prices->firstWhere(fn($p) =>
                                                $p->color_id == $stock->color_id && $p->size_id == $stock->size_id
                                            );
                                        @endphp
                                        <tr>
                                            <td>{{ $stock->color->name ?? 'بدون' }}</td>
                                            <td>{{ $stock->size->name ?? 'بدون' }}</td>
                                            <td>{{ $stock->qty }}</td>
                                            <td>{{ $price?->purchase_price ?? '—' }}</td>
                                            <td>{{ $price?->sale_price ?? '—' }}</td>
                                            <td>{{ $pro->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>

@endsection

@section('scripts')
<script>
    function toggleDetails(productId) {
        const row = document.getElementById('details-' + productId);
        row.style.display = row.style.display === 'none' ? '' : 'none';
    }
</script>

<script>
    function toggleDetails(productId) {
        const detailsRow = document.getElementById('details-' + productId);
        const mainRow = document.getElementById('row-' + productId);
        const allDetailsRows = document.querySelectorAll('tr[id^="details-"]');
        const allMainRows = document.querySelectorAll('.main-product-row');

        const isVisible = detailsRow.style.display !== 'none';

        // إغلاق كل الصفوف وإزالة التمييز
        allDetailsRows.forEach(row => row.style.display = 'none');
        allMainRows.forEach(row => row.classList.remove('bg-primary', 'text-white'));

        if (!isVisible) {
            detailsRow.style.display = '';
            mainRow.classList.add('bg-primary', 'text-white');
        }
    }
</script>
@endsection
