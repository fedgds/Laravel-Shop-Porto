@extends('clients.index')
@section('main')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('index')}}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="container mb-5">
        <div class="wishlist-title">
            <h2 class="p-2">My wishlist</h2>
        </div>
        <div class="wishlist-table-container">
            <table class="table table-wishlist mb-0 table-bordered text-center">
                <thead>
                    <tr>
                        <th class="thumbnail-col"></th>
                        <th class="product-col">Product</th>
                        <th class="price-col">Price</th>
                        <th class="action-col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wishlist->list() as $key => $value)
                        <form action="{{route('cart.add')}}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$value['productId']}}">
                            <input type="hidden" name="quantity" value="1">
                            <tr class="product-row">
                                <td>
                                    <figure class="product-image-container">
                                        <a href="" class="product-image">
                                            <img src="{{asset('storage/images')}}/{{$value['image']}}" alt="product" width="50px">
                                        </a>
                                    </figure>
                                </td>
                                <td>
                                    <h5 class="product-title">
                                        <a href="">{{$value['name']}}</a>
                                    </h5>
                                </td>
                                <td class="price-box">{{number_format($value['price'])}} VND</td>
                                
                                <td class="action">
                                    <button type="submit" class="btn btn-dark mr-2" title="Add to Cart">Add to Cart</button>
                                </td>
                            </tr> 
                        </form>
                    @endforeach
                    
                </tbody>
            </table>
        </div><!-- End .cart-table-container -->
    </div><!-- End .container -->
</main><!-- End .main -->
@endsection