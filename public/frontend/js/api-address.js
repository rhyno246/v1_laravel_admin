function getCountry() {
    $.ajax({
        type: 'get',
        headers: {
            "Accept": "application/json",
        },
        url: 'https://provinces.open-api.vn/api/',
        dataType: "json",
        processData: false,
        contentType: false,
        success: function(data) {
            data.forEach(element => {
                $('#city').append('<option value="' + element.code + '">' + element.name +
                    '</option>')
            });
        },
        crossDomain: true,
        error: function(error) {
            console.log(error)
        },
    })
}

function getState() {
    let country_code = $('#city').val();
    $.ajax({
        type: 'get',
        headers: {
            "Accept": "application/json",
        },
        url: `https://provinces.open-api.vn/api/p/${country_code}?depth=2`,
        dataType: "json",
        processData: false,
        contentType: false,
        success: function(data) {
            $('#state :gt(0)').remove();
            data.districts.forEach(element => {
                $('#state').append('<option value="' + element.code + '">' + element.name +
                    '</option>')
            });
        },
        crossDomain: true,
        error: function(error) {
            console.log(error)
        },
    })
}

function getStateAddress() {
    let state_address = $('#state').val();
    $.ajax({
        type: 'get',
        headers: {
            "Accept": "application/json",
        },
        url: `https://provinces.open-api.vn/api/d/${state_address}?depth=2`,
        dataType: "json",
        processData: false,
        contentType: false,
        success: function(data) {
            $('#state_address :gt(0)').remove();
            data.wards.forEach(element => {
                $('#state_address').append('<option value="' + element.code + '">' + element
                    .name + '</option>')
            });
        },
        crossDomain: true,
        error: function(error) {
            console.log(error)
        },
    })
}


$(document).ready(function() {
    getCountry();
    $(".js-city").select2({
        placeholder: "Chọn thành phổ",
        allowClear: true
    });
    $(".js-state").select2({
        placeholder: "Chọn huyện",
        allowClear: true
    });
    $(".js-state_address").select2({
        placeholder: "Chọn xã",
        allowClear: true
    });
})
$('#city').on('change', function() {
    getState();
})
$('#state').on('change', function() {
    getStateAddress();
})