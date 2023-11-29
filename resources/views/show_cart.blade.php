<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">

    <title>Klassy Cafe - Restaurant HTML Template</title>
    <!--

    TemplateMo 558 Klassy Cafe

    https://templatemo.com/tm-558-klassy-cafe

    -->
    <!-- Additional CSS Files -->

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/templatemo-klassy-cafe.css">

    <link rel="stylesheet" href="assets/css/owl-carousel.css">

    <link rel="stylesheet" href="assets/css/lightbox.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>

<body>

<!-- ***** Preloader Start ***** -->
<div id="preloader">
    <div class="jumper">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<!-- ***** Preloader End ***** -->


<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="/" class="logo">
                        <img src="assets/images/klassy-logo.png" alt="Klassy Cafe HTML Template">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <ul class="nav">
                        <li class="scroll-to-section"><a href="/" class="active">Go To Home Page</a></li>
                        <li class="scroll-to-section">
                            @auth
                                <a href="{{ route('show_cart', Auth::user()->id) }}">Cart[{{ $count }}]</a>
                            @endauth
                        </li>

                        <li>
                            @if (Route::has('login'))
                                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                        @auth
                            <li>
                                @include('dashboard')
                            </li>
                        @else
                            <li><a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a></li>
                            @if (Route::has('register'))
                                <li><a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a></li>
                @endif
                @endauth
            </div>
            @endif
            </li>
            </ul>
            <!-- ***** Menu End ***** -->
            </nav>
        </div>
    </div>
    </div>
</header>
@if(Session::has('order_confirmed'))
    <div class="alert alert-success">{{ session('order_confirmed') }}</div>
@endif
<div id="top">
    <table align="center" bgcolor="yellow" style="width: 100%; border-collapse: collapse;">
        <thead>
        <tr>
            <th style="padding: 15px; border-bottom: 2px solid #000;">Food Name</th>
            <th style="padding: 15px; border-bottom: 2px solid #000;">Price</th>
            <th style="padding: 15px; border-bottom: 2px solid #000;">Quantity</th>
            <th style="padding: 15px; border-bottom: 2px solid #000;">Sum</th>
            <th style="padding: 15px; border-bottom: 2px solid #000;">Action</th>
        </tr>
        </thead>

        <tbody>
        @if(Session::has('delete_cart'))
            <div class="alert alert-success">{{ session('delete_cart') }}</div>
        @endif

        <form method="POST" action="{{route('order_add')}}">
        @csrf

            @foreach($foods as $food)
                <tr style="border-bottom: 1px solid #ccc;">
                    <td style="padding: 15px;"><input type="text" name="food_names[]" value="{{$food->name}}" hidden="">{{$food->name}}</td>
                    <td style="padding: 15px;"><input type="text" name="price[]" value="{{$food->price}}" hidden="">{{$food->price}}$</td>
                    <td style="padding: 15px;"><input type="text" name="quantity[]" value="{{$food->quantity}}" hidden="">{{$food->quantity}}</td>
                    <td style="padding: 15px;">{{$food->quantity * $food->price}}$</td>
                    <td>
                        @foreach($orders as $order)
                            @if($order->food_id == $food->id)
                                <a href="{{ route('delete_cart', $order->id) }}" class="btn btn-warning">Remove</a>
                                @break
                            @endif
                        @endforeach
                    </td>

                </tr>
            @endforeach
        </tbody>


        <!-- Red za ukupnu cenu -->
        <tr>
            <td colspan="3" style="text-align: right; padding: 15px;"><strong>Total Price:</strong></td>
            <td style="padding: 15px;">

                {{$totalPriceForAll."$"}}
            </td>
        </tr>

    </table>


    <div  align="center" style="padding:10px">
        <button class="btn btn-primary" type="button" id="order" style="background-color:blue">Order Now</button>
    </div>

    <div id='appear' align='center' style="padding:10px;">
            <div style="padding: 10px">
                <label>Name</label>
                <input type="text" name="name" placeholder="Name" value="{{ auth()->user()->name }}" readonly>
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div style="padding: 10px">
                <label>Phone</label>
                <input type="number" name="phone" placeholder="Phone">
                @error('phone')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div style="padding: 10px">
                <label>Address</label>
                <input type="text" name="address" placeholder="Address">
                @error('address')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div style="padding: 10px">
                <input type="submit" class="btn btn-success" value="Order Confirm" style="background-color: green">
                <button id="close" type="button" style="background-color: red" class="btn btn-danger">Close</button>
            </div>
        </form>
    </div>

    </form>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#order').click(function(){
            $('#appear').show();
        });

        $('#close').click(function(){
            $('#appear').hide();
        });
    });
</script>


<!-- jQuery -->
<script src="assets/js/jquery-2.1.0.min.js"></script>

<!-- Bootstrap -->
<script src="assets/js/popper.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- Plugins -->
<script src="assets/js/owl-carousel.js"></script>
<script src="assets/js/accordions.js"></script>
<script src="assets/js/datepicker.js"></script>
<script src="assets/js/scrollreveal.min.js"></script>
<script src="assets/js/waypoints.min.js"></script>
<script src="assets/js/jquery.counterup.min.js"></script>
<script src="assets/js/imgfix.min.js"></script>
<script src="assets/js/slick.js"></script>
<script src="assets/js/lightbox.js"></script>
<script src="assets/js/isotope.js"></script>

<!-- Global Init -->
<script src="assets/js/custom.js"></script>
<script>

    $(function() {
        var selectedClass = "";
        $("p").click(function(){
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadeTo(50, 0.1);
            $("#portfolio div").not("."+selectedClass).fadeOut();
            setTimeout(function() {
                $("."+selectedClass).fadeIn();
                $("#portfolio").fadeTo(50, 1);
            }, 500);

        });
    });

</script>
</body>
</html>
