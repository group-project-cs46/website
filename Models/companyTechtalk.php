<?php

namespace Models;

use Core\App;
use Core\Database;

class companyTechtalk
{
    // Helper method to get the authenticated company_id
    private static function getCompanyId()
    {
        $auth_user = auth_user();
        if (!$auth_user || !isset($auth_user['id'])) {
            throw new \Exception('User not authenticated or company_id not found');
        }
        return $auth_user['id'];
    }

    public static function fetchAll()
    {
        $db = App::resolve(Database::class);
        $company_id = self::getCompanyId();

        $techtalks = $db->query('
            SELECT 
                ts.id AS slot_id, ts.pdc_id, ts.datetime, ts.venue, 
                t.id AS techtalk_id, t.techtalk_slot_id, t.company_id, t.host_name, t.host_email, t.description,
                TO_CHAR(ts.datetime, \'YYYY-MM-DD\') AS date,   
                TO_CHAR(ts.datetime, \'HH12:MI AM\') AS time 
            FROM techtalk_slots ts 
            LEFT JOIN techtalks t ON ts.id = t.techtalk_slot_id
            WHERE t.company_id = :company_id OR t.company_id IS NULL;
        ', ['company_id' => $company_id])->get();
        return $techtalks;
    }

    public static function insertHostDetails($techtalkSlotId, $companyId, $hostName, $hostEmail, $description)
    {
        $db = App::resolve(Database::class);
        $company_id = self::getCompanyId();

        // Ensure the company_id matches the authenticated company
        if ($companyId != $company_id) {
            throw new \Exception('Unauthorized access to insert tech talk details');
        }

        $db->query('INSERT INTO techtalks (techtalk_slot_id, company_id, host_name, host_email, description) VALUES (?,?,?,?,?)', [
            $techtalkSlotId,
            $companyId,
            $hostName,
            $hostEmail,
            $description,
        ]);
        return true;
    }

    public static function updateHostDetails($techtalkId, $hostName, $hostEmail, $description)
    {
        $db = App::resolve(Database::class);
        $company_id = self::getCompanyId();

        // Verify that the tech talk belongs to this company
        $techtalk = $db->query('SELECT company_id FROM techtalks WHERE id = ?', [$techtalkId])->find();
        if (!$techtalk || $techtalk['company_id'] != $company_id) {
            throw new \Exception('Unauthorized access to update tech talk');
        }

        $db->query('UPDATE techtalks SET host_name = ?, host_email = ?, description = ? WHERE id = ?', [
            $hostName,
            $hostEmail,
            $description,
            $techtalkId,
        ]);
        return true;
    }

    public static function deleteHostDetails($techtalkId)
    {
        $db = App::resolve(Database::class);
        $company_id = self::getCompanyId();

        // Verify that the tech talk belongs to this company
        $techtalk = $db->query('SELECT company_id FROM techtalks WHERE id = ?', [$techtalkId])->find();
        if (!$techtalk || $techtalk['company_id'] != $company_id) {
            throw new \Exception('Unauthorized access to delete tech talk');
        }

        $db->query('DELETE FROM techtalks WHERE id = ?', [
            $techtalkId,
        ]);
        return true;
    }
}