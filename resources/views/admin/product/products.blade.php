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

    <!-- Sweetalert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                  <h5 class="card-title">Total products</h5>
                                  <h3>{{ $totalProducts }}</h3>
                                </div>
                              </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                  <h5 class="card-title">Stocks</h5>
                                  <h3>{{ $totalQuantity }}</h3>
                                </div>
                              </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                  <h5 class="card-title">Average price</h5>
                                  <h3>{{ $averagePrice }}</h3>
                                </div>
                              </div>
                        </div>
                    </div>
                    <div class="row">
                        @if (session('success'))
                            <script>
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-right',
                                    iconColor: 'white',
                                    color: 'white',
                                    background: '#4CAF50',
                                    customClass: {
                                        popup: 'colored-toast',
                                    },
                                    showConfirmButton: false,
                                    timer: 2500,
                                    timerProgressBar: true,
                                });
                                Toast.fire({
                                    icon: 'success',
                                    title: '{{ session('success') }}',
                                });
                            </script>
                        @endif
                        @if (session('failed'))
                            <script>
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-right',
                                    iconColor: 'white',
                                    color: 'white',
                                    background: '#F44336',
                                    customClass: {
                                        popup: 'colored-toast',
                                    },
                                    showConfirmButton: false,
                                    timer: 2500,
                                    timerProgressBar: true,
                                });
                                Toast.fire({
                                    icon: 'error',
                                    title: '{{ session('failed') }}',
                                });
                            </script>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">{{ $title }}</h5>
                                    <div class="search d-flex justify-content-between align-items-center">
                                        <div class="search-bar">
                                            <form class="search-form d-flex align-items-center" method="GET"
                                                action="{{ route('admin.products') }}">
                                                <input type="text" name="search" placeholder="Search"
                                                    title="Enter search keyword" value="{{ $search }}">
                                                <button type="submit" title="Search"><i
                                                        class="bi bi-search"></i></button>
                                            </form>
                                        </div>
                                        <a href="{{ route('admin.add-product') }}" class="btn btn-primary">Add</a>
                                    </div>
                                </div>
                                <!-- Table with stripped rows -->
                                <table class="table table-bordered table-hover table-light">
                                    @if ($products->isEmpty())
                                        @if ($search)
                                            <p>No products found for your search</p>
                                        @else
                                            <p>No products have been added yet</p>
                                        @endif
                                    @else
                                        <thead class="table-primary">
                                            <tr>
                                                <th scope="col" style="width: 15%">Name</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Description</th>
                                                <th scope="col" style="width: 20%">Created by</th>
                                                <th scope="col" colspan="2" style="width: 25%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->category }}</td>
                                                    <td>{{ $product->price }}</td>
                                                    <td>{{ $product->available_item_count }}</td>
                                                    <td
                                                        title="{{ strlen($product->description) > 60 ? $product->description : '' }}">
                                                        {{ strlen($product->description) < 60 ? $product->description : substr($product->description, 0, 60) . '...' }}
                                                    </td>
                                                    <td>{{ $product->email }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.view-product', $product->id) }}"
                                                            class="btn btn-dark btn-sm">View</a>
                                                        <a href="{{ route('admin.edit-product', $product->id) }}"
                                                            class="btn btn-success btn-sm">Edit</a>
                                                        <form
                                                            action="{{ route('admin.delete-product', $product->id) }}"
                                                            method="post" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @endif
                                </table>
                                <!-- End Table with stripped rows -->
                                {{-- Display pagination links --}}
                                {{ $products->links('vendor.pagination.bootstrap-5') }}
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
