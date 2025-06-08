@extends('app')
@section('content')

<!-- Shop Details Section Begin -->
<section class="shop-details">
    <div class="product__details__pic">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <ul class="nav nav-tabs" role="tablist">
                        @if ($product->images->isNotEmpty())
                            @foreach ($product->images as $img)
                                <li class="nav-item">
                                    <a class="nav-link thumb-image {{ $loop->first ? 'active' : '' }}" href="javascript:void(0);"
                                    data-img="{{ asset('storage/' . $img->path) }}">
                                        <div class="product__thumb__pic set-bg" data-setbg="{{ asset('storage/' . $img->path) }}">
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-lg-6 col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img id="main-product-image" src="{{asset('storage/'.$product->featuredImage->path)}}" alt=""
                                style="background-size: cover;width: 500px; height: 500px; background-repeat: no-repeat">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product__details__content">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="product__details__text">
                        <h4>{{$product->name}}</h4>
                        {{-- <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                            <span> - 5 Reviews</span>
                        </div> --}}
                        <h3 id="dynamic-price">{{$product->prices->last()?->sale_price}}
                            @if ($product->is_featured && $product->prices->count() > 1)
                                <span>{{ $product->prices->slice(-2, 1)->first()?->sale_price }}</span>    
                            @endif
                        </h3>
                        <div class="product__details__option">
                            @if ($product->unique_sizes->isNotEmpty())
                                <div class="product__details__option__size">
                                    <span>القياسات:</span>
                                    @foreach ($product->unique_sizes as $size)
                                        <label for="size_{{ $size->id }}">
                                            {{ $size->name }}
                                            <input type="radio" name="size_id" id="size_{{ $size->id }}" value="{{ $size->id }}">
                                        </label>
                                    @endforeach
                                </div>
                            @endif
                            @if ($product->unique_colors->isNotEmpty())
                                <div class="product__details__option__color">
                                    <span>الألوان:</span>
                                    @foreach ($product->unique_colors as $color)
                                        <label style="background-color: #{{ $color->hex }};width: 36px; height: 36px; display: inline-block; border-radius: 50%; margin-right: 5px; cursor: pointer;" title="{{ $color->hex }}">
                                            <input type="radio" name="color_id" value="{{ $color->id }}" style="display: none;">
                                        </label>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="product__details__cart__option">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1">
                                </div>
                            </div>
                            <a href="#" class="primary-btn">
                                <i class="fa fa-shopping-cart"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                role="tab">وصف المنتج</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <p class="note">{{$product->description}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Details Section End -->

<!-- Related Section Begin -->
{{-- <section class="related spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="related-title">Related Product</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="img/product/product-1.jpg">
                        <span class="label">New</span>
                        <ul class="product__hover">
                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                            <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a></li>
                            <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6>Piqué Biker Jacket</h6>
                        <a href="#" class="add-cart">+ Add To Cart</a>
                        <div class="rating">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <h5>$67.24</h5>
                        <div class="product__color__select">
                            <label for="pc-1">
                                <input type="radio" id="pc-1">
                            </label>
                            <label class="active black" for="pc-2">
                                <input type="radio" id="pc-2">
                            </label>
                            <label class="grey" for="pc-3">
                                <input type="radio" id="pc-3">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="img/product/product-2.jpg">
                        <ul class="product__hover">
                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                            <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a></li>
                            <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6>Piqué Biker Jacket</h6>
                        <a href="#" class="add-cart">+ Add To Cart</a>
                        <div class="rating">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <h5>$67.24</h5>
                        <div class="product__color__select">
                            <label for="pc-4">
                                <input type="radio" id="pc-4">
                            </label>
                            <label class="active black" for="pc-5">
                                <input type="radio" id="pc-5">
                            </label>
                            <label class="grey" for="pc-6">
                                <input type="radio" id="pc-6">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                <div class="product__item sale">
                    <div class="product__item__pic set-bg" data-setbg="img/product/product-3.jpg">
                        <span class="label">Sale</span>
                        <ul class="product__hover">
                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                            <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a></li>
                            <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6>Multi-pocket Chest Bag</h6>
                        <a href="#" class="add-cart">+ Add To Cart</a>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <h5>$43.48</h5>
                        <div class="product__color__select">
                            <label for="pc-7">
                                <input type="radio" id="pc-7">
                            </label>
                            <label class="active black" for="pc-8">
                                <input type="radio" id="pc-8">
                            </label>
                            <label class="grey" for="pc-9">
                                <input type="radio" id="pc-9">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="img/product/product-4.jpg">
                        <ul class="product__hover">
                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                            <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a></li>
                            <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6>Diagonal Textured Cap</h6>
                        <a href="#" class="add-cart">+ Add To Cart</a>
                        <div class="rating">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <h5>$60.9</h5>
                        <div class="product__color__select">
                            <label for="pc-10">
                                <input type="radio" id="pc-10">
                            </label>
                            <label class="active black" for="pc-11">
                                <input type="radio" id="pc-11">
                            </label>
                            <label class="grey" for="pc-12">
                                <input type="radio" id="pc-12">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- Related Section End -->

@endsection

@section('script')

<script>
    window.productPrices = @json($product->prices);
</script>

<script>
    window.productPrices = @json($product->prices);

    document.addEventListener("DOMContentLoaded", function () {
        const prices = window.productPrices || [];
        const priceElement = document.getElementById("dynamic-price");

        let selectedColor = null;
        let selectedSize = null;

        const defaultPrice = prices[prices.length - 1] ?? null;

        function renderPrice(price) {
            priceElement.innerHTML = `
                ${price.sale_price}
                ${price.original_price ? `<span>${price.original_price}</span>` : ''}
            `;
        }

        function updatePrice() {
            let matchedPrice = prices.find(p =>
                (selectedColor ? p.color_id == selectedColor : p.color_id === null) &&
                (selectedSize ? p.size_id == selectedSize : p.size_id === null)
            );

            // جرب لون فقط أو قياس فقط
            if (!matchedPrice) {
                matchedPrice = prices.find(p =>
                    (selectedColor && p.color_id == selectedColor && p.size_id === null) ||
                    (selectedSize && p.size_id == selectedSize && p.color_id === null)
                );
            }

            // إن لم نجد أي تطابق نرجع للسعر الافتراضي
            if (!matchedPrice) {
                matchedPrice = defaultPrice;
            }

            if (matchedPrice) {
                renderPrice(matchedPrice);
            }
        }

        // إعداد السعر الابتدائي عند فتح الصفحة
        if (defaultPrice) {
            renderPrice(defaultPrice);
        }

        // عند تغيير اللون
        document.querySelectorAll('input[name="color_id"]').forEach(input => {
            input.addEventListener('change', function () {
                selectedColor = this.value;
                updatePrice();
            });
        });

        document.querySelectorAll('input[name="size_id"]').forEach(input => {
            input.addEventListener('change', function () {
                selectedSize = this.value;
                updatePrice();
            });
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const thumbnails = document.querySelectorAll('.thumb-image');
        const mainImage = document.getElementById('main-product-image');

        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function () {
                const imgSrc = this.getAttribute('data-img');
                if (imgSrc) {
                    mainImage.src = imgSrc;
                    // تحديث الـ active class
                    thumbnails.forEach(el => el.classList.remove('active'));
                    this.classList.add('active');
                }
            });
        });
    });
</script>

@endsection