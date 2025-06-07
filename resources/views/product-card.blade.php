<style>
    .product__item.sale .product__item__pic .label {
        background: #d92929 !important;
        color: #fff !important;
    }
</style>

<div class="col-lg-4 col-md-6 col-sm-6">
    <div class="product__item sale">
        <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . ($pro->featuredImage->path ?? 'default.jpg')) }}">
            @if ($pro->is_featured)
                <span class="label">تخفيضات</span>
            @endif
            <ul class="product__hover">
                @foreach ($pro->uniqueSizes() as $si)
                    <li style="width: 24px; height: 24px; border-radius: 4px; background-color: #000; border: 1px solid #ccc;color:#fff; text-align:center; line-height:24px; font-size:12px;">
                        {{ $si->name }}
                    </li>
                @endforeach
            </ul>            
        </div>
        <div class="product__item__text">
            <h6>{{$pro->name}}</h6>
            <a href="#" class="add-cart">+ أضف للسلة</a>
            <div class="rating">
                <i class="fa fa-star-o"></i>
                <i class="fa fa-star-o"></i>
                <i class="fa fa-star-o"></i>
                <i class="fa fa-star-o"></i>
                <i class="fa fa-star-o"></i>
            </div>
            <h5>{{$pro->prices->last()?->sale_price}}</h5>
            <div class="product__color__select">
                @foreach ($pro->uniqueColors() as $color)
                    <span style="display: inline-block; width: 24px; height: 24px; border-radius: 50%; background-color: #{{ $color->hex }}; border: 1px solid #ccc;"></span>
                @endforeach
            </div>                        
        </div>
    </div>
</div>