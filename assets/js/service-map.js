document.addEventListener("DOMContentLoaded", function () {
  const AGENCY = {
    name: "VPC Expert — N’Djamena",
    address: "433F+VP N’Djamena, Tchad",
    lat: 12.10465355754795,
    lng: 15.069451878272364,
    gmaps: "https://maps.app.goo.gl/2GLzWVoLRHXygPiA9"
  };

  const zone = document.getElementById("zone-intervention");
  if (!zone) return;

  const els = {
    cityName: document.getElementById("zebCityName"),
    cityNote: document.getElementById("zebCityNote"),
    agencyToCity: document.getElementById("zebAgencyToCity"),
    userToAgency: document.getElementById("zebUserToAgency"),
    userToCity: document.getElementById("zebUserToCity"),
    openAgency: document.getElementById("zebOpenAgency"),
    openCity: document.getElementById("zebOpenCity"),
    geoBtn: document.getElementById("zebGeoBtn")
  };

  if (!els.openAgency || !els.geoBtn) return;

  els.openAgency.href = AGENCY.gmaps;

  let userPos = null;
  let activeCity = null;

  function toRad(x) {
    return x * Math.PI / 180;
  }

  function haversineKm(aLat, aLng, bLat, bLng) {
    const R = 6371;
    const dLat = toRad(bLat - aLat);
    const dLng = toRad(bLng - aLng);
    const s1 = Math.sin(dLat / 2);
    const s2 = Math.sin(dLng / 2);
    const aa = s1 * s1 + Math.cos(toRad(aLat)) * Math.cos(toRad(bLat)) * s2 * s2;
    const c = 2 * Math.atan2(Math.sqrt(aa), Math.sqrt(1 - aa));

    return R * c;
  }

  function fmtKm(km) {
    if (!isFinite(km)) return "—";
    if (km < 10) return km.toFixed(1) + " km";
    return Math.round(km) + " km";
  }

  function setActivePin(pin) {
    zone.querySelectorAll(".zeb-pin").forEach((p) => p.classList.remove("is-active"));
    if (pin) pin.classList.add("is-active");
  }

  function updatePanelForCity(city) {
    activeCity = city;

    if (!city) {
      els.cityName.textContent = "—";
      els.cityNote.textContent = "Survolez une ville pour afficher les informations.";
      els.agencyToCity.textContent = "—";
      els.openCity.setAttribute("aria-disabled", "true");
      els.openCity.removeAttribute("href");
      els.userToCity.textContent = "Non disponible";
      return;
    }

    els.cityName.textContent = city.name;
    els.cityNote.textContent = city.note || "Intervention dans la ville et périphéries.";
    els.agencyToCity.textContent = fmtKm(haversineKm(AGENCY.lat, AGENCY.lng, city.lat, city.lng));

    els.openCity.href = city.gmaps;
    els.openCity.removeAttribute("aria-disabled");

    if (userPos) {
      els.userToAgency.textContent = fmtKm(haversineKm(userPos.lat, userPos.lng, AGENCY.lat, AGENCY.lng));
      els.userToCity.textContent = fmtKm(haversineKm(userPos.lat, userPos.lng, city.lat, city.lng));
    } else {
      els.userToCity.textContent = "Non disponible";
    }
  }

  function getCityFromPin(pin) {
    return {
      name: pin.getAttribute("data-city") || "Ville",
      note: pin.getAttribute("data-note") || "",
      lat: parseFloat(pin.getAttribute("data-lat")),
      lng: parseFloat(pin.getAttribute("data-lng")),
      gmaps: pin.getAttribute("data-gmaps") || ""
    };
  }

  zone.querySelectorAll(".zeb-pin[data-type='city']").forEach((pin) => {
    pin.addEventListener("mouseenter", () => {
      setActivePin(pin);
      updatePanelForCity(getCityFromPin(pin));
    });

    pin.addEventListener("click", () => {
      setActivePin(pin);
      updatePanelForCity(getCityFromPin(pin));
    });

    pin.addEventListener("keydown", (e) => {
      if (e.key === "Enter" || e.key === " ") {
        e.preventDefault();
        setActivePin(pin);
        updatePanelForCity(getCityFromPin(pin));
      }
    });
  });

  els.geoBtn.addEventListener("click", () => {
    if (!navigator.geolocation) return;

    navigator.geolocation.getCurrentPosition(
      (pos) => {
        userPos = {
          lat: pos.coords.latitude,
          lng: pos.coords.longitude
        };

        els.userToAgency.textContent = fmtKm(
          haversineKm(userPos.lat, userPos.lng, AGENCY.lat, AGENCY.lng)
        );

        if (activeCity) {
          els.userToCity.textContent = fmtKm(
            haversineKm(userPos.lat, userPos.lng, activeCity.lat, activeCity.lng)
          );
        }
      },
      () => {
        /* silencieux */
      },
      {
        enableHighAccuracy: true,
        timeout: 8000,
        maximumAge: 60000
      }
    );
  });

  updatePanelForCity(null);
});