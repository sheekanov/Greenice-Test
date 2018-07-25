var map;
var geocoder;
var marker;

//инициализация карты
function initMap() {
    var latlng;

    //если мы в интерфейсе редактирования места (и у нас уже заданы координаты места), то позиционируем карту на заданные координаты
    if ($('#lat').val() != '') {
        latlng = new google.maps.LatLng($('#lat').val(), $('#long').val());
        marker = new google.maps.Marker({position: latlng});
    } else {
        latlng = new google.maps.LatLng(44.616650, 33.525367); //это просто координаты Севастополя, сюда будет позиционироваться карта при открытии интерфейса создания места
    }

    var mapOptions = {
        zoom: 14,
        center: latlng
    };

    map = new google.maps.Map(document.getElementById('map'), mapOptions);
    geocoder = new google.maps.Geocoder();

    //добавляем маркет на карту, если мы в интерфейсе редактирования места
    if (typeof marker !== 'undefined') {
        marker.setMap(map);
    }
}

//на нажатию кнопки Search осуществляется преобразование адреса в гео-координаты
$(document).ready(function(){
    $('#search').on('click', function (e) {
        e.preventDefault();
        var address =$('#address').val();

        geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == 'OK') {
                if (typeof marker !== 'undefined') {  //если маркер на карте уже существует, то удаляем его
                    marker.setMap(null);
                }

                map.setCenter(results[0].geometry.location);
                marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
                //записываем координаты в скрытые поля ввода, чтобы при сохранении места передать их серверу
                $('#lat').val(Math.round(results[0].geometry.location.lat()*1000000)/1000000);
                $('#long').val(Math.round(results[0].geometry.location.lng()*1000000)/1000000);
            } else {
                alert('Location not found: ' + status);
                $('#lat').val(null);
                $('#long').val(null);
            }
        });
    });
});

