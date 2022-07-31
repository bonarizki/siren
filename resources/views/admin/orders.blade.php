@extends('master.admin.index')

@section('title', 'Master Order')

@section('content')
    <!-- Table Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <div class="row">
                        <div class="col-md-6 d-flex justify-content-start align-items-center">
                            <h6 class="mb-2">Order Rental</h6>
                        </div>
                    </div>
                    <div class="">
                        <table class="table table-bordered table-hover" id="table" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col" rowspan="2" class="align-middle">#</th>
                                    <th scope="col" rowspan="2" class="align-middle">Order Code</th>
                                    <th scope="col" rowspan="2" class="align-middle">Order By</th>
                                    <th scope="col" rowspan="2" class="align-middle">Car Brand</th>
                                    <th scope="col" rowspan="2" class="align-middle">Car Name</th>
                                    <th scope="col" rowspan="2" class="align-middle">Car Type</th>
                                    <th scope="col" rowspan="2" class="align-middle">Order Start</th>
                                    <th scope="col" rowspan="2" class="align-middle">Order End</th>
                                    <th scope="col" rowspan="2" class="align-middle">Order Status</th>
                                    <th scope="col" colspan="3"><center>Action<center></th>
                                </tr>
                                <tr>
                                    <th scope="col"><center>Verifikasi<center></th>
                                    <th scope="col"><center>Delete<center></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form Start -->
                    <form id="form">
                        <div class="container-fluid pt-4 px-4">
                            <div class="row g-4">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="bg-light rounded h-100 p-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="order_code" name="order_code"
                                                placeholder="Order Code" readonly>
                                            <label for="order_code">Order Code</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="brand_name" name="brand_name"
                                                placeholder="Brand" readonly>
                                            <label for="brand_name">Brand Car</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="type_name" name="type_name"
                                                placeholder="Type Car" readonly>
                                            <label for="type_name">Type Car</label>
                                        </div>
                                        <div class="row">
                                            <din class="col-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="order_start" name="order_start"
                                                        placeholder="Rental Start" readonly>
                                                    <label for="order_start">Rental Start</label>
                                                </div>
                                            </din>
                                            <din class="col-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="order_end" name="order_end"
                                                        placeholder="Rental Start" readonly>
                                                    <label for="order_end">Rental End</label>
                                                </div>
                                            </din>
                                        </div>
                                        <div class="row">
                                            <din class="col-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="price_day" name="price_day"
                                                        placeholder="Price" readonly>
                                                    <label for="price_day">Price</label>
                                                </div>
                                            </din>
                                            <din class="col-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="total_bayar" name="total_bayar"
                                                        placeholder="Total" readonly>
                                                    <label for="total_bayar">Total</label>
                                                </div>
                                            </din>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="car_image">Booking Status</label>
                                            <select name="order_status" id="order_status" class="form-control">
                                                <option value="payment">Payment</option>
                                                <option value="done">Done</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="car_image">File Transaksi</label>
                                            <input type="text" class="form-control" id="file" name="file"
                                                placeholder="File Transaksi" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Form End -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submit">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Table End -->
@endsection

@section('script')
    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.registerPlugin(FilePondPluginGetFile);


        $(document).ready(function () {
            $('#order').addClass('active');
            $('#table').DataTable({
                ajax : {
                    url : "{{ url('orders') }}",
                    method : "get",
                },
                destroy : true,
                serverSide : true,
                columns : [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex"
                },
                {
                    data: "order_code",
                    name: "order_code"
                },
                {
                    data: "user.name",
                    name: "user.name"
                },
                {
                    data: "car.brands.brand_name",
                    name: "car.brands.brand_name"
                },
                {
                    data: "car.car_name",
                    name: "car.car_name"
                },
                {
                    data: "car.types.type_name",
                    name: "car.types.type_name"
                },
                {
                    data: "order_start",
                    name: "order_start"
                },
                {
                    data: "order_end",
                    name: "order_end"
                },
                {
                    data: "order_status",
                    name: "order_status"
                },
                {
                    data:"id",
                    name:"id",
                    render : (data,meta,row) => {
                        if (row.order_status == 'payment') {
                            return `<center>
                                        <span class='bi bi-pencil-square' onclick="showModal('edit','${data}')"></span>
                                    </center>`;
                        }else{
                            return `<center>
                                        <span class='bi bi-lock'></span>
                                    </center>`;
                        }
                    }
                },
                {
                    data:"id",
                    name:"id",
                    render : (data) => {
                        return `<center>
                                    <span class='bi bi-trash' onclick="alertDelete('${data}')"></span>
                                </center>`;
                    }
                }]
            })
        });

        const showModal = (type,id = null) => {
            $('.is-invalid').removeClass('is-invalid')
            $('#form')[0].reset()
            if (type == 'add') {
                $('.modal-title').text('Form Add Orders');
                $('#modal').modal('show');
                $('#submit').attr('onclick','add()')
            }else{
                $('.modal-title').text('Form Edit Orders');
                edit(id)
            }
        }

        const edit = (id) => {
            $.ajax({
                type : "get",
                url : `{{ url('orders') }}/${id}/edit`,
                success : (res) => {
                    let data = res.data
                    $('#order_code').val(data.order_code);
                    $('#brand_name').val(data.car.brands.brand_name);
                    $('#type_name').val(data.car.types.type_name);
                    $('#order_start').val(data.order_start);
                    $('#order_end').val(data.order_end);
                    $('#order_status').val(data.order_status);
                    $('#price_day').val(formatRupiahReturn(`'${data.car.car_price}'`));
                    date1 = new Date(data.order_start)
                    date2 = new Date(data.order_end)
                    dayDiff = parseInt((date2 - date1) / (1000 * 60 * 60 * 24), 10);
                    $('#total_bayar').val(formatRupiahReturn(`'${data.car.car_price * dayDiff}'`));
                    $('#file').filepond({
                        name: 'filepond',
                        labelButtonDownloadItem: 'custom label', // by default 'Download file'
                        allowDownloadByUrl: false, // by default downloading by URL disabled
                    });
                    $('#file').filepond('removeFiles');
                    showImage(data)

                },
                complete : () => {
                    $('#modal').modal('show');
                    $('#submit').attr('onclick',`update('${id}')`);
                }
            })
        }

        const showImage = (data) => {
            $('#file').filepond();
            if (data.file_pembayaran != null) {
                $('#file').filepond('addFile', `{{asset('file_upload/transaksi_file/${data.file_pembayaran}')}}`)
                .then(function(file){

                });
            }
        }

        const update = (id) => {
            let data = $('#form').serialize();
            $.ajax({
                type : "PATCH",
                url : "{{ url('orders') }}/" + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : data,
                success : (res) => {
                    sweetSuccess(res.status,res.message)
                    $(`#table`).DataTable().ajax.reload();
                    $('#modal').modal('hide');
                    $('#form')[0].reset();
                },
                error : (res) => {
                    errorHandle(res)
                },
            })
        }

        const alertDelete = (id) => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    deleteProcess(id)
                }
            })
        }

        const deleteProcess = (id) => {
            $.ajax({
                type : "delete",
                url : "{{ url('orders') }}/" + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success : (res) => {
                    sweetSuccess(res.status,res.message)
                },
                error : (res) => {
                    errorHandle(res)
                },
                complete : () => {
                    $(`#table`).DataTable().ajax.reload();
                    $('#form')[0].reset()
                }
            })
        }
    </script>
@endsection