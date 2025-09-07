# resumetowebsite

This is a web application built with the TALL stack (Tailwind CSS, Alpine.js, Laravel, and Livewire) that allows users to import their resumes and generate a personal website.

## Tech Stack

  * **Backend:** Laravel
  * **Frontend:** Vue.js, Inertia.js, Tailwind CSS
  * **Database:** SQLite (default)

## Features

  * **User Authentication:** Users can register, log in, and log out.
  * **Resume Import:** Users can import their resumes from various formats (PDF, JSON).
  * **Settings:**
      * Profile settings
      * Password settings
      * Appearance settings (light/dark mode)
      * Language settings
  * **Testing:** The application has a suite of tests written with Pest.

## Installation

1.  Clone the repository:
    ```bash
    git clone https://github.com/Masri-Programmer/resumetowebsite.git
    ```
2.  Navigate to the project directory:
    ```bash
    cd resumetowebsite
    ```
3.  Install PHP dependencies:
    ```bash
    composer install
    ```
4.  Install NPM dependencies:
    ```bash
    npm install
    ```
5.  Create a copy of the `.env.example` file and name it `.env`:
    ```bash
    cp .env.example .env
    ```
6.  Generate an application key:
    ```bash
    php artisan key:generate
    ```
7.  Create a database file:
    ```bash
    touch database/database.sqlite
    ```
8.  Run the database migrations:
    ```bash
    php artisan migrate
    ```
9.  Run the database seeder:
    ```bash
    php artisan db:seed
    ```
10. Build the frontend assets:
    ```bash
    npm run build
    ```
11. Start the development server:
    ```bash
    php artisan serve
    ```

## Usage

After following the installation steps, you can access the application by navigating to `http://127.0.0.1:8000` in your web browser.

## Testing

To run the tests, run the following command:

```bash
php artisan test
```

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.