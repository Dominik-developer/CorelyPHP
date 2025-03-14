# CorelyPHP

## Introduction

CorelyPHP is a ready-to-deploy blogging platform designed for efficient web development. This guide provides instructions on how to set up and run the project on your local machine.

## Prerequisites

Before you begin, ensure you have the following installed:

- PHP (>= 8.2) (8.0+ also should be fine but not tested) <!--(in XAMPP/MAMP)-->
- MySQL (or another compatible database) <!--(in XAMPP/MAMP)-->
- XAMPP / MAMP
- Git

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/Dominik-developer/CorelyPHP.git
   cd CorelyPHP
   ```

2. Set up the database:

   - Open phpMyAdmin in your browser (`http://localhost/phpmyadmin`).
   - Import the SQL files located in the `SQL` folder:
     - Create a new database by importing `blog_DB_structure.sql`
     - Add the `blog_DB_data.sql`

3. Start the development server using XAMPP:

   - Open XAMPP Control Panel.
   - Start Apache and MySQL.
   - Place the repository in the `htdocs` folder inside the XAMPP directory.

4. Access the project folder in your browser: `http://localhost/CorelyPHP`:
   - For user: `http://localhost/CorelyPHP/public`
   - For admin: `http://localhost/CorelyPHP/admin`

5. To log into Admin panel use **`admin`** for login and **`pass`** for password.

## Contributing

If you'd like to contribute, please fork the repository and submit a pull request.

## License

This project is licensed under the MIT License.
