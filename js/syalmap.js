// Initialize and add the map
let map;
let featureLayer;
async function initMap() {
    console.log("this is map function");
  // The location of Uluru
  const position = { lat: 42.172146, lng: -77.251008 }; 
  // Request needed libraries.
  //@ts-ignore
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

  // The map, centered at Uluru
  map = new Map(document.getElementById("map"), {
    zoom: 7,
    center: position,
   
    
  });
  
  var kmlFile = pluginData.kmlUrl;

  console.log('KML File URL:', kmlFile);
  
  const kmlLayer = new google.maps.KmlLayer({
      url: kmlFile,
      map: map,
  });
  
  // Listen for KML layer status events
  google.maps.event.addListener(kmlLayer, 'status_changed', function () {
      console.log('KML Layer Status:', kmlLayer.getStatus());
  });
  
  // Listen for KML layer errors
  google.maps.event.addListener(kmlLayer, 'error', function (event) {
      console.error('KML Layer Error:', event);
  });
  
}

initMap();