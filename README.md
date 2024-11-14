# E-Library Documentation
## Project Overview
The E-Library is a web application that provides users with access to a virtual library. There are two user types: Admin and General User. Users can register with email verification, access available books, search by author or category, request books, send feedback, and participate in a chat room. Admins have additional privileges for managing books, categories, authors, and book requests.This project is my fifth semester school project of the software engineering course and it is Implemented using php,css,mysql and javaScript

## Key Features
#### 1. User Registration with Email Verification
#### 2. User Authentication and Profile Management
#### 3. Book Search by Author or Category
#### 4. Book Request and Feedback System
#### 5. Admin Controls for Book, Category, and Author Management
#### 6. Real-time Chatroom for Registered Users
#### 7. Email Notifications for Approved Book Requests

## Installation
### Prerequisites
- XAMPP Server: Required for running Apache and MySQL.
- FakeSMTP: For testing email verification and notifications without actually sending emails.
- Browser (Chrome, Firefox, etc.) for accessing the application.
  
### Setup Guide
#### 1. Download and Configure XAMPP
- Install XAMPP and start Apache and MySQL from the control panel.
- Navigate to c://xampp/php/php.ini and locate the sendmail_from directive. Set it to a valid email address:sendmail_from = youremail@example.com
- Save the file and restart Apache from the XAMPP control panel.
  
### 2. Set Up FakeSMTP for Email Testing
- Download the FakeSMTP .jar file from the official website.
- Run the FakeSMTP server and start it to capture outgoing emails without sending them externally.
- 
### 3. Import Databases
- Launch phpMyAdmin via XAMPP and import the databases:
  - user_db
  - online_book_store_db
    
### 4. Application Files
- Copy the project files to c://xampp/htdocs.
- Open a browser and navigate to http://localhost/home_page.php to access the application.
  
## Functionalities
### General User
#### 1. Registration & Login
- Users can register with email verification. Once verified, they can log in and access additional features.
#### 2. Book Access
- Non-registered users can view limited book previews.
- Registered users can view and download entire books.
#### 3. Search by Author or Category
- Users can search for books using the author’s name or category.
#### 4. Book Request
- Users can submit a request to the Admin if a desired book is unavailable.
#### 5. Feedback Submission
- Users can send feedback directly to the Admin.
#### 6. Profile Management
- Users can edit their profile details, including name, password, and phone number.
#### 7. Chatroom
- Registered users can interact with each other in a chatroom.
  
### Admin
#### 1. Admin Login
- Admins can log in to access management controls(name: abdella email: abdellaabasse@iut-dhaka.edu password: 12345).
#### 2. Book Management
- Add, edit, or delete books in the library.
- Manage book categories and authors by adding, editing, or deleting them.
#### Book Request Handling
- View and approve book requests from users.
- Send email notifications to users for approved requests.
- Move approved requests to the "Issued Books" section.
- Track returned books under the "Returned" section.
  
## Directory Structure
The project files are named to reflect their functions for easy identification. For example:
- user_registration.php - Manages user registration.
- admin_login.php - Manages admin login.
- home_page.php - Application landing page.
- feedback.php - Handles user feedback submissions.
Other files follow similar naming conventions to indicate their purpose

## Email Configuration
For email verification and notifications:
1. Open php.ini and set a valid email in the sendmail_from directive.
2. Use FakeSMTP to capture outgoing emails by running the FakeSMTP server before registration or notification actions.

### Connect
- [LinkedIn](https://www.linkedin.com/in/mounbagna-abdella-abasse-875958314/) – Connect with me on LinkedIn!


## HOW THE APP LOOKS LIKE

![alt text](https://github.com/mounbagna/e-library/blob/master/home_page1.png)
![alt text](https://github.com/mounbagna/e-library/blob/master/home_page2.png)
![alt text](https://github.com/mounbagna/e-library/blob/master/home_page3.png)


