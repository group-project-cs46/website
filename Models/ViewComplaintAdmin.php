<!-- 

namespace Models;

use Core\App;
use Core\Database;

class ViewComplaintAdmin
{  -->
    // public static function getAllWithMessagesAndUserNames()
    // {
    //     $db = App::resolve(Database::class);

    //     $query = "
    //         SELECT 
    //             c.*, 
    //             cm.id AS message_id,
    //             cm.complaint_id,
    //             cm.sender_id,
    //             cm.message,
    //             cm.created_at AS message_created_at,
    //             u.name AS sender_name,
    //             acc.name AS accused_name
    //         FROM complaints c
    //         LEFT JOIN complaint_messages cm ON c.id = cm.complaint_id
    //         LEFT JOIN users u ON cm.sender_id = u.id
    //         LEFT JOIN users acc ON c.accused_id = acc.id
    //         ORDER BY c.id, cm.created_at
    //     ";

    //     return $db->query($query, [])->get();
    // }
//     public static function getAllBasicComplaintDetails()
// {
//     $db = App::resolve(Database::class);

//     $query = "
//         SELECT 
//             c.*, 
//             complainant.name AS complainant_name,
//             accused.name AS accused_name
//         FROM complaints c
//         LEFT JOIN users complainant ON c.complainant_id = complainant.id
//         LEFT JOIN users accused ON c.accused_id = accused.id
//         ORDER BY c.created_at DESC
//     ";

//     return $db->query($query, [])->get();
// }

<?php 

namespace Models;

use Core\App;
use Core\Database;

class ViewComplaintAdmin
{
    public static function getAllBasicComplaintDetails()
    {
        $db = App::resolve(Database::class);

        $query = "
            SELECT 
                c.*, 
                complainant.name AS complainant_name,
                accused.name AS accused_name
            FROM complaints c
            LEFT JOIN users complainant ON c.complainant_id = complainant.id
            LEFT JOIN users accused ON c.accused_id = accused.id
            ORDER BY c.created_at DESC
        ";

        return $db->query($query, [])->get();
    }
}




