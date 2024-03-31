# Simple Chat Application using Laravel, Laravel Reverb, and Vue.js

This is a simple chat application built with Laravel on the backend, Larvel Reverb for real-time communication, and Vue.js for the frontend.

**Note: This project is currently under development and may not be production-ready.**


## Prerequisites

Before you begin, ensure you have the following installed:

- PHP (>=8.2)
- Composer
- Node.js (>=18.x)
- NPM or Yarn or Bun
- Laravel (>=11.x)
- Laravel Reverb

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/your-username/your-chat-app.git
    ```

2. Navigate into the project directory:

    ```bash
    cd your-chat-app
    ```

3. Install PHP dependencies:

    ```bash
    cd backend
    composer install
    ```

4. Install JavaScript dependencies:

    ```bash
    cd frontend
    npm install
    # or
    yarn install
    #or
    bun install
    ```

5. Copy the `.env.example` file to `.env` and update the database and Pusher configuration:

    ```bash
    cp .env.example .env
    ```

6. Generate application key:

    ```bash
    php artisan key:generate
    ```

7. Run migrations to create the necessary database tables:

    ```bash
    php artisan migrate
    ```

8. If you want to use Pusher you should edit tour '.env' file:
    
    ```.env
    PUSHER_APP_ID=your-pusher-app-id
    PUSHER_APP_KEY=your-pusher-app-key
    PUSHER_APP_SECRET=your-pusher-app-secret
    PUSHER_APP_CLUSTER=your-pusher-app-cluster
    ```
    And change client side configurations

    ```js
    
    import Echo from 'laravel-echo';
    window.Pusher = require('pusher-js');
    
    window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
    });

    ```

9. If you would like to broadcast your event using the sync queue instead of the default queue driver, you can implement the ShouldBroadcastNow interface instead of ShouldBroadcast. Otherwise you should change QUEUE_CONNECTION to 'sync' in .env file.But ist not recommend. Because this can breake whole queue system.

## Usage

1. Serve the backend application:

    ```bash
    php artisan serve
    ```
2. Start Reverb service
    ```bash
    php artisan reverb:start
    ```
3. Start the frontend application
    ```bash
    npm run dev 
    #or
    bun dev
    ```




2. Visit `http://localhost:5173` in your browser to access the chat application.

## Contributing

Contributions are welcome! Feel free to open issues or pull requests.

