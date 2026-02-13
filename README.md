# ERP Product Management (Native PHP)

Simple SPA-based product management module built with:
- Native PHP (OOP)
- PDO (Prepared Statements)
- MySQL (Relational Database)
- Bootstrap 5
- Fetch API (AJAX)

## Features
- Display product list (JOIN with categories)
- Create product without page reload (SPA)
- Foreign key constraint with cascade delete
- Server-side validation (stock & price must be non-negative)
- Dynamic category dropdown
- Stock status checker

## Database Setup
1. Create database: erp_product_management
2. Import database/schema.sql

## Run
Place project inside Laragon `www` directory and access:
http://localhost/erp-product-management
