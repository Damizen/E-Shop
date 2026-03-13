# E-commerce shop

A minimal learning project (PHP + CSS) intended for experimentation and study. This repository contains simple PHP pages, basic admin pages, and CSS assets — it is not a production-ready application.

## Database schema file
- The database schema file is included at: `db/schema.sql`
- Recommended workflow (with XAMPP):
  1. Start Apache and MySQL in the XAMPP Control Panel.
  2. Open phpMyAdmin at `http://localhost/phpmyadmin`.
  3. Create or select a database (the schema will create `MovieStore` automatically).
  4. Import `db/schema.sql`.
- If you also receive a sample data SQL file, import it after `schema.sql` to add example movies and a test user.

## Quick setup (recommended: XAMPP)
1. Place the repository in your web root:
   - Windows (XAMPP): `C:\xampp\htdocs\E-Shop`
   - Linux (XAMPP): `/opt/lampp/htdocs/E-Shop`
2. Start Apache and MySQL.
3. Import `db/schema.sql` via phpMyAdmin (see Database schema file above).
4. Verify DB connection settings in `main/connect.php`:
   ```
   host: localhost
   user: root
   password: (empty by default in XAMPP)
   db_name: MovieStore
   ```
   Edit these values if your MySQL credentials differ.
5. Ensure upload/read directories exist and are writable:
   - `ImagesMovieShop/`
   - `thumbnails/`
   These should be placed at the project root (e.g., `htdocs/E-Shop/ImagesMovieShop`).

## Notes & troubleshooting
- 500 errors when uploading movies: ensure the `ImagesMovieShop` and `thumbnails` folders exist and are writable by the web server, and that the GD extension is enabled in PHP for image processing.
- If images do not appear, confirm the DB `image`/`thumbnail` paths (e.g., `/ImagesMovieShop/filename.jpg`) and that files exist at `htdocs/E-Shop/ImagesMovieShop/filename.jpg`.
- This project is for learning and lacks production-grade validation and security.

## License
- This project is licensed under the MIT License.

## Contact
- Author: Damian Choina
