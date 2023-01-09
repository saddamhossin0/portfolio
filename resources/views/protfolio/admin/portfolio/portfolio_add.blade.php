@extends('protfolio.admin.master')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Portfolio Form Data</h5>

                        <!-- General Form Elements -->
                        <form id="port_data">
                            @csrf

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <input type="text" name="description" id="description" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="portfolio_img" id="portfolio_img">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Submit Button</label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit Portfolio</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>

            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Portfolio Form Data</h5>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody id="tableInfo">



                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection


@section('script')
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

    <script>
        portfolioShow() ;

            $(document).on('submit', '#port_data', function(event) {
                event.preventDefault();
                let portfolio_data = new FormData($('#port_data')[0]);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: `/portfolio/store/`,
                    data: portfolio_data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $("#port_data").trigger("reset");
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        portfolioShow();

                    },
                });
            });


            function portfolioShow() {

                $.ajax({
                    type: "GET",
                    url: `/portfolio/show/`,
                    success: function(response) {
                        var s = '';
                        var total = 1;
                        $('#tableInfo').empty()
                        $.each(response, function(key, value) {
                            s += `
                            <tr style="" class="footable-even">
                                <td><span class="footable-toggle"></span>${total++}</td>
                                <td>${value.name }</td>
                                <td>${value.description }</td>
                                <td><img src="${value.about_image}" alt="" border=3 height=100 width=100></img></td>
                                <td>
                                    <a href='#'>Edit</a>
                                    <a href="#">Delete</a>
                                </td>
                            </tr>
                            `;
                        });
                        $('#tableInfo').append(s);
                    },



                });
            }
    </script>
@endsection
