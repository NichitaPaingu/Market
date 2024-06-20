# Market Project

This is a Laravel-based market project. It includes functionalities for product management, user authentication, shopping cart, favorites, reviews, and more.

## Getting Started

Follow these instructions to get a copy of the project up and running on your local machine.

### Prerequisites

- PHP 7.4 or higher
- Composer
- Node.js and npm
- MySQL or any other compatible database

### Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/NichitaPaingu/Market.git
    cd Market
    ```

2. Install PHP dependencies:

    ```bash
    composer install
    ```

3. Install JavaScript dependencies:

    ```bash
    npm install
    ```

4. Copy the example environment file and configure your environment variables:

    ```bash
    cp .env.example .env
    ```

    Open `.env` and set your database connection details and other environment settings.

5. Generate an application key:

    ```bash
    php artisan key:generate
    ```

6. Import the database:

    The project includes a `myproject.sql` file with pre-populated data. Import this file into your database to have all products visible.

    ```bash
    mysql -u your_username -p your_database < myproject.sql
    ```

    Replace `your_username` with your MySQL username, and `your_database` with the name of your database.

7. Run migrations the database:

    ```bash
    php artisan migrate 
    ```

### Running the Application

1. Compile the assets:

    ```bash
    npm run dev
    ```

2. Serve the application:

    ```bash
    php artisan serve
    ```

    The application will be available at `http://localhost:8000`.

### Admin Account

You can log in as an administrator using the following credentials:

- **Email:** `test@example.com`
- **Password:** `123456789`

