
# Simple ERP
This project is a simple ERP system designed to manage employees and tasks. Managers can add employees, create tasks, and assign them to specific team members. The system helps streamline task management by providing an efficient way to track assignments and employee responsibilities.
## Requirements

- Local server, e.g., XAMPP, WAMP, Laragon (Laragon is preferred).

- PHP 8.2 or greater (Required for Laravel 11).

## Installation

- Clone the project:

```bash
  git clone https://github.com/ameer-ahmed/simple-erp.git
```

- Install composer packages:

```bash
  composer install
```

- Setup your environment:

Rename `.env.example` file to `.env`, then generate your Laravel app key.

```bash
  php artisan key:generate
```

- Migrate and seed database:

```bash
  php artisan migrate --seed
```

- Link your storage folder with public folder:

```bash
  php artisan storage:link
```

- Clear cache:

```bash
  php artisan optimize:clear
```

## Usage
- The seeder will add some users of the project.

### Users

#### Stakeholder Manager User:
```bash
http://127.0.0.1:8000/manager
email: manager0@mail.com
password: Manager0@0!#
```

#### Manager User:
```bash
http://127.0.0.1:8000/manager
email: manager1@mail.com
password: Manager1@0!#
```

#### Employee User:
```bash
http://127.0.0.1:8000/employee
email: employee0@mail.com
password: Employee0@0!#
```

