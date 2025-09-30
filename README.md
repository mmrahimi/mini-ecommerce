# Mini E-commerce

A mockstore built with Laravel

> 🟡 This was my first ever Laravel project, I implemented and used many core Laravel feature here. REBUILT OLD PROJECT

## 🔧 Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/mmrahimi/mini-ecommerce
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```
   
3. **Configure environment**
- Copy `.env.example` to `.env`
- Generate app key:
  ```bash
  php artisan key:generate
  ```

4. **Run the migrations**
   ```bash
   php artisan migrate
   ```

5. **Run the server**
   ```bash
   php artisan serve
   ```
   
6. **Compile frontend assets**
   ```bash
   npm install
   npm run dev
   ```

7. **Link /storage to /public**
   ```bash
   php artisan storage:link
   ```

## 📝 Notes
- Payment flow is mocked via Mockoon at http://localhost:3000/pay (you can replace with your preferred gateway)
- Firefox is blocked in GlobalMiddleware.php, remove that logic if needed

## 📦 Features
- Admin panel
- Session-based cart system
- Notification system
- Wishlists
- Product reviews
