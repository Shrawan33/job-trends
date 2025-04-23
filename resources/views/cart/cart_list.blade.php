
<div class="cart_page_main_wraper cart_page">
    <div class="container">
        <h1 class="title mt-40 mt-lg-60 mb-45">Package Details</h1>
        <div class="table-responsive mb-40 cart_wraper">
            <table class="cart_table_wraper" width="100%">
                <thead>
                    <tr>
                    <th>Package Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                    <th style="text-align: right;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($cart)
                    @php
                        unset($cart['refreshContentId'])
                    @endphp
                        @foreach ($cart as $key=>$item)
                            <tr>
                                <td>
                                    @if (isset($item['package_info']['parent_package_id']))
                                        @php
                                            $parentPackageId = $item['package_info']['parent_package_id'];
                                            $packageTitle = \App\Models\Package::where('id', $parentPackageId)->value('title');
                                        @endphp

                                        @if ($packageTitle)
                                            <p class="m-0" style="white-space: normal">{{ $packageTitle }} <b>({{ $item['title'] }})</b></p>
                                        @else
                                            <p class="m-0" style="white-space: normal">{{ $item['title'] }}</p>
                                        @endif
                                    @else
                                        <p class="m-0" style="white-space: normal">{{ $item['title'] }}</p>
                                    @endif
                                </td>

                                {{-- <td><p class="m-0" style="white-space: normal">{{$item['title']}}</p></td> --}}
                                <td>₹ {{$item['price']}}</td>
                                <td>
                                    @if (!$item['package_info']['is_addon'])
                                        <div class="quantity_box d-flex align-items-center">
                                            <span class="remove_qty" data-packageid="{{$item['id']}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                                                    <rect x="0.5" y="0.5" width="29" height="29" rx="14.5" fill="white" stroke="#E0E0E0"/>
                                                    <path d="M9 15H21" stroke="#838383" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </span>
                                            <input class="input_qty" name="quantity" value="{{$item['quantity']}}">
                                            <span class="add_qty" data-packageid="{{$item['id']}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                                                    <rect x="0.5" y="0.5" width="29" height="29" rx="14.5" fill="white" stroke="#E0E0E0"/>
                                                    <path d="M15 9V21" stroke="#838383" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M9 15H21" stroke="#838383" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </span>
                                        </div>

                                    @endif
                                </td>
                                <td class="action_column"><a href="javascript:void(0)" class="text-uppercase remove-package" data-packageid={{$item['id']}}>Remove</a></td>
                                <td class="total_column text-secondary font-weight-bold" align="right">₹ {{$item['price'] * $item['quantity']}}</td>
                            </tr>
                        @endforeach
                    @endif
                    <tr>
                        <td colspan="5" align="right" class="total_count">Total Price: <span class="text-secondary ml-10 font-weight-bold">₹ {{$cartTotal}}</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="d-flex align-items-center justify-content-between btn_wraper mb-50 mb-lg-100">
            <button class="btn btn-default">Cancel</button>
            <a href="{{ route('cart.checkout') }}" class="btn btn-primary">Checkout</a>
        </div>
    </div>
    {{-- <div class="job_hunt_wraper py-40 py-lg-80">
        <div class="container">
            <h2 class="mb-40">Select Add On to accelerate your job hunt</h2>
            <div class="hunt_table_wraper table-responsive cart_table_wraper">
                <table>
                    <thead>
                        <tr>
                            <th width="30%">Package Name</th>
                            <th width="50%">Description</th>
                            <th width="10%">Price</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($addOns))
                            @foreach ($addOns as $addOn)
                            @dD( $addOn)
                                <tr>
                                    <td width="30%">{{ $addOn->title }}</td>
                                    <td width="50%">{{ $addOn->description }}</td>
                                    <td width="10%" class="font-weight-bold">₹ {{ $addOn->price }}</td>
                                    <td width="10%">
                                        <a href="{{ route('add-to-cart', $addOn->id) }}" class="btn btn-primary btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none" class="mr-5">
                                                <path d="M9 4.25H5.75V1C5.75 0.59 5.41 0.25 5 0.25C4.59 0.25 4.25 0.59 4.25 1V4.25H1C0.59 4.25 0.25 4.59 0.25 5C0.25 5.41 0.59 5.75 1 5.75H4.25V9C4.25 9.41 4.59 9.75 5 9.75C5.41 9.75 5.75 9.41 5.75 9V5.75H9C9.41 5.75 9.75 5.41 9.75 5C9.75 4.59 9.41 4.25 9 4.25Z" fill="white"/>
                                            </svg>
                                            Add
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>


                </table>
            </div>
        </div>
    </div> --}}
</div>

<script>
    $(document).ready(function() {
        $('.add_qty').click(function() {
            const inputQty = $(this).parent().find('.input_qty');
            var quantity = parseInt(inputQty.val()) + 1;
            //var package_id =
            var package_id = $(this).data('packageid');
            inputQty.val(quantity);
            updateCart(quantity, package_id);
        });

        $('.remove_qty').click(function() {
            const inputQty = $(this).parent().find('.input_qty');
            if (parseInt(inputQty.val()) > 1) {
                var quantity = parseInt(inputQty.val()) - 1;
                inputQty.val(quantity);
                var package_id = $(this).data('packageid');
                updateCart(quantity, package_id);
            }
        });


        $('.remove-package').click(function() {
            var package_id = $(this).data('packageid');
            removeCart(package_id);
        });

        function updateCart(quantity, package_id) {
            var $data = JSON.stringify({
                product_id: package_id,
                quantity: quantity
            });
            processAjaxOperation("{{ route('cart.update') }}", 'POST', $data, 'applicaion/json');
        }

        function removeCart(package_id) {
            var $data = JSON.stringify({
                product_id: package_id
            });
            processAjaxOperation("{{ route('cart.remove') }}", 'POST', $data, 'applicaion/json');
        }
    });
</script>
