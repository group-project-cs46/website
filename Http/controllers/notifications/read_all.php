<?php

use Models\Notification;

$notifications = Notification::getAllByUserId(auth_user()['id']);

foreach ($notifications as $notification) {
    Notification::markAsReadById($notification['id']);
}


redirect(urlBack());