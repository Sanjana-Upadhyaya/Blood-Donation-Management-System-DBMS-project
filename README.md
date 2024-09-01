# Blood Donation Management System (DBMS Project)

## Overview
The **Blood Donation Management System** is a web application designed to facilitate blood donations by providing a platform for donors, patients, and administrators. The system allows users to register as blood donors or patients, schedule donations or blood orders, and manage personal information. Administrators can track the availability of blood units and manage donor/patient information.

## Features
### Homepage
- Provides basic information about **blood donation** and different **types of blood**.
- Navigation bar includes links to:
  - **About** (Information page)
  - **Be a Donor**
  - **Be a Patient**
  - **Contacts** (in the footer)
  - **Admin** (restricted to administrators)

### Footer
- Contains **contact information** (phone number and email).
- Includes **social media links** for easy sharing and connectivity.

### Donor Section
- **Login Page**: Allows registered donors to log in using their email and password.
- **Registration Page**: For new donors to sign up.
- **Donor Dashboard**:
  - Header greets the logged-in user and includes a logout button.
  - Displays donor information: name, age, phone number, email, city, and state.
  - Shows donation history and allows scheduling of new donations.
  - Provides an option to edit donor information.

### Patient Section
- **Login Page**: Allows registered patients to log in using their email and password.
- **Registration Page**: For new patients to sign up.
- **Patient Dashboard**:
  - Header greets the logged-in user and includes a logout button.
  - Displays patient information: name, age, phone number, email, city, and state.
  - Shows order history and allows scheduling of blood orders.
  - Provides an option to edit patient information.

### Admin Section
- **Admin Login Page**: Restricted to a single admin user who logs in with a username and password.
- **Admin Dashboard**:
  - Header includes a logout button.
  - Displays tables of all donors, patients, and the available units of blood in each blood group.

## Technologies Used
- **HTML** for structuring the web pages.
- **CSS** for styling the user interface.
- **PHP** for server-side scripting and backend logic.
- **MySQL** for database management.
- **JavaScript** for dynamic front-end functionality.

## Installation and Setup
1. Clone the repository from GitHub:
   ```bash
   git clone https://github.com/Sanjana-Upadhyaya/Blood-Donation-Management-System-DBMS-project.git
2. Set up the database using the provided SQL scripts.
3. Configure the connection settings in the dbms.php file.
4. Open the project in your browser.

## Usage
- Donors can log in, manage their profiles, view donation history, and schedule future donations.
- Patients can log in, manage their profiles, view order history, and schedule blood orders.
- Admins can view donor and patient details, track blood availability, and manage the system.

  ## Screenshots
Here are some screenshots of the application to give you a visual overview:

Homepage
![Homepage](screenshot/sc_homeheader.png)
![Homepage](screenshot/sc_homefooter.png)

Login and Registration Page
![Login](screenshot/sc_login.png)
![Registartion](screenshot/sc_regist.png)

Donor Dashboard
![Donor Dashboard](screenshot/sc_donor1.png)
![Donor Dashboard](screenshot/sc_donor2.png)
![Donor Dashboard](screenshot/sc_donor3.png)

Patient Dashboard
![Patient Dashboard](screenshot/sc_patient1.png)
![Patient Dashboard](screenshot/sc_patient2.png)
![Patient Dashboard](screenshot/sc_patient3.png)

Admin Dashboard
![Admin Dashboard](screenshot/sc_admin1.png)
![Admin Dashboard](screenshot/sc_admin2.png)
![Admin Dashboard](screenshot/sc_admin3.png)
