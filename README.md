Sure, here's an updated version of the README.md file with commands that users can copy directly:

```markdown
# Laravel + Vue Project

## Introduction
This is a Laravel + Vue project for managing tasks. It consists of a Laravel backend for handling API requests and a Vue.js frontend for the user interface.

## Features
- View tasks
- Add new tasks
- Edit existing tasks
- Delete tasks
- Fullscreen mode
- Font size adjustment
- High contrast mode

## Prerequisites
Before you begin, ensure you have met the following requirements:
- Composer installed on your local machine.
- Node.js and npm installed on your local machine.
- A web server like Apache or Nginx installed on your local machine.
- MySQL or any other relational database management system installed on your local machine.

## Installation
To install this project, follow these steps:

1. Clone the repository to your local machine:
   ```bash
   git clone https://github.com/dabirrizvi/laravel-vue-cardiff-su.git
   ```

2. Navigate to the project directory:
   ```bash
   cd laravel-vue-project
   ```

3. Install PHP dependencies using Composer:
   ```bash
   composer install
   ```

4. Install JavaScript dependencies using npm:
   ```bash
   npm install
   ```

5. Copy the `.env.example` file to `.env` and update the database configuration according to your environment: cp .env.example .env

6. Generate the application key: php artisan key:generate


7. Run database migrations and seeders to create the necessary tables and populate the database with sample data: php artisan migrate --seed


## Usage
To run this project, follow these steps:

1. Start the Laravel development server:
   ```bash
   php artisan serve
   ```

2. Start the Vue development server:
   ```bash
   npm run dev
   ```

3. Visit `http://localhost:8000` in your web browser to view the application.

## Additional Notes
- The project utilises Laravel Sanctum for API authentication.
- Ensure that your web server is properly configured to serve the Laravel application and handle Vue router history mode.
- You can customise the project further by modifying the Vue components and Laravel controllers as per your requirements.

## Credits
This project was created by Dabir Hasan Rizvi for Cardiff SU Placement Assignment for Web Developer Role .

## License
This project is open source and available under the [MIT License](https://opensource.org/licenses/MIT).
```

This format allows users to easily copy the commands and run them in their terminal.