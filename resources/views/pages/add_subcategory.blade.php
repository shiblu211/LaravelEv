@extends('layouts.app')

@section('content')
    <div class="d-flex container" id="wrapper">
    @include('layouts.sidebar')
    <!-- Page Content -->
        <div id="page-content-wrapper" class="col-md-6">
            <div class="container-fluid">
                <div class="card-body">
                    <form id="AddSubcategoryForm">
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
                            <label for="category" class="form-label">Category <sup> *</sup> : </label>
                            <select name="category" id="category">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button id="submit" type="submit" class="btn btn-primary">Add Subcategory</button>
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
        $('#AddSubcategoryForm').on('submit',function(e){
            e.preventDefault();

            /** submit button disabled when submission in progress */
            let submitBtn = $('#submit')
            submitBtn.attr('disabled', 'true')
            submitBtn.css('cursor' , 'no-drop')

            /** Get values from form */
            let title = $('#title').val();
            let description = $('#description').val();
            let category_id = $('#category').val();

            /** ajax start */
            $.ajax({
                url: "/store-subcategory",
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    title:title,
                    description:description,
                    category_id:category_id
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

                        /** submit button enable for re submission */
                        submitBtn.removeAttr('disabled')
                        submitBtn.css('cursor' , 'pointer')

                    }
                }, /** error end*/
            }); /** ajax end */
        });
    </script>
@endpush
