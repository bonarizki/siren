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

function getDiffDays(start,end)
{
    date1 = new Date(start.format('YYYY-MM-DD'))
    date2 = new Date(end.format('YYYY-MM-DD'))
    dayDiff = getDifferenceInDays(date1,date2)
    return dayDiff
}