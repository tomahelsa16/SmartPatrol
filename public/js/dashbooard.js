// Fungsi Slider Kamera
function moveSlide(direction) {
    const container = document.getElementById('cameraContainer');
    const totalCameras = container.children.length;
    if (totalCameras <= 1) return;

    let currentIndex = [...container.children].findIndex(camera => camera.style.display !== 'none');
    if (currentIndex === -1) currentIndex = 0;

    currentIndex = (currentIndex + direction + totalCameras) % totalCameras;
    
    Array.from(container.children).forEach((camera, index) => {
        camera.style.display = index === currentIndex ? 'block' : 'none';
    });
}

// Inisialisasi tampilan kamera (hanya tampilkan satu jika slider aktif)
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('cameraContainer');
    if (container && container.children.length > 4) {
        Array.from(container.children).forEach((camera, index) => {
            camera.style.display = index === 0 ? 'block' : 'none';
        });
    }
});

// Update total active robots count
document.getElementById('active-robot-count').textContent = robotData.filter(robot => robot.status === 'Active').length;

// Add robot data to the table dynamically
const robotStatusTableBody = document.getElementById('robot-status-tbody');
robotData.forEach(robot => {
    const row = document.createElement('tr');
    row.innerHTML = `
        <td>${robot.id}</td>
        <td>${robot.startTime} (Operasi: ${robot.duration})</td>
        <td><a href="#details${robot.id}" class="details-link" onclick="showRobotDetails('${robot.id}')">Detail</a></td>
    `;
    robotStatusTableBody.appendChild(row);
});

// Show robot details when clicked
function showRobotDetails(robotId) {
    const robot = robotData.find(r => r.id === robotId);
    alert(`
        ID: ${robot.id}
        Baterai: ${robot.battery}
        Status: ${robot.status}
        Koordinat: ${robot.location}
        Suhu: ${robot.temperature}
    `);
}

// Slider functionality for more than 4 cameras
function moveSlide(direction) {
    const container = document.getElementById('cameraContainer');
    const totalCameras = container.children.length;
    let currentIndex = [...container.children].findIndex(camera => camera.style.display !== 'none');
    currentIndex = (currentIndex + direction + totalCameras) % totalCameras;
    
    Array.from(container.children).forEach((camera, index) => {
        camera.style.display = index === currentIndex ? 'block' : 'none';
    });
}

// Show slider buttons if more than 4 cameras
if (document.getElementById('cameraContainer').children.length > 4) {
    document.getElementById('cameraSlider').style.display = 'block';
}
