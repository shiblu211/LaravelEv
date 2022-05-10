@extends('layouts.app')

@section('content')
    <div class="d-flex container" id="wrapper">
    @include('layouts.sidebar')
    <!-- Page Content -->
        <div id="page-content-wrapper" class="col-md-6">
            <div class="container-fluid">
                <div class="card-body">
                    <form id="AddProductForm">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title <sup> *</sup> : </label>
                            <input type="text" id="title" value="{{ old('title') }}"
                                   name="title" class="form-control "
                                   placeholder="Title">
                            <span class="text-danger" id="titleErrorMsg"></span>
                        </div>
                        <div class="mb-3">
                                <label for="description" class="form-label"> Description <sup> *</sup> : </label>
                                <input type="text" id="description" name="description" class="form-control"
                                placeholder="Description">
                            <span class="text-danger" id="descriptionErrorMsg"></span>
                        </div>
                        <div class="mb-3">
                            <label for="subcategory" class="form-label">Subcategory <sup> *</sup> : </label>
                            <select name="subcategory" id="subcategory">
                                @foreach($subcategories as $subcategory)
                                    <option value="{{$subcategory->id}}">{{$subcategory->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label"> Price <sup> *</sup> : </label>
                            <input type="text" id="price" name="price" class="form-control"
                                   placeholder="Description">
                            <span class="text-danger" id="priceErrorMsg"></span>
                        </div>
                        <div class="mb-3">
                            {{--Todo image upload--}}
                            <label for="thumbnail" class="form-label"> Thumbnail <sup> *</sup> : </label>
                            <input type="text" id="thumbnail" name="thumbnail" class="form-control"
                                   placeholder="Description">
                            <span class="text-danger" id="thumbnailErrorMsg"></span>
                        </div>
                        <button id="submit" type="submit" class="btn btn-primary">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
@endsection
@push('custom-script')
    <script type="text/javascript">
        $('#AddProductForm').on('submit',function(e){
            e.preventDefault();

            /** submit button disabled when submission in progress */
            let submitBtn = $('#submit')
            submitBtn.attr('disabled', 'true')
            submitBtn.css('cursor' , 'no-drop')

            /** Get values from form */
            let title = $('#title').val();
            let description = $('#description').val();
            let subcategory_id = $('#subcategory').val();
            let price = $('#price').val();
            let thumbnail = $('#thumbnail').val();

            /** ajax start */
            $.ajax({
                url: "/store-product",
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    title:title,
                    description:description,
                    subcategory_id:subcategory_id,
                    price:price,
                    thumbnail:thumbnail,
                },

                /** After Successful Submission */
                success:function(){
                    location.reload();
                    Swal.fire({
                        icon: 'success',
                        title: 'Done',
                        text: 'Category Added Successful!',
                        timer: 3000,
                        timerProgressBar: true
                    })
                },

                /** if any error appears */
                error: function(response) {

                    /** clear previous error message */
                    const errorMessage = document.querySelectorAll('.text-danger')
                    errorMessage.forEach((element) => element.textContent = '')

                    /** show error messages */
                    if (response.requestText != "") {
                        $('#titleErrorMsg').text(response.responseJSON.errors.title);
                        $('#descriptionErrorMsg').text(response.responseJSON.errors.description);
                        $('#priceErrorMsg').text(response.responseJSON.errors.price);
                        $('#thumbnailErrorMsg').text(response.responseJSON.errors.thumbnail);


                        /** submit button enable for re submission */
                        submitBtn.removeAttr('disabled')
                        submitBtn.css('cursor' , 'pointer')

                    }
                }, /** error end*/
            }); /** ajax end */
        });
    </script>
@endpush
