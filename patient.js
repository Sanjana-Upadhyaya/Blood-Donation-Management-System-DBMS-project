document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('transfusion-form');

    form.addEventListener('submit', async function (event) {
        event.preventDefault(); // Prevent the form from submitting by default

        // Collect form data
        const formData = new FormData(form);
        const requestData = {
            bloodType: formData.get('blood-type'),
            quantity: formData.get('quantity'),
            urgent: formData.get('urgent') === 'on' // Convert to boolean
        };

        try {
            // Send the form data to the server using fetch API
            const response = await fetch('submitRequest.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(requestData)
            });

            if (!response.ok) {
                throw new Error('Failed to submit request');
            }

            const responseData = await response.json();
            alert(responseData.message); // Display response message to the user
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred. Please try again later.'); // Display error message to the user
        }
    });
});
