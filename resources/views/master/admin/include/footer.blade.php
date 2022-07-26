<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="admin/lib/chart/chart.min.js"></script>
<script src="admin/lib/easing/easing.min.js"></script>
<script src="admin/lib/waypoints/waypoints.min.js"></script>
<script src="admin/lib/owlcarousel/owl.carousel.min.js"></script>
<script src="admin/lib/tempusdominus/js/moment.min.js"></script>
<script src="admin/lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Template Javascript -->
<script src="admin/js/main.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- include FilePond library -->
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

<!-- include FilePond plugins -->
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>

<!-- include FilePond jQuery adapter -->
<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>

<script>
    const errorHandle = (response) => {
        if(response.responseJSON.errors==null){
            sweetError(response.responseJSON.message)
        }else{
            let fail = response.responseJSON.errors;
            let key = Object.keys(fail)
            loopingError(fail,key)
        }
    }

    sweetError = (message) => {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: message,
        })
    }

    sweetSuccess = (status,message) => {
        Swal.fire(
            'Good job!',
            message,
            status
        );
    }

    loopingError = (fail,key) => {
        $('.is-invalid').removeClass('is-invalid')
        for (let index = 0; index < key.length; index++) {
            if (fail.hasOwnProperty(`${key[index]}`)) {
                $(`#${key[index]}`).addClass('is-invalid');
                $(`#${key[index]}_alert`).text(fail[`${key[index]}`][0]);
                sweetError(fail[`${key[index]}`][0]);
            }
        }
    }

    function formatRupiah(data, prefix = 'Rp. '){
        let angka = data.value;
        let id = data.id;
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        $(`#${id}`).val(`${prefix}${rupiah}`);
    }

    function formatRupiahReturn(angka, prefix = 'Rp. '){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>