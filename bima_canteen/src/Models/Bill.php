<?php

namespace Components\Models;

use PDO;
use PDOException;
use Components\Base\Database;

class Bill extends Database {
    protected $table = 'bills';
    private $pdo;

    public function __construct() {
        $this->pdo = Database::init();
    }

    public function bill_report_all($start_date, $end_date) {
        $sql = "SELECT * FROM bills
                WHERE DATE(created_at) >= DATE(:start_date)
                  AND DATE(created_at) <= DATE(:end_date)
                ORDER BY created_at";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':start_date', $start_date);
            $stmt->bindParam(':end_date', $end_date);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function bill_report_due($start_date, $end_date) {
        $sql = "SELECT * FROM bills
                WHERE DATE(created_at) >= DATE(:start_date)
                  AND DATE(created_at) <= DATE(:end_date)
                  AND due_amount > 0
                ORDER BY created_at";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':start_date', $start_date);
            $stmt->bindParam(':end_date', $end_date);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function bill_report_paid($start_date, $end_date) {
        $sql = "SELECT * FROM bills
                WHERE DATE(created_at) >= DATE(:start_date)
                  AND DATE(created_at) <= DATE(:end_date)
                  AND due_amount = 0
                ORDER BY created_at";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':start_date', $start_date);
            $stmt->bindParam(':end_date', $end_date);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function bill_report_pending($start_date, $end_date) {
        $sql = "SELECT * FROM bills
                WHERE DATE(created_at) >= DATE(:start_date)
                  AND DATE(created_at) <= DATE(:end_date)
                  AND fw_status != 'released'
                ORDER BY created_at";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':start_date', $start_date);
            $stmt->bindParam(':end_date', $end_date);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function all_bill() {
        $sql = "SELECT * FROM " . $this->table;

        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function start_end_date() {
        $sql = "SELECT DATE(MIN(created_at)) AS first_bill_date, DATE(MAX(created_at)) AS last_bill_date FROM " . $this->table;

        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function all() {
        $sql = "SELECT * FROM " . $this->table . " ";

        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function all_co() {
        $sql = "SELECT * FROM " . $this->table . " WHERE fw_status = 'canteen_manager'";

        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function all_ao() {
        $sql = "SELECT * FROM " . $this->table . " WHERE fw_status = 'admin_officer'";

        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function due_amount() {
        $sql = "SELECT * FROM " . $this->table . " WHERE due_amount > 0";

        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function food() {
        $sql = "SELECT * FROM " . $this->table . " WHERE hall_rent = 0 AND fw_status != 'canteen_manager'";

        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function hall() {
        $sql = "SELECT * FROM " . $this->table . " WHERE (hall_rent > 0 AND fw_status != 'canteen_manager')";

        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function paid() {
        $sql = "SELECT * FROM " . $this->table . " WHERE due_amount = 0 AND fw_status != 'canteen_manager'";

        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function pending() {
        $sql = "SELECT * FROM " . $this->table . " WHERE (due_amount > 0 AND fw_status = 'canteen_manager' OR fw_status = 'admin_officer')";

        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function findBill($bill_id) {
        $sql = "SELECT * FROM bills WHERE bill_id = :bill_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['bill_id' => $bill_id]);
        return $stmt->fetch();
    }

    public function search($query) {
        $sql = "SELECT * FROM " . $this->table . " WHERE (bill_id LIKE :query OR tag LIKE :query) AND fw_status != 'canteen_manager'";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':query' => "%$query%"]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function forward_ao($bill_id, $fw_status) {
        $sql = "UPDATE bills SET fw_status = :fw_status WHERE bill_id = :bill_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['bill_id' => $bill_id, 'fw_status' => $fw_status]);
    }

    public function delete_bill($bill_id) {
        $sql = "DELETE FROM bills WHERE bill_id = :bill_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['bill_id' => $bill_id]);
    }

    public function add_hall_rent($bill_id, $hall_rent, $total_amount, $due_amount, $Updated_by) {
        $fw_status = 'released';
        $sql = "UPDATE bills SET hall_rent = :hall_rent, total_amount = :total_amount, due_amount = :due_amount, fw_status = :fw_status, Updated_by = :Updated_by WHERE bill_id = :bill_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'hall_rent' => $hall_rent,
            'total_amount' => $total_amount,
            'due_amount' => $due_amount,
            'bill_id' => $bill_id,
            'fw_status' => $fw_status,
            'Updated_by' => $Updated_by
        ]);
    }

    public function create_bill($bill_id, $description, $food_bill, $total_amount, $paid_amount, $due_amount, $mr_no, $submitted_by, $tag, $fw_status) {
        $sql = "INSERT INTO bills (bill_id, description, food_bill, total_amount, paid_amount, due_amount, mr_no, submitted_by, tag, fw_status) 
                VALUES (:bill_id, :description, :food_bill, :total_amount, :paid_amount, :due_amount, :mr_no, :submitted_by, :tag, :fw_status)";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'bill_id' => $bill_id,
            'description' => $description,
            'food_bill' => $food_bill,
            'total_amount' => $total_amount,
            'paid_amount' => $paid_amount,
            'due_amount' => $due_amount,
            'mr_no' => $mr_no,
            'submitted_by' => $submitted_by,
            'tag' => $tag,
            'fw_status' => $fw_status
        ]);
    }

    public function due_bill() {
        $sql = "SELECT * FROM bills WHERE due_amount > 0 AND fw_status != 'canteen_manager'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function receive_cash($bill_id, $due_amount, $money_received_by, $new_paid, $mr_no) {
        $sql = "UPDATE bills SET due_amount = :due_amount, money_received_by = :money_received_by, paid_amount = :paid_amount, mr_no = :mr_no WHERE bill_id = :bill_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'due_amount' => $due_amount,
            'money_received_by' => $money_received_by,
            'bill_id' => $bill_id,
            'paid_amount' => $new_paid,
            'mr_no' => $mr_no
        ]);
    }
}
