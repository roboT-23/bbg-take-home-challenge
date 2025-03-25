# BBG Product Catalog Documentation

## Overview

The BBG Product Catalog is a full-stack web application built with PHP/Laravel and Tailwind CSS. This application enables users to browse products, filter by categories, view details, manage shopping carts, and complete purchases.

## Key Features

- Product browsing with pagination
- Category-based filtering
- Detailed product views
- Shopping cart functionality
- Checkout process
- Order history tracking
- Admin dashboard for product and order management
- Responsive design for all devices

## Tech Stack

- **Backend**: PHP with Laravel 12
- **Frontend**: Tailwind CSS, Blade templates
- **Database**: MySQL/MariaDB
- **Deployment**: Docker-ready

## Getting Started

### Standard Installation

```bash
# Clone repository
git clone this repo
cd bbg-product-catalog

# Configure environment
cp .env.example .env

# Install dependencies
composer install
npm install

# Setup application
php artisan key:generate
php artisan migrate --seed
npm run build

# Launch development server
php artisan serve
```

### Quick Start (Release Package)

```bash
# Navigate to project directory
cd example-app

# Configure environment
cp .env.example .env
php8.4 artisan key:generate

# Setup database
php artisan migrate
php artisan db:seed

# Launch server
php artisan serve
```

## Architecture

### Directory Structure

```
├── app/                            # Application code
│   ├── Http/Controllers/           # Request handlers
│   └── Models/                     # Data models
├── database/                       # Database configuration
├── resources/                      # Frontend assets
│   ├── views/                      # Blade templates
│   ├── css/                        # CSS styles
│   └── js/                         # JavaScript
├── routes/                         # Application routes
└── public/                         # Public assets
```

### Component Design

The application implements a component-based architecture:

- **Layouts**: Master template with header, main content, and footer
- **Components**: Reusable UI elements (product cards, detail views, pagination)
- **Controllers**: Feature-specific logic organized by domain

### Data Models

- **Product**: Store item with pricing and details
- **Category**: Product classification
- **Order**: Customer purchase record
- **OrderItem**: Individual items within an order

## Feature Details

### Product Catalog

- Paginated product listings (10 per page)
- Category dropdown filtering
- Featured products on homepage

### Shopping Cart

- Session-based cart management
- Quantity adjustments
- Item removal
- Order summary with calculations

### Checkout Process

- Customer information collection
- Shipping address entry
- Order summary confirmation
- Order status notification

### Admin Interface

- Sales dashboard with key metrics
- Order management workflow
- Inventory management tools
- Reporting capabilities

## API Reference

| Endpoint | Method | Description |
|----------|--------|-------------|
| `/api/products` | GET | Retrieve paginated products |
| `/api/products/:id` | GET | Get specific product details |
| `/api/categories` | GET | List all product categories |

## Database Schema

### Categories
- `id`: Primary key
- `name`: Category name
- `timestamps`: Created/updated dates

### Products
- `id`: Primary key
- `name`: Product name
- `price`: Product price
- `description`: Product details
- `category_id`: Foreign key to categories
- `image_url`: Product image location
- `timestamps`: Created/updated dates

### Orders
- `id`: Primary key
- `order_number`: Unique identifier
- `customer_details`: Name, email, phone
- `shipping_address`: Multiple address fields
- `financial_details`: Subtotal, tax, shipping, total
- `status`: Order state
- `notes`: Additional information
- `timestamps`: Created/updated dates

### OrderItems
- `id`: Primary key
- `order_id`: Foreign key to orders
- `product_id`: Foreign key to products
- `product_details`: Name, price (snapshot)
- `quantity`: Number ordered
- `subtotal`: Line item total
- `timestamps`: Created/updated dates

## Implementation Achievements

### Backend Development
- ✅ RESTful API endpoints
- ✅ Normalized database schema
- ✅ Sample data seeding

### Frontend Implementation
- ✅ Responsive product listings
- ✅ Dynamic filtering
- ✅ Detailed product views
- ✅ Mobile-optimized interface

### Advanced Features
- ✅ Cart management
- ✅ Checkout flow
- ✅ Order tracking
- ✅ Admin capabilities
- ✅ Component reusability
