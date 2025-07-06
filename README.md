# Bloodbank and Donor Management System

![Repo Size](https://img.shields.io/github/repo-size/whoisdmathz/capstone-m-2025-pharmacy-bidding.svg)

Bloodbank and Donor Management System is a multi-role web application designed to streamline blood donation processes, donor management, and blood stock tracking.

### Donor
<table>
  <tr>
    <td><img src="https://github.com/user-attachments/assets/676ce7fa-f9f1-45f5-b318-c94e5d055060" width="300"/></td>
    <td><img src="https://github.com/user-attachments/assets/14c6f61a-b1c3-42fb-a1c7-ded6104c48ee" width="300"/></td>
  </tr>
  <tr>
    <td><img src="https://github.com/user-attachments/assets/60a3295d-6f0a-4df4-82f4-9d8a48e3ea77" width="300"/></td>
    <td><img src="https://github.com/user-attachments/assets/0434de7f-351b-4d6b-8e79-28a8d7ed54a6" width="300"/></td>
  </tr>
</table>

### Admin
<table>
  <tr>
    <td><img src="https://github.com/user-attachments/assets/c4010179-db22-45cc-92f5-5f274fd14568" width="300"/></td>
    <td><img src="https://github.com/user-attachments/assets/1d114e62-8d09-4708-a0a6-3bdb311c567a" width="300"/></td>
  </tr>
</table>

### Key Features
- Admin
  - Manage all user accounts
  - Approve or decline donor requests to donate or receive blood
  - Manage blood stock levels
- Personnel
  - View all user accounts
  - Assist in managing donor requests
- Donor
  - Request to donate blood
  - Search for available blood stock and request to receive blood

### System Modules
- Donor App / Landing Page
  - Public-facing app for donors to register, request to donate, request to get blood, and search for available blood types.
- Admin App
  - Secure portal for admins to manage users, blood stock, and handle donor requests.
- Appointment Check (Personnel App)
  - Dedicated app for personnel to verify donor appointments for both blood donation and blood retrieval.

A complete solution for organizations managing blood banks, donation drives, and blood distribution, ensuring efficient workflows for both personnel and donors.

--- 

## ⚡ Run on windows

### Prerequisite
- Xampp or Wamp

### Database Setup (in Xampp)
- Run xampp control panel then start apache and mysql
- Open [PhpMyAdmin](http://localhost/phpmyadmin/) in your browser, then create new database name.
- Import the database from **<project_path>/db/** directory

### App Configurations 
- Place the project inside **xampp/htdocs** (if using xampp) or **wamp/www/** (If using wamp)
- Open project in your preferred IDE(e.g., VS Code)
- Go to **<project_path>/admin/includes/connection.php**, then update the MySQL credentials:
```bash
$db = new mysqli("localhost", "username", "password", "bdms", 3306);
```
- Go to **<project_path>/appointment_checker/check.php**, then update the MySQL credentials:
```bash
$db = new mysqli("localhost", "username", "password", "bdms", 3306);
```
- Go to **<project_path>/prospect/includes/connection.php**, then update the MySQL credentials:
```bash
$db = new mysqli("localhost", "username", "password", "bdms", 3306);
```

### Run the app
- Open browser, then type **localhost/<project_forder_name>** to open prospect app
- Open browser, then type **localhost/<project_forder_name>/admin** to open admin app
- To use appointment check, just scan the prospect qrcode and you'll be redirected to it.
- Log In using default admin account
  - Username: **admin**
  - Password: **123**
  
---
