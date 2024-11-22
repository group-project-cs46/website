<?php

namespace Models;

use Core\App;
use Core\Database;

class deleteAd
{
    // Delete an advertisement by ID
    public static function delete($id)
    {
        $db = App::resolve(Database::class);

        // Execute the query to delete the advertisement
        $db->query('DELETE FROM advertisements WHERE id = ?', [$id]);
    }
}
