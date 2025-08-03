## Online Voting System

This is a Laravel-based Online Voting System that allows authenticated users to vote for candidates and view real-time results. The system is built with Laravel, Livewire, and Tailwind CSS for a modern, interactive experience.

### Features
- User registration, login, and authentication
- Unique voting: each user can vote only once
- Candidate management with images and details
- Real-time voting results and rankings
- Admin dashboard
- Responsive and modern UI

### Tech Stack
- Laravel (PHP framework)
- Livewire (dynamic interfaces)
- Tailwind CSS (styling)
- Vite (asset bundling)

### Setup Instructions
1. **Clone the repository:**
   ```sh
   git clone <your-repo-url>
   cd online-voting-system
   ```

2. **Install dependencies:**
   ```sh
   composer install
   npm install
   ```

3. **Copy and configure environment:**
   ```sh
   cp .env.example .env
   php artisan key:generate
   # Edit .env as needed (DB, mail, etc.)
   ```

4. **Run migrations and seeders:**
   ```sh
   php artisan migrate:fresh --seed
   ```

5. **Build frontend assets:**
   ```sh
   npm run build
   # or for development
   npm run dev
   ```

6. **Start the development server:**
   ```sh
   php artisan serve
   ```

7. **Access the app:**
   Open [http://localhost:8000](http://localhost:8000) in your browser.

### Default Users
- See `database/seeders/UserSeeder.php` for default test users and credentials.

### Candidate Images
Place candidate images in the `public/images/` directory. Filenames should match the `image` field in the candidates table (e.g., `alice.jpg`).

### Customization
- To add or edit candidates, update the `CandidateSeeder.php` or use the admin dashboard (if implemented).
- To change voting rules, modify the logic in `app/Livewire/Vote.php`.

### Testing
Run tests with:
```sh
php artisan test
```

### License
MIT
