<?php

namespace Models;

use Core\App;
use Core\Database;
use PDOException;

class pdcBlacklistedcompanies  
{
    public static function fetchAll()
    {
        $db = App::resolve(Database::class);
        return $db->query('
            SELECT 
                b.*, 
                u.name, u.email
            FROM blacklist_reasons b
            JOIN users u ON b.company_id = u.id
            WHERE u.disabled = true
        ', [])->get();
    }

    public static function fetchById($id)
    {
        $db = App::resolve(Database::class);
        return $db->query('
            SELECT 
                b.*, 
                u.name, u.email
            FROM blacklist_reasons b
            JOIN users u ON b.company_id = u.id
            WHERE b.company_id = ? AND u.disabled = true
        ', [$id])->find();
    }

    public static function blacklistCompany($companyId, $reason = 'No reason provided')
    {
        $db = App::resolve(Database::class);
        try {
            // Begin transaction
            $db->query('BEGIN', []);

            // Check if the company exists
            $company = $db->query('SELECT id FROM users WHERE id = ?', [$companyId])->find();
            if (!$company) {
                throw new PDOException('Company not found');
            }

            // Perform the update to disable the company
            $db->query("UPDATE users SET disabled = true WHERE id = ?", [$companyId]);

            // Check if the company is already in blacklist_reasons
            $existing = $db->query('SELECT 1 FROM blacklist_reasons WHERE company_id = ?', [$companyId])->find();

            if ($existing) {
                // Update the existing record
                $db->query('UPDATE blacklist_reasons SET reason = ? WHERE company_id = ?', [$reason, $companyId]);
            } else {
                // Insert a new record
                $db->query('INSERT INTO blacklist_reasons (company_id, reason) VALUES (?, ?)', [$companyId, $reason]);
            }

            // Commit transaction
            $db->query('COMMIT', []);

            return 1; // Assume 1 row was affected if no exception is thrown
        } catch (PDOException $e) {
            // Roll back transaction on error
            $db->query('ROLLBACK', []);
            throw new PDOException('Failed to blacklist company: ' . $e->getMessage());
        }
    }

    public static function unblacklist($companyId)
    {
        $db = App::resolve(Database::class);
        try {
            // Begin transaction
            $db->query('BEGIN', []);

            // Check if the company exists
            $company = $db->query('SELECT id FROM users WHERE id = ?', [$companyId])->find();
            if (!$company) {
                throw new PDOException('Company not found');
            }

            // Update the users table
            $db->query("UPDATE users SET disabled = false WHERE id = ?", [$companyId]);

            // Remove the entry from blacklist_reasons
            $db->query("DELETE FROM blacklist_reasons WHERE company_id = ?", [$companyId]);

            // Commit transaction
            $db->query('COMMIT', []);

            return 1; // Assume 1 row was affected if no exception is thrown
        } catch (PDOException $e) {
            // Roll back transaction on error
            $db->query('ROLLBACK', []);
            throw new PDOException('Failed to unblacklist company: ' . $e->getMessage());
        }
    }
}