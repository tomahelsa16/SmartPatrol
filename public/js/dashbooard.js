// Simulate loading robot data dynamically
const robotData = [
    { id: 'R-001', startTime: '10:00 AM', duration: '2 hours', battery: '85%', status: 'Active', location: 'Lat: -6.174, Long: 106.829', temperature: '27°C' },
    { id: 'R-002', startTime: '10:30 AM', duration: '1 hour 30 minutes', battery: '75%', status: 'Active', location: 'Lat: -6.174, Long: 106.830', temperature: '28°C' },
    { id: 'R-003', startTime: '11:00 AM', duration: '1 hour', battery: '90%', status: 'Inactive', location: 'Lat: -6.175, Long: 106.828', temperature: '26°C' },
    { id: 'R-004', startTime: '11:30 AM', duration: '30 minutes', battery: '50%', status: 'Active', location: 'Lat: -6.173, Long: 106.827', temperature: '29°C' }
];

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
