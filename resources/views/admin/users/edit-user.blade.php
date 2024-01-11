<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ $title }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/admin/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/admin/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    @include('admin.layouts.navbar')
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    @include('admin.layouts.sidebar')
    <!-- End Sidebar-->

    <!-- ======= Main ======= -->
    <main id="main" class="main">

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $title }}</h5>
                                <!-- Vertical Form -->
                                <form class="row g-3" action="{{ route('admin.update-product', $product->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="col-12">
                                        <label for="product" class="form-label">Product</label>
                                        <input type="text" class="form-control" name="product"
                                            value="{{ $product->name }}">
                                        @error('product')
                                            <span class="text-danger">{{ $errors->first('product') }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="category" class="form-label">Category <small class="text-primary" id="addCategoryLink" style="display: none"><a
                                            href="{{ route('admin.add-category') }}">Please add
                                            category</a></small></label>
                                        <select class="form-select" name="category">
                                            <option selected disabled>Select</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->name }}"
                                                    {{ $product->category == $category->name ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <span class="text-danger">{{ $errors->first('category') }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="text" class="form-control" name="price"
                                            value="{{ $product->price }}">
                                        @error('price')
                                            <span class="text-danger">{{ $errors->first('price') }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="text" class="form-control" name="quantity"
                                            value="{{ $product->available_item_count }}">
                                        @error('price')
                                            <span class="text-danger">{{ $errors->first('available_item_count') }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" name="description" style="height: 100px">{{ $product->description }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $errors->first('description') }}</span>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                        <a href="{{ route('admin.products') }}" class="btn btn-warning">Back</a>
                                    </div>
                                </form>
                                <!-- Vertical Form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div><!-- End Left side columns -->

            </div>
        </section>

    </main>
    <!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/admin/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/php-email-form/validate.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/admin/js/main.js') }}"></script>
</body>

</html>
