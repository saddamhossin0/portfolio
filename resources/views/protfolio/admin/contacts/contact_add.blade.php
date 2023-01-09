@extends('protfolio.admin.master')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Contact Form Data</h5>

                        <!-- General Form Elements -->
                        <form id="contact_data">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Full Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="full_name" id="full_name" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-10">
                                    <input type="text" name="phone" id="phone" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" name="email" id="email" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Messages</label>
                                <div class="col-sm-10">
                                    <input type="text" name="messages" id="messages" class="form-control">
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
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Messages</th>
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
        contactShow() ;

            $(document).on('submit', '#contact_data', function(event) {
                event.preventDefault();

                let About_data = new FormData($('#contact_data')[0]);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: `/contact/store/`,
                    data: About_data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $("#contact_data").trigger("reset");
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        contactShow();

                    },
                });
            });


            function contactShow() {

                $.ajax({
                    type: "GET",
                    url: `/contact/show/`,
                    success: function(response) {
                        var s = '';
                        var total = 1;
                        $('#tableInfo').empty()
                        $.each(response, function(key, value) {
                            s += `
                            <tr style="" class="footable-even">
                                <td><span class="footable-toggle"></span>${total++}</td>
                                <td>${value.full_name}</td>
                                <td>${value.phone }</td>
                                <td>${value.email }</td>
                                <td>${value.messages }</td>
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
