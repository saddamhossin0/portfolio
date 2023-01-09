@extends('protfolio.admin.master')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">About Form Data</h5>

                        <!-- General Form Elements -->
                        <form id="service_data">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" id="title" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Service</label>
                                <div class="col-sm-10">
                                    <input type="text" name="service" id="service" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Submit Button</label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit Service</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>

            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">About Form Data</h5>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Services</th>
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
        aboutShow() ;

            $(document).on('submit', '#service_data', function(event) {
                event.preventDefault();

                let About_data = new FormData($('#service_data')[0]);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: `/service/store/`,
                    data: About_data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $("#service_data").trigger("reset");
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        aboutShow();

                    },
                });
            });


            function aboutShow() {

                $.ajax({
                    type: "GET",
                    url: `/service/show/`,
                    success: function(response) {
                        var s = '';
                        var total = 1;
                        $('#tableInfo').empty()
                        $.each(response, function(key, value) {
                            s += `
                            <tr style="" class="footable-even">
                                <td><span class="footable-toggle"></span>${total++}</td>
                                <td>${value.title}</td>
                                <td>${value.name }</td>
                                <td>${value.service }</td>
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
