
# NOTIFISH
#### Joel Van Patten  -  July 2025

---
#### NOTICE: (Demo App - For Education / Illustration Only)
**This App is for demonstration only.**  Although it is 
designed to be secure by default, it has not been quality 
tested for Production environments.  It may also be lacking
features that you would want in a real app.  Enjoy
responsibly.

#### Stack Used In This App
+ Laravel 12
    + Sail (Dev environment using Docker)
        + Redis
        + MySQL 8
    + Sanctum for session and token auth
    + Vite for compiling assets (like Webpack or Mix)
+ Vue Starter Kit
    + VueJS 3 Composition API
    + InertiaJS 2
    + TypeScript
    + TailwindCSS
    + shadcn-vue component library
+ Redis
+ Pest / PhpUnit
---

## Notifish
### Real‑Time Notifications with Laravel, Redis Queues & Vue 3

---


## 🔍 What It Does

Notifish is a small demo project built to showcase:

- **Queue‑driven notifications**: Dispatch background jobs via Redis and process them in real time.
- **Secure session‑based auth**: User login powered by Laravel Sanctum.
- **Modern frontend**: Vue 3 with Inertia (Blade + Vue components) and TailwindCSS styling.
- **UUID‑based seeding**: Seed random notifications with shortened UUID “shorthands” for easy reference.
- **Feature Tests**: Pest/PhpUnit feature tests help ensure code that is robust and easy to maintain.

## 📡 Example Use Case

A lightweight event logging and visibility system for internal operational awareness.
You’d use it to track and visualize system-level events like:

+ User registration
+ Email sent (welcome, password reset, newsletter)
+ Reports generated or exported
+ Purchases made or invoices generated
+ Auth/login events
+️ Errors or failed jobs (if you want to surface those)
+ Cron jobs / scheduled tasks that have run
+️ API integrations that fired

In a production app you don’t always want to send email/slack alerts for everything. But you also don’t want to dig through logs to know what happened.So a tool like Notifish sits in between: giving you visibility into what your app is doing, without overwhelming your alerting systems.

---

## 🏗️ Why This Stack?

1. **Laravel 12 + Sail**
    - Industry‑standard PHP framework.
    - Sail container environment ensures “it works on my machine” for everyone.

2. **Redis Queues**
    - Demonstrates decoupled background processing—essential for scaling.
    - Immediate feedback loop when queue workers are running.

3. **Sanctum (Session‑based)**
    - Lightweight authentication for SPAs.
    - No tokens to manually manage; works out of the box with Laravel sessions.

4. **Vue 3 + Inertia**
    - Leverages Blade for initial page render and Vue for dynamic components.
    - Keeps your application cohesive without a full‑blown SPA router.

5. **TailwindCSS**
    - Utility‑first styling speeds up prototyping and ensures consistency.

---

## 🚀 Getting Started
### Prerequisites:
Before starting, you will need to have PHP (8.2 or higher), Composer, and Docker already installed on your computer.


Instructions
--

1. **Clone & Install**
   ```bash
   git clone git@github.com:joelvanpatten/notifish.git
   cd demo
   ```

2. **Install dependencies via Composer:**
   ```bash
   composer install
   ```
   
3. **Set Up Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   # Edit .env as needed (DB, Redis, etc.)
   ```

4. **Install Dependencies**
   ```bash
   # Using Laravel Sail:
   ./vendor/bin/sail up -d
   ./vendor/bin/sail artisan migrate --seed
   ./vendor/bin/sail npm install
   ```

5. **Build Frontend Assets & Start Queue Worker**
   ```bash
   ./vendor/bin/sail composer run dev
   ```

6. **Login**

   + Open `http://localhost` in your browser.
   + Click the login button.  
   + The demo user is `demo@notifish.test` and the password is `password`.

---

**Explore the Demo App**
  + Visit the Notifications page in the side menu to see your notifications.
  + To start you won't have any notifications to view.  Because this is a 
    demo, we will be creating these ourselves.
  + To create notifications:
    1. Open a new terminal window.
    2. Navigate to your project directory.
    3. Use artisan command to seed mock notifications:
    `./vendor/bin/ sail artisan redis:seed-notifications 3`.  The argument 3 is to create
       3 notifications.
  + The terminal window where you ran `./vendor/bin/sail composer run dev` should show 
    that the Redis queue is working the queued job: 
    ```log
    [queue]   2025-06-14 16:18:43 App\Jobs\LogNotificationToQueue ................ RUNNING
    [queue]   2025-06-14 16:18:43 App\Jobs\LogNotificationToQueue ........... 21.53ms DONE
    [queue]   2025-06-14 16:18:43 App\Jobs\LogNotificationToQueue ................ RUNNING
    [queue]   2025-06-14 16:18:43 App\Jobs\LogNotificationToQueue ........... 14.39ms DONE
    [queue]   2025-06-14 16:18:44 App\Jobs\LogNotificationToQueue ................ RUNNING
    [queue]   2025-06-14 16:18:44 App\Jobs\LogNotificationToQueue ........... 11.92ms DONE
    ```
  + You can erase all the notifications with this artisan command: `./vendor/bin/ sail artisan 
    redis:clear-notifications`
  + The Notifications page on the frontend is not "real-time" yet.  I would need to setup
 websocket infrastructure which I haven't done yet.  Right now the Notifications page makes
    an API call once the Vue component is mounted to the DOM: `onMounted()`. That means that 
    you will need to refresh the Notifications page in order to see any new notifications.
    
    
    





---

## 🧪 Features to Explore

- ✅ Auth with Laravel Sanctum
- ✅ Redis-backed job queues
- ✅ Notifications seeded with UUIDs
- ✅ Tailwind styling with Inertia layout
- ✅ Basic responsive UI with Vue 3 components
- ✅ Queueable command to seed test notifications
- ✅ View shorthands of notification UUIDs (like git commit hashes)
- ✅ Run Automated Software Tests (see below)

---

## 🔬 To Run Tests
In your terminal: `./vendor/bin/sail test tests/Feature/NotificationsApiTest.php`

or to run all of the tests: `./vendor/bin/sail test`

---

## 📦 Possible Improvements

- Add broadcasted notifications via Laravel Echo or Pusher
- Add multi-user and team support
- Add filtering, pagination, and richer notification metadata
- Add tests for queue job logic and Vue components

---

## 👨‍💻 About Me

I'm Joel Van Patten, a full-stack PHP developer specializing in building scalable, maintainable applications.  
I built this project as a demonstration of my ability to integrate backend queues, secure authentication, and a reactive frontend into a cohesive project..

---

📁 [View the source code on GitHub](https://github.com/joelvanpatten/notifish)

Feel free to fork, explore, and reach out with any questions!



