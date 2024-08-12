<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Book Recommendation System

This is a Book Recommendation System API with an accompanying admin panel, built using Laravel. The admin panel is designed with Blade templates, allowing administrators to manage books, users, and recommendations.

## Features

- **API Endpoints:**
    - Book management (add, update, delete, download books)
    - User management (registration, authentication)
    - Book recommendation engine based on user preferences
- **Admin Panel:**
    - Manage books, categories, roles and authors
    - View and manage user recommendations

## Technologies Used

- **Backend:**
    - Laravel Framework
    - MySQL 
    - Blade templating engine for the admin panel
    - Tailwind CSS
- **Authentication:**
    - Laravel Sanctum 

## Installation

   ```bash
    # Clone the repository
    git clone https://github.com/Shakhzod0307/book-recomandation-system-api.git
   
    # Navigate to the project directory 
    cd book-recommendation-system-api
   
    # Install dependencies
    composer install
    
    # Copy the example env file and make the required configuration changes
    cp .env.example .env
    
    # Generate an application key
    php artisan key:generate
    
    # Run the migrations
    php artisan migrate --seed
   
    # Serve the application
    php artisan serve
    
   ```
### Access the admin panel:    

- **Visit http://localhost:8000**
- **Default admin credentials:**
    - Email: admin@admin.com
    - Password: admin123


# Some screenshots


<img src="public/screenshots/image1.png" alt="Screenshot of the application" height="400" width="700">
<img src="public/screenshots/image2.png" alt="Screenshot of the application" height="400" width="700">
<img src="public/screenshots/image3.png" alt="Screenshot of the application" height="400" width="700">
<img src="public/screenshots/image4.png" alt="Screenshot of the application" height="400" width="700">
<img src="public/screenshots/image5.png" alt="Screenshot of the application" height="400" width="700">
<img src="public/screenshots/image6.png" alt="Screenshot of the application" height="400" width="700">
<img src="public/screenshots/image7.png" alt="Screenshot of the application" height="400" width="700">
<img src="public/screenshots/image8.png" alt="Screenshot of the application" height="400" width="700">

