<?php

namespace Components\Database;

use PDO;
use PDOException;

class DB {
    private $pdo;

    public function __construct($dbName = 'bms_data_2024.db') {
        $dbFile = __DIR__ . '/' . $dbName;

        if (!file_exists($dbFile)) {
            try {
                file_put_contents($dbFile, '');
            } catch (Exception $e) {
                die('Failed to create database file: ' . $e->getMessage());
            }
        }

        try {
            $this->pdo = new PDO('sqlite:' . $dbFile);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public function createSysadminTable() {
        $query = "
            CREATE TABLE IF NOT EXISTS sysadmin (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username TEXT NOT NULL UNIQUE,
                password TEXT NOT NULL,
                app_mode TEXT NOT NULL DEFAULT 'dev',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ";
        $this->pdo->exec($query);
    }

    public function createUsersTable() {
        $query = "
            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username TEXT NOT NULL UNIQUE,
                password TEXT NOT NULL,
                first_name TEXT NOT NULL,
                last_name TEXT NOT NULL,
                phone TEXT NOT NULL,
                image_url TEXT,
                role_name TEXT DEFAULT 'user',
                role_designation TEXT DEFAULT 'employee',
                user_status TEXT DEFAULT 'inactive',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ";
        $this->pdo->exec($query);
    }

    public function createBillsTable() {
        $query = "
            CREATE TABLE IF NOT EXISTS bills (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                bill_id TEXT UNIQUE,
                description TEXT,
                food_bill INTEGER DEFAULT 0,
                hall_rent INTEGER DEFAULT 0,
                total_amount INTEGER DEFAULT 0,
                paid_amount INTEGER DEFAULT 0,
                due_amount INTEGER DEFAULT 0,
                mr_no TEXT DEFAULT 'empty',
                submitted_by TEXT DEFAULT 'user',
                updated_by TEXT DEFAULT 'user',
                money_received_by TEXT DEFAULT 'cashier',
                tag TEXT DEFAULT 'none',
                fw_status TEXT DEFAULT 'none',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ";
        $this->pdo->exec($query);
    }

    public function addDefaultAdmin($username = '___admin', $password = '55761910') {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT OR IGNORE INTO sysadmin (username, password) VALUES (:username, :password)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':username' => $username, ':password' => $hashedPassword]);
    }

    public function run() {
        $this->createSysadminTable();
        $this->createUsersTable();
        $this->createBillsTable();
        $this->addDefaultAdmin();
    }
}
