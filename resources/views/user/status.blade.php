@extends('master.user.index')

@section('title','Status')
    
@section('content')
<div class="ftco-blocks-cover-1">
    <div class="ftco-cover-1 overlay innerpage" style="background-image: url('user/images/hero_2.jpg')">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 text-center">
                    <h1>Status History</h1>
                    <p>Riwayat Penyewaan Kendaraan Anda</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-section bg-light">
    <div class="container">
        <div class=" d-flex justify-content-center">
            <h1>
                <b>LIST HISTORY ORDER</b>
            </h1>
        </div>
        @forelse ($orders as $item)
        <div class="card mb-3">
            <h5 class="card-header">Code Booking  - {{ $item->order_code }}</h5>
            <div class="card-body">
                <h5 class="card-title">
                    <b>
                        <i>
                            {{ $item->Car->Brands->brand_name }} - {{ $item->Car->car_name }} - {{ $item->Car->Types->type_name }}
                        </i>
                    </b>
                </h5>
                <p class="card-text">Date Order : {{ $item->order_start }} - {{ $item->order_end }}</p>
                @php
                    $start_date = strtotime( $item->order_start); 
                    $end_date = strtotime( $item->order_end); 

                    $diff = $end_date - $start_date;

                    $days = $diff / 60 / 60 / 24;
                @endphp
                <p class="card-text">Total Price : <b>Rp. {{number_format($days * $item->Car->car_price,2,",",'.')}}</b></p>
                <p class="card-text">Booking Status : {{ $item->order_status }} </p>
                
                @if ($item->order_status == 'booking')
                    <a href="#" class="btn btn-primary" onclick="upload('{{ $item->id }}')">Upload Payment</a>
                @else
                    <span class="badge badge-info">Paid</span>
                @endif
            </div>
        </div>
        @empty
            <div class=" d-flex justify-content-center">
                <h1>
                    You Don't Have History
                </h1>
            </div>
        @endforelse
    </div>
</div>

<div class="modal" id="modal" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="file">Upload File</label>
                                <input class="my-pond" placeholder="Upload File"
                                    id="file" name="file">
                            </div>
                            <div class="invalid-feedback" id="file_alert"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-save">Upload</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $.fn.filepond.registerPlugin(FilePondPluginImagePreview);

    $('#status').addClass('active');

    const upload = (id) => {
        $('.my-pond').filepond();
        $('#btn-save').attr('onclick',`uploadProcess('${id}')`)
        $('#modal').modal('show');
    }

    const uploadProcess = (id) => {
        let file = $(`.my-pond`).filepond('getFiles');
            let formData = new FormData($('#form').get(0));
            if (file.length != 0) {
                formData.append('file', file[0].file, file[0].file.name);
                formData.append('id', id);

                $.ajax({
                    type: "POST",
                    url: "{{ url('upload-transfer') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    enctype: 'multipart/form-data',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (res) => {
                        Swal.fire(
                            'Good job!',
                            res.message,
                            res.status
                        ).then(function() {
                            window.location.reload();
                        });
                        $('#modal').modal('hide');
                    },
                    error: (res) => {
                        errorHandle(res)
                    },
                })
            }else{
                sweetError('Please Upload File')
            }
    }
</script>
@endsection