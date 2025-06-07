@extends('admin.layout')
@section('content')

<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3  style="text-align: right;">{{$product->name}}</h3>
                    <div class="product__details__price">
                        @if($product->discount && $product->discount < $product->price)
                            <h3 class="text-danger" style="text-decoration: line-through;text-align: right;">
                                {{ $product->price }}</h3>
                            <h3 style="text-align: right;">{{ $product->discount }}</h3>
                        @else
                            <h3 style="text-align: right;">{{ $product->price }}</h3>
                        @endif
                    </div>
                    <ul style="text-align: right; direction: rtl;">
                        <li>
                            <b>النوع</b>
                            <span>{{$product->type}}</span>
                        </li>
                        <li>
                            <b>المنشأ</b>
                            <span>{{$product->manufacture}}</span>
                        </li>
                        <li>
                            <b>الكمية</b>
                            <span>{{$product->qty}}</span>
                        </li>
                        <li>
                            <b>القياس</b>
                            <span>{{$product->size}}</span>
                        </li>
                        <li>
                            <b>الأبعاد</b>
                            <span>{{$product->dimention}}</span>
                        </li>
                        <li>
                            <b>الألوان</b>
                            <span>{{$product->color}}</span>
                        </li>
                        <li>
                            <b>التوصيل</b>
                            <span>{{$product->delivery}}</span>
                        </li>
            
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large"
                            style="height: 400px; width: 100%; object-fit: cover; border-radius: 12px;"
                            src="{{ $product->images->first() ? asset('storage/' . $product->images->first()->path) : asset('themes/minimal/item/img/placeholder.png') }}"
                            alt="{{ $product->name }}"
                        >

                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        @forelse ($product->images->take(3) as $image)
                            <img class="border" style="width: 100%; height: 150px; object-fit: cover; border-radius: 10px;"
                                data-imgbigurl="{{ asset('storage/' . $image->path) }}"
                                src="{{ asset('storage/' . $image->path) }}"
                                alt="صورة المنتج">
                        @empty
                            <img style="width: 100%; height: 350px; object-fit: cover; border-radius: 10px;"
                                data-imgbigurl="{{ asset('themes/minimal/item/img/placeholder.png') }}"
                                src="{{ asset('themes/minimal/item/img/placeholder.png') }}"
                                alt="لا توجد صور">
                        @endforelse
                    </div>
                    
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                aria-selected="true">وصف المنتج</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <p style="text-align: center;">{{$product->description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection