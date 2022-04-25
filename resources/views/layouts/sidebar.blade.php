@push('custom-style')
    <style>
        body {
            overflow-x: hidden;
        }

        #sidebar-wrapper {
            min-height: 100vh;
            margin-left: -15rem;
            -webkit-transition: margin .25s ease-out;
            -moz-transition: margin .25s ease-out;
            -o-transition: margin .25s ease-out;
            transition: margin .25s ease-out;
        }

        #sidebar-wrapper .list-group {
            width: 15rem;
        }

        #wrapper.toggled #sidebar-wrapper {
            margin-left: 0;
        }
        .side-list li {
            list-style: none;
        }

        @media (min-width: 768px) {
            #sidebar-wrapper {
                margin-left: 0;
            }

            #wrapper.toggled #sidebar-wrapper {
                margin-left: -15rem;
            }
        }
    </style>
@endpush
<!-- Sidebar -->
<div class="bg-light border-right col-md-3" id="sidebar-wrapper">
    <div class="list-group list-group-flush">
        <a href="{{url('/home')}}" class="list-group-item list-group-item-action bg-light">Dashboard</a>
        <a href="{{url('/manage-category')}}" class="list-group-item list-group-item-action bg-light">Categories</a>
        <ul class="side-list">
            <li><a href="{{url('/add-category')}}">Add Category</a></li>
        </ul>
        <a href="{{url('/manage-subcategory')}}" class="list-group-item list-group-item-action bg-light">Subcategories</a>
        <ul class="side-list">
            <li><a href="{{url('/add-subcategory')}}">Add Subcategory</a></li>
        </ul>
        <a href="#" class="list-group-item list-group-item-action bg-light">Products</a>
        <ul class="side-list">
            <li><a href="#">Add Product</a></li>
        </ul>
    </div>
</div>
<!-- /#sidebar-wrapper -->
