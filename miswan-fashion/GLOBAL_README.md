# Miswan Fashion - Full-Stack Laravel E-Commerce Application

A complete, production-ready **Laravel (v13.x) + MySQL** full-stack e-commerce web application featuring the exact, high-end responsive design of [Miswan Fashion](https://www.miswanfashion.com/).

---

## 🚀 Live Application Server

The Laravel application server is currently **running live** on MySQL database from `/Volumes/2BT/Ridoy/miswan-fashion` at:
```
http://127.0.0.1:8000
```

### Quick Commands
```bash
# Start server manually (if stopped)
php artisan serve --port=8000

# Re-run migrations
php artisan migrate
```

---

## 🎨 Dynamic Purchasable Banners & Sliders Feature

- **Admin Management (`/admin/sliders`)**:
  - Dual-tab management for **Hero Carousel Sliders** and **Promotional Banners** (Side Top & Middle Section).
  - Admin can upload custom banner images, add custom titles/taglines, specify sort order, and **delete** banners/sliders.
  - **Product Linking**: Admin can optionally associate any banner with a specific product in the store catalog.

- **Interactive Homepage Banners**:
  - Banners linked to products automatically render an interactive overlay with the product name, price tag (`TK XX,XXX`), and instant **"Buy Now" / "Add to Cart"** button.
  - Clicking the banner or purchase button allows customers to buy items directly from the banner!

---

## 🔑 Default Credentials (Seeders)

### 1. Admin Control Panel
- **Login URL**: [http://127.0.0.1:8000/admin/login](http://127.0.0.1:8000/admin/login)
- **Email**: `admin@miswanfashion.com`
- **Password**: `Admin@123456`

### 2. Customer Demo Account
- **Login URL**: [http://127.0.0.1:8000/login](http://127.0.0.1:8000/login)
- **Phone**: `01711112222`
- **Password**: `Customer@123456`

---

## 📂 Project Structure (`miswan-fashion`)

```text
miswan-fashion/
├── app/
│   ├── Http/Controllers/ (Admin, Cart, Checkout, Auth, Product, User, Home)
│   ├── Models/ (User, Admin, Product, Category, Order, OrderItem, Slider, Banner, Setting, etc.)
│   └── Providers/
├── bootstrap/
├── config/
├── database/
│   ├── migrations/ (11 MySQL Migrations including banners product_id migration)
│   └── seeders/ (Miswan Fashion Real Seeders)
├── public/
│   ├── assets/ (Fonts, CSS, JS, Images, SVGs)
│   ├── uploads/ (Product, Category & Banner Images)
│   ├── index.php
│   └── .htaccess
├── resources/
│   └── views/
│       ├── layouts/ (app.blade.php, header, footer, navbar, cart_drawer)
│       ├── frontend/ (index, category, product_details, cart, checkout, search)
│       ├── user/ (dashboard, orders, order_details, profile)
│       └── admin/ (dashboard, products, orders, categories, sliders, settings)
├── routes/ (web.php, api.php)
├── storage/
├── .env (MySQL Configured: miswan_fashion_db)
├── artisan
└── composer.json
```
