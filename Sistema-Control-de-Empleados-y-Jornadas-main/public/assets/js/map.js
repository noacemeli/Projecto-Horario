const form = document.getElementById('entrada');

function setCookie(name, value, hoursToExpire) {
  let now = new Date();
  let time = now.getTime();
  time += hoursToExpire * 60 * 60 * 1000;
  now.setTime(time);
  document.cookie = `${name}=${value}; expires=${now.toUTCString()}; path=/`;
}

function getCurrentPosition() {
  return new Promise((resolve, reject) => {
    if ("geolocation" in navigator) {
      navigator.geolocation.getCurrentPosition(resolve, reject);
    } else {
      reject(new Error("La geolocalización no está disponible en este navegador."));
    }
  });
}

form.addEventListener('submit', async function geoposition(event) {
  event.preventDefault();

  try {
    const position = await getCurrentPosition();
    const latitude = position.coords.latitude;
    const longitude = position.coords.longitude;

    // Crear una cookie que dure 24 horas para almacenar la geolocalización
    setCookie('nombreUsuario', `${latitude},${longitude}`, 24);
    console.log("Geolocalización almacenada en la cookie.");
    form.submit();
  } catch (error) {
    console.error("Error al obtener la geolocalización:", error);
  }
});
