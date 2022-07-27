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
                                    <th scope="col"><center>Edit<center></th>
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
                                            <input type="text" class="form-control" id="brand_name" name="brand_name"
                                                placeholder="Brand Name">
                                            <label for="brand_name">Brand Name</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="brand_code" name="brand_code"
                                                placeholder="Brand Code">
                                            <label for="brand_code">Brand Code</label>
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
                    render : (data) => {
                        return `<center>
                                    <span class='bi bi-pencil-square' onclick="showModal('edit','${data}')"></span>
                                </center>`;
                    }
                },
                {
                    data:"id",
                    name:"id",
                    render : (data) => {
                        return `<center>
                                    <span class='bi bi-pencil-square' onclick="showModal('edit','${data}')"></span>
                                </center>`;
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
                    $('#brand_name').val(res.data.brand_name);
                    $('#brand_code').val(res.data.brand_code);
                },
                complete : () => {
                    $('#modal').modal('show');
                    $('#submit').attr('onclick',`update('${id}')`);
                }
            })
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