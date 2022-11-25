<div class="col-lg-6 col-xl-6">
    @if(isset($product))
    <div class="product-details">
        <h5 class="pro-title"><a href="#">Woman fashion dress</a></h5>
        <span class="price">Price : $387</span>
        <div class="size-variation">
            <span>size :</span>
            <select wire:model="getsize" name="size-value">
                @php
                    $trim = trim($product[0]->sizes);
                    $size = explode(" ",$trim);
                @endphp
                @foreach ($size as $s)
                    <option value="{{ $s }}">{{ $s }}</option>
                @endforeach
            </select>
        </div>
        <div class="color-checkboxes">
            <h4>Color:</h4>
            @php
                $trim = trim($product[0]->colors);
                $color = explode(" ",$trim);
            @endphp
            @foreach ($color as $s)
                <input class="color-checkbox__input" id="col-{{$s}}" name="colour" type="radio" >
                <label class="color-checkbox" for="col-{{$s}}" id="col-{{$s}}-label" style="background: {{$s}}"></label>
                <span></span>
            @endforeach

        </div>

        <div class="add-tocart-wrap">
            <!--PRODUCT INCREASE BUTTON START-->
            <div class="cart-plus-minus-button">
                <input type="text" value="1" name="qtybutton" class="cart-plus-minus">
            </div>
            <a href="#" class="add-to-cart"><i class="flaticon-shopping-purse-icon"></i>Add to Cart</a>
        </div>

        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
            irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <ul>
            <li>Lorem ipsum dolor sit amet</li>
            <li>quis nostrud exercitation ullamco</li>
            <li>Duis aute irure dolor in reprehenderit</li>
        </ul>
        <div class="product-social">
            <span>Share :</span>
            <ul>
                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
            </ul>
        </div>

    </div>
    @endif
</div>
