@extends('layouts.app')

@push('custom-style')
    <style>
        .range-slider {
            width: 300px;
            margin: auto;
            text-align: center;
            position: relative;
            height: 6em;
        }

        .range-slider svg,
        .range-slider input[type=range] {
            position: absolute;
            left: 0;
            bottom: 0;
        }

        input[type=number] {
            border: 1px solid #ddd;
            text-align: center;
            font-size: 1.6em;
            -moz-appearance: textfield;
        }

        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        input[type=number]:invalid,
        input[type=number]:out-of-range {
            border: 2px solid #ff6347;
        }

        input[type=range] {
            -webkit-appearance: none;
            width: 100%;
        }

        input[type=range]:focus {
            outline: none;
        }

        input[type=range]:focus::-webkit-slider-runnable-track {
            background: #2497e3;
        }

        input[type=range]:focus::-ms-fill-lower {
            background: #2497e3;
        }

        input[type=range]:focus::-ms-fill-upper {
            background: #2497e3;
        }

        input[type=range]::-webkit-slider-runnable-track {
            width: 100%;
            height: 5px;
            cursor: pointer;
            animate: 0.2s;
            background: #2497e3;
            border-radius: 1px;
            box-shadow: none;
            border: 0;
        }

        input[type=range]::-webkit-slider-thumb {
            z-index: 2;
            position: relative;
            box-shadow: 0 0 0 #000;
            border: 1px solid #2497e3;
            height: 18px;
            width: 18px;
            border-radius: 25px;
            background: #a1d0ff;
            cursor: pointer;
            -webkit-appearance: none;
            margin-top: -7px;
        }

        input[type=range]::-moz-range-track {
            width: 100%;
            height: 5px;
            cursor: pointer;
            animate: 0.2s;
            background: #2497e3;
            border-radius: 1px;
            box-shadow: none;
            border: 0;
        }

        input[type=range]::-moz-range-thumb {
            z-index: 2;
            position: relative;
            box-shadow: 0 0 0 #000;
            border: 1px solid #2497e3;
            height: 18px;
            width: 18px;
            border-radius: 25px;
            background: #a1d0ff;
            cursor: pointer;
        }

        input[type=range]::-ms-track {
            width: 100%;
            height: 5px;
            cursor: pointer;
            animate: 0.2s;
            background: transparent;
            border-color: transparent;
            color: transparent;
        }

        input[type=range]::-ms-fill-lower,
        input[type=range]::-ms-fill-upper {
            background: #2497e3;
            border-radius: 1px;
            box-shadow: none;
            border: 0;
        }

        input[type=range]::-ms-thumb {
            z-index: 2;
            position: relative;
            box-shadow: 0 0 0 #000;
            border: 1px solid #2497e3;
            height: 18px;
            width: 18px;
            border-radius: 25px;
            background: #a1d0ff;
            cursor: pointer;
        }
        /*--- /.price-range-slider ---*/

        table.table.table-striped.table-responsive {
            margin-top: 1rem;
        }
        hr {
            margin-top: 20px !important;
        }
    </style>
@endpush

@section('content')
    <div class="d-flex container" id="wrapper">
    @include('layouts.sidebar')
    <!-- Page Content -->
        <div id="page-content-wrapper" class="col-md-6">
            <div class="container-fluid row">
                <h1 class="mt-4">Browse Your Favorite Products</h1>
                <div class="range-slider">
                    <span>
                        <input type="number" value="25" min="0" max="500"/>
                        <input type="number" value="300" min="0" max="500"/>
                    </span>
                    <input name="min_price" value="25" min="0" max="500" step="10" type="range"/>
                    <input name="max_price" value="300" min="0" max="500" step="10" type="range"/>
                </div>
                <div class="col-md-6">
                    <form action="{{route('search.product')}}" method="POST" >
                        @csrf
                        <label class="form-label"> Title
                            <input type="text" name="title" class="form-control">
                        </label>
                        <label class="form-label"> Category
                            <select name="category" id="category" class="form-select category_select">
                                @if($categories->isEmpty())
                                    <option value="none">No Category Found</option>
                                @else
                                    <option value="">---- Select ----</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </label>
                        <label class="form-label"> Subcategory
                            <select name="subcategory" id="subcategory" class="form-select">

                            </select>
                        </label>
                        <button type="submit">Search</button>

                    </form>
                </div>
                <hr>
                <table class="table table-striped table-responsive">
                    <thead>
                    <tr class="text-center">
                        <th>Sl No</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Subcategory</th>
                        <th>Price</th>
                        <th>Thumbnail</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=1)
                    @foreach( $products as $product)
                        <tr class="text-center">
                            <td>{{ $i++ }}</td>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->subcategory->title }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->thumbnail }}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
@endsection
@push('custom-script')

    <script>

        $('#category').change(function (e) {
            category = $(this).val();
            if (category > 0){
                //get subcategories as subcategory
                $.get('{{route('subcategory.get')}}', {category:category}, function (response) {

                    if (response.data){
                        $('#subcategory').html('<option value="">---- Select ----</option>');
                        for (i in response.data){
                            //get subcategories
                            subcategories = response.data[i];
                            $('#subcategory').append('<option value="'+subcategories.id+'">'+subcategories.title+'</option>')
                        }
                    }
                })
            }

        });
    </script>

    <script>
        (function() {

            var parent = document.querySelector(".range-slider");
            if(!parent) return;

            var
                rangeS = parent.querySelectorAll("input[type=range]"),
                numberS = parent.querySelectorAll("input[type=number]");

            rangeS.forEach(function(el) {
                el.oninput = function() {
                    var slide1 = parseFloat(rangeS[0].value),
                        slide2 = parseFloat(rangeS[1].value);

                    if (slide1 > slide2) {
                        [slide1, slide2] = [slide2, slide1];
                        // var tmp = slide2;
                        // slide2 = slide1;
                        // slide1 = tmp;
                    }

                    numberS[0].value = slide1;
                    numberS[1].value = slide2;
                }
            });

            numberS.forEach(function(el) {
                el.oninput = function() {
                    var number1 = parseFloat(numberS[0].value),
                        number2 = parseFloat(numberS[1].value);

                    if (number1 > number2) {
                        var tmp = number1;
                        numberS[0].value = number2;
                        numberS[1].value = tmp;
                    }

                    rangeS[0].value = number1;
                    rangeS[1].value = number2;

                }
            });

        })();
    </script>
@endpush

