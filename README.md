# Task Management API

## Overview

A Laravel API for managing tasks with endpoints for creating, updating, deleting, and retrieving tasks. Includes user authentication and role-based access for admins and regular users.

## Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/asmaSismail/Task-Management-API-Laravel.git

2. **Install Dependencies**

      ```bash
      cd Task-Management-API-Laravel
      composer install

3. **Set Up Environment**

    ```bash
    cp .env.example .env
    php artisan key:generate
    php artisan migrate

   
4. **Run the Server**
     ```bash
    php artisan serve
     
The application will be available at http://127.0.0.1:8000.


## Endpoints

### Authentication

- **Login Admin:** `POST /api/login`
- **Register User:** `POST /api/register`
- **Logout:** `POST /api/logout`

### Admin Endpoints

- **Get All Tasks:** `GET /api/admin/tasks`
- **Find Task:** `GET /api/admin/tasks/{task_id}`
- **Get Deleted Tasks:** `GET /api/admin/tasks/deleted`
- **Create Task:** `POST /api/admin/tasks`
- **Delete Task:** `DELETE /api/admin/tasks/{task_id}`
- **Update Task:** `PUT /api/admin/tasks/{task_id}`

### User Endpoints

- **Get All Tasks:** `GET /api/user/tasks`
- **Find Task:** `GET /api/user/tasks/{task_id}`
- **Create Task:** `POST /api/user/tasks`
- **Delete Task:** `DELETE /api/user/tasks/{task_id}`
- **Update Task:** `PUT /api/user/tasks/{task_id}`

## Testing with Postman

1. **Install Postman:** [Download Postman](https://www.postman.com/downloads/)

2. **Import Collection:**
   - Open Postman.
   - Click "Import" and choose "Raw Text."
   - Paste the Postman collection JSON (provided separately) and import.

## Configuration

- Replace `YOUR_ADMIN_TOKEN` and `YOUR_USER_TOKEN` in Postman requests with actual tokens obtained from authentication.






