<?php
/**
 * config/database.php
 * Koneksi ke database MySQL menggunakan PDO.
 * PDO lebih aman dari mysqli biasa karena support prepared statements.
 */
class Database {
    private static ?PDO $instance = null;

    // Sesuaikan dengan setting Laragon kamu
    private static string $host   = 'localhost';
    private static string $dbname = 'maldives_landing';
    private static string $user   = 'root';
    private static string $pass   = ''; // Laragon default: kosong

    // Singleton pattern — koneksi hanya dibuat 1x
    public static function getInstance(): PDO {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8mb4",
                    self::$user,
                    self::$pass,
                    [
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]
                );
            } catch (PDOException $e) {
                die("<h2 style='font-family:sans-serif;color:red;padding:40px'>
                    Database Error: " . $e->getMessage() . "<br><br>
                    Pastikan Laragon sudah aktif dan database <b>maldives_landing</b> sudah dibuat.
                </h2>");
            }
        }
        return self::$instance;
    }
}
