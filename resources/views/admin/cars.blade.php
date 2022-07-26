@extends('master.admin.index')

@section('title', 'Master Brand')

@section('content')
    <!-- Table Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <div class="row">
                        <div class="col-md-6 d-flex justify-content-start align-items-center">
                            <h6 class="mb-2">Master Cars</h6>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end align-items-center">
                            <button class="btn btn-primary m-2" onclick="showModal('add')">
                                <i class="fa fa-plus me-2"></i>
                                Add Cars
                            </button>
                        </div>
                    </div>
                    <div class="">
                        <table class="table table-bordered table-hover" id="table" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col" rowspan="2" class="align-middle">#</th>
                                    <th scope="col" rowspan="2" class="align-middle">Cars Name</th>
                                    <th scope="col" rowspan="2" class="align-middle">Cars Brand</th>
                                    <th scope="col" rowspan="2" class="align-middle">Cars Type</th>
                                    <th scope="col" rowspan="2" class="align-middle">Cars Seat</th>
                                    <th scope="col" rowspan="2" class="align-middle">Cars Price</th>
                                    <th scope="col" colspan="2"><center>Action<center></th>
                                </tr>
                                <tr>
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
                    <form id="form" enctype="multipart/form-data">
                        @csrf
                        <div class="container-fluid pt-4 px-4">
                            <div class="row g-4">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="bg-light rounded h-100 p-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="car_name" name="car_name"
                                                placeholder="Cars Name">
                                            <label for="car_name">Cars Name</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select name="brand_id" id="brand_id" class="form-control">
                                                <option value="">Choosee . . </option>
                                            </select>
                                            <label for="brand_id">Cars Brand</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select name="type_id" id="type_id" class="form-control">
                                                <option value="">Choosee. . .</option>
                                            </select>
                                            <label for="type_id">Type Cars</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="car_seat" name="car_seat"
                                                placeholder="Cars Seat">
                                            <label for="car_seat">Cars Seat</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="car_price" name="car_price"
                                                placeholder="Cars Seat" onkeyup="formatRupiah(this)">
                                            <label for="car_price">Cars Price</label>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="car_image">Cars Image</label>
                                            <input type="text" class="form-control" id="car_image" name="car_image"
                                                placeholder="Cars Image">
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
        $.fn.filepond.registerPlugin(FilePondPluginImagePreview);

        $(document).ready(function () {
            $('#master').addClass('active');

            $('#master-car').addClass('active');

            getBrands();

            getTypes();

            $('#table').DataTable({
                ajax : {
                    url : "{{ url('cars') }}",
                    method : "get",
                },
                destroy : true,
                serverSide : true,
                columns : [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex"
                },
                {
                    data: "car_name",
                    name: "car_name"
                },
                {
                    data: "brands.brand_name",
                    name: "brands.brand_name"
                },
                {
                    data: "types.type_name",
                    name: "types.type_name"
                },
                {
                    data: "car_seat",
                    name: "car_seat"
                },
                {
                    data: "car_price",
                    name: "car_price",
                    render : (data) => {
                        return formatRupiahReturn(data)
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
            $('#car_image').filepond();
            $('#car_image').filepond('removeFiles');
            $('.is-invalid').removeClass('is-invalid')
            $('#form')[0].reset()
            if (type == 'add') {
                $('.modal-title').text('Form Add Brand');
                $('#modal').modal('show');
                $('#submit').attr('onclick','add()')
            }else{
                $('.modal-title').text('Form Edit Brand');
                edit(id)
            }
        }

        const add = () => {
            let file = $(`#car_image`).filepond('getFiles');
            let formData = new FormData($('#form').get(0));
            if (file.length != 0) {
                formData.append('image',file[0].file,file[0].file.file_name);
            }
            
            $.ajax({
                type : "POST",
                url : "{{ url('cars') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data : formData,
                dataType: "json",
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                success : (res) => {
                    sweetSuccess(res.status,res.message)
                    $(`#table`).DataTable().ajax.reload();
                    $('#modal').modal('hide');
                },
                error : (res) => {
                    errorHandle(res)
                },
            })
        }

        const edit = (id) => {
            $.ajax({
                type : "get",
                url : `{{ url('cars') }}/${id}/edit`,
                success : (res) => {
                    $('#car_name').val(res.data.car_name);
                    $('#brand_id').val(res.data.brand_id);
                    $('#type_id').val(res.data.type_id);
                    $('#car_seat').val(res.data.car_seat);
                    $('#car_price').val(res.data.car_price);
                    showImage(res.data)
                },
                complete : () => {
                    $('#modal').modal('show');
                    $('#submit').attr('onclick',`update('${id}')`);
                }
            })
        }

        const update = (id) => {
            let file = $(`#car_image`).filepond('getFiles');
            let data = $('#form').get(0)
            let formData = new FormData(data);
            if (file.length != 0) {
                formData.append('image',file[0].file,file[0].file.name);
            }
            formData.append('id',id);
            $.ajax({
                type : "post",
                url : "{{ url('cars-update') }}",
                data:formData,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success : (res) => {
                    sweetSuccess(res.status,res.message)
                    $(`#table`).DataTable().ajax.reload();
                    $('#modal').modal('hide');
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
                url : "{{ url('cars') }}/" + id,
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

        const getBrands = () => {
            $.ajax({
                type : "get",
                url : "{{ url('brand') }}",
                success : (res) => {
                    let data = res.data;
                    let option = ''
                    data.forEach(el => {
                        option += `<option value="${el.id}">${el.brand_name}</option>`
                    });
                    $('#brand_id').append(option);
                }
            })
        }

        const getTypes = () => {
            $.ajax({
                type : "get",
                url : "{{ url('type') }}",
                success : (res) => {
                    let data = res.data;
                    let option = ''
                    data.forEach(el => {
                        option += `<option value="${el.id}">${el.type_name}</option>`
                    });
                    $('#type_id').append(option);
                }
            })
        }

        const showImage = (data) => {
            $('#car_image').filepond();
            if (data.car_image != null) {
                $('#car_image').filepond('addFile', `{{asset('file_upload/car_image/${data.car_image}')}}`)
                .then(function(file){

                });
            }
        }
    </script>
@endsection