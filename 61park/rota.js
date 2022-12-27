function calculateRoute() {
    // Başlangıç ve bitiş konumlarını alma
    var start = document.getElementById("start").value;
    var end = document.getElementById("end").value;
  
    // Yandex Maps API'sini kullanarak en kısa yolu hesaplama
    ymaps.route([start, end]).then(function (route) {
      var distance = route.getLength(); // Yolun uzunluğunu alın (km cinsinden)
      var time = route.getTime(); // Yolculuğun süresini alın (dk cinsinden)
  
      // Yolculuğun detaylarını gösterin
      alert("Yolculuğun mesafesi: " + distance + " km\nYolculuğun süresi: " + time + " dakika");
  
      // Haritada en kısa yolu gösterin
      var map = new ymaps.Map("map", {
        center: start,
        zoom: 7
      });
      map.geoObjects.add(route);
    });
  }
  