<!DOCTYPE html>
<html>
  <head>
  <style>
  
  #map {
    width: 100%;
    height: 300px;
   
  }
  </style>
   
  </head>
  <body>
    <div id="map"></div>

    <script>
      function initMap() {
        var mapOptions = {
          center: new google.maps.LatLng(10.83756311333107, 106.6567879953455), // Tọa độ của trung tâm Hồ Chí Minh
          zoom: 30, // Độ phóng to ban đầu của bản đồ
          mapTypeId: google.maps.MapTypeId.ROADMAP // Loại bản đồ
        };
        var map = new google.maps.Map(document.getElementById("map"), mapOptions);
      }
    </script>

    <!-- Thay YOUR_API_KEY bằng API key của bạn -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCg6mnpzs8wMSQnS4LhJNbjsTzDspUcXRM&callback=initMap" async defer></script>
  </body>
</html>
