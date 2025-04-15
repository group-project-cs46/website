<?php

use Models\Notification;

$notification_id = $_GET['id'];
$notification = Notification::getById($notification_id);

Notification::markAsReadById($notification_id);

redirect($notification['action_url']);