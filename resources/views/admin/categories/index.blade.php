@extends('admin.layout')
@section('content')

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('admin.categories.create') }}" class="btn bg-gradient-primary">
            إضافة
        </a>
        <h5 class="mb-0 ms-6">عدد الفئات: {{ $categories->count() }}</h5>
    </div>

    <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>قائمة الفئات</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                        الاسم
                      </th>
                      <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        القسم
                      </th>
                      <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        الحالة
                      </th>
                      <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                         عدد المنتجات
                      </th>
                      <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        تاريخ الإنشاء
                      </th>
                      <th class="text-secondary text-center opacity-7">الإجراءات</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($categories as $cat)
                        <tr id="row-{{ $cat->id }}">
                            <td class="align-middle text-center">{{ $cat->name }}</td>
                            <td class="align-middle text-center">{{ $cat->department->name }}</td>
                            <td class="align-middle text-center">
                                <span class="badge badge-sm {{ $cat->status_badge_class }}">
                                    {{ $cat->status_label }}
                                </span>
                            </td>
                            <td class="align-middle text-center">{{ $cat->products->count() }}</td>
                            <td class="align-middle text-center">{{ $cat->created_at->format('Y-m-d') }}</td>
                            <td class="align-middle text-center">
                                <a href="{{ route('admin.categories.edit', $cat->id) }}">
                                    تعديل
                                </a>

                                <a href="#"
                                   class="delete-btn text-danger font-weight-bold m-3"
                                   data-id="{{ $cat->id }}">
                                   حذف
                                </a>
                                <form id="delete-form-{{ $cat->id }}"
                                      action="{{ route('admin.categories.destroy', $cat->id) }}"
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
      </div>
</div>
@endsection
