let map;

async function initMap() {
  // The location of Uluru
  const position = { lat: 41.140762375, lng: 1.1165606874999998 };
  // Request needed libraries.
  //@ts-ignore
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerView } = await google.maps.importLibrary("marker");

  // The map, centered at Uluru
  map = new Map(document.getElementById("map"), {
    zoom: 11,
    center: position,
    mapId: "DEMO_MAP_ID",
  });

  // The marker, positioned at Uluru
  const cookies=document.cookie.split('; ');
  const cookieObj={};
  cookies.forEach(cookie =>{
    const [name, value]=cookie.split('=')
    cookieObj[name]=value;
  });

  for (const name in cookieObj) {
    if (Object.hasOwnProperty.call(cookieObj, name)) {
        const element = cookieObj[name];
        const [latitud,longitud]=element.split(',')
        const lat=parseFloat(latitud)
        const lng=parseFloat(longitud)

        console.log(lat, lng)

        const marker = new AdvancedMarkerView({
            map: map,
            position: {lat:lat, lng:lng},
            title: name,
        });
    }
  }

}

initMap();
