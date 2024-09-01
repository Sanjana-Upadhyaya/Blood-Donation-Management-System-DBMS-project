document.addEventListener('DOMContentLoaded', function() {
    fetch('admin.php')
        .then(response => response.json())
        .then(data => {
            const donorTable = document.getElementById('donorTable');
            const patientTable = document.getElementById('patientTable');
            const donorBloodCountContainer = document.getElementById('donorBloodCountContainer');
            const patientBloodCountContainer = document.getElementById('patientBloodCountContainer');

            data.donors.forEach(donor => {
                const row = document.createElement('tr');
                row.innerHTML = `<td>${donor.name}</td><td>${donor.age}</td><td>${donor.bloodGroup}</td><td>${donor.City}</td><td>${donor.state}</td>`;
                donorTable.appendChild(row);
            });

            data.patients.forEach(patient => {
                const row = document.createElement('tr');
                row.innerHTML = `<td>${patient.name}</td><td>${patient.age}</td><td>${patient.bloodGroup}</td><td>${patient.City}</td><td>${patient.state}</td>`;
                patientTable.appendChild(row);
            });

            data.donorBloodCounts.forEach(bloodCount => {
                const box = document.createElement('div');
                box.className = 'blood-group-box';
                box.innerHTML = `<p>${bloodCount.bloodGroup}</p><p>${bloodCount.count}</p>`;
                donorBloodCountContainer.appendChild(box);
            });

            data.patientBloodCounts.forEach(bloodCount => {
                const box = document.createElement('div');
                box.className = 'blood-group-box';
                box.innerHTML = `<p>${bloodCount.bloodGroup}</p><p>${bloodCount.count}</p>`;
                patientBloodCountContainer.appendChild(box);
            });
        })
        .catch(error => console.error('Error:', error));

    document.getElementById('logoutBtn').addEventListener('click', function() {
        window.location.href = 'logout.php';
    });
});
