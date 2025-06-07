@extends('admin.layout')
@section('content')

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('admin.products.create') }}" class="btn bg-gradient-primary">
            إضافة
        </a>
        <h5 class="mb-0 ms-6">عدد المنتجات: {{ $products->count() }}</h5>
      </div>

    <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>قائمة المنتجات</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">الاسم</th>
                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">الفئة</th>
                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">الحالة</th>
                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">الصورة</th>
                        <th class="text-secondary text-center opacity-7">الإجراءات</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as $pro)
                        <tr id="row-{{ $pro->id }}">
                        <td class="align-middle text-center">{{ $pro->name }}</td>
                        <td class="align-middle text-center">{{ $pro->category->name }}</td>
                        <td class="align-middle text-center">
                            <span class="badge badge-sm {{ $pro->status_badge_class }}">
                                {{ $pro->status_label }}
                            </span>
                        </td>
                        <td class="align-middle text-center">
                            <img src="{{ asset('storage/' . $pro->featuredImage->path) }}"
                             alt="Featured Image"
                             style="width: 50px; height: 50px; object-fit: cover;"
                             class="rounded">
                        </td>
                        <td class="align-middle text-center">
                            <a href="{{ route('admin.products.edit', $pro->id) }}" 
                               >
                                تعديل
                            </a>
                           
                            <a href="#" 
                                class="delete-btn text-danger font-weight-bold m-3" 
                                data-id="{{ $pro->id }}">
                                حذف
                            </a>
                            <form id="delete-form-{{ $pro->id }}" 
                                action="{{ route('admin.products.destroy', $pro->id) }}" 
                                method="POST" 
                                style="display: none;">
                            @csrf
                            @method('DELETE')
                            </form>
                        </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="flex items-center justify-center">
            {{ $products->links() }}
        </div>
      </div>
  </div>

  @endsection