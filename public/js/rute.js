let detailMap, editMap, createMap;
let detailMarker, editMarker, createMarker;



// =======================================================
// DETAIL MODAL
// =======================================================
function openDetailModal(id) {

    fetch(`/tambah/rute/${id}/detail`)
    .then(res => res.json())
    .then(data => {

        document.getElementById("detail_nama").value = data.nama_tempat;
        document.getElementById("detail_koordinat").value = `${data.latitude}, ${data.longitude}`;

        document.getElementById("detailModal").style.display = "flex";

        setTimeout(() => initDetailMap(data.latitude, data.longitude), 200);
    });
}

function closeDetail() {
    document.getElementById("detailModal").style.display = "none";
}



// =======================================================
// MAP DETAIL
// =======================================================
function initDetailMap(lat, lng) {

    if (detailMap) detailMap.remove();

    detailMap = L.map('detail_map').setView([lat, lng], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(detailMap);

    detailMarker = L.marker([lat, lng]).addTo(detailMap);

    setupSearch("detail_search", detailMap, detailMarker, "detail");
}



// =======================================================
// EDIT MODAL
// =======================================================
function openEditModal(id) {

    fetch(`/tambah/rute/${id}/edit`)
    .then(res => res.json())
    .then(data => {

        document.getElementById("edit_nama").value = data.nama_tempat;
        document.getElementById("edit_latitude").value = data.latitude;
        document.getElementById("edit_longitude").value = data.longitude;

        document.getElementById("editForm").action = `/tambah/rute/${id}/update`;

        document.getElementById("editModal").style.display = "flex";

        setTimeout(() => initEditMap(data.latitude, data.longitude), 200);
    });
}

function closeEdit() {
    document.getElementById("editModal").style.display = "none";
}



// =======================================================
// MAP EDIT
// =======================================================
function initEditMap(lat, lng) {

    if (editMap) editMap.remove();

    editMap = L.map('edit_map').setView([lat, lng], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(editMap);

    editMarker = L.marker([lat, lng], { draggable: true }).addTo(editMap);

    // Geser marker → update input
    editMarker.on("dragend", e => {
        let pos = e.target.getLatLng();
        document.getElementById("edit_latitude").value = pos.lat.toFixed(7);
        document.getElementById("edit_longitude").value = pos.lng.toFixed(7);
    });

    // Klik map → pindah marker
    editMap.on("click", e => {
        editMarker.setLatLng(e.latlng);
        document.getElementById("edit_latitude").value = e.latlng.lat.toFixed(7);
        document.getElementById("edit_longitude").value = e.latlng.lng.toFixed(7);
    });

    setupSearch("edit_search", editMap, editMarker, "edit");
}



// =======================================================
// CREATE MAP
// =======================================================
document.addEventListener("DOMContentLoaded", () => {

    if (document.getElementById("create_map")) {

        createMap = L.map("create_map").setView([-6.2000, 106.8166], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(createMap);

        createMarker = L.marker([-6.2000, 106.8166], { draggable: true }).addTo(createMap);

        createMarker.on("dragend", e => {
            let pos = e.target.getLatLng();
            document.getElementById("create_latitude").value = pos.lat.toFixed(7);
            document.getElementById("create_longitude").value = pos.lng.toFixed(7);
        });

        createMap.on("click", e => {
            createMarker.setLatLng(e.latlng);
            document.getElementById("create_latitude").value = e.latlng.lat.toFixed(7);
            document.getElementById("create_longitude").value = e.latlng.lng.toFixed(7);
        });

        setupSearch("create_search", createMap, createMarker, "create");
    }
});




// =======================================================
// SEARCH LOKASI (OPENSTREETMAP NOMINATIM)
// =======================================================
function setupSearch(inputId, map, marker, mode) {

    let searchBox = document.getElementById(inputId);

    searchBox.addEventListener("keypress", function(e) {

        if (e.key === "Enter") {
            e.preventDefault();
            searchLocation(searchBox.value, map, marker, mode);
        }
    });
}

function searchLocation(query, map, marker, mode) {

    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${query}`)
    .then(res => res.json())
    .then(data => {

        if (data.length === 0) {
            alert("Lokasi tidak ditemukan!");
            return;
        }

        let lat = parseFloat(data[0].lat);
        let lon = parseFloat(data[0].lon);

        map.setView([lat, lon], 17);
        marker.setLatLng([lat, lon]);

        if (mode === "edit") {
            document.getElementById("edit_latitude").value = lat.toFixed(7);
            document.getElementById("edit_longitude").value = lon.toFixed(7);
        }

        if (mode === "create") {
            document.getElementById("create_latitude").value = lat.toFixed(7);
            document.getElementById("create_longitude").value = lon.toFixed(7);
        }
    });
}



// =======================================================
// GPS BUTTON
// =======================================================
function getLocation(latID, longID) {

    if (!navigator.geolocation) {
        alert("Browser tidak mendukung GPS");
        return;
    }

    navigator.geolocation.getCurrentPosition(pos => {
        let lat = pos.coords.latitude.toFixed(7);
        let lng = pos.coords.longitude.toFixed(7);

        document.getElementById(latID).value = lat;
        document.getElementById(longID).value = lng;
    });
}


function closeEditModal() { document.getElementById('editModal').style.display = 'none'; }
    function openDeleteModal(id) {
        const form = document.getElementById('deleteForm');
        form.action = `/tambah/rute/${id}/delete`;
        document.getElementById('deleteModal').style.display = 'flex';
    }
    function closeDeleteModal() { document.getElementById('deleteModal').style.display = 'none'; }

// =======================================================
// CLOSE MODAL WHEN CLICK OUTSIDE
// =======================================================
window.onclick = function(e) {
    if (e.target.classList.contains("modal")) {
        e.target.style.display = "none";
    }
}
