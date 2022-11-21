var locations = [
    [
        "Queen Elizabeth Central Hospital",
        "-15.801597458153344, 35.02074545963088",
        "https://www.google.com/maps/place/Queen+Elizabeth+Central+Hospital/@-15.8020517,35.0185831,15.49z/data=!4m9!1m2!2m1!1shospital+near+Blantyre!3m5!1s0x18d845943c4567f7:0x90209604ea3b857f!8m2!3d-15.8021!4d35.0207!15sChZob3NwaXRhbCBuZWFyIEJsYW50eXJlkgEIaG9zcGl0YWw",
    ],
    [
        "Mwaiwanthu Private Hospital",
        "-15.784997129770295, 35.01699589927475",
        "https://www.google.com/maps/place/Mwaiwanthu+Private+Hospital,+Blantyre/@-15.7861301,35.0179171,17.37z/data=!4m5!3m4!1s0x18d84575324ea9ff:0xff389dcd002cfbb2!8m2!3d-15.7850835!4d35.0169589",
    ],
    [
        "Blantyre Adventist Hospital",
        "-15.782086985353361, 35.0033741698224",
        "https://www.google.com/maps/place/Blantyre+Adventist+Hospital/@-15.7822082,35.0016465,17z/data=!4m5!3m4!1s0x18d84505ac2ba60d:0xab09b2af0c55f759!8m2!3d-15.7822082!4d35.0033456",
    ],
    [
        "Kamuzu Central Hospital",
        "-13.97255012921029, 33.78777479972634",
        "https://www.google.com/maps/place/Kamuzu+Central+Hospital/@-13.9699558,33.7645187,14.46z/data=!4m9!1m2!2m1!1shospital+near+Lilongwe!3m5!1s0x1921d328a309122b:0x9d726ab8cac24d54!8m2!3d-13.9765527!4d33.7862381!15sChZob3NwaXRhbCBuZWFyIExpbG9uZ3dlWhgiFmhvc3BpdGFsIG5lYXIgbGlsb25nd2WSAQhob3NwaXRhbJoBI0NoWkRTVWhOTUc5blMwVkpRMEZuU1VObmRFcGZTVmxuRUFF",
    ],
    [
        "Daeyang Luke Hospital",
        "-13.870579321283326, 33.81077742410996",
        "https://www.google.com/maps/place/Daeyang+Luke+Hospital/@-13.8734219,33.799158,14.46z/data=!4m9!1m2!2m1!1shospital+near+Lilongwe!3m5!1s0x0:0x4ab780455ed1883d!8m2!3d-13.8761043!4d33.8087296!15sChZob3NwaXRhbCBuZWFyIExpbG9uZ3dlkgEIaG9zcGl0YWw",
    ],
    [
        "Mzuzu Central Hospital",
        "-11.4354816, 33.9936378",
        "https://www.google.com/maps/place/Mzuzu+Central+Hospital/@-11.4354816,33.9936378,15.52z/data=!4m9!1m2!2m1!1shospital+near+mzuzu!3m5!1s0x0:0x54a3b618474fb9d8!8m2!3d-11.4279!4d33.9955!15sChNob3NwaXRhbCBuZWFyIG16dXp1kgEIaG9zcGl0YWw",
    ],
    [
        "St Johns Hospital",
        "-11.4496736, 33.9928566",
        "https://www.google.com/maps/place/St+Johns+Hospital/@-11.4496736,33.9928566,14z/data=!4m9!1m2!2m1!1shospital+near+mzuzu!3m5!1s0x191d3a7bd3b06d05:0xed93429479b71c29!8m2!3d-11.4515186!4d34.0277156!15sChNob3NwaXRhbCBuZWFyIG16dXp1kgEIaG9zcGl0YWw",
    ],
    [
        "Zomba Central Hospital",
        "-15.400479526735039, 35.31229109366388",
        "https://www.google.com/maps/place/Zomba+Central+Hospital/@-15.4013277,35.3055963,15z/data=!4m9!1m2!2m1!1shospital+near+zomba!3m5!1s0x0:0x164984b729c090aa!8m2!3d-15.4013294!4d35.3123804!15sChNob3NwaXRhbCBuZWFyIHpvbWJhkgEIaG9zcGl0YWw",
    ],
    [
        "Mangochi District Hospital",
        "-14.474317413120314, 35.26619780058669",
        "https://www.google.com/maps/place/Mangochi+District+Hospital/@-14.476609,35.2697582,14.71z/data=!4m9!1m2!2m1!1shospital+near+Mangochi!3m5!1s0x0:0x9afc9d40b714c79!8m2!3d-14.4817894!4d35.2652292!15sChZob3NwaXRhbCBuZWFyIE1hbmdvY2hpkgEIaG9zcGl0YWw",
    ],
];

var geocoder;
var map;
var bounds = new google.maps.LatLngBounds();

function initialize() {
    map = new google.maps.Map(document.getElementById("map_canvas"), {
        center: new google.maps.LatLng(-15.803338, 35.046725),
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    });
    geocoder = new google.maps.Geocoder();

    for (i = 0; i < locations.length; i++) {
        geocodeAddress(locations, i);
    }
}
google.maps.event.addDomListener(window, "load", initialize);

function geocodeAddress(locations, i) {
    var title = locations[i][0];
    var address = locations[i][1];
    var url = locations[i][2];
    geocoder.geocode({
            address: locations[i][1],
        },

        function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var marker = new google.maps.Marker({
                    icon: "http://maps.google.com/mapfiles/ms/icons/blue.png",
                    map: map,
                    position: results[0].geometry.location,
                    title: title,
                    animation: google.maps.Animation.DROP,
                    address: address,
                    url: url,
                });
                infoWindow(marker, map, title, address, url);
                bounds.extend(marker.getPosition());
                map.fitBounds(bounds);
            } else {
                alert("geocode of " + address + " failed:" + status);
            }
        }
    );
}

function infoWindow(marker, map, title, address, url) {
    google.maps.event.addListener(marker, "click", function() {
        var html =
            "<div><h3>" +
            title +
            "</h3><p>" +
            address +
            "<br></div><a href='" +
            url +
            "'>View location</a></p></div>";
        point = new google.maps.InfoWindow({
            content: html,
            maxWidth: 350,
        });
        point.open(map, marker);
    });
}

function createMarker(results) {
    var marker = new google.maps.Marker({
        icon: "http://maps.google.com/mapfiles/ms/icons/blue.png",
        map: map,
        position: results[0].geometry.location,
        title: title,
        animation: google.maps.Animation.DROP,
        address: address,
        url: url,
    });
    bounds.extend(marker.getPosition());
    map.fitBounds(bounds);
    infoWindow(marker, map, title, address, url);
    return marker;
}