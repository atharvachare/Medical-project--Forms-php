# Hospital Management System

A comprehensive web application for managing hospital operations including patient registration, staff management, appointment scheduling, and feedback collection.

## Features

- **Patient Management**:
  - Registration and profile management
  - Appointment booking
  - Feedback submission

- **Staff Management**:
  - Doctor and staff registration
  - Role-based access control
  - Dashboard for managing appointments

- **Appointment System**:
  - Online booking by patients
  - Status tracking (Pending/Confirmed/Cancelled)
  - Doctor assignment

- **Feedback System**:
  - Patient satisfaction ratings
  - Comments collection
  - Anonymous feedback option

## Database Schema

The system uses MySQL with the following tables:
- `doctors` - Medical staff information
- `staff` - Administrative staff
- `patients` - Patient records
- `appointments` - Booking information
- `feedback` - Patient feedback

## Setup Instructions

1. Install XAMPP/WAMP server
2. database name: 'hospital_db'
2. Import database schema from `hospital_db_setup.sql`
3. Place all files in htdocs/medical directory
4. Access via `http://localhost/medical`

## Usage

- Patients can register and book appointments
- Staff can login to manage appointments
- Doctors can view their schedules
- Administrators can manage all records

## Technical Details

- Frontend: HTML, CSS, JavaScript
- Backend: PHP
- Database: MySQL
